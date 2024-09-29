<?php
session_start();
require("./lib/header.php");
require_once("./lib/connect.php");
?>
<title>Catalogue</title>
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

                <?php
                if (isset($_SESSION["email"])) {
                ?>
                    <h5> Hello <?php echo $_SESSION["first_name"] ?> <i class="fa fa-user"></i></h5>
                <?php
                } else {
                ?>

                <?php
                }
                ?>

            </div>

            <div id="searchbox" class="container-fluid" ">
        <div>
            <form role=" search" method="POST" action="Result.php">
                <input type="text" class="form-control" name="keyword" style="width:80%;margin:20px 10% 20px 10%;" placeholder="Search for a Movie, Genre Or Description">
                </form>
            </div>
        </div>
        <hr style="border: 2px solid black">
        <div class="filmat container">
            <div class="row fil">


                <?php
                $keyword = $_POST['keyword'];
                $query = "select *from genre inner join film on genre.id = film.genre_id
         where film.title like '%{$keyword}%' OR
               genre.name like '%{$keyword}%' OR genre.description like '%{$keyword}%'";


                $res = mysqli_query($conn, $query);
                echo '<div class="container-fluid" id="books">
          <div class="col-xs-12 text-center" id="heading">
                 <h4 style="color:#d2bb6b;text-transform:uppercase;"> found  ' . mysqli_num_rows($res) . ' records </h4>
           </div>
        </div>';
                while ($arr = mysqli_fetch_assoc($res)) {
                    $poster = $arr["poster"];
                    $id = $arr["id"];
                ?>
                    <div class="filmi filmi-response ">
                        <a href=<?php echo "'/film.php?id=$id'" ?>>
                            <div class="poster shadow">
                                <a href=<?php echo '"/film.php?id=' . $arr["id"] . '"' ?>>
                                    <?php printf("<img src=\"%s\">", '.' . $arr["poster"]) ?></a>
                                <b class="price shadow rounded">
                                    <?php printf("%s $", $arr["price"]) ?>
                                </b>
                            </div>
                        </a>
                        <div class="titulli">
                            <p>
                                <a href=<?php echo '"/film.php?id=' . $arr["id"] . '"' ?> class="text-decoration-none text-reset">
                                    <?php
                                    printf("%s ", $arr["title"]);
                                    printf("(%s)", $arr["production"]);
                                    ?>
                                </a>
                                </br>
                                <?php
                                printf("<a href=\"%s\"> <i class='fa fa-youtube-play gold'> Trailer</i></a>", $arr["trailer"], $arr["trailer"]); ?>
                                <i class="right"><?php printf("%s min", $arr["duration"]) ?></i>
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


    <?php
    require_once("./lib/footer.php");
    ?>

    <script src="./resource/static/js/script.js"></script>
    <script src="./resource/static/js/admin.js"></script>



    </script>
</body>

</html>