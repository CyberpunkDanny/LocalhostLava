<?php
	require_once "pdo.php";
	
	if(isset($_POST["userName"]) && isset($_POST["userEmail"]) && isset($_POST["userPassword"]))
	{
		$sql = "INSERT INTO users(user_name, user_email, user_password) VALUES(:name, :email, :password)";
		$stmt = $pdo->prepare($sql);
		$stmt->execute( array(
				':name' => $_POST["userName"],
				':email' =>	$_POST["userEmail"],
				':password' => $_POST["userPassword"]
				)
		);
	}	
	
	if(isset($_POST["userID"]))
	{
		$sql = "DELETE FROM users WHERE user_id = :user_id";
		$stmt = $pdo->prepare($sql);
		$stmt->execute( array(':user_id' => $_POST["userID"]) );
	}
	
	if(isset($_POST["attachedUserID"]))
	{
		$sql = "DELETE FROM users WHERE user_id = :user_id";
		$stmt = $pdo->prepare($sql);
		$stmt->execute( array(':user_id' => $_POST["attachedUserID"]) );
	}
	
	echo "<pre>\n";
	$stmt = $pdo->query("SELECT * FROM users");
	while($row = $stmt->fetch(PDO::FETCH_ASSOC))
		print_r($row);
	echo "</pre>\n";
	
	$stmtOther = $pdo->query("SELECT * FROM users");
	echo '<table border="1">';
	echo "<tr><th>Name</th><th>Email</th><th>Del?</th></tr>\n";
	while($row = $stmtOther->fetch(PDO::FETCH_ASSOC)){
		echo "<tr><td>".$row['user_name']."</td><td>".$row['user_email']."</td><td>";
		echo '<form method = "post">';
		echo '<input type = "hidden" name = "attachedUserID" value = "'.$row['user_id'].'"/>';
		echo '<input type = "submit" value = "Del" name = "delete"/>';
		echo '</form></td></tr>';
	}
	echo "</table><br>";
?>

<html lang = "en">

<head>
</head>

<body>

	<form method = "post">
	<fieldset>
		<p>Name: <input type = "text" name = "userName" size = "20"/></p>
		<p>Email: <input type = "text" name = "userEmail"/></p>
		<p>Password: <input type = "text" name = "userPassword"/></p>
		<p><input type = "submit" value = "Add"/></p>
	</fieldset>
	</form>

	<form method = "post">
	<fieldset>
		<p>User ID: <input type = "text" name = "userID"/></p>
		<p><input type = "submit" value = "Delete"/></p>
	</fieldset>
	</form>
	
</body>

</html>