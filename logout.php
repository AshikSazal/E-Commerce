<?php

  session_start();
  $_SESSION['username'] = '';
  $_SESSION['logout'] = '';
  $_SESSION['username'] ='';
  $_SESSION['username2'] = '';
  $_SESSION['userid'] = '';
  $_SESSION['logout'] = 'logout';
  $_SESSION['user_email']='';
  $_SESSION['item_quantity']=0;
  $_SESSION['create_tbl']='';
  $_SESSION['product_id']='';

  // session_start(); // for unset session varibale
  // session_unset();
  // session_destroy();


  //session_destroy();
  header('location: front_page.php');
?>
