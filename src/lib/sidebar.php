<div class="nav-bar" id="nav-bar">
            <img class="logo" src="resource/media/img/blackGold.png">
            <a class="triger-a" href="javascript:void(0);" class="icon" onclick="myFunction()">
                <i class="fa fa-bars"></i>
            </a>
            <hr class="hr-nav">
            <ul class="ul-nav">
                <?php
                if (isset($_SESSION["role_id"]) && $_SESSION["role_id"] == ADMIN_ROLE_ID) {
                ?>
                    <li>
                        <h6>Admin</h6>
                    </li>
                    <li class="nav-li"><a href="add-film-genre.php"><i class="fa fa-film"></i> Add film genre</a></li>
                    <li class="nav-li"><a href="add-film.php"><i class="fa fa-file-movie-o"></i> Add film</a></li>
                    <li>
                        <h6>Menu</h6>
                    </li>
                    <li class="nav-li"><a href="index.php"><i class="fa fa-film"></i> Catalogue</a></li>
                    <li class="nav-li"><a href="dashboard.php"><i class="fa fa-user"></i> Purchases</a></li>
                    <li class="nav-li"><a href="admin-dashboard.php"><i class="fa fa-user"></i> Admin Home</a></li>
                    <li class="nav-li"><a href="reset.php"><i class="fa fa-cog"></i> Settings </a></li>
                    <li class="nav-li"><a href="logout.php"><i class="fa fa-power-off"></i> Logout</a></li>
                <?php
                } else {
                ?>
                    <li>
                        <h6>Menu</h6>
                    </li>
                    <li class="nav-li"><a href="index.php"><i class="fa fa-film"></i> Catalogue</a></li>

                    <?php
                    if (isset($_SESSION["email"])) {
                    ?>
                        <li class="nav-li"><a href="dashboard.php"><i class="fa fa-user"></i> Profile</a></li>
                        <li class="nav-li"><a href="reset.php"><i class="fa fa-cog"></i> Settings </a></li>
                        <li class="nav-li"><a href="logout.php"><i class="fa fa-power-off"></i> Logout</a></li>
                    <?php
                    } else {
                    ?>
                        <li class="nav-li"><a href="login.php"><i class="fa fa-user-circle"></i> Log In</a></li>
                        <li class="nav-li"><a href="signup.php"><i class="fa fa-user"></i> Sign Up</a></li>
                <?php
                    }
                }
                ?>
            </ul>
        </div>