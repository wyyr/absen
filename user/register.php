<?php require '../functions.php';
	( isset($_POST["btn_register"]) ) ? register($_POST) : "";
?>
<!DOCTYPE html>
<html>
<head>
	<title>Sign Up</title>
	<link rel="stylesheet" href="../assets/css/register.css?version=<?php echo filemtime('../assets/css/register.css'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="../assets/fontawesome5.3.1/css/all.css">
	<link rel="stylesheet" href="../assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="../assets/css/animate.css/animate.min.css">
</head>	
<body>

	<div class="main">
		<div class="form-register">		

			<div class="container">	
				<h1><span class="fa fa-user-tie fa-1x"></span>&nbsp; Register</h1>
				<br>
				<form action="" method="post" name="formRegister" onsubmit="return validateFormRegister()"> 

					<div class="form-group">
						<input class="form-control" type="text" name="nama_user" id="nama_user" placeholder="Masukkan Nama Lengkap" autocomplete="off" required>
					</div>
					<div class="form-group">
						<input class="form-control" type="text" name="username" id="username" placeholder="Username" autocomplete="off" required>
					</div>
					<?php 
					if( isset($_GET["ex"]) ) {
						if( $_GET["ex"] == 1 ) {
							echo '<div class="alert alert-warning alert-dismissible fade show">
									<span class="fa fa-exclamation-triangle"></span>&nbsp; Username already exists
									<button type="button" class="close" data-dismiss="alert">&times;
								</div>';
						}
					}
					?>
					<div class="form-group">
						<input class="form-control" type="email" name="email" id="email" placeholder="Email" autocomplete="off" required>
					</div>
					<?php 
					if( isset($_GET["ex"]) ) {
						if( $_GET["ex"] == 2 ) {
							echo '<div class="alert alert-warning alert-dismissible fade show">
									<span class="fa fa-exclamation-triangle"></span>&nbsp; Email already exists
									<button type="button" class="close" data-dismiss="alert">&times;
								</div>';
						}
					}
					?>
					<div class="form-group">
						<input class="form-control" type="password" name="password" id="password" placeholder="Password" required>
					</div>

					<div class="form-check-inline">
						<input class="form-check-input" type="radio" name="gender" id="genderL" value="Laki - laki" checked="checked">
						<label class="form-check-label" for="genderL">Laki - laki</label>
					</div>
			
					<div class="form-check-inline">
						<input class="form-check-input" type="radio" name="gender" id="genderP" value="Perempuan">
						<label class="form-check-label" for="genderP">Perempuan</label>
					</div>
					<div class="form-group">
						<input class="form-control" type="number" name="hp" id="hp" maxlength="15" placeholder="No HP" autocomplete="off" required>
					</div>

					<div class="form-group">
						<input class="form-control" type="text" name="sekolah" id="sekolah" placeholder="Asal Sekolah" autocomplete="off" required>
					</div>
					<select name="kelas" class="form-control">
						<label for="kelas">Class : </label>
						<option value="X Multimedia 1">X Multimedia 1</option>
						<option value="X Multimedia 2">X Multimedia 2</option>
						<option value="X Multimedia 3">X Multimedia 3</option>
						<option value="X Multimedia 4">X Multimedia 4</option>
					</select>

					<div class="form-group">
						<input class="form-control" type="hidden" name="level_user" value="sw">
					</div>
					
					<button type="submit" name="btn_register" class="btn btn-outline-success btn-block">Sign Up</button>
					<br>
					
					<a href="../login.php"><div class="btn btn-primary btn-block"><span class="fa fa-arrow-left"></span> Back</div></a>
					
				</form>
			</div>

		</div>
	</div>

<script src="../assets/js/jquery.slim/jquery.slim.min.js"></script>
<script src="../assets/js/popper.js/dist/umd/popper.min.js"></script>
<script src="../assets/js/bootstrap.min.js"></script>
<script src="../assets/js/validateForm.js"></script>

</body>
</html>