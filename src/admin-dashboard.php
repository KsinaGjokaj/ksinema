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
<title>Admin Dashboard</title>
</head>

<body>
    <div class="container1">
    <?php
    require_once("./lib/sidebar.php");
    ?>
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
                <table style="margin-top: 0;">
                    <thead>
                        <tr>
                            <th class="th-table">ID</th>
                            <th>Title</th>
                            <th colspan="3">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $query = "select `film`.`id`, `film`.`title` from `film`;";
                        $res = mysqli_query($conn, $query);
                        if ($res) {
                            while ($arr = mysqli_fetch_assoc($res)) {
                                $id = $arr["id"];
                                $title = $arr["title"];
                                // TODO
                                $show_path = "./film.php";
                                $edit_path = "./edit-film.php";
                                $delete_path = "./delete-film.php";
                        ?>
                                <tr>
                                    <td class="th-table"><?php echo $id; ?></td>
                                    <td class="left-th"><?php echo $title; ?></td>
                                    <!-- CRUD operations -->
                                    <td>
                                        <a class="btn btn-outline-primary" href=<?php printf("\"%s?id=%d\"", $show_path, $id); ?>>
                                            Show
                                        </a>
                                    </td>
                                    <td>
                                        <a class="btn btn-outline-secondary" href=<?php printf("\"%s?id=%d\"", $edit_path, $id); ?>>
                                            Edit
                                        </a>
                                    </td>
                                    <td>
                                        <a class="btn btn-outline-danger" href=<?php printf("\"%s?id=%d\"", $delete_path, $id); ?>>
                                            Delete
                                        </a>
                                    </td>
                                </tr>
                        <?php
                            }
                        }
                        ?>
                    </tbody>
                </table>

            </div>
        </div>
    </div>

    <?php
    require_once("./lib/footer.php");
    ?>

    <script src="./resource/static/js/admin.js"></script>
</body>

</html>