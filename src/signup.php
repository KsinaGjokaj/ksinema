<?php
require_once("./lib/header.php");
?>
<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet" type="text/css">
<!--Google api-->
<script src="https://apis.google.com/js/api:client.js"></script>
<script src="./resource/static/js/google.js"></script>
<!--Facebook api-->
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v13.0" nonce="cf7vdor7"></script>
<title>SignUP</title>
</head>

<body>

    <div class="bg_login">

        <a href="./index.php"><img class="logo" src="./resource/media/img/blackGold.png"></a>
        <div class="div-form">
            <form class="form-signup" id="registration-form" method="post" action="procces-signup.php">
                <h2 class="h-form ">Sign up</h2>
                <div class="ui-message" id="uiMess"></div>
                <div>
                    <label for="email">Email:</label>
                    <input class="form-control" autocomplete type="email" name="email" id="email">
                    <span class="error_form input-error"></span>
                </div>
                <div>
                    <label for="first_name">First name:</label>
                    <input class="form-control" type="text" name="first_name" id="first_name">
                    <span class="error_form"></span>
                </div>
                <div>
                    <label for="last_name">Last name:</label>
                    <input class="form-control" type="text" name="last_name" id="last_name">
                    <span class="error_form"></span>
                </div>
                <div>
                    <label for="password">Password:</label>
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
                    <label for="password">Confirm Password:</label>
                    <input class="form-control" type="password" name="password1" id="password1">
                    <span class="error_form" id="errorPass1"></span>
                    <br />
                </div>
                <input type="submit" class="form-control btn-sec">

                </br>
                <div class="orLine">
                    <span class="or">or</span>
                </div>
                </br>
                <div id="name"></div>
                <script>
                    startApp();
                </script> <!--google aouth if success login-->
                <div id="fb-root"></div> <!--google aouth if success login-->

                <div class="row ">
                    <div class="faButtons">
                        <button type="button" id="customBtn" class="buttonText google" data-onsuccess="onSignIn">
                            <i class="fa fa-google">&nbsp;Google</i>
                        </button>
                        <button type="button" class="facebook" style="margin-bottom: 10px;" data-onsuccess="onSignIn">
                            <i class="fa fa-facebook">&nbsp;Facebook</i>
                        </button>
                    </div>
                </div>
                <a class="a_signup" href="./login.php">Log In</a>
            </form>
        </div>


        <footer class="bg-footer">
            <!-- Grid container -->
            <div class="container p-4">
                <!--Grid row-->
                <div class="row ">
                    <!--Grid column-->
                    <div class="col-sm-4  mb-4 mb-md-12 text-center ">
                        <h5 class="text-uppercase gold">Ksina KINEMA</h5>
                        <a class="footer_a" href="#">Register</a></br>
                        <a class="footer_a" href="#">LogIn</a></br>
                        <a class="footer_a" href="https://gitlab.com/fshn/programim-ne-web/kino">Privacy Policy </a>
                    </div>

                    <div class="col-sm-4  mb-4 mb-md-12 text-center">

                        <a class="footer_a" href="https://gitlab.com/fshn/programim-ne-web/kino">Help Center</a></br>
                        <a class="footer_a" href="https://gitlab.com/fshn/programim-ne-web/kino">About Us</a>
                    </div>
                    <div class="col-sm-4 mb-4 mb-md-5 text-center">
                        <h5 class="gold">Social Media</h5>

                        <a class="btn btn-primary s-media" style="background-color: #3b5998;" href="#" role="button">
                            <i class="fa fa-facebook"></i>
                        </a>
                        <!-- Youtube -->
                        <a class="btn btn-primary s-media" style="background-color: #ed302f;" href="#" role="button">
                            <i class="fa fa-youtube"></i>
                        </a>
                        <a class="btn btn-primary s-media" style="background-color: #333333;" href="#" role="button">
                            <i class="fa fa-github"></i>
                        </a>
                        <!-- Stack overflow -->
                        <a class="btn btn-primary s-media" style="background-color: #ffac44;" href="#" role="button">
                            <i class="fa fa-stack-overflow"></i>
                        </a>
                    </div>
                </div>
            </div>
        </footer>

        <div class="text-center copy-right p-3">
            © 2024
        </div>

    </div>

    <script src="./resource/static/js/script.js"></script>


</body>
<html>