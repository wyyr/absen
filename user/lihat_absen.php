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
</head>
<body>

	<nav class="navbar navbar-light bg-light">
		<div class="container">
			<span class="menu" id="menu">&#9776;</span>
			<h1 class="brand">AppSend</h1>
			<div class="dropdown">
				<button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
					<?php echo strtoupper($_SESSION["sw"]); ?>
				</button>
				<div class="dropdown-menu">
				    <a class="dropdown-item" href="#">Change Password</a>
				    <a class="dropdown-item" href="../logout.php">Logout</a>
				</div>
			</div>			
		</div>
	</nav>
	<!-- container-fluid -->
	<div class="container-fluid">
		<!-- row -->
		<div class="row">
			<div class="col-md-2 sidenav">
				<div class="list-group">
					<span id="close" class="close" id="close">&times;</span>
					<div class="waktu"><?= date("H:i a"); ?></div>
					<a href="index.php" class="list-group-item list-group-item-action"><span class="fa fa-tachometer-alt"></span> &nbsp;Mainpage</a>
					<a href="view_data.php" class="list-group-item list-group-item-action"><span class="fa fa-user-tie"></span> &nbsp;View Data</a>
					<a href="absen.php" class="list-group-item list-group-item-action"><span class="fa fa-user-check"></span> &nbsp;Absen</a>
					<!-- <a href="lihat_absen.php" class="list-group-item list-group-item-action active"><span class="fa fa-eye"></span> &nbsp;Lihat Absen</a>
 -->
				</div>
			</div>
			<!-- col-md-10 -->
			<div class="col-md-10">
				<table class="table table-hover" class="table" cellspacing="0">
					<thead class="thead-light">
						<tr>
							<th>Username</th>
							<th>Tanggal</th>
							<th>Waktu</th>
							<th>Status</th>	
						</tr>
					</thead>
					<tbody>
					<?php 
						$result =  mysqli_query($conn, "SELECT * FROM data_absen");
					?>
					<?php while( $data = mysqli_fetch_assoc($result) ) : ?>
					<tr>
						<td><?= $data["username"]; ?></td>
						<td><?= $data["tanggal"]; ?></td>
						<td><?= $data["waktu"]; ?></td>
						<td><?= $data["status"]; ?></td>
					</tr>
					<?php endwhile; ?>
					</tbody>
				</table>
			<!-- col-md-10 -->
			</div>
		<!-- row -->
		</div>
	<!-- container-fluid -->
	</div>
	
	<script src="../assets/js/jquery.slim/jquery.slim.min.js"></script>
	<script src="../assets/js/popper.js/dist/umd/popper.min.js"></script>
	<script src="../assets/js/bootstrap.min.js"></script>
	<script src="../assets/js/script.js"></script>

</body>
</html>