<?php

  error_reporting(0);
  $del_id=$_GET['id'];
  $conn = new mysqli('localhost', 'root', '', 'ecommerce');
  $img_query = mysqli_query($conn,"select * from product where id = '$del_id'");
  while($row=mysqli_fetch_array($img_query)){
    $img = $row['location'];
  }
  unlink($img);
  $sql="delete from product where id ='$del_id'";
  mysqli_query($conn,$sql);
  header('location: show_all_product.php');

 ?>
