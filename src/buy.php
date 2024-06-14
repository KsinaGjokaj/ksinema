<?php
session_start();
require_once("./lib/connect.php");

if (!isset($_POST["film"]) || !isset($_SESSION["user_id"])) {
    print "Error!\n";
    print "User and film id are required!\n";
} else {
    $film_id = mysqli_real_escape_string($conn, $_POST["film"]);
    $user_id = mysqli_real_escape_string($conn, $_SESSION["user_id"]);

    $res = mysqli_query(
        $conn,
        <<<QUERY
        select count(*)
        from `purchase`
        where `purchase`.`film_id` = $film_id and `purchase`.`user_id` = $user_id;
        QUERY
    );
    $check = mysqli_fetch_array($res);

    if ($check[0] != 0) {
?>
        <style>
            body {
                text-align: center;
                padding: 40px 0;
                background: #EBF0F5;
            }

            h1 {
                color: #88B04B;
                font-family: "Nunito Sans", "Helvetica Neue", sans-serif;
                font-weight: 900;
                font-size: 40px;
                margin-bottom: 10px;
            }

            p {
                color: #404F5E;
                font-family: "Nunito Sans", "Helvetica Neue", sans-serif;
                font-size: 20px;
                margin: 0;
            }

            i {
                color: #9ABC66;
                font-size: 100px;
                line-height: 200px;
                margin-left: -15px;
            }

            .card {
                background: white;
                padding: 60px;
                border-radius: 4px;
                box-shadow: 0 10px 20px -5px #61855d85;
                display: inline-block;
                margin: 0 auto;
            }

            a {
                text-decoration: none;
                color: green;
                cursor: pointer;
            }

            a::before {
                content: ' < ';
            }
        </style>

        <div class="card">
            <div style="border-radius:200px; height:200px; width:200px; background: #F8FAF5; margin:0 auto;">
                <i class="checkmark">✓</i>
            </div>
            <h1>You already own this film</h1>
            <p><a href="./dashboard.php">Go to dashboard</a></p>
        </div>
        <?php
    } else {
        $res = mysqli_query(
            $conn,
            <<<QUERY
            select count(*)
            from `film`
            where `film`.`id` = $film_id;
            QUERY
        );
        $check = mysqli_fetch_array($res);
        if ($check[0] != 1) {
            print "Film with id = $film_id, does not exists.\n";
        } else {
            $now = date("Y-m-d");
            $res = mysqli_query(
                $conn,
                <<<QUERY
                insert into `purchase`(`purchase`.`film_id`, `purchase`.`user_id`, `purchase`.`purchase_date`)
                values ($film_id, $user_id, "$now");
                QUERY
            );
            if ($res) {
        ?>
                <style>
                    body {
                        text-align: center;
                        padding: 40px 0;
                        background: #EBF0F5;
                    }

                    h1 {
                        color: #88B04B;
                        font-family: "Nunito Sans", "Helvetica Neue", sans-serif;
                        font-weight: 900;
                        font-size: 40px;
                        margin-bottom: 10px;
                    }

                    p {
                        color: #404F5E;
                        font-family: "Nunito Sans", "Helvetica Neue", sans-serif;
                        font-size: 20px;
                        margin: 0;
                    }

                    i {
                        color: #9ABC66;
                        font-size: 100px;
                        line-height: 200px;
                        margin-left: -15px;
                    }

                    .card {
                        background: white;
                        padding: 60px;
                        border-radius: 4px;
                        box-shadow: 0 10px 20px -5px #61855d85;
                        display: inline-block;
                        margin: 0 auto;
                    }

                    a {
                        text-decoration: none;
                        color: green;
                        cursor: pointer;
                    }

                    a::before {
                        content: ' < ';
                    }
                </style>

                <div class="card">
                    <div style="border-radius:200px; height:200px; width:200px; background: #F8FAF5; margin:0 auto;">
                        <i class="checkmark">✓</i>
                    </div>
                    <h1>Success</h1>
                    <p><a href="/dashboard.php">Go to dashboard</a></p>
                </div>

<?php
            } else {
                print "Error while registing the purchase";
            }
        }
    }
}
?>