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
<html lang="en">

<head>
  <title>E-Commerce</title>
  <link rel="icon" href="image/logo.jpg">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="style/front_upper_footer_side.css">
  <link rel="stylesheet" href="fontawesome\css\all.min.css">
  <link rel="stylesheet" href="style/product_upload.css">
  <link rel="stylesheet" href="style\bootstrap.min.css">
  <script src="js/jquery.js"></script>

</head>

<body>

  <?php
    $nameErr = $categoryErr = $sub_categoryErr = $colorErr = $quantityErr = $priceErr = $locationErr = '';
    $name = $category = $sub_category = $color = $quantity = $price = $location = '';
    $file_name = $file_tem_loc = $file_store = $file_type = '';
    $dup_pic = $dup_name = '';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

      if (empty($_POST['name'])) {
        $nameErr = 'Name is required';
      }else {
        $name = test_input($_POST["name"]);
      }

      if (empty($_POST['category'])) {
        $categoryErr = 'Category is required';
      }else {
        $category = test_input($_POST['category']);
      }

      if (empty($_POST['sub_category'])) {
        $sub_categoryErr = 'Sub-category is required';
      }else {
        $sub_category = test_input($_POST['sub_category']);
      }

      if (empty($_POST['color'])) {
        $colorErr = 'Color is required';
      }else {
        $color = test_input($_POST['color']);
      }

      if (empty($_POST['quantity'])) {
        $quantityErr = 'Quantity is required';
      }else {
        $quantity =(int) test_input($_POST['quantity']);
      }

      if (empty($_POST['price'])) {
        $priceErr = 'Price is required';
      }else {
        $price = (float) test_input($_POST['price']);
      }

        $file_name = $_FILES['file']['name']; // file name
        $file_tem_loc = $_FILES['file']['tmp_name']; // file temporary location(from where to upload)
        $file_type = $_FILES['file']['type']; // flie extension format
        $file_store = "image/product/" . $file_name; // file permanent location



        $conn = new mysqli('localhost', 'root', '', 'ecommerce');
        $dup_name = mysqli_query($conn,"select * from product where name = '$name' and category = '$category' and sub_category = '$sub_category'");
        $dup_pic = mysqli_query($conn,"select location from product where locate('$file_name',location)");

        if($file_name==''){
          $locationErr = 'Include the file';
        }elseif(mysqli_num_rows($dup_pic)>0){
          $locationErr = 'File already exists';
        }else {
          if (mysqli_num_rows($dup_name)==0 ){
            if($file_type == 'image/png' || $file_type == 'image/gif' || $file_type == 'image/jpeg' || $file_type == 'image/jpg'){
              move_uploaded_file($file_tem_loc, $file_store); // store the file in permanent location
              $location = $file_store;
            }else{
              $locationErr = 'Invalid file format';
              $location = '';
            }
          }
          else {
            $nameErr = 'File name already exists';
          }
        }
        $conn->close();

    }

    function test_input($data) {
    $data = trim($data);
    return $data;
    }

    if(!empty($_POST['name']) && !empty($_POST['category']) && !empty($_POST['sub_category']) && !empty($_POST['quantity']) && !empty($_POST['price']) && $location != ''){

      $conn = new mysqli('localhost', 'root', '', 'ecommerce');
      $dup = mysqli_query($conn,"select * from product where name = '$name' and sub_category='$sub_category'");
      if (mysqli_num_rows($dup)==0 ) {
        $sql = "insert into product(name,category,sub_category,color,quantity,price,location)values('$name','$category','$sub_category','$color','$quantity','$price','$location')";
        mysqli_query($conn,$sql);
        $name = $category = $sub_category = $color = $quantity = $price = $location ='';
      }
      $conn->close();
    }

   ?>

  <div>
    <?php fun1($_SESSION['username'],$_SESSION['logout']); ?>
  </div>

  <div class="container" style="padding: 100px 0;">
    <div class="row">
      <div class="col-lg-3 col-md-3 col-sm-0"></div>
      <div class="col-lg-6 col-md-6 col-sm-12">
        <form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>" enctype="multipart/form-data">
          <input type="text" name="name" value="<?php echo $name; ?>" placeholder="Name" style="width: 26.25rem;"><br>
          <span> <?php echo $nameErr;?> </span><br>
          <input type="text" name="category" value="<?php echo $category; ?>"  placeholder="Category" style="width: 13rem;">
          <input type="text" name="sub_category" value="<?php echo $sub_category; ?>"  placeholder="Sub-Category" style="width: 13rem;"><br>
          <span style="padding-right: 3.125rem;"> <?php echo $categoryErr;?> </span>
          <span> <?php echo $sub_categoryErr;?> </span><br>
          <input type="text" name="color" value="<?php echo $color; ?>" placeholder="Color" style="width: 26.25rem;"><br>
          <span> <?php echo $colorErr;?> </span><br>
          <input type="text" name="quantity"  value="<?php echo $quantity; ?>" placeholder="Quantity" style="width: 13rem;">
          <input type="text" name="price" value="<?php echo $price; ?>" placeholder="Price" style="width: 13rem;"><br>
          <span style="padding-right: 5rem;"> <?php echo $quantityErr;?> </span>
          <span> <?php echo $priceErr;?> </span><br>
          <input type="file" name="file" style="border: none; margin-left: -125px;"><br>
          <span style="float: left; margin-left: 4.375rem;"> <?php echo $locationErr;?> </span><br><br>
          <input class="submit" type="submit" name="upload" value="UPLOAD DATA" style="width: 26.25rem;"><br><br><br><br>
          <a class='btn btn-info addItemBtn' href='admin.php' style="font-size: 20px;">Go Back</a>
        </form>
      </div>
      <div class="col-lg-3 col-md-3 col-sm-0"></div>
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
