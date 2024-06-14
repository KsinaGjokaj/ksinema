<?php
session_start();
require_once("./lib/connect.php");

if (!isset($_SESSION["user_id"])) {
    header("Location: /login/login.php");
    die();
}

$film_id = mysqli_real_escape_string($conn, $_GET["id"]);
$user_id = mysqli_real_escape_string($conn, $_SESSION["user_id"]);

$check = <<<QUERY
    select count(*)
    from `purchase`
    where `purchase`.`user_id` = $user_id and `purchase`.`film_id` = $film_id;
QUERY;

if (mysqli_fetch_array(mysqli_query($conn, $check))[0] > 0) {
    $query = <<<QUERY
        select `film`.`video`
        from `film`
        where `film`.`id` = "$film_id";
    QUERY;
    $res = mysqli_query($conn, $query);
    if ($res) {
        $arr = mysqli_fetch_assoc($res);
        $filepath = substr($arr["video"], 1);
        if (file_exists($filepath)) {
            header('Content-Description: File Transfer');
            header('Content-Type: video/mp4');
            header('Content-Disposition: attachment; filename="'.basename($filepath).'"');
            header('Pragma: public');
            header('Content-Length: ' . filesize($filepath));
            header('Content-Transfer-Encoding: binary');
            flush();

            readfile($filepath);
            die();
        }
        else {
            echo "file: $filepath does not exists";
        }
    }
    else {
        echo "database error.";
        echo "film id = " . $film_id;
    }
}
else {
    print "You haven't bought this movie yet!\n";
}

