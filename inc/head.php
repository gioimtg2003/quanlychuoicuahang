<?php 
if(!isset($_SESSION)) session_start();
require_once __DIR__ . '/../database/api/getData.php';
$getData = new getData();

// echo "<br>" .$_SESSION['id_account']. "<br>";
// $profile = $profile->getInfo($_SESSION['id_account'])[0]['name'];
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?php echo $title ?></title>
    <link data-default-icon="https://static.xx.fbcdn.net/rsrc.php/yD/r/d4ZIVX-5C-b.ico" data-badged-icon="https://static.xx.fbcdn.net/rsrc.php/ye/r/Ta8_J_nYekI.ico" rel="shortcut icon" href="https://static.xx.fbcdn.net/rsrc.php/yD/r/d4ZIVX-5C-b.ico">
    <link rel="stylesheet" href="/css/about.css"  />
    <link rel="stylesheet" href="<?=$_pathCss?>"  />
    <script
      src="https://kit.fontawesome.com/0a37ab2a11.js"
      crossorigin="anonymous"
    ></script>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="/js/logout.js"></script>
    <script src="/js/cart.js"></script>
  </head>
  <body>
    <div class="top">
      <div class="container top-bar">
        <div class="item-top">
          <a href="/" title="Chi nhánh">
            <i class="fa-solid fa-location-dot"></i>
            <span>Có hơn 200 chi nhánh toàn quốc</span>
          </a>
        </div>
        <div class="item-top">
          <a href="/" title="Liên hệ">
            <i class="fa-sharp fa-solid fa-phone-volume"></i>
            <span>Liên hệ: 123456789</span>
          </a>
        </div>
        <div class="item-top">
          <a href="/" title="Miễn phí vận chuyển">
            <i class="fa-solid fa-helicopter"></i>
            <span>Free ship đơn trên 50.000đ</span>
          </a>
        </div>
      </div>
    </div>
    <header>
      <div class="container-header">
        <div class="header-nav">
          <div id="logo">
            <h2 title="LFF">Live For Food</h2>
          </div>
          <nav>
            <ul>
              <li><a href="/" title="Trang chủ">Trang chủ</a></li>
              <li><a href="/views/About" title="Giới thiệu">Giới thiệu</a></li>
              <li><a href="/views/Menu/" title="Thực đơn">Thực đơn</a></li>

              <?php
              if(isset($_SESSION['cart'])) $countCart = count($_SESSION['cart']);
              if (isset($_SESSION['id_account'])) {
              
    echo '<li class="cart">
    <a href="/views/Cart" title="Giỏ hàng">Giỏ hàng</a>';
    echo '<span class="count-cart">';
    if(isset($_SESSION['cart'])) echo $countCart;
    echo '</span>';
    echo '</li>';
    echo '<li><a href="/views/Order" title="Đơn hàng">Đơn hàng</a></li>';}?>
              <li><a href="/views/Facility"  title="Chi nhánh">Chi nhánh</a></li>
              <li><a href="/views/Blogs"  title="Tin tức">Tin tức</a></li>
            </ul>
          </nav>
        </div>
        <div class="auth">
            <!--login and logout-->
            <?php
if (isset($_SESSION['id_account'])) {
    $infoPerson = $getData->getData('profile', $_SESSION['id_account'])[0];
    $_SESSION["name"] = $infoPerson['name'];
    $_SESSION["phone"] = $infoPerson['phone'];
    $_SESSION["address"] = $infoPerson['address'];
    if(!isset($_SESSION["cart"]) ) $_SESSION["cart"] = [];
    $profile = $_SESSION["name"];
    echo <<<PROFILE
            <div class="auth-item profile">
              <a href="/views/profile.php" title="$profile">$profile</a>
            </div>
            <div class="auth-item" >
              <a href="#" title="Click để đăng xuất" id ="logout" onclick="logout()">Đăng xuất</a>
            </div>
            PROFILE;
};
if (!isset($_SESSION['id_account'])) {
    echo <<<AUTH
            <div class="auth-item">
              <a href="/auth/Login" title="Click để đăng nhập thành viên">Đăng nhập</a>
            </div>
            <div class="auth-item">
              <a href="/auth/Register" title="Click để đăng ký">Đăng ký</a>
            </div>
          AUTH;
}
?>
        </div>
      </div>
    </header>
    <main>

