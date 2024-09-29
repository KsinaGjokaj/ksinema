<?php
session_start();
require_once("./lib/connect.php");
require_once("./lib/header.php");

// redirect if there is no session
if (!isset($_SESSION["first_name"])) {
    header("Location: login/login.php");
    die();
}
?>
<link rel="stylesheet" type="text/css" href="resource/static/css/admin.css">
<title>Stream</title>
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
            if (!isset($_GET["id"])) {
                print "No film selected.\n";
            } else {
                $user_id = mysqli_real_escape_string($conn, $_SESSION["user_id"]);
                $film_id = mysqli_real_escape_string($conn, $_GET["id"]);
                $query = <<<QUERY
                select * from `rental`
                where `film_id` = $film_id and `user_id` = $user_id
                order by `end_date` desc
                limit 1;
            QUERY;
                $res = mysqli_query($conn, $query);
                if ($res) {
                    $arr = mysqli_fetch_assoc($res);
                    if (date("Y-m-d") <= $arr["end_date"]) {
                        $query = <<<QUERY
                        select `video`
                        from `film`
                        where `id` = $film_id;
                    QUERY;
                        $video = mysqli_fetch_array(mysqli_query($conn, $query))[0];
            ?>
                        <video controls class="videoja">
                            <source src=<?php echo ".$video" ?> type="video/mp4">
                        </video>
            <?php
                    } else {
                        print "It has expired.\n";
                    }
                } else {
                    print "You haven't purchase this film.\n";
                }
            }
            ?>
        </div>
    </div>

    <?php
    require_once("lib/footer.php");
    ?>
    <script src="resource/static/js/script.js"></script>
    <script src="resource/static/js/admin.js"></script>
</body>

</html>