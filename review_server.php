<?php
session_start();
$conn = new mysqli('localhost','root','','ecommerce');

  if (isset($_POST['rating'])) {
    $sql="insert into review(product_id,rating,user_email)values('{$_POST['product_id']}','{$_POST['number']}','{$_SESSION['user_email']}')";
    mysqli_query($conn,$sql);
    $result=mysqli_query($conn,"select sum(rating)/count(product_id) as mean_rating from review where product_id={$_POST['product_id']} and rating!=''");
    $row=mysqli_fetch_assoc($result);
    mysqli_query($conn,"update product set rating={$row['mean_rating']} where id={$_POST['product_id']}");
    echo "<script>location.href='review.php?product_id={$_POST['product_id']}'</script>";
  }
  if (isset($_POST['comment'])) {
    $sql="insert into review(product_id,comment,user_email)values('{$_POST['product_id']}','{$_POST['Pro_comment']}','{$_SESSION['user_email']}')";
    mysqli_query($conn,$sql);
    echo "<script>location.href='review.php?product_id={$_POST['product_id']}'</script>";
  }

 ?>
