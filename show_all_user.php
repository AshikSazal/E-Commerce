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
              <th>Database Information</th>
              <th>Remove</th>
            </tr>
            <tr>
              <?php

                $conn=new mysqli('localhost','root','','ecommerce');
                $sql="select * from customer_biodata order by fname and lname";
                $result=mysqli_query($conn,$sql);

                if($result && $result->num_rows>0){
                  while($row=$result->fetch_assoc()){
                    echo "
                      <tr><td>".ucwords(strtolower($row['fname']))." ".ucwords(strtolower($row['lname']))."</td>".
                      "<td>".$row['email']."</td>".
                      "<td>".$row['phone']."</td>".
                      "<td>".ucwords(strtolower($row['city']))."</td>".
                      "<td>".ucwords(strtolower($row['district']))."</td>".
                      "<td>".ucwords(strtolower($row['country']))."</td>".
                      "<td>
                        <a href='user_database_info.php?email=$row[email]' style='font-size: 25px;'><i class='fas fa-database'></i></a>
                      </td>
                      <td>
                        <a href='user_delete.php?email=$row[email]' style='color: red; font-size: 25px;'><i class='fas fa-trash-alt'></i></a>
                      </td>
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

  </body>
</html>
