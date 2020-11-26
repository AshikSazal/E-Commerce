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
<html lang="en" dir="ltr">
<head>
  <title>E-Commerce</title>
  <link rel="icon" href="image/logo.jpg">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="style/front_upper_footer_side.css">
  <link rel="stylesheet" href="style/registration.css">
  <link rel="stylesheet" href="fontawesome\css\all.min.css">
  <link rel="stylesheet" href="style\bootstrap.min.css">
  <script src="js/jquery.js"></script>

</head>
  <body>

    <?php

    $id = $_GET['id'];
    $fname = $_GET['fname'];
    $lname = $_GET['lname'];
    $email = $_GET['email'];
    $phone = $_GET['phone'];
    $password = $_GET['password'];


    if(isset($_GET['submit'])){
      $id = $_GET['id'];
      $fname = $_GET['fname'];
      $lname = $_GET['lname'];
      $email = $_GET['email'];
      $phone = $_GET['phone'];
      $password = $_GET['password'];

      $conn = new mysqli('localhost','root','','ecommerce');
      $sql = "update customer_biodata set fname='$fname',lname='$lname',email='$email',phone='$phone',password='$password' where id='$id'";
      $result = mysqli_query($conn,$sql);
      if($result){
        $fname = $lname = $email = $phone = $password = '';
        echo("<script>location.href = 'my_profile.php';</script>");
      }else {
        echo "<script>alert('Failed to update')</script>";
      }
    }


     ?>

    <div>
      <?php fun1($_SESSION['username'],$_SESSION['logout']); ?>
    </div>

    <div class="container-fluid registration">
      <div class="row">
        <div class="col-lg-3 col-md-0 col-sm-0"></div>
        <div class="col-lg-6 col-md-12 col-sm-12" style="text-align: center;">
          <form method="get" action="<?php echo $_SERVER['PHP_SELF'];?>">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <input class="fl" type="text" name="fname" value="<?php echo $fname; ?>" placeholder="First name">
            <input class="fl" type="text" name="lname" value="<?php echo $lname; ?>" placeholder="Last name"><br><br>
            <input class="epc" type="text" name="email" value="<?php echo $email; ?>" placeholder="Email"><br><br>
            <input class="epc" type="text" name="phone" value="<?php echo $phone; ?>" placeholder="Email"><br><br>
            <input class="epc" type="text" name="password" value="<?php echo $password; ?>" placeholder="Password"><br><br>
            <input class="epc" type="text" name="cpassword" value="<?php echo $password; ?>" placeholder="Confirm Password"><br><br>
            <input class="epc submit" type="submit" name="submit" value="UPDATE">
          </form>
        </div>
        <div class="col-lg-3 col-md-0 col-sm-0"></div>
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
