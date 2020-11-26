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
    <meta charset="utf-8">
    <title>E-Commerce</title>
    <link rel="icon" href="image/logo.jpg">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="style/front_upper_footer_side.css">
  <link rel="stylesheet" href="style/sign_in.css">
  <link rel="stylesheet" href="fontawesome\css\all.min.css">
  <link rel="stylesheet" href="style\bootstrap.min.css">
  <script src="js/jquery.js"></script>
  </head>
  <body>

    <?php
    error_reporting(0);

      $invalid = $email =$password = "";
      $conn = new mysqli("localhost","root","","ecommerce");

      if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $sql = "select name, password from admin_info where name='$_POST[email]' and password='$_POST[password]'";
        $result = mysqli_query($conn,$sql);
        $row=$result->fetch_assoc();
        if ($result->num_rows>0) {
          $_SESSION['username'] = $row['name'];
          $_SESSION['logout'] = $row['password'];
          header('location: admin.php');
        }elseif(!empty($_POST['email']) && !empty($_POST['password'])){
          $email = $_POST['email'];
          $password = $_POST['password'];
        }else {
          $invalid = 'Enter email & password';
        }
      }


      $sql = "select * from customer_biodata where email = '$email' and password = '$password'";
      $dup = mysqli_query($conn,$sql);

      $result = $conn->query($sql);

      $rows = $result->fetch_assoc();

      if (!empty($_POST['email']) && !empty($_POST['password'])) {
        if(mysqli_num_rows($dup)==0){
          $invalid='Invalid email & password';
        }
         else {
          if(isset($_POST['submit'])){
            $_SESSION['username'] = $rows['fname'];
            $_SESSION['username2'] = $rows['lname'];
            $_SESSION['userid'] = $rows['id'];
            $_SESSION['logout'] = 'logout';
            $_SESSION['user_email']=$rows['email'];

          }
          header('location: front_page.php');
        }
      }


      $conn->close();

    ?>

    <div>
      <?php fun1($_SESSION['username'],$_SESSION['logout']); ?>
    </div>

    <div class="container sign-in">
      <div class="row">
        <div class="col-lg-3 col-md-0 col-sm-0"></div>
        <div class="col-lg-6 col-md-12 col-sm-12">
          <form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">

            <input class="epc" type="text" name="email" placeholder="Email"><br><br>
            <input class="epc" type="password" name="password" placeholder="Password"><br>
            <span class="error"> <?php echo $invalid;?></span>
            <br>
            <input class="epc submit" type="submit" name="submit" value="Log in">

            <div class="create-account" style="padding: 50px 0; text-decoration:underline;">
              <h6><a href="registration.php">Create an account</a></h6>
            </div>

          </form>



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
            data: {cartItem: "$_SESSION['item_quantity']"},   //cart_count
            success: function(response){
              $('#cart_count').html(response);
            }
          });
        }
      });
    </script>

  </body>
</html>
