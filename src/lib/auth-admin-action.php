<?php
session_start();
require_once("connect.php");
require_once("header.php");
?>
<link rel="stylesheet" type="text/css" href="resource/static/css/admin.css">
</head>

<body>
    <?php
    $allow = false;

    if (!isset($_SESSION["role_id"]) || $_SESSION["role_id"] != ADMIN_ROLE_ID) {
        echo "Permission denied!</br>";
        echo "User: " . $_SESSION["email"] . ", does <b>NOT</b> have admin privileges</br>";
    } else if (!isset($_GET["id"])) {
        echo "Film ID not provided";
    } else {
        $allow = true;
    }
    ?>