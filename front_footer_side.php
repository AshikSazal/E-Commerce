<?php

  function fun2(){
    $element = "
      <div class='footer'>
      <div class='foot-info col-lg-6 col-md-6'>
        <h5>INFORMATION</h5><br>
        <a href='help_info.php'>Sign In</a><br>
        <a href='help_info.php'>View Cart</a><br>
        <a href='help_info.php'>Help & Info</a><br>
        <a href='help_info.php'>Purchasing Policy</a><br>
        <a href='help_info.php'>Terms & Condition</a>
        <div class='copy-right'>
          <div class='designed-by'>
            Copyright ©2020 all right reserved -
          </div>
          <div class='designed-by'>
            Designed by Trojan
          </div>
        </div>
      </div>
      <div class='foot-contact col-lg-6 col-md-6'>
        <h4>Contact Us</h4><br>
        <p>House #2 (3rd Floor), Road #8,<br>
          Dhanmondi, Dhaka-1209.</p>
        <p>Email: e-Commerce@gmail.com</p>
        <p>Contact no: +88017*****567</p>
        <div class='pay-list'>
          <ul>
            <li><i class='foot-icon text-white fab fa-cc-visa'></i></li>
            <li><i class='foot-icon text-white fab fa-cc-paypal'></i></li>
            <li><i class='foot-icon text-white fab fa-cc-amazon-pay'></i></li>
            <li><i class='foot-icon text-white fab fa-cc-google-pay'></i></li>
          </ul>
        </div>
      </div>
    </div>";

    echo $element;
  }

?>
