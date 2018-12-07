<?php
	session_start();
	
	if(isset($_POST["where"])){
		if($_POST["where"] == '1'){
			header("Location: redirect.php");
			return;
		}else if($_POST["where"] == 2){
			header("Location: redirect2.php?param=123");
			return;
		}else{
			header("Location: http://www.drchuck.com/");
			return;
		}
	}
?>
<!-- Look in Developer Mode -->
<html>
	<head></head>
	<body>
		<p>Router 1</p>
		<form method = "post">
			<p>Where to go? (1-3) <input type="text" name="where" /></p>
			<p><input type="submit" value="Submit"/>
		</form>
	</body>
</html>