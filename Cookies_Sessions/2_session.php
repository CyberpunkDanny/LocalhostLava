<?php
	session_start();
	
	if(!isset($_SESSION["pizza_session"])){
		echo "<p>Session is empty</p>";
		$_SESSION["pizza_session"] = 0;
	}else if($_SESSION["pizza_session"]<3){
		$_SESSION["pizza_session"]++;
		echo "<p>Added one</p>";
	}else{
		session_destroy();
		session_start();
		echo "<p>Session restarted</p>";
	}
?>
<html lang="en">
	<head>
	</head>
	
	<body>
		<h3>Session Cookie</h3>
		<p><a href="2_session.php">Click Me!</a></p>
		<p>Session ID: <?= htmlentities(session_id()); ?> </p>
		
		<pre>
			<?php print_r($_SESSION);?>
		</pre>
	</body>
</html>