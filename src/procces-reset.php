<?php
session_start();

$form_url = "/user/reset.php";
if (!(
    isset($_POST["password"])
)) {
    header($form_url);
    die();
}

require_once("./lib/connect.php");

function redirect($field, $msg) {
    $url = sprintf("/user/reset.php?field=%s&msg=%s", $field, $msg);
    header("Location: " . $url);
    die();
}
$password = mysqli_real_escape_string($conn, trim($_POST["password"]));

$id = mysqli_real_escape_string($conn, $_SESSION["user_id"]);


if (preg_match("/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9]).{8,}$/", $password) == 0) {
    // Has minimum 8 characters in length.
    // At least one uppercase English letter.
    // At least one lowercase English letter.
    // At least one digit.
    redirect("password", "Not a valid pattern");
}
    else {
        $update = sprintf(
            <<<SCRIPT
            UPDATE `user` SET password = "%s" WHERE id= %s;
            SCRIPT,
            password_hash($password, PASSWORD_DEFAULT),
            $id
        );
        if (!mysqli_query($conn, $update)) {
            echo "Failed to insert<br>";
        }
        else {
            header("Location: /logout.php");
            die();
        }

}
