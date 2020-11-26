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
              <td colspan="6" style="font-size: 40px; color: #800000;">MY CART</td>
            </tr>
            <tr>
              <th>Image</th>
              <th>Name</th>
              <th>Price ($)</th>
              <th>Quantity</th>
              <th>Total Price ($)</th>
              <th>
                <a href="cart_store.php?clear=all" class="btn btn-danger"
                onclick="return confirm('Are you sure want to delete');"><i class="fas fa-trash"></i>&nbsp;&nbsp;Remove all</a>
              </th>
            </tr>

            <?php

              $conn = new mysqli('localhost','root','','ecommerce');
              $user_tbl=$_SESSION['username'].$_SESSION['username2'].$_SESSION['userid'];
              $sql = "select * from $user_tbl where status=1";
              $result = mysqli_query($conn,$sql);
              $total_price=0;
              if ($result) {
                if(mysqli_num_rows($result)>0){
                  while($row = $result->fetch_assoc()){
                        echo "<tr><td>".
                        "<input type='hidden' class='pid' value="."'$row[pid]'></input>".
                        "<img src=$row[pimage] style='height: 80px; width: 80px;'>"."</td>".
                        "<td>".ucwords(strtolower($row['pname']))."</td>".
                        "<td>".$row['pprice']."</td>".
                        "<input type='hidden' class='pprice' value='$row[pprice]'></input>".
                        "<td><input type='number' class='item_quantity' value='$row[pquantity]' min='1' style='width: 75px; height: 30px;'></input>".
                        "<td>".number_format($row['ptotalprice'],2,'.',', ')."</td>".
                        "<td>
                          <a href='cart_store.php?remove=$row[pid]' class='' style='color: red; font-size: 25px;'><i class='fas fa-trash-alt'></i></a>
                        </td></tr>";
                        $total_price+=$row['ptotalprice'];

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
              <td colspan="4" style=" font-size: 25px; color: Teal;">Total Price</td>
              <td style=" font-size: 25px; color: Teal;"><?php echo number_format($total_price,2,'.',', '); ?></td>
              <td><a href="check_out.php" class="btn btn-success <?= ($total_price>1)?"":"disabled"; ?>"> <!-- Disabled the cart value for less than one taka -->
                <i class="fas fa-shopping-basket"></i>&nbsp;&nbsp;Check Out</a> </td>
            </tr>
            <tr>
              <td colspan="6" style="background-color: white;"><a href="front_page.php" class="btn btn-info" style="margin-top: 50px;"><i class="fas fa-cart-plus"></i>&nbsp;Continue Shopping</a></td>
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

        $(".item_quantity").on('change',function(){
          var $element = $(this).closest("tr"); // value from tr tag of table
          var pid = $element.find(".pid").val();
          var pprice = $element.find(".pprice").val();
          var pquantity = $element.find(".item_quantity").val();
          location.reload(true);
          $.ajax({ // request to server
            url: 'cart_store.php',
            method: 'post',
            cache: false,
            data: {pid:pid,pprice:pprice,pquantity:pquantity},
            success: function(response){
              console.log(response);
            }
          });
        });

        $(".item_quantity").on('input',function(){
          var $element = $(this).closest("tr"); // value from tr tag of table
          var pid = $element.find(".pid").val();
          var pprice = $element.find(".pprice").val();
          var pquantity = $element.find(".item_quantity").val();
          setTimeout(function(){// wait for 5 secs(2)
            location.reload(); // then reload the page.(3)
          }, 5000);
          $.ajax({ // request to server
            url: 'cart_store.php',
            method: 'post',
            cache: false,
            data: {pid:pid,pprice:pprice,pquantity:pquantity},
            success: function(response){
              if(response.success == true){ // if true (1)
                setTimeout(function(){// wait for 5 secs(2)
                  location.reload(); // then reload the page.(3)
                }, 5000);
              }
            }
          });
        });

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
