<?php
	session_start();
	require_once "pdo.php";
	echo "<p>";
	//var_dump($_SESSION);
	echo "</p>";
?>	

<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>Divyateja Chepuru | Home</title>
	</head>
	
	<body>
	<h3>Welcome to Automobiles Databases</h3>
	<p><a href="login.php">Please Log In</a></p>
	<p>Attempt to go to <a href="view.php">view.php</a> without logging in would fail </p>
	<p>Attempt to go to <a href="add.php">add.php</a> without logging in would fail</p>
	</body>
</html>