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
  <link rel="stylesheet" href="style/admin_info_update.css">
  <link rel="stylesheet" href="style\bootstrap.min.css">
  <script src="js/jquery.js"></script>

</head>

<body>

  <div>
    <?php fun1($_SESSION['username'],$_SESSION['logout']); ?>
  </div>



  <?php

    error_reporting(0);


    $u_id = trim($_GET['id']);
    $u_name = trim($_GET['name']);
    $u_password = trim($_GET['password']);
    $updateErr = '';

    if (isset($_GET['submit'])) {
      $id = trim($_GET['i_id']);
      $name = trim($_GET['i_name']);
      $password = trim($_GET['i_password']);

      $conn = new mysqli('localhost','root','','ecommerce');
      if($name!='' && $password!=''){
        $sql = "update admin_info set name='$name',password='$password' where id='$id'";
        $_SESSION['username'] = $name;
        $_SESSION['logout'] = $password;
        $data=mysqli_query($conn,$sql);
        if($data){
          echo "<script>location.href='admin_info.php'</script>";
        }else {
          $updateErr = "Failed to update";
        }
      }else {
        $updateErr = "Failed to update";
      }



      $conn->close();
    }


   ?>

   <div>
     <?php fun1($_SESSION['username'],$_SESSION['logout']); ?>
   </div>



  <div class="container" style="padding: 6.25rem 0;">
    <div class="row">
      <div class="col-lg-3 col-md-3 col-sm-0"></div>
      <div class="col-lg-6 col-md-6 col-sm-12">
        <form method="get" action="<?php echo $_SERVER['PHP_SELF'];?>">
          <input value="<?php echo $u_id ?>" type="text" name="i_id" style="display: none;">
          <input class="admin-name" value="<?php echo $u_name ?>" type="text" name="i_name" placeholder="Name"><br><br>
          <input class="admin-name" value="<?php echo $u_password ?>" type="text" name="i_password" placeholder="Password"><br>
          <span> <?php echo $updateErr;?></span><br>
          <input class="submit admin-name" type="submit" name="submit" value="UPDATE INFORMATION" style="width: 420px;"><br><br><br><br>
            <a class='btn btn-info addItemBtn' href='admin.php'>Go Back</a>
        </form>
      </div>
      <div class="col-lg-3 col-md-3 col-sm-0"></div>
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
