<?php 
	session_start();
	require '../functions.php';
	
	if( empty($_SESSION["sw"]) ){
		header("Location: ../login.php");
		exit;
	}

	$siswa = query("SELECT * FROM detail_sw ORDER BY id");
	
	
?>
<!DOCTYPE html>
<html>
<head>
	<title>Daftar </title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="../assets/css/mainstyle.css?version=<?php echo filemtime('../assets/css/mainstyle.css'); ?>">
	<link rel="stylesheet" href="../assets/fontawesome5.3.1/css/all.css">
	<link rel="stylesheet" href="../assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="../assets/css/animate.css/animate.min.css">
</head>
<body>


	<?php require 'navbar-user.php'; ?>
	</nav>
	<!-- conatiner-fluid -->
	<div class="container-fluid">
		<!-- row -->
		<div class="row">
			<div class="col-md-2 sidenav"><span id="close" class="close" id="close">&times;</span>
				<div class="list-group">
					
					<div class="waktu"><?= date("H:i a"); ?></div>
					<a href="index.php" class="list-group-item list-group-item-action"><span class="fa fa-tachometer-alt"></span> &nbsp;Mainpage</a>
					<a href="view_data.php" class="list-group-item list-group-item-action active animated fadeInLeft"><span class="fa fa-user-tie"></span> &nbsp;View Data</a>
					<a href="absen.php" class="list-group-item list-group-item-action"><span class="fa fa-user-check"></span> &nbsp;Absen</a>
					<!-- <a href="lihat_absen.php" class="list-group-item list-group-item-action"><span class="fa fa-eye"></span> &nbsp;Lihat Absen</a> -->
				</div>
			</div>
			<!-- col-md-10 -->
			<div class="col-md-10">
				<main>
					<h2>Daftar Siswa</h2>
					<form class="form-inline" method="post" action="">
						<input class="form-control mr-sm-2" type="text" autocomplete="off" autofocus id="keyword" name="keyword">
						<!-- <button type="submit" name="tombol-cari" id="tombol-cari" class="btn btn-outline-primary"></button> -->
					</form>
					<div id="tampil">
						<table class="table table-hover" cellpadding="10" cellspacing="0">
							<thead class="thead-light">
								<tr>
									<th>No</th>
									<th>Nama</th>
									<th>Kelas</th>
									<th>Gender</th>
									<th>Asal Sekolah</th>
									<!-- <th>No Hp</th> -->
								</tr>
							</thead>
							<tbody>
							<?php
								$i = 1; 
								$result = mysqli_query($conn, "SELECT * FROM detail_sw");
							?>
							<?php while( $data = mysqli_fetch_assoc($result) ) : ?>
							<tr class="profile">
								<td><?= $i; ?></td>
								<td><?= "<strong>".$data["nama_user"] ."</strong>"; ?></td>
								<td><?= $data["kelas"]; ?></td>
								<td><?= $data["gender"]; ?></td>
								<td><?= "<strong>".strtoupper($data["sekolah"])."</strong>"; ?></td>
							</tr>
							<?php $i++; ?>
							<?php endwhile; ?>
							</tbody>
						</table>
					</div>
				</main>
			<!-- col-md-10 -->
			</div>
		<!-- row -->
		</div>
	<!-- container-fluid -->
	</div>

	

	
	<script src="../assets/js/jquery.slim/jquery.slim.min.js"></script>
	<script src="../assets/js/popper.js/dist/umd/popper.min.js"></script>
	<script src="../assets/js/bootstrap.min.js"></script>
	<script src="../assets/js/ajax.js"></script>
	<script src="../assets/js/script.js"></script>

</body>
</html>