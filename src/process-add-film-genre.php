<?php
session_start();

$form_url = "./add-film-genre.php";
if (!(
        isset($_SESSION["email"]) &&
        isset($_POST["genre-name"])
    )) {
    header("Location: " . $form_url);
    die();
}

require_once("./lib/connect.php");

function redirect($field, $msg)
{
    $url = sprintf("/admin/add-film-genre.php?field=%s&msg=%s", $field, $msg);
    header("Location: " . $url);
    die();
}

$role = mysqli_real_escape_string($conn, trim($_POST["genre-name"]));

if ($_SESSION["role_id"] != ADMIN_ROLE_ID) {
    header("Location: /login/login.php?err=" . "Only admin is allowed to enter this url");
    die();
}


$query = sprintf("select count(*) as cnt from `genre` where `genre`.`name` = \"%s\";", $role);
$result = mysqli_query($conn, $query);
$arr = mysqli_fetch_array($result);

if ($arr["cnt"] != 0) {
    redirect("genre-name", "Already exists");
} else {
    $insert = sprintf(
        <<<QUERY
        insert into `genre`(`name`, `description`)
        values("%s", "%s");
        QUERY,
        mysqli_real_escape_string($conn, trim($_POST["genre-name"])),
        mysqli_real_escape_string($conn, trim($_POST["description"]))
    );
    if (!mysqli_query($conn, $insert)) {
        header("Location: ./add-film-genre.php?err=Database error");
        die();
    }
    else {
        header("Location: ./dashboard.php?ok=Genre added");
        die();
    }
}
