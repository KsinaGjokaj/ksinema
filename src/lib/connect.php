<?php
$conn = mysqli_connect("db", "root", "rootpwd", "cinema") or die("Cannot connect to db");

$__admin_role_id = mysqli_fetch_assoc(mysqli_query(
    $conn,
    <<<ADMIN
    select `role`.`id`
    from `role`
    where `role`.`name` = "admin";
    ADMIN
));

define("ADMIN_ROLE_ID", $__admin_role_id["id"]);
