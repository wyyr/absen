<?php
	session_start();
	require '../functions.php';
	if( empty($_SESSION["sw"]) ){
		header("Location: ../login.php");
		exit;
	}

	( isset($_POST["btn_cek"]) ) ? absen($_POST) : "";

?>

<!DOCTYPE html>
<html>
<head>
	<title>Dashboard</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="../assets/css/mainstyle.css?version=<?php echo filemtime('../assets/css/mainstyle.css'); ?>">
	<link rel="stylesheet" href="../assets/fontawesome5.3.1/css/all.css">
	<link rel="stylesheet" href="../assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="../assets/css/animate.css/animate.min.css">
	<link rel="stylesheet" href="../assets/plugin/datepicker/css/bootstrap-datepicker.min.css">
</head>
<body>


	<?php require 'navbar-user.php'; ?>
	<!-- container-fluid -->
	<div class="container-fluid">
		<!-- row -->
		<div class="row">
			<!-- col-md-2 -->
			<div class="col-md-2 sidenav">
				<div class="list-group">
					<span id="close" class="close" id="close">&times;</span>
					<div class="waktu"><?= date("H:i a"); ?></div>
					<a href="index.php" class="list-group-item list-group-item-action"><span class="fa fa-tachometer-alt"></span> &nbsp;Mainpage</a>
					<a href="view_data.php" class="list-group-item list-group-item-action"><span class="fa fa-user-tie"></span> &nbsp;View Data</a>
					<a href="" class="list-group-item list-group-item-action active animated fadeInLeft"><span class="fa fa-user-check"></span> &nbsp;Absen</a>
					<!-- <a href="lihat_absen.php" class="list-group-item list-group-item-action"><span class="fa fa-eye"></span> &nbsp;Lihat Absen</a> -->
				</div>
			<!-- col-md-2 -->
			</div>
			<!-- col-md-10 -->
			<div class="col-md-10">
				<div class="container">
					<form action="" method="post">
						<input type="hidden" name="username" value="<?= $_SESSION["sw"]; ?>">
						<input type="hidden" name="waktu" value="<?= date('H:i:s') ?>">
						<input type="hidden" name="status" value="hadir">
						<input type="text" name="tanggal" class="datepicker" required autocomplete="off"><span class="fa fa-calender-alt"></span>
						<button type="submit" name="btn_cek" class="btn btn-primary" id="btn_cek">Absen</button>
					</form>
				</div>
			<!-- col-md-10 -->
			</div>
		<!-- row -->
		</div>
	<!-- container-fluid -->
	</div>

<script src="../assets/js/jquery.slim/jquery.slim.min.js"></script>
<script src="../assets/js/popper.js/dist/umd/popper.min.js"></script>
<script src="../assets/js/bootstrap.min.js"></script>
<script src="../assets/js/plugin/datepicker/js/bootstrap-datepicker.min.js"></script>
<script src="../assets/js/script.js"></script>
<script type="text/javascript">
		$(function(){
			$(".datepicker").datepicker({
				format: 'yyyy-mm-dd'
			});
		 });

	// var btn_cek = document.getElementById('btn_cek');

	// btn_cek.addEventListener('click', function(){

	// 	btn_cek.disabled = true;

	// 	hitung();

	// });

	//function hitung(){

		// var hitung = addEventListener('click', function(){

		// 	if( btn_cek.disabled == true ){

		// 		var interval = setTimeout(function(){

		// 			btn_cek.disabled = false;

		// 			if( btn_cek.disabled == false){
		// 				clearInterval(interval);
		// 			}

		// 		}, 18000);

		// 	}

		// });
	//}


</script>
</body>
</html>