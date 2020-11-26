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
    <link rel="stylesheet" href="fontawesome\css\all.min.css">
    <link rel="stylesheet" href="style/show_all_product.css">
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
              <th>Image</th>
              <th>Name</th>
              <th>Category</th>
              <th>Sub-category</th>
              <th>Color</th>
              <th>Quantity</th>
              <th>Price($)</th>
              <th>Total($)</th>
              <th>Update</th>
              <th>Review</th>
              <th>Delete</th>
            </tr>

            <?php

              $conn = new mysqli('localhost', 'root', '', 'ecommerce');
              $data = mysqli_query($conn,"select * from product order by name");
              if($data){
                $rowcount = mysqli_num_rows($data);
                if($rowcount!=0){
                  while($row=mysqli_fetch_assoc($data)){
                    echo "
                      <tr>
                      <td>"."<img src=$row[location] style='height: 100px; width: 100px;'>"."</td>
                      <td>".ucwords(strtolower($row['name']))."</td>
                      <td>".ucwords(strtolower($row['category']))."</td>
                      <td>".ucwords(strtolower($row['sub_category']))."</td>
                      <td>".ucwords(strtolower($row['color']))."</td>
                      <td>".$row['quantity']."</td>
                      <td>".$row['price']."</td>
                      <td>".number_format($row['quantity']*$row['price'],2,'.',', ')."</td>
                      <td>
                        <a style='color: #fd7e14; font-size: 30px;' href='product_update.php?id=$row[id]&name=$row[name]&category=$row[category]&sub_category=$row[sub_category]&color=$row[color]&quantity=$row[quantity]&price=$row[price]'>
                        <i class='fas fa-edit'></i></a>
                      </td>
                      <td>
                        <a style='color: #be4bdb; font-size: 30px;' href='product_review_admin.php?product_id=$row[id]'><i class='fas fa-comments'></i></a>
                      </td>
                      <td>
                        <a href='product_delete.php?id=$row[id]' style='color: red; font-size: 30px;'><i class='fas fa-trash-alt'></i></a>
                      </td></tr>";
                  }
                }
              }else {
                echo "<tr style='border: none;'><td colspan='10' style='background-color: white; font-size: 30px; padding-bottom: 100px;'>No data is available</td></tr>";
              }
              $conn->close();
            ?>

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
            data: {cartItem: "cart_count"},   //cart_count
            success: function(response){
              $('#cart_count').html(response);
            }
          });
        }
      });
    </script>

  </body>
</html>
