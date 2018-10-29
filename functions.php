<?php

$conn = mysqli_connect("localhost", "root", "", "absen") or die("KONEKSI ERROR!!!<br>" . mysqli_connect_error($conn));

date_default_timezone_set("Asia/Jakarta");

require 'alert.php';

function query($query){
	global $conn;
	$result = mysqli_query($conn, $query);
	$rows = [];
	while( $row = mysqli_fetch_assoc($result) ){
		$rows[] = $row;
	}
	return $rows;
}

//###############################
//
//		     LOGIN
//
//###############################
function login($data){
	global $conn;
	$username = strtolower(htmlspecialchars($data["username"]));
	$pwd = htmlspecialchars($data["password"]);
	$user = mysqli_query($conn, "SELECT * FROM user WHERE user.email = '$username' OR user.username = '$username'") or die("ERROR LOGIN SQL!!!<br>" . mysqli_error($conn));

	// jika user ada
	if( mysqli_num_rows($user) === 1 ){
		$row = mysqli_fetch_assoc($user);

		if( $row['level_user'] === "pb" ){

			if( password_verify($pwd, $row['password']) ){

				$_SESSION['admin'] = $row['username'];
				if( isset($data['remember']) ){

					$cipher="AES-128-CBC";
					setcookie('key', openssl_encrypt($row['id'], $cipher, 'password'), time()+3600);
					setcookie('code', hash('sha256', $row['username']), time()+3600);
				}
				header("Location: admin/index.php");
			}else{
				header("Location: login.php?err=2");
				exit;
				return false;
			}

		}else if( $row['level_user'] === "sw" ){

			if( password_verify($pwd, $row['password']) ){

				$_SESSION['sw'] = $row['username'];
				if( isset($data['remember']) ){
					setcookie('key', openssl_encrypt($row['id'], "AES-128-CBC", 'password'), time()+3600);
					setcookie('code', hash('sha256', $row['username']), time()+3600);
				}
				header("Location: user/index.php");
			}else{
				header("Location: login.php?err=2");
				return false;
			}

		}

	}else{
		header("Location: login.php?err=3");
		return false;
	}

}

//###############################
//
//		  REGISTER ADMIN
//
//###############################
function reg_admin($data){

	global $conn;
	$email = htmlspecialchars($data["email"]);
	$username = htmlspecialchars($data["username"]);
	$pwd = password_hash($data["password"], PASSWORD_DEFAULT);
	$kelas = htmlspecialchars($data["kelas"]);
	$level_user = $data["level_user"];

	$admin = mysqli_query($conn, "SELECT email, username FROM admin") or die(mysqli_error());
	$data = mysqli_fetch_assoc($admin);

	if( $email === $data["email"] && $username === $data["username"] ){
		echo "<script>alert('Email atau Password telah digunakan!');</script>";
	}else{
		$query = mysqli_query($conn, "INSERT INTO admin VALUES('', '$email', '$username', '$pwd', '$kelas','$level_user')") or die( "ERROR MIN!!<br>" . mysqli_error() );
	}


	if($query){
		header("Location: login.php");
	}else{
		header("Location: register.php?msg=error");
	}
}

//###############################
//
//		 REGISTER SISWA
//
//###############################
function register($data){

	global $conn;
	# TABLE DETAIL SISWA
	$nama = htmlspecialchars($data["nama_user"]);
	$kelas = htmlspecialchars($data["kelas"]);
	$gender = htmlspecialchars($data["gender"]);
	$sekolah = strtolower(htmlspecialchars($data["sekolah"]));
	$hp = htmlspecialchars((int)$data["hp"]);
	# TABLE USER
	$email = htmlspecialchars($data["email"]);
	$username = stripslashes(htmlspecialchars($data["username"]));
	$pwd = mysqli_real_escape_string($conn, password_hash($data["password"], PASSWORD_DEFAULT));
	$level_user = $data["level_user"];

	$user = mysqli_query($conn, "SELECT * FROM user WHERE username = '$username' OR email = '$email'") or die("KONEKSI REGISTER ERROR!!!" . mysqli_error($conn));

	if( $data = mysqli_fetch_assoc($user) ){

		if( $data['username'] ) {
			header("Location: register.php?ex=1");
			return false;
		}else if( $data['email'] ) {
			header("Location: register.php?ex=2");
			return false;
		}

	}else{
		$query = mysqli_query($conn, "INSERT INTO detail_sw VALUES( NULL, '$nama', '$username', '$kelas', '$gender', '$sekolah', '$hp')")
		or die( "REGISTER : ERROR TABLE DETAIL_SW!!<br>" . mysqli_error($conn) );

		$query = mysqli_query($conn, "INSERT INTO user VALUES( NULL, '$email', '$username', '$pwd', '$level_user')") or die( "ERROR TABLE USER!!<br>" . mysqli_error($conn) );
	}

	if($query){
		alertSuccess('Register');
		header("Location: ../login.php");
		exit;
	}else{
		alertFailed('Register');
		return false;
	}

}

//###############################
//
//		   TAMBAH DATA
//
//###############################
function tambah($data){
	global $conn;
	# TABLE DETAIL SISWA
	$nama = htmlspecialchars($data["nama_user"]);
	$kelas = htmlspecialchars($data["kelas"]);
	$gender = htmlspecialchars($data["gender"]);
	$sekolah = strtolower(htmlspecialchars($data["sekolah"]));
	$hp = htmlspecialchars($data["hp"]);
	# TABLE USER
	$email = htmlspecialchars($data["email"]);
	$username = strtolower(stripslashes(htmlspecialchars($data["username"])));
	$pwd = mysqli_real_escape_string($conn, password_hash($data["password"], PASSWORD_DEFAULT));
	$level_user = $data["level_user"];

	$user = mysqli_query($conn, "SELECT * FROM user WHERE username = '$username' OR email = '$email'") or die(mysqli_error());

	if( mysqli_fetch_assoc($user) ){

		echo "<script>
				alert('Email atau Username telah digunakan');
				window.location.href = 'view_admin.php';
			</script>";
		return false;

	}else{
		$query = mysqli_query($conn, "INSERT INTO detail_sw VALUES( NULL, '$nama', '$username', '$kelas', '$gender', '$sekolah', '$hp')")
		or die( "TAMBAH DATA : ERROR TABLE DETAIL_SW!!<br>" . mysqli_error($conn) );

		$query = mysqli_query($conn, "INSERT INTO user VALUES( NULL, '$email', '$username', '$pwd', '$level_user')") or die( "ERROR TABLE USER!!<br>" . mysqli_error($conn) );
	}

	if($query){
		alertSuccess('Tambah');
		header("Location: view_admin.php");
	}else{
		alertFailed('Tambah');
		header("Location: view_admin.php");
		return false;
	}

}

//###############################
//
//		    HAPUS DATA
//
//###############################
function hapus($username){
	global $conn;
	$query = mysqli_query($conn, "DELETE user,detail_sw FROM user INNER JOIN detail_sw ON detail_sw.username = user.username WHERE user.username = '$username'");

	if($query){
		header("Location: view_admin.php?err=5");
		exit;
	}else{
		echo "<script>
				swal('Data gagal dihapus!');
				window.location.href = 'view_admin.php';
			</script>";
		return false;
	}

}

//###############################
//
//		    EDIT DATA
//
//###############################
function edit($data){
	global $conn;

	$id = $data["id"];
	$nama = $data["nama_user"];
	$username = $data['username'];
	$kelas = $data["kelas"];
	$gender = $data["gender"];
	$sekolah = $data["sekolah"];
	$hp = $data["hp"];
	$email = $data["email"];


	$result = mysqli_query($conn, "UPDATE detail_sw SET nama_user='$nama', username='$username', kelas='$kelas', gender='$gender', sekolah='$sekolah', hp='$hp' WHERE id = '$id'");

	$result = mysqli_query($conn, "UPDATE user SET email='$email', username='$username' WHERE id = '$id'");

	if($result){
		echo "<script>
				swal('Data berhasil diedit!');
				window.location.href = 'view_admin.php';
			</script>";
	}else{
		echo "<script>
				alert('Data gagal diedit!');
				window.location.href = 'view_admin.php';
			</script>";
	}

}

//###############################
//
//		   ABSEN SISWA
//
//###############################
function absen($data){
	global $conn;

	$tanggalLengkap = $data["tanggal"];
	$arrTanggal = explode('-', $tanggalLengkap);
	$username = $data["username"];
	$tanggal = $arrTanggal["2"];
	$bulan = $arrTanggal["1"];
	$tahun = $arrTanggal["0"];
	$waktu = $data["waktu"];
	$status = $data["status"];

	$query = mysqli_query($conn, "INSERT INTO data_absen VALUES( NULL, '$username', '$tanggal', '$bulan', '$tahun', '$waktu', '$status')") or die("ABSEN ERROR!!!<br>" . mysqli_error($conn));

	if($query){
		echo "<script>
				alert('Absen Berhasil!');
				window.location.href = 'view_data.php';
			</script>";
	}else{
		echo "<script>
				alert('Absen Gagal!');
			</script>";
	}
}

function cari($keyword){
	$query = "SELECT * FROM detail_sw
				WHERE
				nama_user LIKE '%$keyword%' OR
				kelas LIKE '%$keyword%' OR
				gender LIKE '%$keyword%' OR
				sekolah LIKE '%$keyword%' OR
				hp LIKE '%$keyword%'
				";
	return query($query);
}

function session(){
	$habis = 2;

	if( isset($_SESSION["user"]) ){
		$session_habis = 2;
	}
}

?>