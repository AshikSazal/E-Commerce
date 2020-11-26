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
              <td colspan="6" style="font-size: 40px; color: #800000;">ORDER</td>
            </tr>
            <tr>
              <th>Image</th>
              <th>Name</th>
              <th>Price ($)</th>
              <th>Quantity</th>
              <th>Total Price ($)</th>
              <th>Date</th>
            </tr>

            <?php

              $conn = new mysqli('localhost','root','','ecommerce');
              $sql='';
              $user_tbl=$_SESSION['username'].$_SESSION['username2'].$_SESSION['userid'];
              $user_email=$_SESSION['user_email'];
              $sql = "select * from place_order where status=1 and email='$user_email'"; // show for user
              $user_email=$_SESSION['user_email'];

              $f=0;

              if ($_GET) { // show from admin login
                $user_email = $_GET['email'];
                $id = $_GET['id'];
                $sql = "select * from place_order where email='$user_email' and id='$id'";
                $result=mysqli_query($conn,"select * from customer_biodata where email='$user_email'");
                if ($result) {
                  if(mysqli_num_rows($result)>0){
                    $row=$result->fetch_assoc();
                    $user_tbl=$row['fname'].$row['lname'].$row['id'];
                    $f=1;
                  }
                }
              }


              $result = mysqli_query($conn,$sql);
              $total_price=0;
              $total_quantity=0;
              if ($result) {
                if(mysqli_num_rows($result)>0){
                  while($row = $result->fetch_assoc()){
                        $order_product_id=$row['order_product_id']; // fetch only order_product_id column value
                        $pid=explode(",",$order_product_id); // get the product id
                        $pid=implode(",",$pid);
                        $result2=mysqli_query($conn,"select * from $user_tbl where pid in ($pid)"); // get the common product id from user table
                        if($result2 && mysqli_num_rows($result2)>0){
                          while($row2 = $result2->fetch_assoc()){ // show the product which is already ordered
                            echo "<tr><td>".
                        "<img src=$row2[pimage] style='height: 80px; width: 80px;'>"."</td>".
                        "<td>".ucwords(strtolower($row2['pname']))."</td>".
                        "<td>".$row2['pprice']."</td>".
                        "<td>".$row2['pquantity']."</td>".
                        "<td>".number_format($row2['ptotalprice'],2,'.',', ')."</td>".
                        "<td>".date('D, d-M, Y',strtotime($row['order_date']))."</td>".
                        "</tr>";
                        $total_price+=$row2['ptotalprice'];
                        $total_quantity+=$row2['pquantity'];
                          }
                        }
                    }
                }else {
                  echo "<tr><td colspan='6' style='background-color: white; font-size: 30px;'>No data is available</td></tr>";
                }
              }
            ?>
            <tr>
              <td colspan="6" style="border-top: 5px solid brown;"></td>
            </tr>
            <tr  style="background-color: white;">
              <td colspan="3" style=" font-size: 25px; color: Teal;">Total Price</td>
              <td style=" font-size: 25px; color: Teal;"><?php echo $total_quantity; ?></td>
              <td style=" font-size: 25px; color: Teal;"><?php echo number_format($total_price,2,'.',', '); ?></td>
            </tr>
            <tr>
              <td colspan="6" style="background-color: white;">
                <?php
                  if($f==0){
                    echo "<a href='front_page.php' class='btn btn-info' style='margin-top: 50px;'><i class='fas fa-cart-plus'></i> Go to Shopping</a>";
                  }else{
                    echo "<a href='admin.php' class='btn btn-info' style='margin-top: 50px;'>Go Back</a>";
                  }
                 ?>
              </td>
            </tr>
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
