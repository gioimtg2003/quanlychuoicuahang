<?php
require __DIR__ . '/../../database/api/postData.php';

// kiểm tra xem có phải là phương thức post và có tồn tại biến $_SERVER
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_SERVER)) {
    $registerAccount = new postData();
   // post data để đăng ký account
    if ($registerAccount->postData("register", $_POST['username'], $_POST['password'], $_POST['email'], $_POST['address'], $_POST['phone'], $_POST['name'], $_POST['gender'])) {
        header('Content-Type: application/json');
        echo "<script>alert('Đăng ký thành công')</script>";
        header('Location: /Auth/Login/', true, 301);
    }
}
?>