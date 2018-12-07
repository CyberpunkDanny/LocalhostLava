<?php
	require_once "pdo.php";
	session_start();
	
	if(!isset($_SESSION["account"]))
	{
		echo "<p><a href='index.php'>Go back</a></p>";
		die("Access denied!");
	}
	
	if(!isset($_GET["userID"]))
	{
		$_SESSION["error"] = "Missing User ID";
		header("Location: index.php");
		return;
	}
	
	if(isset($_POST["deleteRecord"]))
	{
		$sql = "DELETE FROM autos WHERE auto_id = :ph_userID";
		$stmt = $pdo->prepare($sql);
		$stmt->execute( array( ':ph_userID' => $_POST["userId"]) );
		$_SESSION["success"] = "Record deleted";
		header("Location: index.php");
		return;
	}
?>

<html lang="en">

<head>
	<meta charset="utf-8"/>
	<title>Divyateja Chepuru | Delete</title>
</head>

<body>
	<h3>Confirm Delete?</h3>
	<?php 
		$sql = "SELECT COUNT(*) FROM autos WHERE auto_id = :ph_userID";
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
		<input type="hidden" name="userId" value="<?= $_GET["userID"]; ?>" />
		<input type="submit" name="deleteRecord" value="Delete" /> <button><a href="index.php">Cancel</a></button>
	</form>
</body>

</html>