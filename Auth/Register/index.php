<?php
$title = 'Đăng Ký';

$_pathCss = "chan.css";
require __DIR__ . '/../../inc/head.php';
if (isset($_SESSION['id_account'])){
  header('Location: /views/Home ');
}
?>
 <section id="register">
        <div class="container-register" >
          <div class="form">
            <div>
              <h1>Đăng ký thành viên</h1>
            </div>
            <form action="post.php" method="post">
              <div class="input">
                <label for="name">Họ và tên</label>
                <input type="text" name="name" id="name" />
              </div>
              <div class="input">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" placeholder="ex:example@gmail.com"/>
              </div>
              <div class="input">
                <label for="address">Địa chỉ</label>
                <input type="text" name="address" id="address" />
              </div>
              <div class="input">
                <label for="phone">Số điện thoại</label>
                <input type="text" name="phone" id="phone"  />
              </div>
              <div class="input gender">
                <div class="male">
                  <input type="radio" name="gender" id="male" value="nam">
                  <label for="male">Nam</label>
                </div>
                <div class="female">
                  <input type="radio" name="gender" value="nữ" id="female">
                  <label for="female">Nữ</label>
                </div>
              </div>
              <div class="input">
                <label for="username">Tên đăng nhập</label>
                <input type="text" name="username" id="username" />
              </div>
              <div class="input">
                <label for="password">Mật khẩu</label>
                <input type="password" name="password" id="password" />
              </div>
              <div class="input">
                <label for="repassword">Nhập lại mật khẩu</label>
                <input type="password" name="repassword" id="repassword" />
              </div>
              <div class="input">
                <input type="submit" value="Đăng ký" />
              </div>
            </form>
          </div>
        </div>
</section>
