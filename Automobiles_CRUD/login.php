<?php
	require_once "pdo.php";
	session_start();
	if(isset($_POST["email"]) && isset($_POST["pass"]))
	{
		unset($_SESSION["account"]);
		if(strlen($_POST["email"])<1 || strlen($_POST["pass"])<1)
		{
			$_SESSION["error"] = "User name and password are required";
			header("Location: login.php");
			return;
		}
		if(strpos($_POST["email"], "@") === FALSE)
		{
			$_SESSION["error"] = "Username must be an email";
			header("Location: login.php");
			return;
		}
		$salt = 'XyZzy12*_';
		$originalPwdHash = '1a52e17fa899cf40fb04cfc42e6352f1'; //php123
		$userPwdHash = hash('md5', $salt.$_POST["pass"]);
		
		if($userPwdHash == $originalPwdHash)
		{
			$_SESSION["success"] = "Successfully logged in";
			$_SESSION["account"] = $_POST["email"];
			header("Location: index.php");
			return;
		}
		else
		{
			$_SESSION["error"] = "Incorrect Password";
			header("Location: login.php");
			return;
		}
	}
?>

<html lang="en">
	<head>
		<meta charset="utf-8"/>
		<title>Divyateja Chepuru | Login</title>
	</head>
	
	<body>
		<h2>Please Log In</h2>
		<?php
			if(isset($_SESSION["error"]))
			{
				echo '<p style="color:red">'.$_SESSION["error"].'</p>';
				unset($_SESSION["error"]);
			}
		?>
		<form method="post">
			<p>User Name <input type="text" name="email"/></p>
			<p>Password <input type="text" name="pass"/></p>
			<input type="submit" value="Log In" /> <a href="index.php">Cancel</a>		
		</form>
	</body>
</html>