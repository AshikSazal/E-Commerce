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

        if($_GET['submit']){

          $conn = new mysqli('localhost','root','','ecommerce');

          $search_item = strtolower(trim($_GET['search']));
          $search_item = explode(' ',$search_item); // split the string if separated by space
          $id = array();

          $result = mysqli_query($conn,"select * from product");
          $f=0;

          if($result && mysqli_num_rows($result)>0){
            while($row=$result->fetch_assoc()){
              foreach ($search_item as $val) { // fetch the same category,sub_category,color from product table
                if ($val==strtolower($row['category']) || preg_match("/$val/", strtolower($row['category']))) {
                  $f=$f+1;
                }
                if ($val==strtolower($row['sub_category'])) {
                  $f=$f+1;
                }
                if ($val==strtolower($row['color'])) {
                  $f=$f+1;
                }
                if($f==count($search_item)){
                  array_push($id,$row['id']); // Get the founded id in array
                }
              }
              $f=0;
            }
          }

          $id = implode(',',$id);

          $sql ="select * from product where id in ($id)";
          $result = mysqli_query($conn,$sql);
          if($result && mysqli_num_rows($result)>0){
            while($row = mysqli_fetch_assoc($result)){
              if($row['quantity']>0){
                fun($row['id'],$row['name'],$row['price'],$row['location'],$row['rating'],'');
              }else{
                fun($row['id'],$row['name'],$row['price'],$row['location'],$row['rating'],'NOT AVAILABLE');
              }
            }
          }else {
            echo "
            <div class='col-lg-5 col-md-5 col-sm-0'></div>"."
            <div style='padding: 150px 0;' class='col-lg-4 col-md-4 col-sm-12'>
              <h3>No data is available</h3>
            </div>"."
            <div class='col-lg-3 col-md-3 col-sm-0'></div>";
          }

          $conn->close();

      }

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
