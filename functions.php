<?php
$conn = mysqli_connect("localhost", "root", "", "database");

	
function query($sql) {
	global $conn;
	$result = mysqli_query($conn, $sql);

	$rows = [];
	while( $row = mysqli_fetch_assoc($result) ) {
		$rows[] = $row;
	}

	return $rows;
}

function hapus($id) {
	global $conn;
	mysqli_query($conn, "delete from mahasiswa where id = $id");

	return mysqli_affected_rows($conn);
}


function register($data) {
	global $conn;

	$username = htmlspecialchars($_POST["username"]);
	$password = htmlspecialchars($_POST["password"]);
	$email = htmlspecialchars($_POST["email"]);

	// cek username sudah pernah ada atau belum
	$cek_username = mysqli_query($conn, "SELECT * FROM user WHERE username = '$username'");

	if( mysqli_num_rows($cek_username) === 1 ) {
		echo "<script>
				alert('username sudah terpakai!');
				document.location.href = '';
			  </script>";
		return false;
	}

	// tambahkan user baru ke database
	// enkripsi password
	$password = password_hash($password, PASSWORD_DEFAULT);

	// insert ke DB
	$sql = "INSERT INTO user VALUES ('', '$username', '$password', '$email')";
	mysqli_query($conn, $sql);

	return mysqli_affected_rows($conn);
}

?>