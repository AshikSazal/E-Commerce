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
  <link rel="stylesheet" href="style/front_page.css">
  <link rel="stylesheet" href="style\bootstrap.min.css">
  <script src="js/jquery.js"></script>

</head>

<body>

  <div>
    <?php fun1($_SESSION['username'],$_SESSION['logout']); ?>
  </div>

  <div class="container-fluid" style="margin-top: 95px;">
    <div class="row">
      <div class="col-lg-12 col-sm-12 col-md-12">
        <p>
          <h3>
            Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of "de Finibus Bonorum et Malorum" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in section 1.10.32.
          </h3><br><br>
          <h3>
            The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from "de Finibus Bonorum et Malorum" by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.
          </h3>
        </p>
      </div>
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
