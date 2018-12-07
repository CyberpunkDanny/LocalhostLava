<?php
	session_start();
	
	if(isset($_POST["account"]) && isset($_POST["pwd"]))
	{
		unset($_SESSION["account"]); //To logout any previous(current) user
		if(strlen($_POST["account"])<1 || strlen($_POST["pwd"])<1){
			$_SESSION["error"] = "Please fill in all the fields";
			header("Location: login.php");
			return;
		}
		elseif($_POST["pwd"] == "hello123") // In actual, we write SQL here to retrieve login details
			{
				$_SESSION["account"] = $_POST["account"];
				$_SESSION["success"] = "Login Successful";
				header("Location: app.php");
				return;
			}
		else{
				$_SESSION["error"] = "Incorrect Password";
				header("Location: login.php");
				return;
			}
	
	}			
	
	
?>

<html>
	<head></head>
	<body>
		<h2>Please Login</h2>
		<?php 
			if(isset($_SESSION["error"]))
			{
				echo "<p style='color:red'>".$_SESSION["error"]."</p>";				
				unset($_SESSION["error"]);
			}
			?>
		<form method = "post">
			<p>Account : <input type="text" name="account" value=""/></p>
			<p>Password: <input type="text" name="pwd" value=""/></p>
			<p><input type="submit" name="loginButton" value="Log In"/> <button><a href="app.php">Cancel</a></button></p>
		</form>
	</body>
</html>