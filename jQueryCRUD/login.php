<?php
	require_once "pdo.php";
	session_start();
	
	//Always perform client-side (JS) and server-side(PHP) validation
	if(isset($_POST["userLoginEmail"]) && isset($_POST["userLoginPwd"]))
	{
		unset($_SESSION["activeAccount"]);
		unset($_SESSION["adminAccount"]);
		
		if(strlen($_POST["userLoginEmail"])<1 || strlen($_POST["userLoginPwd"])<1)
		{
			$_SESSION["error"] = "Both fields must be filled out";
			header("Location: login.php");
			return;
		}
		if(strpos($_POST["userLoginEmail"], '@')<0)
		{
			$_SESSION["error"] = "Email must have @ symbol";
			header("Location: login.php");
			return;
		}
		
		$salt = 'XyZzy12*_';
		$userPwdHash = hash('md5', $salt.$_POST["userLoginPwd"]);
		
		if($_POST["userLoginEmail"] == "admin@gmail.com")
		{
			$originalPwdHash = '1a52e17fa899cf40fb04cfc42e6352f1'; //php123	
			$_SESSION["adminAccount"] = $_POST["userLoginEmail"];
		}
		else
		{
			$sql = "SELECT * FROM users WHERE user_email=:ph_email";
			$stmt = $pdo->prepare($sql);
			$stmt->execute( array( ':ph_email' => $_POST["userLoginEmail"]) );
			$returnedRows = $stmt->rowCount();
			//echo $returnedRows."</br>";
			if($returnedRows > 0)
			{
				$row = $stmt->fetch(PDO::FETCH_ASSOC);
				$originalPwdHash = hash('md5', $salt.$row["user_password"]);
				$_SESSION["fetchedUserId"] = $row["user_id"];
				$_SESSION["activeAccount"] = $_POST["userLoginEmail"];
			}
			else
			{
				$_SESSION["error"] = "No User Found. Please find valid usernames in comments";
				header("Location: login.php");
				return;
			}
		}
		if($userPwdHash != $originalPwdHash)
		{
			$_SESSION["error"] = "Incorrect Password";
			unset($_SESSION["adminAccount"]);
			unset($_SESSION["activeAccount"]);
			unset($_SESSION["fetchedUserId"]);
			header("Location: login.php");
			return;
		}
		else
		{
			$_SESSION["success"] = "Successfully logged in";
			header("Location: index.php");
			return;
		}
		
	}
	
?>

<html lang="en">

<head>
	<title>Divyateja Chepuru | Login</title>
	<meta charset="utf-8">
	
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">
	
	<script src="https://code.jquery.com/jquery-3.2.1.js" integrity="sha256-DZAnKJ/6XZ9si04Hgrsxu/8s717jcIzLy3oi35EouyE=" crossorigin="anonymous"></script>
	
	<script type="text/javascript">
	function validateLoginCredentials()
	{
		var email = document.getElementById("userLoginEmail").value;
		var password = document.getElementById("userLoginPwd").value
		
		if(email.length<1 || password.length<1)
		{
			document.getElementById("flashMsg").innerHTML = "Both fields must be filled out";
			document.getElementById("flashMsg").style.color = "red";
			return false;
		}
		if(email.indexOf('@')<0)
		{
			document.getElementById("flashMsg").innerHTML = "Invalid Email Address";
			document.getElementById("flashMsg").style.color = "red";
			return false;
		}
		return true;
	}
	</script> 
</head>

<body>
	<div class="container">
		<h2>Please Log In</h2>
		<div id="flashMsg">
			<?php 
			if(isset($_SESSION["error"])){
				echo '<p style="color:red">'.$_SESSION["error"].'</p>';
				unset($_SESSION["error"]);
			} ?>
		</div>
		<form method="post">
			<label>Email <input type="text" name="userLoginEmail" id="userLoginEmail"/></label><br/>
			<label>Password <input type="password" name="userLoginPwd" id="userLoginPwd"/></label><br/>
			<input type="submit" class="btn btn-primary" onclick="return validateLoginCredentials();" value="Log In" /> <a href="index.php" class="btn btn-warning">Cancel</a>
		</form>
	</div>
	<!-- Hint: 
	Valid accounts: umsi@umich.edu, chuck@umich.edu, csev@umich.edu, test@gmail.com, divyateja@gmail.com, admin@gmail.com
	The password is the three character name of the 
	programming language used in this class (all lower case) 
	followed by 123 and same for all accounts. -->
</body>

</html>