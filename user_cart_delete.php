<?php

  $email=$_GET['email'];
  $_SESSION['user_email']=$email;
  $id = $_GET['id'];
  $conn = new mysqli('localhost','root','','ecommerce');
  $result = mysqli_query($conn,"select * from customer_biodata where email='$email'");
  $row = $result->fetch_assoc();
  $create_tbl = $row['fname'].$row['lname'].$row['id'];
  mysqli_query($conn,"delete from $create_tbl where pid='$id'");
  header('location: user_database_info.php');

 ?>
