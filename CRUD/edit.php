<?php
	require_once "pdo.php";
	session_start();
	
	if(isset($_POST["memberName"]) && isset($_POST["memberEmail"]) && isset($_POST["memberPwd"]))
	{
		if(strlen($_POST["memberName"])<1 || strlen($_POST["memberEmail"])<1 || strlen($_POST["memberPwd"])<1)
		{
			$_SESSION["error"] = "Please fill in all the fields";
			header("Location: edit.php?userID=".urlencode($_POST['userID']));
			return;
		}
		if(strpos($_POST["memberEmail"], "@") === FALSE)
		{
			$_SESSION["error"] = "Email must have @ symbol";
			header("Location: edit.php?userID=".urlencode($_POST['userID']));
			return;
		}
		$sql = "UPDATE members SET member_name=:ph_memberName, member_email=:ph_memberEmail,
													member_password = :ph_memberPwd WHERE member_id = :ph_userID ";
		$stmt = $pdo->prepare($sql);
		$stmt->execute( array(
						':ph_memberName' => $_POST["memberName"],
						':ph_memberEmail' => $_POST["memberEmail"],
						':ph_memberPwd' => $_POST["memberPwd"],
						':ph_userID' => $_POST["userID"]
						)				
		);
		$_SESSION["success"] = "Member details updated";
		header("Location: index.php");
		return;
	}
?>

<html lang="en">

<head>
	<meta charset="utf-8"/>
	<title>Members | Edit</title>
</head>

<body>
	<?php 
		$sql = "SELECT * FROM members WHERE member_id = :ph_userID";
		$stmt = $pdo->prepare($sql);
		$stmt->execute(array(':ph_userID' => $_GET["userID"]));
		$row = $stmt->fetch(PDO::FETCH_ASSOC);z
		if($row === FALSE)
		{
			$_SESSION["error"] = "Bad user id";
			header("Location:index.php");
			return;
		}
	
		if(isset($_SESSION["error"]))
		{
			echo '<p style="color:red">'.$_SESSION["error"].'</p>';
			unset($_SESSION["error"]);
		}
	?>
	<form method="post">
		<p>Name: <input type="text" name="memberName" value="<?= htmlentities($row["member_name"]);?>"/></p>
		<p>Email: <input type="text" name="memberEmail" value="<?= htmlentities($row["member_email"]); ?>"/></p>
		<p>Password: <input type="text" name="memberPwd" value="<?= htmlentities($row["member_password"]); ?>"/></p>	
		<input type="hidden" name="userID" value="<?= $_GET['userID'] ?>;" />
		<p><input type="submit" value="Update" />  <button><a href="index.php">Cancel</a></button></p>
	</form>

</body>

</html>