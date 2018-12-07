<?php
	require_once "pdo.php";
	session_start();
	
	//Always perform client-side (JS) and server-side(PHP) validation
	if(isset($_POST["email"]) && isset($_POST["pass"]))
	{	
		unset($_SESSION["activeAccount"]);
		unset($_SESSION["adminAccount"]);
		if(strlen($_POST["email"]) < 0 || strlen($_POST["pass"])<0)
		{
			$_SESSION["serverValErrorMsg"] = "Both fields are required";
			header("Location: login.php");
			return;
		}
		
		if(strpos($_POST["email"], "@")<0)
		{
			$_SESSION["serverValErrorMsg"] = "Email must have \'@\' symbol";
			header("Location: login.php");
			return;
		}
		
		$salt = 'XyZzy12*_';
		$userPwdHash = hash('md5', $salt.$_POST["pass"]);
		
		if($_POST["email"] == "admin@gmail.com")
		{
			$originalPwdHash = '1a52e17fa899cf40fb04cfc42e6352f1'; //php123	
		}
		else
		{
			$sql = "SELECT * FROM users WHERE user_email = :ph_email";
			$stmt = $pdo->prepare($sql);
			$stmt->execute(array('ph_email' => $_POST['email']));
			if($stmt->fetch(PDO::FETCH_ASSOC) === FALSE)
			{
				$_SESSION["serverValErrorMsg"] = "No User Found. Please find usernames in comments";
				header("Location: login.php");
				return;
			}
			else
			{
				$sql = "SELECT * FROM users WHERE user_email = :ph_email";
				$stmt = $pdo->prepare($sql);
				$stmt->execute(array('ph_email' => $_POST['email']));
				$row = $stmt->fetch(PDO::FETCH_ASSOC);
				$originalPwdHash = $row["user_password"]; //php123
				$_SESSION["fetchedUserId"] = $row["user_id"];
			}
		}
		if($originalPwdHash != $userPwdHash)
		{
			$_SESSION["serverValErrorMsg"] = "Incorrect Password";
			unset($_SESSION["fetchedUserId"]);
			header("Location: login.php");
			return;
		}
		else
		{
			$_SESSION["serverValSuccessMsg"] = "Successfully logged in";
			if($_POST["email"] == "admin@gmail.com")
				$_SESSION["adminAccount"] = $_POST["email"];
			else 
				$_SESSION["activeAccount"] = $_POST["email"];
			header("Location: index.php");
			return;	
		}
	}
?>

<html lang="en">

<head>
	<title>Divyateja Chepuru | Login</title>
	<meta charset="utf-8">
	<link rel="shortcut icon" href="#">
	<script type="text/javascript">
		function validateCredentials()
		{
			console.dir(document.getElementById("userEmail"));
			console.dir(document.getElementById("userPwd"));
			
			var emailId = document.getElementById("userEmail").value;
			var password = document.getElementById("userPwd").value;	
			
			if(password=="" || password==null || emailId=="" || emailId==null){
				document.getElementById("warningMsg").innerHTML = "Both fields must be filled out";
				document.getElementById("warningMsg").style = "color:red";
				return false;
			}
			
			console.log("Index of @ "+emailId.indexOf('@'));
			if(emailId.indexOf('@')<0){
				document.getElementById("warningMsg").innerHTML = "Invalid Email Address";
				document.getElementById("warningMsg").style.color = "red";
				return false;
			}
		
			return true;		
		}
	</script>
</head>
<body>
	<h2>Please Log In</h2>
	<form method="post">
		<p>Email: <input type="text" name="email" id="userEmail" /></p>
		<p>Password: <input type="password" name="pass" id="userPwd" /></p>
		<input type="submit" onclick="return validateCredentials();" value="Log In" /> <button type="button"><a href="index.php">Cancel</a></button>
	</form>
	<!-- Hint: 
	Valid accounts: umsi@umich.edu, chuck@umich.edu, csev@umich.edu, test@gmail.com, divyateja@gmail.com, admin@gmail.com
	The password is the three character name of the 
	programming language used in this class (all lower case) 
	followed by 123 and same for all accounts. -->
	<p id="warningMsg" style="color:red">
		<?php 
			if(isset($_SESSION["serverValErrorMsg"])){
				echo $_SESSION["serverValErrorMsg"];
				unset($_SESSION["serverValErrorMsg"]);
			}
		?>
	</p>
</body>

</html>
