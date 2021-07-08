<?php
	$conn = mysqli_connect("localhost", "root", "rootmysql@1#", "db");

	if (!$conn) {
		echo "<title>502</title>";
		echo "Unknown error occured!";
		exit();
	}
?>