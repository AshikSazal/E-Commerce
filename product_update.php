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
  <link rel="stylesheet" href="style/product_upload.css">
  <link rel="stylesheet" href="style\bootstrap.min.css">
  <script src="js/jquery.js"></script>

</head>

<body>

  <div>
    <?php fun1($_SESSION['username'],$_SESSION['logout']); ?>
  </div>

  <?php

  error_reporting(0);

    $u_id = $_GET['id'];
    $u_name = $_GET['name'];
    $u_category = $_GET['category'];
    $u_sub_category = $_GET['sub_category'];
    $u_color = $_GET['color'];
    $u_quantity = $_GET['quantity'];
    $u_price = $_GET['price'];

    $nameErr = $categoryErr = $sub_categoryErr = $colorErr = $quantityErr = $priceErr = '';

    if ($_GET['submit']) {
      if(!empty($_GET['i_id'])){
        $id = trim($_GET['i_id']);
      }

      if (!empty($_GET['i_name'])) {
        $name = trim($_GET['i_name']);
      }else {
        $nameErr = 'Name is required';
      }

      if (!empty($_GET['i_category'])) {
        $category = trim($_GET['i_category']);
      }else{
        $categoryErr = 'Category is required';
      }

      if (!empty($_GET['i_sub_category'])) {
        $sub_category = trim($_GET['i_sub_category']);
      }else{
        $sub_categoryErr = 'Sub category is required';
      }

      if (!empty($_GET['i_color'])) {
        $color = trim($_GET['i_color']);
      }else{
        $colorErr = 'Color is required';
      }

      if (!empty($_GET['i_quantity'])) {
        $quantity = trim($_GET['i_quantity']);
      }else{
        $quantityErr = 'Quantity is required';
      }

      if (!empty($_GET['i_price'])) {
        $price = trim($_GET['i_price']);
      }else{
        $priceErr = 'Location is required';
      }


      if (!empty($_GET['i_id']) && !empty($_GET['i_name']) && !empty($_GET['i_category']) && !empty($_GET['i_sub_category']) && !empty($_GET['i_color']) && !empty($_GET['i_quantity']) && !empty($_GET['i_price'])) {
        $conn = new mysqli('localhost','root','','ecommerce');
        $sql = "update product set name='$name',category='$category',sub_category='$sub_category',color='$color',quantity='$quantity',price='$price' where id='$id'";
        $data = mysqli_query($conn,$sql);

        if($data){
           // header('location: show_all_product.php');
           echo("<script>location.href = 'show_all_product.php';</script>");
        }else {
          echo "Failed to update";
        }
        $conn->close();
      }
    }

   ?>



  <div class="container" style="padding: 100px 0;">
    <div class="row">
      <div class="col-lg-3 col-md-3 col-sm-0"></div>
      <div class="col-lg-6 col-md-6 col-sm-12">
        <form method="get" action="<?php echo $_SERVER['PHP_SELF'];?>">
          <input value="<?php echo $u_id ?>" type="text" name="i_id" placeholder="Name" style="width: 420px; display: none;">
          <input value="<?php echo $u_name ?>" type="text" name="i_name" placeholder="Name" style="width: 420px;"><br>
          <span> <?php echo $nameErr;?> </span><br>

          <input value="<?php echo $u_category ?>" type="text" name="i_category" placeholder="Category" style="width: 208px;">
          <input value="<?php echo $u_sub_category ?>" type="text" name="i_sub_category" placeholder="Sub-Category" style="width: 208px;"><br>
          <span style="padding-right: 3.125rem;"> <?php echo $categoryErr;?> </span>
          <span> <?php echo $sub_categoryErr;?> </span><br>

          <input value="<?php echo $u_color ?>" type="text" name="i_color" placeholder="color" style="width: 420px;"><br>
          <span> <?php echo $colorErr;?> </span><br>

          <input value="<?php echo $u_quantity ?>" type="text" name="i_quantity" placeholder="Quantity" style="width: 208px;">
          <input value="<?php echo $u_price ?>" type="text" name="i_price" placeholder="Price" style="width: 208px;"><br>
          <span style="padding-right: 5rem;"> <?php echo $quantityErr;?> </span>
          <span> <?php echo $priceErr;?> </span><br>

          <input class="submit" type="submit" name="submit" value="UPDATE DATA" style="width: 420px;"><br><br>
        </form>

      </div>
      <div class="col-lg-3 col-md-3 col-sm-0">

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
