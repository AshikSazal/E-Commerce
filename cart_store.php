<?php
session_start();
if(!isset($_SESSION['create_tbl'])){
  $_SESSION['create_tbl']='';
}
if(!isset($_SESSION['user_email'])){
  $_SESSION['user_email']='';
}
if (!isset($_SESSION['username2'])) {
  $_SESSION['username2'] = '';
}
if (!isset($_SESSION['userid'])) {
  $_SESSION['userid'] = '';
}
if(!isset($_SESSION['item_quantity'])){
  $_SESSION['item_quantity']=0;
}

// cart value store in database
if (isset($_POST['p_id'])) { // from product.php
  if($_SESSION['user_email']==''){
    echo "<script>alert('Log in first')</script>";
    echo("<script>location.href = 'sign_in.php';</script>");
  }else{
    $pid=$_POST['p_id'];
    $conn = new mysqli('localhost','root','','ecommerce');
    $result = mysqli_query($conn,"select * from product where id='$pid' and quantity>0");
    if (mysqli_num_rows($result)==0) {
      echo "<script>alert('Not Available')</script>";
    }else {
      $pname=$_POST['p_name'];
      $pprice=$_POST['p_price'];
      $ptotalprice=$_POST['p_price'];
      $pimage=$_POST['p_image'];
      $pqty=1;

      $create_tbl = $_SESSION['username'].$_SESSION['username2'].$_SESSION['userid'];
      $_SESSION['create_tbl']=$create_tbl;


      mysqli_query($conn,"create table $create_tbl(id int not null auto_increment primary key,pid varchar(20),pname varchar(20),pprice double,pquantity int,ptotalprice double,pimage varchar(100),status int)");
      $sql = "insert into $create_tbl(pid,pname,pprice,pquantity,ptotalprice,pimage,status)values('$pid','$pname','$pprice','$pqty','$ptotalprice','$pimage',1)";
      $result=mysqli_query($conn,"select * from $create_tbl where pid='$pid'");

      if($result){
        if(mysqli_num_rows($result)>0){
          $result2=mysqli_query($conn,"select * from $create_tbl where status=0");
          if (mysqli_num_rows($result2)>0) {
            mysqli_query($conn,"update $create_tbl set status=1,pquantity=1,ptotalprice='$pprice' where pid='$pid'"); // value change in old table
          }else {
            echo "<script>alert('Item already added')</script>";
          }

        }else {
          //echo "<script>alert('successfully added')</script>";
          mysqli_query($conn,$sql); // insert into new table
        }
      } else {
         echo "<script>alert('Table not found')</script>";
       }
    }
    $conn->close();
  }

}

// cart item count and show
if(isset($_GET['cartItem']) && isset($_GET['cartItem']) == 'cart_count'){
  $conn = new mysqli('localhost','root','','ecommerce');
  $user_tbl=$_SESSION['username'].$_SESSION['username2'].$_SESSION['userid'];
  $sql = "select * from $user_tbl where status=1";
  //$_SESSION['item_quantity']=0;
  $result= mysqli_query($conn,$sql);
  if($result){
    $_SESSION['item_quantity'] = mysqli_num_rows($result);
  }
  echo $_SESSION['item_quantity'];
  $conn->close();
}

// remove the particular item from cart.php for individual user table
if(isset($_GET['remove'])){
  $pid=$_GET['remove'];
  $conn = new mysqli('localhost','root','','ecommerce');
  $user_tbl=$_SESSION['username'].$_SESSION['username2'].$_SESSION['userid'];
  $sql = "delete from $user_tbl where pid='$pid'";
  mysqli_query($conn,$sql);
  $conn->close();
  header('location: cart.php');
}


// remove all the cart item
if(isset($_GET['clear'])){
  $conn = new mysqli('localhost','root','','ecommerce');
  $user_tbl=$_SESSION['username'].$_SESSION['username2'].$_SESSION['userid'];
  $sql = "truncate $user_tbl";
  mysqli_query($conn,$sql);
  $conn->close();
  header('location: cart.php');
}


// Item quantity change
if(isset($_POST['pquantity'])){
  $pquantity=$_POST['pquantity'];
  $pid=$_POST['pid'];
  $pprice=$_POST['pprice'];

  $conn = new mysqli('localhost','root','','ecommerce');

  $result = mysqli_query($conn,"select quantity from product where id='$pid'");
  if($result){
    $row = $result->fetch_assoc();
    if($row['quantity']>=$pquantity){
      $total_price=$pquantity*$pprice;
      $user_tbl=$_SESSION['username'].$_SESSION['username2'].$_SESSION['userid'];
      $sql = "update $user_tbl set pquantity='$pquantity',ptotalprice='$total_price' where pid='$pid'";
      mysqli_query($conn,$sql);
    }else {
      $pquantity = $row['quantity'];
      $total_price=$pquantity*$pprice;
      $user_tbl=$_SESSION['username'].$_SESSION['username2'].$_SESSION['userid'];
      $sql = "update $user_tbl set pquantity='$pquantity',ptotalprice='$total_price' where pid='$pid'";
      mysqli_query($conn,$sql);
    }
  }


  $conn->close();
}
?>
