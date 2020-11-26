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
  <link rel="stylesheet" href="style/my_profile.css">
  <link rel="stylesheet" href="style\bootstrap.min.css">
  <script src="js/jquery.js"></script>

</head>

<body>

  <div>
    <?php fun1($_SESSION['username'],$_SESSION['logout']); ?>
  </div>

  <div class="container">
    <div class="row">
      <div class="col-lg-3 col-md-3 col-sm-0"></div>
      <div class="col-lg-6 col-md-6 col-sm-12">
        <table>
          <tr>
            <th colspan="2"><h1>MY PROFILE</h1></th>
          </tr>
          <?php
            $conn = new mysqli('localhost','root','','ecommerce');
            $user_email = $_SESSION['user_email'];
            $result = mysqli_query($conn,"select * from customer_biodata where email = '$user_email'");
            $row = $result->fetch_assoc();
            echo "<tr><td>Name: </td><td>".ucwords(strtolower($row['fname']))." ".ucwords(strtolower($row['lname']))."</td></tr>".
            "<tr><td>Email: </td><td>".$row['email']."</td></tr>".
            "<tr><td>Phone: </td><td>".$row['phone']."</td></tr>".
            "<tr><td>Password: </td><td>".$row['password']."</td></tr>".
            "<tr><td colspan='2'>
              <a href='my_profile_update.php?id=$row[id]&fname=$row[fname]&lname=$row[lname]&email=$row[email]&phone=$row[phone]&password=$row[password]'>
              <input type='submit' value ='UPDATE' class='btn btn-info'></a>
            </td></tr>";
           ?>
        </table>
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
