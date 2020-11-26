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
  <link rel="stylesheet" href="style/registration.css">
  <link rel="stylesheet" href="fontawesome\css\all.min.css">
  <link rel="stylesheet" href="style\bootstrap.min.css">
  <script src="js/jquery.js"></script>

</head>
  <body>

    <?php

$nameErr = $emailErr = $passwordErr = $cpasswordErr = $numberErr = $cityErr = $districtErr = $countryErr = "";
$fname= $lname = $email = $number = $city = $district = $country = $password = $cpassword = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
if (empty($_POST["fname"])||empty($_POST["lname"])) {
  $nameErr = "Name is required";
} else {
  $fname = test_input($_POST["fname"]);
  $lname = test_input($_POST["lname"]);
}

if (empty($_POST["email"])) {
  $emailErr = "Email is required";
} elseif (!preg_match("/@gmail.com/", $_POST["email"])) {
  $emailErr = "Email is not correct";
} else {
  $email = test_input($_POST["email"]);
}

if(empty($_POST['number'])){
  $numberErr = "Number is required";
}elseif (!is_numeric($_POST['number'])) {
  $numberErr = "Invalid number";
}else{
  $number = $_POST['number'];
}

if(empty($_POST['city'])){
  $cityErr = "City is required";
}else{
  $city = test_input($_POST['city']);
}

if(empty($_POST['district'])){
  $districtErr = "District is required";
}else{
  $district = test_input($_POST['district']);
}

if(empty($_POST['country'])){
  $countryErr = "Country is required";
}else{
  $country = test_input($_POST['country']);
}

if (empty($_POST["password"])) {
  $passwordErr = "Password is required";
}

if (empty($_POST["cpassword"])) {
  $cpasswordErr = "Password is required";
} elseif ($_POST["password"]!=$_POST["cpassword"]) {
  $cpasswordErr = "Password is not correct";
} else {
  $password = test_input($_POST["password"]);
}

}

function test_input($data) {
$data = trim($data);
return $data;
}
$conn = new mysqli("localhost","root","","ecommerce");

$dup = mysqli_query($conn,"select * from customer_biodata where email = '$email'");
if(mysqli_num_rows($dup)==1){
  $emailErr = "Email is already use";
}
if(mysqli_num_rows($dup)==0 && !empty($_POST["fname"]) && !empty($_POST["lname"]) && !empty($_POST["email"]) && !empty($_POST['number']) && !empty($_POST["city"]) && !empty($_POST["district"]) && !empty($_POST["country"]) && !empty($_POST["cpassword"]) && !empty($_POST["password"]) && ($_POST['password']==$_POST['cpassword'])){
  $sql = "insert into customer_biodata(fname,lname,email,phone,city,district,country,password)values('$fname','$lname','$email','$number','$city','$district','$country','$password')";
  $fname= $lname = $email = $number = $city = $district = $country = $password = $cpassword = "";
  mysqli_query($conn,$sql);
  echo("<script>location.href = 'sign_in.php';</script>");
}

$conn->close();


?>

    <div>
      <?php fun1($_SESSION['username'],$_SESSION['logout']); ?>
    </div>

    <div class="container-fluid registration">
      <div class="row">
        <div class="col-lg-3 col-md-0 col-sm-0"></div>
        <div class="col-lg-6 col-md-12 col-sm-12" style="text-align: center;">
          <form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
            <input class="fl" type="text" value="<?php echo $fname; ?>" name="fname" placeholder="First Name">
            <input class="fl" type="text" value="<?php echo $lname; ?>" name="lname" placeholder="Last name"><br>
            <span> <?php echo $nameErr;?></span>
            <br>
            <input class="epc" type="text" value="<?php echo $email; ?>" name="email" placeholder="Email"><br>
            <span> <?php echo $emailErr;?></span>

            <br>
            <input class="epc" type="text" value="<?php echo $number; ?>" name="number" placeholder="Mobile number"><br>
            <span> <?php echo $numberErr;?></span>

            <br>
            <input class="epc" type="text" value="<?php echo $city; ?>" name="city" placeholder="City/Village"><br>
            <span> <?php echo $cityErr;?></span>

            <br>
            <input class="epc" type="text" value="<?php echo $district; ?>" name="district" placeholder="District"><br>
            <span> <?php echo $districtErr;?></span>

            <br>
            <input class="epc" type="text" value="<?php echo $country; ?>" name="country" placeholder="Country"><br>
            <span> <?php echo $countryErr;?></span>

            <br>
            <input class="epc" type="password" name="password" placeholder="Password"><br>
            <span> <?php echo $passwordErr;?></span>

            <br>
            <input class="epc" type="password" name="cpassword" placeholder="Confirm Password"><br>
            <span> <?php echo $cpasswordErr;?></span>

            <br>
            <input class="epc submit" type="submit" name="submit" value="Create an account">
          </form>
          <div style="text-align: center; margin-top:20px;">
            <h6>Have an account?<a href="sign_in.php" style="text-decoration: underline;">Sign in</a> </h6>
          </div>
        </div>
        <div class="col-lg-3 col-md-0 col-sm-0"></div>
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

    <script src="js\front_page_style.js" charset="utf-8"></script>
    <script src="js\bootstrap.min.js" charset="utf-8"></script>


  </body>
</html>
