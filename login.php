<?php  
	session_start();
	require'functions.php';

	if( isset($_COOKIE['key']) && isset($_COOKIE['code']) ){

		$cipher="AES-128-CBC";
		$id = openssl_decrypt($_COOKIE['key'], $cipher, 'password');
		$code = $_COOKIE['code'];

		// ambil username berdasarkan id
		$result = mysqli_query($conn, "SELECT username, level_user FROM user WHERE id = $id");
		$row = mysqli_fetch_assoc($result);
		
		// cek cookie dan username
		if( $code === hash('sha256', $row['username']) ){
			
			if( $row["level_user"] === 'sw' ){
				$_SESSION["sw"] = $row["username"];	
			}else if( $row["level_user"] === 'pb' ){
				$_SESSION['admin'] = $row['username'];
			}
		}

	}


	if( isset($_SESSION["sw"]) ){
		header("Location: user/index.php");
		exit;
	}else if( isset($_SESSION["admin"]) ){
		header("Location: admin/index.php");
		exit;
	}

	( isset($_POST["btn_login"]) ) ? login($_POST) : "";

?>
<!DOCTYPE html>
<html>
<head>
	<title>AppSend - Sign In or  Sign Up</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="assets/css/login.css?version=<?php echo filemtime('assets/css/login.css'); ?>">
	<link rel="stylesheet" href="assets/fontawesome5.3.1/css/all.css">
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
</head>
<body>

	<div class="form-login">
	
		<div class="container">

			<h1><span class="fa fa-user-tie fa-1x"></span>&nbsp; LOGIN</h1>
			<br>
			<form class="form" action="" method="post" onsubmit="return validateFormLogin()" name="formLogin">

				<?php require 'status.php'; ?>

				<div class="form-group">
					<input id="email" type="text" name="username" autocomplete="off" class="form-control" placeholder="Email or Username" data-toggle="popover" data-trigger="hover" data-content="Email atau Username" required>
				</div>

				<div class="form-group">
					<input type="password" name="password" id="password" class="form-control" placeholder="Password" required>
				</div>
				<div class="form-group form-check">
					<input type="checkbox" class="form-check-input" name="remember" id="remember">
					<label for="remember" class="form-check-label">Remember Me</label>
				</div>
					
				<button type="submit" name="btn_login" class="btn btn-outline-primary btn-block">Sign In</button> 
					
				<span class="or">or</span>
					
				<a href="user/register.php"><div class="btn btn-success btn-block">Sign Up</div></a>
				
			</form>
		</div>
	</div>
	<!-- https://www.hakkoblogs.com -->
<script src="assets/js/jquery.slim/jquery.slim.min.js"></script>
<script src="assets/js/popper.js/dist/umd/popper.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/js/jquery-3.2.1.min.js"></script>
<script src="assets/js/validateForm.js"></script>

</body>
</html>