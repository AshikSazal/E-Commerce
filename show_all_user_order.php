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
  <link rel="stylesheet" href="style/show_all_user.css">
  <link rel="stylesheet" href="style\bootstrap.min.css">
  <script src="js/jquery.js"></script>

</head>

<body>

  <div>
    <?php fun1($_SESSION['username'],$_SESSION['logout']); ?>
  </div>


  <div class="container show-data">
    <div class="row">
      <div class="col-lg-12 col-md-12 col-sm-6">
        <table>
          <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Phone number</th>
            <th>City</th>
            <th>District</th>
            <th>Country</th>
            <th>Show Product</th>
            <th>Delivery</th>
            <th>Date</th>
          </tr>
          <tr>
            <?php

              $conn=new mysqli('localhost','root','','ecommerce');
              $sql="select * from place_order where status=1"; // status=1 order is ongoing and status=0 order is done
              $result=mysqli_query($conn,$sql);

              if($result && $result->num_rows>0){
                while($row=$result->fetch_assoc()){
                  $result2=mysqli_query($conn,"select * from customer_biodata where email='{$row['email']}'"); // fetch only name
                  $row2=$result2->fetch_assoc();
                  echo "
                    <tr><td>".ucwords(strtolower($row2['fname']))." ".ucwords(strtolower($row2['lname']))."</td>".
                    "<td>".$row['email']."</td>".
                    "<td>".$row['phone']."</td>".
                    "<td>".ucwords(strtolower($row['city']))."</td>".
                    "<td>".ucwords(strtolower($row['district']))."</td>".
                    "<td>".ucwords(strtolower($row['country']))."</td>".
                    "<td>
                      <a href='order_info.php?email=$row[email]&id=$row[id]' style='font-size: 25px;'><i class='fab fa-product-hunt'></i></a>
                    </td>
                    <td>
                      <a href='order_confirm.php?email=$row[email]&id=$row[id]' style='font-size: 25px;'><i class='fas fa-check-circle'></i></a>
                    </td>
                    <td>".date('D, d-M, Y',strtotime($row['order_date']))."</td>
                    </tr>";
                }
              }else {
                echo "<tr style='border: none;'><td colspan='10' style='background-color: white; font-size: 30px; padding: 50px 0;'>No data is available</td></tr>";
              }

              $conn->close();

            ?>
          </tr>
        </table>
      </div>
    </div>
    <div>
      <a class='btn btn-info addItemBtn' href='admin.php'>Go Back</a>
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
