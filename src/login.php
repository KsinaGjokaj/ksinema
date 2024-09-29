<?php
require_once("./lib/header.php");
?>
<!--Google api-->
<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet" type="text/css">
<!--Google api-->
<script src="https://apis.google.com/js/api:client.js"></script>
<script src="./resource/static/js/google.js"></script>
<!--Facebook api-->
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v13.0" nonce="cf7vdor7"></script>
<title>Login</title>
</head>

<body class="bg_login d-flex flex-column" style="min-height: 0;">
    <a href="./index.php"> <img class="logo" style="position: absolute;" src="./resource/media/img/blackGold.png"></a>
    <main>
        <div class="div-form" style="margin-top: 100px;">
            <form id="login-form" class="form-login" method="post" action="process-login.php">
                <h2 class="h-form">Log In</h2>

                <div class="ui-message" id="uiMessage_Login">
                    Sorry, we can't find an account with this email address.
                    Please try again or <a href="./signup.php">create a new account</a>.
                </div>
                <div>
                    <label for="email">Email:</label>
                    <input type="text" id="email" name="email" class="form-control">
                    <span class="error_form"></span>
                </div>
                <div>
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" class="form-control">
                    <span class="error_form"></span>
                </div>

                <div>
                    <input type="submit" value="Log In" class="form-control  btn-sec">
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
                                <i class="fa fa-google"> Google</i>
                            </button>
                            <button type="button" class="facebook" data-onsuccess="onSignIn">
                                <i class="fa fa-facebook"> Facebook</i>
                            </button>
                        </div>
                    </div>
                    <a class="a_signup" href="./signup/signup.php">Sign up now</a>
                </div>
            </form>
        </div>
    </main>

    <footer class="bg-footer">
        <!-- Grid container -->
        <div class="container p-4">
            <!--Grid row-->
            <div class="row ">
                <!--Grid column-->
                <div class="col-sm-4  mb-4 mb-md-12 text-center ">
                    <h5 class="text-uppercase gold">Ksina KINEMA</h5>
                    <a class="footer_a" href="./signup.php">Register</a></br>
                    <a class="footer_a" href="./login.php">LogIn</a></br>

                </div>

                <div class="col-sm-4  mb-4 mb-md-12 text-center">

                    </br>

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
    <div class="text-center copy-right p-3" style="background-color: black;">
        © 2024
    </div>

    </div>


    <script src="./resource/static/js/script.js"></script>


</body>

</html>