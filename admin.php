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
  <link rel="stylesheet" href="style/admin.css">
  <link rel="stylesheet" href="style\bootstrap.min.css">
  <script src="js/jquery.js"></script>

</head>

<body>

  <div>
    <?php fun1($_SESSION['username'],$_SESSION['logout']); ?>
  </div>


  <div class="admin-control-panel">
    <div class="container">
      <div class="control-panel">
        <h1>ADMIN CONTROL PANEL</h1>
      </div>
      <div class="row database">
        <div class="col-lg-2 col-md-4 col-sm-12">
          <a class="btn btn-info" href="product_upload.php">UPLOAD FILE</a>
        </div>
        <div class="col-lg-2 col-md-4 col-sm-12">
          <a class="btn btn-info" href="show_all_product.php">SHOW ALL PRODUCT</a>
        </div>
        <div class="col-lg-2 col-md-4 col-sm-12">
          <a class="btn btn-info" href="admin_info.php">ADMIN INFORMATION</a>
        </div>
        <div class="col-lg-2 col-md-4 col-sm-12">
          <a class="btn btn-info" href="show_all_user_order.php">SHOW ALL USER ORDER</a>
        </div>
        <div class="col-lg-2 col-md-4 col-sm-12">
          <a class="btn btn-info" href="show_all_user.php">SHOW ALL LOGIN USER</a>
        </div>
        <div class="col-lg-2 col-md-4 col-sm-12">
          <a class="btn btn-info" href="show_all_order_database.php">SHOW ALL ORDER DATABASE</a>
        </div>
      </div>
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
