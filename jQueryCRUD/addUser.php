<?php
	require_once "pdo.php";
	session_start();
	
	if(isset($_POST["newUserName"]) && isset($_POST["newUserEmail"]) && isset($_POST["newUserPwd"]))
	{
		if(strlen($_POST["newUserName"])<1 || strlen($_POST["newUserEmail"])<1 || strlen($_POST["newUserPwd"])<1)
		{
			$_SESSION["error"] = "All fields must be filled out";
			header("Location: addUser.php");
			return;
		}
		if(strpos($_POST["newUserEmail"], '@')<0)
		{
			$_SESSION["error"] = "Email must contain @ symbol";
			header("Location: addUser.php");
			return;
		}
		
		$salt = 'XyZzy12*_';
		$userPwdHash = hash('md5', $salt.$_POST["userLoginPwd"]);
		$sql = "INSERT INTO users(user_name, user_email, user_password) VALUES(:ph_name, :ph_email, :ph_pwd)"; 
		$stmt = $pdo->prepare($sql);
		$stmt->execute( array(
						':ph_name' => $_POST["newUserName"],
						':ph_email' => $_POST["newUserEmail"],
						':ph_pwd' => $_POST["newUserPwd"]						
		));
		$_SESSION["success"] = "New User Added Successfully";
		header("Location: index.php");
		return;
	}
?>

<html lang="en">

<head>
	<title>Divyateja Chepuru | Index</title>
	<meta charset="utf-8">
	
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">
	
	<script src="https://code.jquery.com/jquery-3.2.1.js" integrity="sha256-DZAnKJ/6XZ9si04Hgrsxu/8s717jcIzLy3oi35EouyE=" crossorigin="anonymous"></script>
	<script type="text/javascript">
		function validateAddUserFields()
		{
			var name = document.getElementById("newUserName").value;
			var email = document.getElementById("newUserEmail").value;
			var password = document.getElementById("newUserPwd").value;
			
			if(name.length<1 || email.length<1 || password.length<1)
			{
				document.getElementById("flashMsg").innerHTML = "All fields must be filled out";
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
		<h2>Adding a new user</h2>
		<div id="flashMsg">
			<?php
			if(isset($_SESSION["success"])){
				echo '<p style="color:green">'.$_SESSION["success"].'</p>';
				unset($_SESSION["success"]);
			}
			
			if(isset($_SESSION["error"])){
				echo '<p style="color:red">'.$_SESSION["error"].'</p>';
				unset($_SESSION["error"]);
			}
			?>
		</div>
		<form method="post">
			<label>Name <input type="text" name="newUserName" id="newUserName"/></label><br/>		
			<label>Email <input type="text" name="newUserEmail" id="newUserEmail"/></label><br/>
			<label>Password <input type="password" name="newUserPwd" id="newUserPwd"/></label><br/>
			<input type="submit" class="btn btn-info" onclick="return validateAddUserFields();" value="Add" /> <a href="index.php" class="btn btn-info">Cancel</a>
		</form>
	</div>
</body>

</html>