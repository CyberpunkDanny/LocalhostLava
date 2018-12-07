<?php
	require_once "pdo.php";
	session_start();
	
	if(!isset($_GET["userID"]))
	{
		$_SESSION["error"] = "Missing User ID";
		header("Location: index.php");
		return;
	}
	
	if(isset($_POST["deleteMember"]))
	{
		$sql = "DELETE FROM members WHERE member_id = :ph_userID";
		$stmt = $pdo->prepare($sql);
		$stmt->execute( array( ':ph_userID' => $_POST['userID']) );
		$_SESSION["success"] = "Member deleted successfully";
		header("Location: index.php");
		return;
	}
?>

<html lang="en">

<head>
	<meta charset="utf-8"/>
	<title>Members | Delete</title>
</head>

<body>
	<h3>Confirm Delete?</h3>
	<?php 
		$sql = "SELECT COUNT(*) FROM members WHERE member_id = :ph_userID";
		$stmt = $pdo->prepare($sql);
		$stmt->execute(array(':ph_userID' => $_GET["userID"]));
		if($stmt->fetch(PDO::FETCH_ASSOC) === FALSE)
		{
			$_SESSION["error"] = "Bad user id";
			header("Location:index.php");
			return;
		}
	?>
	<form method="post">
		<input type="hidden" name="userID" value="<?= $_GET['userID']; ?>" />
		<input type="submit" name = "deleteMember" value="Delete"/> <button><a href="index.php">Cancel</a>	
	</form>
</body>

</html>