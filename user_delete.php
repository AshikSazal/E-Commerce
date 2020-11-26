<?php

  $email=$_GET['email'];
  $_SESSION['user_email']=$email;
  $id = $_GET['id'];
  $conn = new mysqli('localhost','root','','ecommerce');
  $result = mysqli_query($conn,"select * from customer_biodata where email='$email'");
  $row = $result->fetch_assoc();
  $create_tbl = $row['fname'].$row['lname'].$row['id'];
  mysqli_query($conn,"drop table $create_tbl");
  mysqli_query($conn,"delete from customer_biodata where email='$email'");
  $conn->close();
  header('location: show_all_user.php');

 ?>
