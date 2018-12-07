<?php
	require_once "pdo.php";
	
	if(isset($_POST["userEmail"]) && isset($_POST["userPassword"]))
	{
		$sql = "SELECT user_name FROM users WHERE user_email = :email  AND user_password = :pwd ";
		//Always use PDO prepared statements. Never use string concatenation in SQL especially when user-entered data 
			//is present
		$stmt = $pdo->prepare($sql);
		$stmt->execute( array(
						':email' => $_POST["userEmail"],
						':pwd' => $_POST["userPassword"]
						)
			);
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		
		echo "<pre>";
		var_dump($row);
		echo "</pre>";
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