<?php
session_start();
require_once("./lib/connect.php");
require_once("./lib/header.php");
?>
<link rel="stylesheet" type="text/css" href="resource/static/css/admin.css">
<title>Film page</title>
<script src="https://www.paypal.com/sdk/js?client-id=sb&enable-funding=venmo&currency=USD" data-sdk-integration-source="button-factory"></script>

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
          <h6>Menu</h6>
        </li>
        <li class="nav-li"><a href="index.php"><i class="fa fa-home"></i> Home</a></li>
        <?php
        if (isset($_SESSION["email"])) {
        ?>
          <li class="nav-li"><a href="dashboard.php"><i class="fa fa-user"></i> User Home</a></li>
          <li class="nav-li"><a href="logout.php"><i class="fa fa-power-off"></i> Logout</a></li>
        <?php
        } else {
        ?>
          <li class="nav-li"><a href="./login/login.php"><i class="fa fa-user-circle"></i> Log In</a></li>
          <li class="nav-li"><a href="./signup/signup.php"><i class="fa fa-user"></i> Sign Up</a></li>
        <?php
        }
        ?>
      </ul>
    </div>
    <div class="container2" id="container2">
      <div class="logout-nav">
        <a class="triger-b" href="javascript:void(0);" class="icon" onclick="myFunction()">
          <i class="fa fa-bars"></i>
        </a>
        <!--Search-->


      </div>
      <div class="container filmi_div">
        <div class="row">
          <div class="col-sm borderi" style="text-align: center; margin-top: 40px;">
            <?php
            $id = $_GET["id"];
            $query = "select * from `film` where `film`.`id` = " .
              mysqli_real_escape_string($conn, $id) . ";";
            $res = mysqli_query($conn, $query);
            if ($res) {
              $arr = mysqli_fetch_assoc($res);
            ?>
              <div class="container">
                <div id="headerPopup" class="mfp-hide embed-responsive embed-responsive-21by9">
                  <iframe id="myUrl" class="embed-responsive-item" width="854" height="480" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                </div>
                <?php


                printf("<img src=\"%s\">", '.' . $arr["poster"]);
                printf("</div>  </div> <div class='col-sm size-top'>");

                // printf("<h5><a href=\"/download.php?id=%s\">download</a></h5>", $id);
                printf("<span><span class='gold font'>Title: </span> %s</span><br>", $arr["title"]);
                printf("<span><span class='gold font'>Production: </span>%s</span><br>", $arr["production"]);
                printf("<span><span class='gold font'>Duration: </span>%s min</span><br>", $arr["duration"]);
                printf("<span><span class='gold font'>Price: </span>%s $</span><br>", $arr["price"]);
                printf("<a href='#headerPopup' id='headerVideoLink' target='_blank' class='font'> <i class='fa fa-youtube-play gold'> Trailer</i></a>");
                printf("");

                if (isset($_SESSION["user_id"])) {
                ?>


                  <form action="rent.php" method="post">
                    <input type="hidden" id="film" name="film" value=<?php echo "'$id'" ?>>
                    <input type="submit" id="submit" name="submit" value="Rent for 3 days" class="form-control btn-sec">
                  </form>
                  </br>
                  <form action="buy.php" method="post">
                    <input type="hidden" id="film" name="film" value=<?php echo "'$id'" ?>>

                    <input style="display: none;" type="submit" id="submit" name="submit" value="Buy" class="form-control btn-sec buyBtn">
                  </form>

                  </br>


                  <div id="smart-button-container">
                    <div style="text-align: center;">
                      <div id="paypal-button-container"></div>
                    </div>
                  </div>
                  <script>
                    function initPayPalButton() {
                      paypal.Buttons({
                        style: {
                          shape: 'rect',
                          color: 'gold',
                          layout: 'vertical',
                          label: 'paypal',

                        },

                        createOrder: function(data, actions) {
                          return actions.order.create({
                            purchase_units: [{
                              "amount": {
                                "currency_code": "USD",
                                "value": <?php echo $arr["price"] ?>
                              }
                            }]
                          });
                        },

                        onApprove: function(data, actions) {
                          return actions.order.capture().then(function(orderData) {

                            // Full available details
                            console.log('Capture result', orderData, JSON.stringify(orderData, null, 2));

                            // Show a success message within this page, e.g.
                            const element = document.getElementById('paypal-button-container');
                            element.innerHTML = '';
                            element.innerHTML = '<h3>Thank you for your payment!</h3>';
                            // Or go to another URL:  actions.redirect('thank_you.html');
                            document.querySelector('.buyBtn').click()
                          }).catch(err => {
                            console.log('err catcher', err);
                          })
                        },
                        onCancel: function(cancel) {
                          //cancel like aprove bcz we dont have money :/
                          document.querySelector('.buyBtn').click()
                        },
                        onError: function(err) {
                          console.log(err);

                        },
                      }).render('#paypal-button-container');
                    }
                    initPayPalButton();
                  </script>



                <?php
                }
                ?>
              </div>
          </div>
        <?php
            } else {
              echo "Cannot find film with id = " . $id;
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

  <!--Video pop up-->
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.0.0/magnific-popup.min.css" rel="stylesheet">
  <link href="resource/static/css/style.css" rel="stylesheet">

  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.0.0/jquery.magnific-popup.min.js"></script>
  <script>
    const str = '<?php printf('%s', $arr["trailer"]); ?>'
    // const slug = str.split('=').pop();
    // var url = "https://www.youtube.com/embed/" + slug + "?autoplay=0";
    // console.log(url);
    var a = document.getElementById('myUrl'); //or grab it by tagname etc
    a.src = str;
    //    https://www.youtube.com/embed/qN3OueBm9F4?autoplay=1
    //	  https://www.youtube.com/watch?v=qN3OueBm9F4          shembulliii

    $(document).ready(function() {
      $('#headerVideoLink').magnificPopup({
        type: 'inline',
        midClick: true // Allow opening popup on middle mouse click. Always set it to true if you don't provide alternative source in href.
      });
    });
  </script>



</body>

</html>