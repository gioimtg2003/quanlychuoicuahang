<?php
$title = 'Đăng Nhập';
$_pathCss = "test.css";
require_once  __DIR__ . '/../../inc/head.php';
require_once __DIR__ . '/../../database/api/postData.php';
if (isset($_SESSION['id_account'])){
  header('Location: /views/Home ');
}
 ?>
  <section class="login">
            <div class="container-login">
                <div class="form">
                    <div>
                        <h5 id="accoutlogin">Đăng nhập tài khoản</h5>
                        <form action="" method="post">
                            <div class="input">
                                <label for="username">Tên đăng nhập</label>
                                <input type="text" name="username" id="username" placeholder="Nhập tên đăng nhập" />
                            </div>
                            <div class="input">
                                <label for="password">Mật khẩu</label>
                                <input type="password" name="password" id="password" placeholder="Nhập mật khẩu" />
                            </div>
                            <button id="button">Đăng Nhập</button>
                        </form>
                        <a class="register2" title="Click vào đây để đăng ký" href="/register">Chưa có tài khoản? Đăng ký ngay</a>
                    </div>
                </div>
                <div class="img1">
                    <img src="/img/loginBG.png" height="250px" width="250px" alt="">
                </div>
            </div>
        </section>
      <?php
    if($_SERVER['REQUEST_METHOD']== 'POST' && isset($_SERVER)){
        $accountLogin = new postData();
        $id = $accountLogin->postData('login', $_POST['username'], $_POST['password']);
        if ($id){
          $_SESSION['id_account'] = $id;
            header('Location: / ');
        } 
        else{
          echo "<script>alert('Tên đăng nhập hoặc mật khẩu không đúng')</script>";
        }   
    } 

?>
        