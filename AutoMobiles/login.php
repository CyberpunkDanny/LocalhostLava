<?php
	require_once "pdo.php";

	$message = FALSE;
	
	if(isset($_POST["who"]) && isset($_POST["pass"]))
	{
		if(strlen($_POST["who"])<1 || strlen($_POST["pass"])<1)
		{
			$message = "Username and Password are required\n";
		}
		else {
			if(strpos($_POST["who"], '@') === FALSE)
			{
				$message = "Username must be an email\n";		
			}
			else
			{
				$salt = 'XyZzy12*_';
				$originalPwdHash = '1a52e17fa899cf40fb04cfc42e6352f1'; //php123
				$userPwdHash = hash('md5', $salt.$_POST['pass']);
				if($userPwdHash == $originalPwdHash)
				{
					error_log("Login Success ".$_POST['who']);
					header("Location: autos.php?user=".urlencode($_POST["who"]));
					return;		
				}
				else
				{
					$message = "Incorrect Password\n";					
					error_log("Login fail ".$_POST['who']." $userPwdHash");
				} 
				
			}
		}
	}


	if(isset($_POST["BackToIndex"]))
	{
		header("Location: index.php");
	}
		

?>

<html lang="en">

<head>
	<meta charset="UTF-8">
	<title>Divyateja Chepuru | Login</title>
	
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

	<!-- Optional theme -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">

	<style>
		#message {
			color: red;
			font-size: 14px;
		}
	</style>
</head>

<body>
	<div class="container">
	<h2>Please Log In</h2>
	<p id = "message"><?= htmlentities($message);?></p>
	<form method = "post">
		<p>Username <input type="text" name="who"/></p>
		<p>Password <input type="text" name="pass"/></p>
		<!-- Password is php123-->
		<p><input type="submit" value="Log In" /></p>
		<p><input type="submit" name = "BackToIndex" value="Go Back" /></p>		
	</form>
	</div>
</body>

</html>
