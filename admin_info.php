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
  <link rel="stylesheet" href="style/admin_info.css">
  <link rel="stylesheet" href="style\bootstrap.min.css">
  <script src="js/jquery.js"></script>

</head>

<body>

  <div>
    <?php fun1($_SESSION['username'],$_SESSION['logout']); ?>
  </div>


  <div class="container show-data">
    <div class="row">
      <div class="col-lg-12 col-md-12 col-sm-12">
        <table>
          <tr>
            <th>Name</th>
            <th>Password</th>
            <th>Update</th>
          </tr>
          <?php

            $conn = new mysqli('localhost','root','','ecommerce');
            $sql = "select * from admin_info";
            $result = mysqli_query($conn,$sql);
            if($result->num_rows>0){
              while($row=$result->fetch_assoc()){
                echo "<tr><td>".$row['name']."</td>".
                "<td>".$row['password']."</td>
                <td>
                  <a href='admin_info_update.php?id=$row[id]&name=$row[name]&password=$row[password]'>
                  <input type='submit' value ='UPDATE' class='btn btn-info'></a>
                </td>
                </tr>"
                ;
              }
            }

          ?>
        </table>
      </div>
    </div>
    <div style="padding: 50px 0;">
      <a class='btn btn-info addItemBtn' href='admin.php'>Go Back</a>
    </div>
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


  <div>
    <?php fun2(); ?>
  </div>


  <script src="js\front_page_style.js" charset="utf-8"></script>
  <script src="js\bootstrap.min.js" charset="utf-8"></script>


</body>

</html>
