<?php

  function fun1($username,$logout){
    //session_start();
    $conn = new mysqli('localhost','root','','ecommerce');
    $sql = "select name, password from admin_info where name='$username' and password='$logout'";
    $result = mysqli_query($conn,$sql);

    if($result->num_rows>0){
      $element = "
      <div class='container-fluid header'>
        <div class='row upper-right-side'>
          <div class='col-lg-10 col-md-9 col-sm-6'></div>
          <div class='col-lg-2 col-md-3 col-sm-6 hs'>
            <a class='as' href='help_info.php'>HELP & INFO</a>
          </div>
        </div>
        <div class='menu-bar row'>
          <div class='go-to-home col-md-3 col-lg-2'>
            <h1 class='centered'>
              <a href='front_page.php' id='home-replace'>HOME</a>
            </h1>
          </div>

          <div class='drop-all col-md-4 col-lg-5'>

          <div class='dropdown'>
            <button class='dropbtn'>MAN</button>
            <div class='dropdown-content'>
              <a class='menu' href='product_show.php?category=shirt&sub_category=man'>SHIRT</a>
              <a class='menu' href='product_show.php?category=t-shirt&sub_category=man'>T-SHIRT</a>
              <a class='menu' href='product_show.php?category=pant&sub_category=man'>PANT</a>
              <a class='menu' href='product_show.php?category=jacket&sub_category=man'>JACKET</a>
              <a class='menu' href='product_show.php?category=shoe&sub_category=man'>SHOES</a>
            </div>
          </div>

          <div class='dropdown'>
            <button class='dropbtn'>WOMAN</button>
            <div class='dropdown-content'>
              <a class='menu menu1' href='product_show.php?category=tops and t-shirt&sub_category=woman'>TOPS & T-SHIRT</a>
              <a class='menu' href='product_show.php?category=shirt&sub_category=woman'>SHIRT</a>
              <a class='menu' href='product_show.php?category=pant&sub_category=woman'>PANT</a>
              <a class='menu' href='product_show.php?category=jacket&sub_category=woman'>JACKET</a>
              <a class='menu' href='product_show.php?category=shoe&sub_category=woman'>SHOES</a>
            </div>
          </div>

            <div class='dropdown'>
              <button class='dropbtn'>KIDS</button>
              <div class='dropdown-content'>
                <a class='menu menu1' href='#'>TOYS</a>
                <a class='menu' href='#'>DOLLS</a>
                <a class='menu' href='#'>T-SHIRT</a>
                <a class='menu' href='#'>SHOES</a>
                <a class='menu' href='#'>JACKET</a>
              </div>
            </div>

            <div class='dropdown'>
              <button class='dropbtn'>GOODS</button>
              <div class='dropdown-content'>
                <a class='menu menu1' href='#'>OUTDOOR FACE SHIELD</a>
                <a class='menu' href='#'>HARDWARE</a>
                <a class='menu' href='#'>HEADPHONE</a>
                <a class='menu' href='#'>GIFT CARDS</a>
                <a class='menu' href='#'>SPEAKER</a>
                <a class='menu' href='#'>WATCH</a>
              </div>
            </div>

            <div class='dropdown'>
              <button class='dropbtn'>SPORTS</button>
              <div class='dropdown-content'>
                <a class='menu menu1' href='#'>BAT</a>
                <a class='menu' href='#'>BALL</a>
                <a class='menu' href='#'>HANDGLOVES</a>
                <a class='menu' href='#'>TROUSER</a>
                <a class='menu' href='#'>BAG</a>
              </div>
            </div>

          </div>

          <div class='search-bar col-lg-2.5'>
            <div class='search-container'>
              <form action='search_item.php'method='get'>
                <input type='text' placeholder='Search...' name='search'>
                <button type='submit' name='submit' value='submit'><i class='fa fa-search'></i></button>
              </form>
            </div>
          </div>

          <div class='cart col-lg-2'>
          </div>
          <div class='col-lg-.5'>
            <div class='dropdown'>
              <img src='image/login icon.png' style='height: 40px; width: 40px; margin: 10px 0; cursor: pointer;'>
              <div class='dropdown-content' style='color: black; left: -80px; min-width: 150px; padding-left: 10px;'>
              <a class='menu' href='admin.php'>Admin contorl panel</a>
              <a class='menu' href='logout.php'>logout</a>
              </div>
            </div>
          </div>
        </div>
      </div>";
    }elseif($username==''){
      $element = "<div class='container-fluid header'>
        <div class='row upper-right-side'>
          <div class='col-lg-10 col-md-9 col-sm-6'></div>
          <div class='col-lg-2 col-md-3 col-sm-6 hs'>
            <a class='as' href='help_info.php'>HELP & INFO</a>
            <a class='as1' href='sign_in.php'>SIGN IN</a>
          </div>
        </div>
        <div class='menu-bar row'>
          <div class='go-to-home col-md-3 col-lg-2'>
            <h1 class='centered'>
              <a href='front_page.php' id='home-replace'>HOME</a>
            </h1>
          </div>

          <div class='drop-all col-md-4 col-lg-5'>

          <div class='dropdown'>
            <button class='dropbtn'>MAN</button>
            <div class='dropdown-content'>
              <a class='menu' href='product_show.php?category=shirt&sub_category=man'>SHIRT</a>
              <a class='menu' href='product_show.php?category=t-shirt&sub_category=man'>T-SHIRT</a>
              <a class='menu' href='product_show.php?category=pant&sub_category=man'>PANT</a>
              <a class='menu' href='product_show.php?category=jacket&sub_category=man'>JACKET</a>
              <a class='menu' href='product_show.php?category=shoe&sub_category=man'>SHOES</a>
            </div>
          </div>

          <div class='dropdown'>
            <button class='dropbtn'>WOMAN</button>
            <div class='dropdown-content'>
              <a class='menu menu1' href='product_show.php?category=tops and t-shirt&sub_category=woman'>TOPS & T-SHIRT</a>
              <a class='menu' href='product_show.php?category=shirt&sub_category=woman'>SHIRT</a>
              <a class='menu' href='product_show.php?category=pant&sub_category=woman'>PANT</a>
              <a class='menu' href='product_show.php?category=jacket&sub_category=woman'>JACKET</a>
              <a class='menu' href='product_show.php?category=shoe&sub_category=woman'>SHOES</a>
            </div>
          </div>

            <div class='dropdown'>
              <button class='dropbtn'>KIDS</button>
              <div class='dropdown-content'>
                <a class='menu menu1' href='#'>TOYS</a>
                <a class='menu' href='#'>DOLLS</a>
                <a class='menu' href='#'>T-SHIRT</a>
                <a class='menu' href='#'>SHOES</a>
                <a class='menu' href='#'>JACKET</a>
              </div>
            </div>

            <div class='dropdown'>
              <button class='dropbtn'>GOODS</button>
              <div class='dropdown-content'>
                <a class='menu menu1' href='#'>OUTDOOR FACE SHIELD</a>
                <a class='menu' href='#'>HARDWARE</a>
                <a class='menu' href='#'>HEADPHONE</a>
                <a class='menu' href='#'>GIFT CARDS</a>
                <a class='menu' href='#'>SPEAKER</a>
                <a class='menu' href='#'>WATCH</a>
              </div>
            </div>

            <div class='dropdown'>
              <button class='dropbtn'>SPORTS</button>
              <div class='dropdown-content'>
                <a class='menu menu1' href='#'>BAT</a>
                <a class='menu' href='#'>BALL</a>
                <a class='menu' href='#'>HANDGLOVES</a>
                <a class='menu' href='#'>TROUSER</a>
                <a class='menu' href='#'>BAG</a>
              </div>
            </div>

          </div>

          <div class='search-bar col-lg-2.5'>
            <div class='search-container'>
              <form action='search_item.php'method='get'>
                <input type='text' placeholder='Search...' name='search'>
                <button type='submit' name='submit' value='submit'><i class='fa fa-search'></i></button>
              </form>
            </div>
          </div>

          <div class='cart col-lg-2'>
            <a href='cart.php'>
              <i class='fas fa-cart-plus'>CART</i>
              <span id='cart_count'></span>
            </a>
          </div>

        </div>
      </div>";
    }
    else{
      $element="
      <div class='container-fluid header'>
        <div class='row upper-right-side'>
          <div class='col-lg-10 col-md-9 col-sm-6'></div>
          <div class='col-lg-2 col-md-3 col-sm-6 hs'>
            <a class='as' href='help_info.php'>HELP & INFO</a>
          </div>
        </div>
        <div class='menu-bar row'>
          <div class='go-to-home col-md-3 col-lg-2'>
            <h1 class='centered'>
              <a href='front_page.php' id='home-replace'>HOME</a>
            </h1>
          </div>

          <div class='drop-all col-md-4 col-lg-5'>

          <div class='dropdown'>
            <button class='dropbtn'>MAN</button>
            <div class='dropdown-content'>
              <a class='menu' href='product_show.php?category=shirt&sub_category=man'>SHIRT</a>
              <a class='menu' href='product_show.php?category=t-shirt&sub_category=man'>T-SHIRT</a>
              <a class='menu' href='product_show.php?category=pant&sub_category=man'>PANT</a>
              <a class='menu' href='product_show.php?category=jacket&sub_category=man'>JACKET</a>
              <a class='menu' href='product_show.php?category=shoe&sub_category=man'>SHOES</a>
            </div>
          </div>

          <div class='dropdown'>
            <button class='dropbtn'>WOMAN</button>
            <div class='dropdown-content'>
              <a class='menu menu1' href='product_show.php?category=tops and t-shirt&sub_category=woman'>TOPS & T-SHIRT</a>
              <a class='menu' href='product_show.php?category=shirt&sub_category=woman'>SHIRT</a>
              <a class='menu' href='product_show.php?category=pant&sub_category=woman'>PANT</a>
              <a class='menu' href='product_show.php?category=jacket&sub_category=woman'>JACKET</a>
              <a class='menu' href='product_show.php?category=shoe&sub_category=woman'>SHOES</a>
            </div>
          </div>

            <div class='dropdown'>
              <button class='dropbtn'>KIDS</button>
              <div class='dropdown-content'>
                <a class='menu menu1' href='#'>TOYS</a>
                <a class='menu' href='#'>DOLLS</a>
                <a class='menu' href='#'>T-SHIRT</a>
                <a class='menu' href='#'>SHOES</a>
                <a class='menu' href='#'>JACKET</a>
              </div>
            </div>

            <div class='dropdown'>
              <button class='dropbtn'>GOODS</button>
              <div class='dropdown-content'>
                <a class='menu menu1' href='#'>OUTDOOR FACE SHIELD</a>
                <a class='menu' href='#'>HARDWARE</a>
                <a class='menu' href='#'>HEADPHONE</a>
                <a class='menu' href='#'>GIFT CARDS</a>
                <a class='menu' href='#'>SPEAKER</a>
                <a class='menu' href='#'>WATCH</a>
              </div>
            </div>

            <div class='dropdown'>
              <button class='dropbtn'>SPORTS</button>
              <div class='dropdown-content'>
                <a class='menu menu1' href='#'>BAT</a>
                <a class='menu' href='#'>BALL</a>
                <a class='menu' href='#'>HANDGLOVES</a>
                <a class='menu' href='#'>TROUSER</a>
                <a class='menu' href='#'>BAG</a>
              </div>
            </div>

          </div>

          <div class='search-bar col-lg-2.5'>
            <div class='search-container'>
              <form action='search_item.php'method='get'>
                <input type='text' placeholder='Search...' name='search'>
                <button type='submit' name='submit' value='submit'><i class='fa fa-search'></i></button>
              </form>
            </div>
          </div>

          <div class='cart col-lg-2'>
            <a href='cart.php'>
              <i class='fas fa-cart-plus'>CART</i>
              <span id='cart_count'></span>
            </a>
          </div>
          <div class='col-lg-.5'>
            <div class='dropdown'>
              <img src='image/login icon.png' style='height: 40px; width: 40px; margin: 10px 0; cursor: pointer;'>
              <div class='dropdown-content' style='color: black; left: -40px; min-width: 90px; padding-left: 10px;'>
                <a class='menu' href='my_profile.php'>My profile</a>
                <a class='menu' href='order_info.php'>My order</a>
                <a class='menu' href='logout.php'>logout</a>
              </div>
            </div>
          </div>
        </div>
      </div>";
    }

    echo $element;
  }

?>
