<?php
session_start();
require_once("../lib/connect.php");
// redirect if there is no session
if (!isset($_SESSION["first_name"])) {
    header("Location: login/login.php");
    die();
}

require_once("../lib/connect.php");
require_once("../lib/header.php");
?>
<link rel="stylesheet" type="text/css" href="../resource/static/css/admin.css">
<title>Settings</title>
</head>

<body>
    <div class="container1">
        <div class="nav-bar" id="nav-bar">
            <img class="logo" src="../resource/media/img/blackGold.png">
            <a class="triger-a" href="javascript:void(0);" class="icon" onclick="myFunction()">
                <i class="fa fa-bars"></i>
            </a>
            <hr class="hr-nav">
            <ul class="ul-nav">

                <li>
                    <h6>Dashboard</h6>
                </li>
                <li><a href="../dashboard.php"><i class="fa fa-user"></i> Profile</a></li>
                <li><a href="../catalogue.php"><i class="fa fa-film"></i> Catalogue</a></li>
                <li><a href="reset.php"><i class="fa fa-sliders"></i> Settings</a></li>
                <li><a href="../logout.php"><i class="fa fa-power-off"></i> Log Out</a></li>
            </ul>
        </div>
        <div class="container2" id="container2">
            <div class="logout-nav">
                <a class="triger-b" href="javascript:void(0);" class="icon" onclick="myFunction()">
                    <i class="fa fa-bars"></i>
                </a>
                <h5> Hello <?php echo $_SESSION["first_name"] ?> <i class="fa fa-user"></i></h5>

            </div>

            <form class="form-reset" id="reset-form" method="post" action="procces-reset.php">
                <h2 class="h-form">Reset Password</h2>
                <div class="ui-message" id="uiMess"></div>
                <div>
                    <label for="password">New Password</label>
                    <input class="form-control" type="password" name="password" id="password">
                    <span class="error_form" id="errorPass"></span>
                    <ul class="validimePass hidden ">
                        Password must contain:
                        <li class="charE "> Minimum 8 characters in length.</li>
                        <li class="upper"> At least one uppercase English letter.</li>
                        <li class="lower"> At least one lowercase English letter.</li>
                        <li class="digit"> At least one digit.</li>
                    </ul>
                </div>
                <div>
                    <label for="password">Repeat New Password</label>
                    <input class="form-control" type="password" name="password1" id="password1">
                    <span class="error_form" id="errorPass1"></span>
                </div>
                <div>
                    <input type="submit" value="submit" class="form-control  btn-sec">
                </div>
            </form>

        </div>
    </div>

    <?php
    require_once("../lib/footer.php");
    ?>
    <script src="../resource/static/js/script.js"></script>
    <script src="../resource/static/js/admin.js"></script>
</body>

</html>