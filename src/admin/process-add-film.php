<?php
session_start();

$form_url = "./add-film.php";
if (!(
        isset($_SESSION["email"]) &&
        isset($_POST["title"]) &&
        isset($_POST["duration"]) &&
        isset($_POST["price"])
    )) {
    header("Location: " . $form_url);
    die();
}

if ($_POST["exists"]) {
    $form_url = "./edit-film.php?id=" . $_POST["id"] . "&err=";
}
else {
    $form_url = $form_url . "?err=";
}

require_once("../lib/connect.php");

if ($_SESSION["role_id"] != ADMIN_ROLE_ID) {
    header("Location: /login/login.php?err=" . "Only admin is allowed to enter this url");
    die();
}



/// Functions

function escape($str) {
    return mysqli_real_escape_string($GLOBALS["conn"], $str);
}

function date_is_in_past($date) {
    $now = explode("/", date("Y/m/d"));
    $now[0] = (int) $now[0];
    $now[1] = (int) $now[1];
    $now[2] = (int) $now[2];

    if ($date[0] < $now[0]) {
        return true;
    }
    else if ($date[0] > $now[0]) {
        return false;
    }
    if ($date[1] < $now[1]) {
        return true;
    }
    else if ($date[1] > $date[1]) {
        return false;
    }
    return $date[2] < $now[2];
}

function structure_data($conn) {
    $data = array(
        "valid" => null,
        "title" => null,
        "production" => null,
        "duration" => null,
        "genre_id" => null,
        "price" => null,
        "trailer" => null,
        "poster" => null,
        "video" => null,
    );

    // title
    $title= trim($_POST["title"]);
    if (strlen($title) > 32) {
        $data["valid"] = "Title too long";
        return $data;
    }
    else {
        $data["title"] = escape($title);
    }

    // production
    if (isset($_POST["production"]) && trim($_POST["production"]) != "") {
        $date = explode("-", $_POST["production"]);
        $cnt = count($date);
        if ($cnt != 0 && $cnt != 3) {
            $data["valid"] = "Invalid date";
            return $data;
        }

        $date[0] = (int) $date[0];
        $date[1] = (int) $date[1];
        $date[2] = (int) $date[2];

        if (!checkdate($date[1], $date[2], $date[0])) {
            $data["valid"] = "Invalid date";
            return $data;
        }

        if (date_is_in_past($date)) {
            $data["production"] = sprintf("%d/%d/%d", $date[0], $date[1], $date[2]);
        }
        else {
            $data["valid"] = "Date is in the future";
            return $data;
        }
    }

    // duration
    $duration = (int) $_POST["duration"];
    if ($duration <= 0) {
        $data["valid"] = "Duration must be positive";
        return $data;
    }
    $data["duration"] = $duration;

    // genre
    if (isset($_POST["genre"])) {
        $genre = escape($_POST["genre"]);
        $query = sprintf("select * from `genre` where `genre`.`id` = %d;", $genre);

        if (!mysqli_query($conn, $query)) {
            $data["valid"] = "Genre not found";
            return $data;
        }
        $data["genre_id"] = $genre;
    }

    // price
    $price = (int) $_POST["price"];
    if ($price <= 0) {
        $data["valid"] = "Price must be positive";
        return $data;
    }
    $data["price"] = $price;

    // trailer
    if (isset($_POST["trailer"])) {
        $trailer = trim($_POST["trailer"]);
        if ($trailer != "") {
            $trailer = escape($trailer);
            $len = strlen($trailer);

            if ($len > 128) {
                $data["valid"] = "URL must be <= 128";
                return $data;
            }
            if ($len == 0) {
                $trailer = "null";
            }

            $data["trailer"] = $trailer;
        }
    }

    // poster
    if (isset($_FILES["poster"]) && $_FILES["poster"]["name"] != null) {
        $dir        = "/resource/media/img/";
        $extensions = array("jpeg", "jpg", "png");
        $file_name  = $_FILES['poster']['name'];
        $file_size  = $_FILES['poster']['size'];
        $file_tmp   = $_FILES['poster']['tmp_name'];
        $file_type  = $_FILES['poster']['type'];
        $a = explode('.', $_FILES['poster']['name']);
        $ext = end($a);
        $file_ext   = strtolower($ext);

        if (!in_array($file_ext, $extensions)) {
            $data["valid"] = "Unsupported file extension";
            return $data;
        }
        if ($file_size > 10 * (2 << 20)) {
            $data["valid"] = "File must be <= 10MB";
            return $data;
        }

        $location = $dir . uniqid("img-", true) . "." . $file_ext;
        $data["poster"] = $location;
        move_uploaded_file($file_tmp, ".." . $location);
    }

    // video
    if (isset($_FILES["video"]) && $_FILES["video"]["name"] != null) {
        $dir        = "/resource/media/video/";
        $extensions = array("mp4");
        $file_name  = $_FILES['video']['name'];
        $file_size  = $_FILES['video']['size'];
        $file_tmp   = $_FILES['video']['tmp_name'];
        $file_type  = $_FILES['video']['type'];
        $a = explode('.', $_FILES['video']['name']);
        $ext = end($a);
        $file_ext   = strtolower($ext);

        if (!in_array($file_ext, $extensions)) {
            $data["valid"] = "Unsupported file extension";
            return $data;
        }
        if ($file_size > 100 * (2 << 20)) {
            $data["valid"] = "File must be <= 100MB";
            return $data;
        }

        $location = $dir . uniqid("vid-", true) . "." . $file_ext;
        $data["video"] = $location;
        move_uploaded_file($file_tmp, ".." . $location);
    }
    else if ($_POST["exists"] != 1) {
        $data["valid"] = "Video must be povided";
        return $data;
    }

    return $data;
}

function generate_insert_query($data, $start, $end) {
    $insert = "insert into `film`(";
    $values = "values(";

    $key = array_keys($data);
    $val = array_values($data);

    for ($i = $start; $i < $end - 1; $i++) {
        $insert = $insert . "`" . $key[$i] . "`, ";
        $quote = "'";
        if ($val[$i] == null) {
            $values = $values . "null, ";
        }
        else {
            $values = $values . "'" . $val[$i] . "', ";
        }
    }

    $insert = $insert . "`" . $key[$end - 1] . "`)\n";
    $i = $end - 1;
    if ($val[$i] == null) {
        $values = $values . "null);";
    }
    else {
        $values = $values . "'" . $val[$end - 1] . "');";
    }

    return $insert . $values;
}

function generate_update_query($data, $start, $end) {
    $update = "update `film` set";
    $key = array_keys($data);
    $val = array_values($data);

    for ($i = $start; $i < $end - 1; $i++) {
        $update = $update . " `film`.`" . $key[$i] ."` = '" . $val[$i] . "',";
    }
    $update = $update . " `film`.`" . $key[$end - 1] ."` = '" . $val[$end - 1] . "'";
    return $update . " where `film`.`id` = " . escape($_POST["id"]) . ";";
}

function generate_query($data, $start, $end) {
    if ($_POST["exists"]) {
        return generate_update_query($data, $start, $end - 2);
    }
    return generate_insert_query($data, $start, $end);
}



/// Main

$data = structure_data($conn);
if ($data["valid"] != null) {
    header("Location: $form_url" . $data["valid"]);
    die();
}

$query = generate_query($data, 1, count($data));
//print "<br>" . $query . "<br>";

if (mysqli_query($conn, $query)) {
    header("Location: ./dashboard.php?ok=Film added");
    die();
}
else {
    header("Location: $form_url" . "Some error occurred");
    die();
}

