<?php
session_start();
require 'functions.php';

if( !isset($_SESSION['username']) ) {
	header("Location: login.php");
	exit;
}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Halaman Login</title>
</head>
<body>

<a href="logout.php">Logout</a>

</body>
</html>