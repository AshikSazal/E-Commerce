<?php

function fun($productid,$productname,$productprice,$productimg,$rating,$notavailable){
  $star_rating='';
  if((int)$rating==$rating){
    for($i=1;$i<=(int)$rating;$i++){
      $star_rating=$star_rating."<i class='fas fa-star'></i>";
    }
  }else{
    for($i=1;$i<=(int)$rating;$i++){
      $star_rating=$star_rating."<i class='fas fa-star'></i>";
    }
    $star_rating=$star_rating."<i class='fas fa-star-half-alt'></i>";
  }
  
  $element="
  <div class='col-lg-3 col-md-6 col-sm-12' style='padding-bottom: 30px;'>
  <div id='message'></div>
    <form class='form-submit' action='product_show.php' method='post'>
      <div class='back-shadow'>
        <div class='text-block'>
          <h4>$notavailable</h4>
        </div>
        <div><img class='pro-img' src='$productimg'></div>
        <h5>$productname</h5>
        <h6>
          $star_rating
        </h6>
        <h6><span class='price'>$$productprice</span></h6>
        <button class='btn btn-info addItemBtn' type='submit' name='add'>Add to Cart <i class='fas fa-shopping-cart'></i></button><br><br>
        <a href='review.php?product_id=$productid' class='btn btn-dark'>Review</a>
        <input type='hidden' class='p_id' value='$productid'>
        <input type='hidden' class='p_name' value='$productname'>
        <input type='hidden' class='p_price' value='$productprice'>
        <input type='hidden' class='p_image' value='$productimg'>
        <input type='hidden' class='p_image' value='$rating'>
      </div>
    </form>
  </div>";

  echo $element;
  }

 ?>
