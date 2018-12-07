<?php
	session_start();
?>

<html>

<head></head>

<body>
	<h2>Cool Application</h2>
	<?php
		if(isset($_SESSION["success"]))
		{
			echo "<p style='color:green'>".$_SESSION["success"]."</p>";				
			unset($_SESSION["success"]);
		}
		if(isset($_SESSION["account"]))
		{
	?>
			<p>How cool this is gonna be!</p>
			<p>Please <button><a href="logout.php">Log Out</a></button> here once done.</p>

	<?php 
		}
		else
		{
			echo '<p><a href="login.php">Press here to login</a></p>';
		}
	?>
</body>
</html>