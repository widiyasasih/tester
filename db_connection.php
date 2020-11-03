<?php 
	$dbhost = "localhost";
	$dbuser = "root";
	$dbpass = "";
	$db     = "tester";

	$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $db);
	if (!$conn) {
		die("Connection failed: ".mysqli_connect_error());
	}

	echo "Connection successfully";

	// mysqli_close($conn);
?>