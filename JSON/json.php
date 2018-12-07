<?php
	sleep(2);
	header("Content-Type: application/json; charset=utf-8");
	$stuff = array( "first" => "Chuck", "last" => "Severance");
	echo(json_encode($stuff));
?>