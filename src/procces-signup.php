<?php
$form_url = "/signup/signup.php";
if (!(
    isset($_POST["email"]) &&
    isset($_POST["first_name"]) &&
    isset($_POST["last_name"]) &&
    isset($_POST["password"])
)) {
    header($form_url);
    die();
}

require_once("./lib/connect.php");

function redirect($field, $msg) {
    $url = sprintf("/signup/signup.php?field=%s&msg=%s", $field, $msg);
    header("Location: " . $url);
    die();
}

$email = mysqli_real_escape_string($conn, trim($_POST["email"]));
$first_name = mysqli_real_escape_string($conn, trim($_POST["first_name"]));
$last_name = mysqli_real_escape_string($conn, trim($_POST["last_name"]));
$password = mysqli_real_escape_string($conn, trim($_POST["password"]));

$first_len = strlen($first_name);
$last_len = strlen($last_name);

if (strlen($email) >= 128) {
    redirect("email", "Length >= 128");
}
else if (preg_match("/^(([^<>()[\]\.,;:\s@\"]+(\.[^<>()[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i", $email) == 0) {
    redirect("email", "Not a valid pattern");
}
else if (!($first_len >= 3 && $first_len < 32)) {
    redirect("first_name", "Does not have valid length");
}
else if (!($last_len >= 3 && $last_len < 32)) {
    redirect("last_name", "Does not have valid length");
}
else if (preg_match("/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9]).{8,}$/", $password) == 0) {
    // Has minimum 8 characters in length.
    // At least one uppercase English letter.
    // At least one lowercase English letter.
    // At least one digit.
    // At least one special character.
    redirect("password", "Not a valid pattern");
}
else {
    $query = sprintf("select count(*) as cnt from `user` where `user`.`email` = \"%s\";", $email);
    $result = mysqli_query($conn, $query);
    $arr = mysqli_fetch_array($result);
    if ($arr["cnt"] != 0) {
        redirect("email", "Already exists");
    }
    else {
        $insert = sprintf(
            <<<SCRIPT
            insert into `user`(`email`, `first_name`, `last_name`, `role_id`, `password`)
            values("%s", "%s", "%s", 2, "%s");
            SCRIPT,
            $email,
            $first_name,
            $last_name,
            password_hash($password, PASSWORD_DEFAULT)
        );
        if (!mysqli_query($conn, $insert)) {
            echo "Failed to insert<br>";
        }
        else {
            header("Location: ./login.php");
            die();
        }
    }
}

