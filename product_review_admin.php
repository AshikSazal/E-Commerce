<?php
session_start();
if(!isset($_SESSION['username'])){
  $_SESSION['username']='';
  $_SESSION['logout']='';
}
if ($_SESSION['username']=='') {
  echo "<script>alert('Log in first')</script>";
  echo "<script>location.href='sign_in.php'</script>";
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
    <link rel="stylesheet" href="style/review.css">
    <link rel="stylesheet" href="style\bootstrap.min.css">
    <script src="js/jquery.js"></script>
    <!-- <script src="js/review.js" charset="utf-8"></script> -->
  </head>
  <body>

    <?php
    $conn = new mysqli('localhost','root','','ecommerce');

      if (isset($_GET['product_id'])) {
        $product_id=$_GET['product_id'];
      }
      $result=mysqli_query($conn,"select * from product where id='$product_id'");
      $row=mysqli_fetch_assoc($result);

     ?>

    <div>
      <?php fun1($_SESSION['username'],$_SESSION['logout']); ?>
    </div>

    <div class="show-data container">
      <div class="row">
        <div class="col-lg-4">
          <div class='text-block'>
            <h2>
              <?php
              if($row['quantity']==0){
                echo "Not available";
              }
             ?>
           </h2>
          </div>
          <img src="<?php echo $row['location']; ?>" height="300" width="300" style="border: 3px solid brown;">
        </div>
        <div style="color: purple;" class="col-lg-3">
          <h3><?php echo ucwords(strtolower($row['color']))." ".ucwords(strtolower($row['category'])); ?></h3><br><br>
          <h3>Price: <?php echo '$'.$row['price']; ?></h3>
        </div>
        <div class="col-lg-5" style="left: 6.25rem; color: GoldenRod;">
          <h2>
            <?php
            for($i=1;$i<=5;$i++){
              echo $i." : ";
              for($j=5;$j>=$i;$j--){
                echo "<i class='fas fa-star'></i>";
              }
              echo "<br>";
            }
             ?>
             </h2><br><br>
             <?php 
             
             $star_rating='';
            if((int)$row['rating']==$row['rating']){
              for($i=1;$i<=(int)$row['rating'];$i++){
                $star_rating=$star_rating."<i class='fas fa-star'></i>";
              }
            }else{
              for($i=1;$i<=(int)$row['rating'];$i++){
                $star_rating=$star_rating."<i class='fas fa-star'></i>";
              }
              $star_rating=$star_rating."<i class='fas fa-star-half-alt'></i>";
            }
            echo "<h2>"."Rating : ".$star_rating."</h2>";
             
             ?>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-12 review">
          <h2>Comment</h2>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-2"></div>
        <div class="col-lg-8">
          <table>
            <tr>
              <th>Name</th>              
              <th>Rating</th>
              <th>Comment</th>
              <th>Delete</th>
            </tr>
            <?php
              $sql="select * from review where product_id='$product_id'";
              $result=mysqli_query($conn,$sql);
              if($result && mysqli_num_rows($result)>0){
                while($row=$result->fetch_assoc()){
                  $result2=mysqli_query($conn,"select * from customer_biodata where email='{$row['user_email']}'");
                  $row2=$result2->fetch_assoc();  // fetch the name who has already give comment for a particular product
                  echo "<tr><td>".ucwords(strtolower($row2['fname']))." ".ucwords(strtolower($row2['lname']))."</td>".
                  "<td>".$row['rating']."</td>".
                  "<td>".$row['comment']."</td>
                  <td>
                   <a href='review_delete.php?id=$row[id]&product_id=$row[product_id]' style='color: red; font-size: 30px;'><i class='fas fa-trash-alt'></i></a>
                  </td>
                  </tr>";
                }
              }
             ?>
          </table>
        </div>
        <div class="col-lg-2"></div>
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
