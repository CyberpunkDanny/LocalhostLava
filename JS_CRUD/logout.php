<?php 
	require_once "pdo.php";
	session_start();
	unset($_SESSION["activeAccount"]);
	unset($_SESSIOn["adminAccount"]);
	session_destroy();
	header("Location: index.php");
	return;
?>