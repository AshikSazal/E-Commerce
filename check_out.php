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
  <link rel="stylesheet" href="style/check_out.css">
  <link rel="stylesheet" href="style\bootstrap.min.css">
  <script src="js/jquery.js"></script>
</head>
  <body>

    <?php

    error_reporting(0);

      $user_email = $_SESSION['user_email'];
      $conn = new mysqli('localhost','root','','ecommerce');
      $result = mysqli_query($conn,"select * from customer_biodata where email='$user_email'");
      $row = $result->fetch_assoc();
      $id = $row['id'];
      $email = $row['email'];
      $city = $row['city'];
      $district = $row['district'];
      $country = $row['country'];
      $phone = $row['phone'];

      $postcodeErr = $cityErr = $districtErr = $countryErr = $emailErr = $phoneErr = '';

      if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if(!empty($_POST['street_address'])){
          $street_address = trim($_POST['street_address']);
        }

        if(!empty($_POST['postcode'])){
          $postcode = trim($_POST['postcode']);
        }else {
          $postcodeErr = 'Postcode is required';
        }

        if(!empty($_POST['city'])){
          $city = trim($_POST['city']);
        }else{
          $cityErr = 'City is required';
        }

        if(!empty($_POST['district'])){
          $district = trim($_POST['district']);
        }else {
          $districtErr = 'District is required';
        }

        if(!empty($_POST['country'])){
          $country = trim($_POST['country']);
        }else {
          $countryErr = 'Country is required';
        }

        if(!empty($_POST['email'])){
          $email = trim($_POST['email']);
        }else {
          $emailErr = 'Email is required';
        }

        if (!empty($_POST['phone'])) {
          $phone = trim($_POST['phone']);
        }else{
          $phoneErr = 'Phone number is required';
        }

        if (!empty($_POST['postcode']) && !empty($_POST['city']) && !empty($_POST['district']) && !empty($_POST['country']) && !empty($_POST['email']) && !empty($_POST['phone'])) {
          // Fetch user table name
          $user_email = $_SESSION['user_email'];
          $result = mysqli_query($conn,"select * from customer_biodata where email='$user_email'");
          $row = $result->fetch_assoc();
          $user_tbl = $row['fname'].$row['lname'].$row['id'];
          $id = $row['id'];

          $order_product_id = array();
          $result = mysqli_query($conn,"select * from $user_tbl where status=1");
          if($result){
            while($row=$result->fetch_assoc()){
              array_push($order_product_id,$row['pid']);
            }
          }
          $order_product_id = implode(',',$order_product_id);

          // Insert into place_order table
          mysqli_query($conn,"insert into place_order(ref_tbl,street_address,postcode,city,district,country,order_product_id,table_name,email,phone,status,order_date)
          values('$id','$street_address','$postcode','$city','$district','$country','$order_product_id','$user_tbl','$email','$phone',1,now())");

          // Erase the quantity of product
          $result=mysqli_query($conn,"update product,$user_tbl set product.quantity=product.quantity-$user_tbl.pquantity where product.id=$user_tbl.pid and $user_tbl.status=1");

          // status value change of user_tbl
          mysqli_query($conn,"update $user_tbl,product set status=0 where product.id=$user_tbl.pid");

          $street_address = $postcode = $city = $district = $country = $email = $phone = '';

          if($result){
            echo "<script>alert('Successfully done')</script>";
            echo "<script>location.href='front_page.php'</script>";
          }
        }
      }

    ?>

    <div>
      <?php fun1($_SESSION['username'],$_SESSION['logout']); ?>
    </div>

    <div class="container-fluid check-out">
      <form class="" action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
      <div class="row">

          <div class="col-lg-7 col-md-12 col-sm-12 user-info">
            <h3 style="margin-left: 120px; color: brown;">MY INFORMATION</h3>
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <input type="hidden" name="email" value="<?php echo $user_email; ?>">

            <input class="my_info" type="text" name="email" value="<?php echo $email; ?>" placeholder="Email"><br>
            <span><?php echo $emailErr; ?></span><br>

            <input class="my_info" type="text" name="phone" value="<?php echo $phone; ?>" placeholder="Phone"><br>
            <span><?php echo $phoneErr; ?></span><br>

            <input class="my_info" type="text" name="street_address" value="" placeholder="Street Address"><br><br>
            <input class="my_info" type="text" name="postcode" value="" placeholder="Postcode"><br>
            <span><?php echo $postcodeErr; ?></span><br>

            <input class="my_info" type="text" name="city" value="<?php echo $city; ?>" placeholder="City"><br>
            <span><?php echo $cityErr; ?></span><br>

            <input class="my_info" type="text" name="district" value="<?php echo $district; ?>" placeholder="District"><br>
            <span><?php echo $districtErr; ?></span><br>

            <input class="my_info" type="text" name="country" value="<?php echo $country; ?>" placeholder="Country"><br>
            <span><?php echo $countryErr; ?></span><br>

          </div>

          <div class="col-lg-4 col-md-12 col-sm-12 shop-info">
            <table>
              <tr>
                <th colspan="4" style="text-align: center;">MY SHOPPING</th>
              </tr>
              <tr>
                <td colspan="4" style="border-top: 3px solid brown;"></td>
              </tr>

            <?php

            $total_price=0;
            $shipping_cost=60;

              $conn = new mysqli('localhost','root','','ecommerce');
              $user_tbl = $_SESSION['username'].$_SESSION['username2'].$_SESSION['userid'];
              $result = mysqli_query($conn,"select * from $user_tbl where status=1");
              if($result){
                while($row=$result->fetch_assoc()){
                  echo "<tr><td>".$row['pname']."</td>".
                  "<td> x ".$row['pquantity']."</td>".
                  "<td>=</td>".
                  "<td>".$row['ptotalprice']."</td>".
                  "</tr>";
                  $total_price+=$row['ptotalprice'];
                }
              }
             ?>
             <tr>
               <td colspan="4" style="border-bottom: 3px solid brown;"></td>
             </tr>
             <tr>
               <td><b>PRICE</b></td>
               <td></td>
               <td>=</td>
               <td><?php echo $total_price; ?></td>
             </tr>
             <tr>
             </tr>
             <tr>
               <td><b>Shipping cost</b></td>
               <td></td>
               <td> = </td>
               <td><?php echo $shipping_cost; ?></td>
             </tr>
             <tr>
               <td colspan="4" style="border-bottom: 3px solid brown;"></td>
             </tr>
             <tr>
               <td><b>TOTAL PRICE</b></td>
               <td></td>
               <td> = </td>
               <td><?php echo $total_price+$shipping_cost; ?></td>
             </tr>
             <tr>
               <td style="padding-top: 30px;"><input type="radio" checked="checked"></td>
               <td style="padding-top: 30px;">Cash on delivery</td>
               <td></td>
             </tr>
            </table>
          </div>

      </div>
      <div class="row">
        <div class="col-lg-7"></div>
        <div class="col-lg-2">
          <input type="submit" name="submit" value="Place order" class="btn btn-success place-order">
        </div>
      </div>
      </form>
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
