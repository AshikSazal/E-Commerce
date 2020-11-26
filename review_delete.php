<?php
    $id=$_GET['id'];
    $product_id=$_GET['product_id'];
    $conn=new mysqli('localhost','root','','ecommerce');
    mysqli_query($conn,"delete from review where id='$id'");
    echo "<script>location.href='product_review_admin.php?product_id=$product_id'</script>";
?>