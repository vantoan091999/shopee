<?php
	include '../classes/adminlogin.php';

?>
<?php
	$class = new Adminlogin();//tạo một biến mới bằng class bên file adminlogin.php đã tạo liên kết ở trên để gọi class
	if($_SERVER['REQUEST_METHOD'] == 'POST'){ //fform đăng nhập dùng phương thức post gửi dữ liệu
		$adminuser = $_POST['adminUser'];//tạo biến để lấy giữ liệu từ mảng POST
		$adminPass = md5($_POST['adminPass']);

		$login_check = $class->login_admin($adminuser,$adminPass);
		// đặt 1 biến bằng class dùng '->'dấu mũi tên để triệu gọi hàm login_admin và truyền vào 2 biến trên để kiểm tra
	}

?>

<!DOCTYPE html>
<head>
<meta charset="utf-8">
<title>Login</title>
    <link rel="stylesheet" type="text/css" href="css/stylelogin.css" media="screen" />
</head>
<body>
<div class="container">
	<section id="content">
		<form action="login.php" method="post">
			<h1>Admin Login</h1>
			<span> <?php
				if(isset($login_check)){
					echo $login_check;
				}
			?></span>
			<div>
				<input type="text" placeholder="Username"  name="adminUser"/>
				<!-- require thông báo k nhập lại khi ng dùng k nhập gì vào ô ng dùng  -->
			</div>
			<div>
				<input type="password" placeholder="Password"  name="adminPass"/>
			</div>
			<div>
				<input type="submit" value="Log in" />
			</div>
		</form><!-- form -->
		<div class="button">
			<a href="#">Training with live project</a>
		</div><!-- button -->
	</section><!-- content -->
</div><!-- container -->
</body>
</html>