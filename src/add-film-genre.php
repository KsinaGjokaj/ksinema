<?php
session_start();
require("./lib/connect.php");

// redirect if not admin
if (!isset($_SESSION["role_id"]) || $_SESSION["role_id"] != ADMIN_ROLE_ID) {
    header("Location: /login/login.php?err=Only admin is allowed");
    die();
}

require_once("./lib/header.php");
?>
<link rel="stylesheet" type="text/css" href="./resource/static/css/admin.css">

<title>Add film genre</title>
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

            <form id="role-form" class="genre" method="post" action="process-add-film-genre.php">
                <h2 class="h-form">Add film genre</h2>
                <div class="ui-message" id="uiMess"></div>
                <div>
                    <label for="genre-name">Genre name</label>
                    <input type="text" id="genre-name" name="genre-name" class="form-control">
                    <span class="error_form"></span>
                </div>
                <div>
                    <label for="description">Description</label>
                    <input type="text" id="description" name="description" class="form-control">
                    <span class="error_form"></span>
                </div>
                <div>
                    <input type="submit" value="submit" class="form-control  btn-sec">
                </div>
            </form>

        </div>
    </div>

    <?php
    require_once("./lib/footer.php");
    ?>
    <script src="resource/static/js/script.js"></script>
    <script src="resource/static/js/admin.js"></script>
</body>

</html>