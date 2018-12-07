<?php
	require_once "pdo.php";
	
	if(isset($_POST["userEmail"]) && isset($_POST["userPassword"]))
	{
		$e = $_POST["userEmail"];
		$p = $_POST["userPassword"];
		$sql = "SELECT user_name FROM users WHERE user_email = '$e'  AND user_password = '$p' ";
		// ' OR '1' = '1 induces SQL Injection
		$stmt = $pdo->query($sql);
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		
		if($row === FALSE)
			echo "Login Incorrect\n";
		else echo "Login Success\n";
	}

?>

<html lang="en">
	<head></head>
	<body>
		<p>Please Login
		<form method="post">
			<p>Email: <input type = "text" name = "userEmail" /></p>
			<p>Password: <input type = "text" name = "userPassword" /></p>	
			<p><input type = "submit" value = "Login" />
		</form>
	</body>

</html>