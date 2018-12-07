<?php
	require_once "pdo.php";
	session_start();
	
	if(!isset($_SESSION["adminAccount"])){
		die("Not Logged In. Admin access needed");
	}
	
	if(isset($_POST["addUser"]))
	{
		$salt = 'XyZzy12*_';
		$userPwdHash = hash('md5', $salt.$_POST["userPwd"]);
		$sql = "INSERT INTO users(user_name, user_email, user_password)
					VALUES(:ph_userName, :ph_email, :ph_pwd)";
		$stmt = $pdo->prepare($sql);
		$stmt->execute( array( 
							':ph_userName' => $_POST["userName"],
							':ph_email' => $_POST["userEmail"],
							':ph_pwd' => $userPwdHash						
						)
					);
		$_SESSION["serverValSuccessMsg"] = "User added";
		header("Location: index.php");
		return;
	}
?>
<html lang="en">

<head>
	<title>Divyateja Chepuru | Admin</title>
	<meta charset="utf-8">
	<link rel="shortcut icon" href="#">
	<script type="text/javascript">
		function validateUser()
		{
			var userName = document.getElementById("userName").value;
			var emailId = document.getElementById("userEmail").value;
			var pwd = document.getElementById("userPwd").value;
			
			if(userName.length<1 || emailId.length<1 || pwd.length<1)
			{
				document.getElementById("warningMsg").innerHTML = "All fields are required";
				document.getElementById("warningMsg").style = "color:red";
				return false;
			}
			
			if(emailId.indexOf('@')<0)
			{
				document.getElementById("warningMsg").innerHTML = "Invalid Email Address";
				document.getElementById("warningMsg").style = "color:red";
				return false;	
			}
			
			return true;
		}
	</script>
</head>
<body>
	<h2>Adding User</h2>
	<p id="warningMsg"></p>
	<form method="post">
		<p>User Name <br/><input type="text" name="userName" id="userName"/> </p>
		<p>Email <br/><input type="text" name="userEmail" id="userEmail"/> </p>
		<p>Password <br/><input type="password" name="userPwd" id="userPwd"/> </p>
		<input type="submit" onclick="return validateUser();" name="addUser" value="Add" /> <button><a href="index.php">Cancel</a></button>
	</form>
</body>

</html>