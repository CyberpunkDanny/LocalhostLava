<?php
	session_start();
	require_once "pdo.php";	
		$salt = 'XyZzy12*_';
		$originalPwdHash = '1a52e17fa899cf40fb04cfc42e6352f1'; //php123

		if(isset($_POST["username"]) && isset($_POST["userpwd"]))
		{
			unset($_SESSION["account"]);
			
			if(strpos($_POST["username"], "@") === FALSE)
			{
				$_SESSION["error"] = "Username must be an email";
				error_log("Login fail as username is not an email: ".$_POST['email']);
				header("Location: login.php");
				return;
			}
			
			if(strlen($_POST["username"])<1 || strlen($_POST["userpwd"])<1)
			{
				$_SESSION["error"] = "Please fill in all the fields";
				error_log("Login failed as all the fields are not filled: ".$_POST['email']." $userPwdHash");
				header("Location: login.php");
				return;
			}
			
			$userPwdHash = hash('md5', $salt.$_POST["userpwd"]);
			
			if($userPwdHash == $originalPwdHash)
			{
				$_SESSION["success"] = "You're successfully logged in";
				$_SESSION["account"] = $_POST["username"];
				error_log("Login success: ".$_POST['email']);
				header("Location: view.php");
				return;
			}
			else
			{
				$_SESSION["error"] = "Incorrect Password";
				error_log("Login failed due to wrong password: ".$_POST['email']." $userPwdHash");
				header("Location: login.php");
				return;
			}
		}
?>

<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>Divyateja Chepuru | Login</title>
	</head>
	
	<body>
	<h2>Please Login</h2>
	<?php 
		if(isset($_SESSION["error"]))
		{
				echo "<p style='color:red'>".$_SESSION["error"]."</p>";
				unset($_SESSION["error"]);
		}
	?>
	<form method="post">
		<p>Username <input type="text" name="username"/></p>
		<p>Password <input type="text" name="userpwd"/></p>
		<p><input type="submit" value="Login" /> <button><a href="index.php">Go Back</a></button></p>
	</form>
	</body>
</html>