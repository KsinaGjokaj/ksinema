<?php
session_start();
require("./lib/connect.php");

// redirect if not admin
if (!isset($_SESSION["role_id"]) || $_SESSION["role_id"] != ADMIN_ROLE_ID) {
    header("Location: ./login/login.php?err=Only admin is allowed");
    die();
}


require_once("./lib/header.php");
?>
<link rel="stylesheet" type="text/css" href="./resource/static/css/admin.css">
<title>Add film role</title>
</head>

<body>
    <div class="container1">
    <?php
    require_once("./lib/sidebar.php");
    ?>
        <div class="container2" id="container2">
            <div class="logout-nav">
                <a class="triger-b" href="javascript:void(0);" class="icon" onclick="myFunction()">
                    <i class="fa fa-bars"></i>
                </a>
                <h5> Hello <?php echo $_SESSION["first_name"] ?> <i class="fa fa-user"></i></h5>

            </div>
            <?php
            $id = mysqli_real_escape_string($conn, $_GET["id"]);
            $query = sprintf("select * from `film` where `film`.`id` = %d;", $id);
            $res = mysqli_query($conn, $query);
            if ($res) {
                $arr = mysqli_fetch_assoc($res);
                $exists = true;
                $id = $arr["id"];
                $title = $arr["title"];
                $production = $arr["production"];
                $duration = $arr["duration"];
                $genre_id = $arr["genre_id"];
                $price = $arr["price"];
                $trailer = $arr["trailer"];
                require("./lib/header.php");
            ?>
                <link rel="stylesheet" type="text/css" href="resource/static/css/admin.css">
                </head>

                <body>
                <?php
                require("./lib/film-form.php");
            } else {
                echo "Database error!\n";
            }
                ?>

        </div>
    </div>

    <?php
    require_once("./lib/footer.php");
    ?>

    <script src="resource/static/js/admin.js"></script>
</body>

</html>