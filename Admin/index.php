
<!DOCTYPE html>
<html lang="en">
<head>
<title>Đăng nhập quản trị viên</title>
<meta name="viewport" content="width=device-width, initial-scale=1" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Clean Login Form Responsive, Login Form Web Template, Flat Pricing Tables, Flat Drop-Downs, Sign-Up Web Templates, Flat Web Templates, Login Sign-up Responsive Web Template, Smartphone Compatible Web Template, Free Web Designs for Nokia, Samsung, LG, Sony Ericsson, Motorola Web Design" />
<link href="/css/admin/main.css" rel="stylesheet" type="text/css" media="all" />
<body>
<div class="container demo-1 content">
        <div id="large-header" class="large-header">
			<h1>live for food</h1>
				<div class="main-agileits">
				<!--form-stars-here-->
                <div id="loginForm" class="container">
						<div class="form-w3-agile">
							<h2>Đăng nhập quản trị viên</h2>
							<form action="#" method="post">
								<div class="form-sub-w3">
									<input type="text" name="Username" placeholder="Username " required="" />
								<div class="icon-w3">
									<i class="fa fa-user" aria-hidden="true"></i>
								</div>
								</div>
								<div class="form-sub-w3">
									<input type="password" name="Password" placeholder="Password" required="" />
								<div class="icon-w3">
									<i class="fa fa-unlock-alt" aria-hidden="true"></i>
								</div>
							</div>
								<p class="p-bottom-w3ls">Forgot Password?<a class href="#">  Click here</a></p>
								<p class="p-bottom-w3ls1">New User?  <a href="javascript:void(0);" onclick="showRegisterForm()">Register here</a></p>
								<div class="clear"></div>
								<div class="submit-w3l">
									<input type="submit" value="Login">
								</div>
							</form>

						</div>
                    </div>

</div>
        </div>
</div>


</body>
</html>
<?php
require_once __DIR__ . "/../database/api/postData.php";
if (isset($_POST['Username']) && isset($_POST['Password'])) {
    $postData = new postData();
    $id = $postData->postData("loginAdmin", $_POST['Username'], $_POST['Password']);
    if ($id) {
        session_start();
        $_SESSION['id'] = $id;
        $_SESSION["user_admin"] = true;
        header("Location: /Admin/Dashboard/index.php");
    } else {
        echo "<script>alert('Tên đăng nhập hoặc mật khẩu không đúng')</script>";
    }
}
?>

