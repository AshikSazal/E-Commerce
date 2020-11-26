<?php
session_start();
if(!isset($_SESSION['username'])){
  $_SESSION['username']='';
  $_SESSION['logout']='';
}
require_once("front_footer_side.php");
require_once("front_upper_side.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <title>E-Commerce</title>
  <link rel="icon" href="image/logo.jpg">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="style/front_upper_footer_side.css">
  <link rel="stylesheet" href="fontawesome\css\all.min.css">
  <link rel="stylesheet" href="style/front_page.css">
  <link rel="stylesheet" href="style\bootstrap.min.css">
  <script src="js/jquery.js"></script>
  
</head>

<body>

  <div>
    <?php fun1($_SESSION['username'],$_SESSION['logout']); ?>
  </div>

    <div class="front-pic">
      <div id="pic-link" class="front-pic2">
        <img class="slide-pic" src="image/pic0.jpg">
      </div>
      <div class="front-pic2">
        <img class="slide-pic" src="image/pic1.jpg">
      </div>
      <div class="front-pic2">
        <img class="slide-pic" src="image/pic2.jpg">
      </div>
      <div class="front-pic2">
        <img class="slide-pic" src="image/pic3.jpg">
      </div>
      <div class="front-pic2">
        <img class="slide-pic" src="image/pic4.jpg">
      </div>
      <button class="left-btn" onclick="prev()"><i class="fa fa-arrow-left"></i></button>
      <button class="right-btn" onclick="next()"><i class="fa fa-arrow-right"></i></button>
    </div>

    <div class="slide-dot">
      <span class="dot" onclick="currentSlide(0)"></span>
      <span class="dot" onclick="currentSlide(1)"></span>
      <span class="dot" onclick="currentSlide(2)"></span>
      <span class="dot" onclick="currentSlide(3)"></span>
      <span class="dot" onclick="currentSlide(4)"></span>
    </div>

        <div class="row middle">
          <div class="off col-lg-4 col-md-4 col-sm-4">
            <div class="login-off">30% Off For Order</div><br>
            <div class="login-off-det">For first time order<br>you will get 30% discount</div>
          </div>
          <div class="return col-lg-4 col-md-4 col-sm-4">
            <div class="return-day">Maximum 30 Day Returns</div><br>
            <div class="return-day-det">Refund within 30 days<br>if there is any problem</div>
          </div>
          <div class="shipment col-lg-4 col-md-4 col-sm-4">
            <div class="worldwide">International Transportation</div><br>
            <div class="worldwide-det">Free worldwide shipping on<br>all orders over 20$</div>
          </div>
        </div>


          <div>
            <?php fun2(); ?>
          </div>

          <script type="text/javascript">
            $(document).ready(function(){
              load_cart_item_number(); // for show the change value of cart count

              function load_cart_item_number(){
                $.ajax({
                  url:'cart_store.php',
                  method: 'get',
                  data: {cartItem: "count_cart_item"},   //cart_count
                  success: function(response){
                    $('#cart_count').html(response);
                  }
                });
              }
            });
          </script>


  <script src="js\front_page_style.js" charset="utf-8"></script>
  <script src="js\bootstrap.min.js" charset="utf-8"></script>


</body>

</html>
