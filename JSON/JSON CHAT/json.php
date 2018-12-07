<?php
	session_start();
	sleep(4);
	header("Content-Type: application/json; charset=utf-8");
	if(!isset($_SESSION["chats"]))
		$_SESSION["chats"] = new Array();
?>