<?php
session_start();
require_once("./lib/connect.php");

// redirect if there is no session
if (!isset($_SESSION["first_name"])) {
    header("Location: login/login.php");
    die();
}

require_once("./lib/connect.php");
require_once("./lib/header.php");
?>
<link rel="stylesheet" type="text/css" href="./resource/static/css/admin.css">

<title>Dashboard</title>
</head>

<body>
    <div class="container1">
        <div class="nav-bar" id="nav-bar">
            <img class="logo" src="./resource/media/img/blackGold.png">
            <a class="triger-a" href="javascript:void(0);" class="icon" onclick="myFunction()">
                <i class="fa fa-bars"></i>
            </a>
            <hr class="hr-nav">
            <ul class="ul-nav">

                <li>
                    <h6>Dashboard</h6>
                </li>
                <li class="nav-li"><a href="./dashboard.php"><i class="fa fa-user"></i> Profile</a></li>
                <li class="nav-li"><a href="./index.php"><i class="fa fa-film"></i> Catalogue</a></li>
                <li class="nav-li"><a href="./user/reset.php"><i class="fa fa-sliders"></i> Settings</a></li>
                <li class="nav-li"><a href="./logout.php"><i class="fa fa-power-off"></i> Log Out</a></li>
            </ul>
        </div>
        <div class="container2" id="container2">
            <div class="logout-nav" style="padding-top: 5px;">
                <a class="triger-b" href="javascript:void(0);" class="icon" onclick="myFunction()">
                    <i class="fa fa-bars"></i>
                </a>
                <h5 style="margin-bottom: 0;">
                    Hello <?php echo $_SESSION["first_name"] ?> <i class="fa fa-user"></i>
                </h5>

            </div>
            <div class="div-body">
                <h2>Data:</h2>
                <ul>
                    <li>User ID: <?php echo $_SESSION["user_id"] ?></li>
                    <li>First name: <?php echo $_SESSION["first_name"] ?></li>
                    <li>Last name: <?php echo $_SESSION["last_name"] ?></li>
                    <li>Email: <?php echo $_SESSION["email"] ?></li>
                </ul>
            </div>


            <div class="div-body">
                <h2>Purchases:</h2>
                <hr>
                <div class="filmat container">
                    <div class="row fil">
                        <?php
                        $id = mysqli_real_escape_string($conn, $_SESSION["user_id"]);
                        $query = <<<QUERY
                        select `film`.`id` as `film_id`, `film`.`title` as `title`, `film`.`poster` as `poster`, `purchase`.`purchase_date` as `date`
                        from `user` inner join `purchase`
                                    on `user`.`id` = `purchase`.`user_id`
                                    inner join `film`
                                    on `film`.`id` = `purchase`.`film_id`
                        where `user`.`id` = $id;
                    QUERY;
                        $res = mysqli_query($conn, $query);
                        while ($arr = mysqli_fetch_assoc($res)) {
                        ?>
                            <div class="filmi filmi-response ">
                                <a href=<?php echo "'./film.php?id=$id'" ?>>
                                    <div class="poster shadow">
                                        <a href=<?php echo '"./film.php?id=' . $arr["film_id"] . '"' ?>>
                                            <?php printf("<img src=\"%s\">", '.' . $arr["poster"]) ?></a>
                                        <b class="download shadow rounded">
                                            <a href=<?php echo "'./download.php?id=" . $arr["film_id"] . "'" ?>>
                                                <i class="fa fa-download" aria-hidden="true"></i>
                                            </a>
                                        </b>
                                    </div>
                                </a>
                                <div class="titulli">
                                    <p>
                                        <a href=<?php echo '"./film.php?id=' . $arr["film_id"] . '"' ?> class="text-decoration-none text-reset">
                                            <?php
                                            printf("%s ", $arr["title"]);

                                            ?>
                                        </a>
                                        </br>
                                        <?php
                                        ?>
                                        <i class="left"><?php printf("<b>Purchase date:</b> %s .", $arr["date"]) ?></i>
                                    </p>
                                </div>
                            </div>
                        <?php
                        }
                        ?>
                    </div>
                </div>
            </div>



            <div class="container2">

                <hr>
            </div>
            <div class="div-body">
                <h2>Rentals:</h2>
                <hr>
                <div class="filmat container">
                    <div class="row fil">
                        <?php
                        $id = mysqli_real_escape_string($conn, $_SESSION["user_id"]);
                        $query = <<<QUERY
                        select  `film`.`id` as `film_id`,
                                `film`.`title` as `title`,`film`.`poster` as `poster`,
                                `rental`.`start_date` as `start`,
                                `rental`.`end_date` as `end`
                        from `user` inner join `rental`
                                        on `user`.`id` = `rental`.`user_id`
                                    inner join `film`
                                        on `film`.`id` = `rental`.`film_id`
                        where `user`.`id` = $id;
                    QUERY;
                        $res = mysqli_query($conn, $query);
                        while ($arr = mysqli_fetch_assoc($res)) {
                        ?>
                            <div class="filmi filmi-response ">
                                <a href=<?php echo "'./film.php?id=$id'" ?>>
                                    <div class="poster shadow">
                                        <a href=<?php echo '"./film.php?id=' . $arr["film_id"] . '"' ?>>
                                            <?php printf("<img src=\"%s\">", '.' . $arr["poster"]) ?></a>
                                        <b class="download shadow rounded">
                                            <a href=<?php echo "'./stream.php?id=" . $arr["film_id"] . "'" ?>>
                                                <i class="fa fa-play-circle" aria-hidden="true"></i>
                                            </a>
                                        </b>
                                    </div>
                                </a>
                                <div class="titulli">
                                    <p>
                                        <a href=<?php echo '"./film.php?id=' . $arr["film_id"] . '"' ?> class="text-decoration-none text-reset">
                                            <?php
                                            printf("%s ", $arr["title"]);

                                            ?>
                                        </a>
                                        </br>
                                        <?php
                                        ?>
                                        <i class="left"><?php printf("%s - %s", $arr["start"], $arr["end"]) ?></i>
                                    </p>
                                </div>
                            </div>
                        <?php
                        }
                        ?>
                    </div>
                </div>
            </div>

        </div>
    </div>


    <?php
    require_once("./lib/footer.php");
    ?>
    <script src="resource/static/js/admin.js"></script>
</body>

</html>