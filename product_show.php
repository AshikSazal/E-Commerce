<?php
session_start();
if(!isset($_SESSION['username'])){
  $_SESSION['username']='';
  $_SESSION['logout']='';
}

require_once("front_footer_side.php");
require_once("front_upper_side.php");
require_once("product.php");
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>E-Commerce</title>
    <link rel="icon" href="image/logo.jpg">
    <link rel="stylesheet" href="style/front_upper_footer_side.css">
    <link rel="stylesheet" href="fontawesome\css\all.min.css">
    <link rel="stylesheet" href="style/product.css">
    <link rel="stylesheet" href="style\bootstrap.min.css">
    <script src="js/jquery.js"></script>
  </head>
  <body>

    <div>
      <?php fun1($_SESSION['username'],$_SESSION['logout']); ?>
    </div>


    <div class="container">
      <div class="row">
        <?php

        error_reporting(0);
        if (isset($_GET['category']) && isset($_GET['sub_category'])) {
          $_SESSION['get_category']=$_GET['category'];
          $_SESSION['get_sub_category']=$_GET['sub_category'];
        }

        $get_category=$_SESSION['get_category'];
        $get_sub_category=$_SESSION['get_sub_category'];

        $conn = new mysqli('localhost','root','','ecommerce');
        $sql ="select * from product where category='$get_category' and sub_category='$get_sub_category'";
        $result = mysqli_query($conn,$sql);
        $rowcount = mysqli_num_rows($result);
        if($rowcount!=0){
          while($row = mysqli_fetch_assoc($result)){
            if($row['quantity']>0){
              fun($row['id'],$row['name'],$row['price'],$row['location'],$row['rating'],'');
            }else{
              fun($row['id'],$row['name'],$row['price'],$row['location'],$row['rating'],'NOT AVAILABLE');
            }
          }
        }

        $conn->close();

         ?>
      </div>
    </div>

    <div>
      <?php fun2(); ?>
    </div>

    <script type="text/javascript">
      $(document).ready(function(){
        $(".addItemBtn").click(function(e){
          e.preventDefault(); // stop refresh for add button click
          var $form = $(this).closest(".form-submit");
          var p_id= $form.find(".p_id").val();
          var p_name= $form.find(".p_name").val();
          var p_price= $form.find(".p_price").val();
          var p_image= $form.find(".p_image").val();


          $.ajax({
            url: 'cart_store.php',
            method: 'post',
            data: {p_id:p_id,p_name:p_name,p_price:p_price,p_image:p_image},
            success: function(response){
              $("#message").html(response);
              load_cart_item_number(); // for show the change value of cart count
            }
          });
        });

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

  </body>
</html>
