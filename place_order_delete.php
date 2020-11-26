<?php

$email=$_GET['email'];
$_SESSION['user_email']=$email;
$id = $_GET['id'];
$conn = new mysqli('localhost','root','','ecommerce');
mysqli_query($conn,"delete from place_order where email='$email' and id='$id'");
$conn->close();
header('location: show_all_order_database.php');

 ?>
