<?php
session_start();
if(!isset($_SESSION['username'])){
  $_SESSION['username']='';
  $_SESSION['logout']='';
}
if (!isset($_SESSION['username2'])) {
  $_SESSION['username2'] = '';
}
if (!isset($_SESSION['userid'])) {
  $_SESSION['userid'] = '';
}
require_once("front_footer_side.php");
require_once("front_upper_side.php");
?>


<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>E-Commerce</title>
    <link rel="icon" href="image/logo.jpg">
    <link rel="stylesheet" href="style/front_upper_footer_side.css">
    <link rel="stylesheet" href="fontawesome\css\all.min.css">
    <link rel="stylesheet" href="style/cart.css">
    <link rel="stylesheet" href="style\bootstrap.min.css">
    <script src="js/jquery.js"></script>
  </head>
  <body>

    <div>
      <?php fun1($_SESSION['username'],$_SESSION['logout']); ?>
    </div>

    <div class="container show-data">
      <div class="row justify-content-center">
        <div class="col-lg-10 col-md-10 col-sm-6">

          <table>
            <tr>
              <th>ID</th>
              <th>Image</th>
              <th>Name</th>
              <th>Price</th>
              <th>Quantity</th>
              <th>Total price</th>
              <th>Status</th>
              <th>Remove</th>
            </tr>

            <?php

            $user_email='';

            if ($_GET) {
              $_SESSION['user_email'] = $_GET['email'];
            }
            if(isset($_SESSION['user_email'])){
              $user_email=$_SESSION['user_email'];
            }

              $conn = new mysqli('localhost','root','','ecommerce');
              $sql = "select * from customer_biodata where email='$user_email'";
              $result = mysqli_query($conn,$sql);
              if($result){
                  $row=$result->fetch_assoc();
                    $user_tbl = $row['fname'].$row['lname'].$row['id'];
                    $result2 = mysqli_query($conn,"select * from $user_tbl order by pid");
                    $total_price=0;
                    if($result2){
                      while($row2 = $result2->fetch_assoc()){
                            echo "<tr><td>".$row2['pid']."</td>".
                            "<td><img src=$row2[pimage] style='height: 80px; width: 80px;'>"."</td>".
                            "<td>".$row2['pname']."</td>".
                            "<td>".$row2['pprice']."</td>".
                            "<td>".$row2['pquantity']."</td>".
                            "<td>".number_format($row2['ptotalprice'],2,'.',', ')."</td>".
                            "<td>".$row2['status']."</td>
                            <td>
                            <a href='user_cart_delete.php?email=$row[email]&id=$row2[pid]' class='' style='color: red; font-size: 25px;'><i class='fas fa-trash-alt'></i></a>
                            </td></tr>";
                        }
                    }else {
                      echo "<tr><td colspan='8' style='background-color: white; font-size: 30px;'>No data is available</td></tr>";
                    }
              }else {
                echo "<tr><td colspan='8' style='background-color: white; font-size: 30px; padding-bottom: 1.25rem; padding-top: 6.25rem;'>No data is available</td></tr>";
              }

              echo "<tr><td colspan='8' style='background-color: white; font-size: 30px; padding-bottom: 1.25rem; padding-top: 6.25rem;'>
              <a class='btn btn-info addItemBtn' href='admin.php'>Go Back</a></td></tr>"
            ?>
          </table>
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

  </body>
</html>
