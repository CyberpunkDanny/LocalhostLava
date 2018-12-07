<?php
	require_once "pdo.php";
	session_start();
	unset($_SESSION["adminAccount"]);
	unset($_SESSION["activeAccount"]);
	unset($_SESSION["fetchedUserId"]);
	session_destroy();
	header("Location: index.php");
	return;