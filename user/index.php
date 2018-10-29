<?php 
	session_start();
	require '../functions.php';
	if( empty($_SESSION["sw"]) ){
		header("Location: ../login.php");
		exit;
	}

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
</head>
<body>
			
	<?php require 'navbar-user.php'; ?>

	<div class="container-fluid">
		<!-- row -->
		<div class="row">
			<div class="col-md-2 sidenav">
				<div class="list-group">
					<span id="close" class="close" id="close">&times;</span>
					<div class="waktu"><?= date("H:i a"); ?></div>
					<a href="" class="list-group-item list-group-item-action active animated fadeInLeft"><span class="fa fa-tachometer-alt"></span> &nbsp;Mainpage</a>
					<a href="view_data.php" class="list-group-item list-group-item-action"><span class="fa fa-user-tie"></span> &nbsp;View Data</a>
					<a href="absen.php" class="list-group-item list-group-item-action"><span class="fa fa-user-check"></span> &nbsp;Absen</a>
					<!-- <a href="lihat_absen.php" class="list-group-item list-group-item-action"><span class="fa fa-eye"></span> &nbsp;Lihat Absen</a> -->
				</div>
			</div>
			<!-- col-md-10 -->
			<div class="col-md-10">
				<div class="main">
					<div class="container">				
						<div class="submain">
							<?php 
								if( isset($_GET["log"]) == "user" ){
									echo '
										<div class="berhasil"><span class="fa fa-check-circle fa-2x"></span><h2>Login Berhasil!</h2></div>
										';
								}
							?>
							<h1>Welcome, <?= $_SESSION["sw"]; ?> :)</h1>
							<h2>No description.</h2>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>


	<script src="../assets/js/jquery.slim/jquery.slim.min.js"></script>
	<script src="../assets/js/popper.js/dist/umd/popper.min.js"></script>
	<script src="../assets/js/bootstrap.min.js"></script>
	<script src="../assets/js/script.js"></script>
	
</body>
</html>