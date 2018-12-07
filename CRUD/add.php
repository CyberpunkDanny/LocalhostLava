<?php
	require_once "pdo.php";
	session_start();
	
	if(isset($_POST["memberName"]) && isset($_POST["memberEmail"]) && isset($_POST["memberPwd"]))
	{
		if(strlen($_POST["memberName"])<1 || strlen($_POST["memberEmail"])<1 || strlen($_POST["memberPwd"])<1)
		{
			$_SESSION["error"] = "Please fill in all the fields";
			header("Location: add.php");
			return;
		}
		if(strpos($_POST["memberEmail"], "@") === FALSE)
		{
			$_SESSION["error"] = "Email must have @ symbol";
			header("Location: add.php");
			return;
		}
		$sql = "INSERT INTO members(member_name, member_email, member_password) VALUES(:ph_memberName, :ph_memberEmail, :ph_memberPwd)";
		$stmt = $pdo->prepare($sql);
		$stmt->execute(array(
						':ph_memberName' => $_POST["memberName"],
						':ph_memberEmail' => $_POST["memberEmail"],
						':ph_memberPwd' => $_POST["memberPwd"]						
					)
		);
		$_SESSION["success"] = "New member added successfully";
		header("Location: index.php");
		return;
	}
?>

<html lang="en">

<head>
	<meta charset="utf-8"/>
	<title>Members | Add</title>
</head>

<body>
	<h3>Add a new user</h3>
	<?php
	if(isset($_SESSION["error"]))
		{
			echo '<p style="color:red">'.$_SESSION["error"].'</p>';
			unset($_SESSION["error"]);
		}
	?>
	<form method="post">
		<p>Name: <input type="text" name="memberName" /></p>
		<p>Email: <input type="text" name="memberEmail" /></p>
		<p>Password: <input type="text" name="memberPwd" /></p>	
		<p><input type="submit" value="Add" /> | <button><a href="index.php">Cancel</a></button></p>
	</form>
</body>

</html>