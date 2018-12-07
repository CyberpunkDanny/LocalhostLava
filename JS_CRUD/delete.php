<?php
	require_once "pdo.php";
	session_start();
	
	if(!isset($_SESSION["activeAccount"])){
		die("Not Logged In");
	}
	
	if(isset($_POST["deleteProf"]))
	{
		$sql = "DELETE FROM profile WHERE profile_id = :ph_profID";
		$stmt = $pdo->prepare($sql);
		$stmt->execute(array(":ph_profID" => $_GET["profileID"]));
		$_SESSION["serverValSuccessMsg"] = "Profile deleted successfully";
		header("Location: index.php");
		return;
	}
?>
<html lang="en">

<head>
	<title>Divyateja Chepuru | Delete</title>
	<meta charset="utf-8">
	<link rel="shortcut icon" href="#">
</head>
<body>
	<h2>Deleting Profile</h2>
	<?php 
		if(!isset($_GET["profileID"]))
		{
			$_SESSION["serverValErrorMsg"] = "Invalid Profile ID";
			header("Location: index.php");
			return;
		}
		$sql = "SELECT * FROM profile WHERE profile_id = :ph_profID";
		$stmt = $pdo->prepare($sql);
		$stmt->execute(array(":ph_profID" => $_GET["profileID"]));
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		echo "<p>First Name: ".$row["profile_firstName"]."</p>";
		echo "<p>Last Name: ".$row["profile_lastName"]."</p>";		
	?>
	<form method="post">
		<input type="submit" name="deleteProf" value="Delete"/> <button><a href="index.php">Cancel</a></button>
	</form>
</body>

</html>