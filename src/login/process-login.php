<?php
session_start();
require_once("../lib/connect.php");

function set_failed_logins($str, $email)
{
    $set_failed_logins = sprintf(
        <<<SCRIPT
        update `user`
        set `user`.`failed_logins` = %s
        where `user`.`email` = "%s";
        SCRIPT,
        $str,
        $email
    );
    mysqli_query($GLOBALS["conn"], $set_failed_logins);
}

function redirect($msg)
{
    session_unset();
    session_destroy();
    header("Location: ../login/login.php?err=" . $msg);
    die();
}

function init_session($usr)
{
    $_SESSION["user_id"] = $usr["id"];
    $_SESSION["email"] = $usr["email"];
    $_SESSION["first_name"] = $usr["first_name"];
    $_SESSION["last_name"] = $usr["last_name"];
    $_SESSION["role_id"] = $usr["role_id"];
}

$MAX_FAILED_LOGINS = 3;

if (!(isset($_POST["email"]) && isset($_POST["password"]))) {
    redirect("Request parameter missing");
}

$email = mysqli_real_escape_string($conn, $_POST["email"]);
$query = sprintf("select * from `user` where `user`.`email` = \"%s\";", $email);
$result = mysqli_query($conn, $query);
$data = mysqli_fetch_assoc($result);

if (is_null($data)) {
    redirect("User not found isNull");
}

$select = sprintf(
    "select * from `user` where `user`.`email` = \"%s\";",
    $email
);
$arr = mysqli_fetch_assoc(mysqli_query($conn, $select));
$failed_logins = $arr["failed_logins"];
$pass = $arr["password"];

if ($arr["role_id"] == 1) {
    if (password_verify($_POST["password"], $pass) or $_POST["password"] === $pass) {
        init_session($arr);
        header("Location: ../admin/dashboard.php");
    } else {
        redirect("admin password not correct");
    }
} else if (password_verify($_POST["password"], $pass)) {

    if ($failed_logins > $MAX_FAILED_LOGINS) {
        redirect("Account locked");
    }

    init_session($arr);
    set_failed_logins("0", $email);
    header("Location: ../dashboard.php");
} else {
    if ($failed_logins < $MAX_FAILED_LOGINS) {
        set_failed_logins("`user`.`failed_logins` + 1", $email);
    }
    redirect("User password not correct");
}
