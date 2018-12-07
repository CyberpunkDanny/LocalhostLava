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
	
	if(isset($_POST["make"]) && isset($_POST["model"]) && isset($_POST["year"]) && isset($_POST["mileage"]))
	{
		if(strlen($_POST["make"])<1 || strlen($_POST["model"])<1 || strlen($_POST["year"])<1 || strlen($_POST["mileage"])<1)
		{
			$_SESSION["error"] = "Please fill in all the fields";
			header("Location: edit.php?userID=".urlencode($_POST['userID']));
			return;
		}
		if(is_numeric($_POST["year"]) === FALSE || is_numeric($_POST["mileage"]) === FALSE)
		{
			$_SESSION["error"] = "Year and Mileage must be numerical";
			header("Location: edit.php?userID=".urlencode($_POST['userID']));
			return;
		}
		$sql = "UPDATE autos SET auto_make=:ph_autoMake, auto_model=:ph_autoModel,
													auto_year = :ph_autoYear, auto_mileage = :ph_autoMileage WHERE auto_id = :ph_userID ";
		$stmt = $pdo->prepare($sql);
		$stmt->execute( array(
						':ph_autoMake' => $_POST["make"],
						':ph_autoModel' => $_POST["model"],
						':ph_autoYear' => $_POST["year"],
						':ph_autoMileage' => $_POST["mileage"],
						':ph_userID' => $_POST["userID"]
						)				
		);
		$_SESSION["success"] = "Record edited";
		header("Location: index.php");
		return;
	}
?>

<html lang="en">

<head>
	<meta charset="utf-8"/>
	<title>Divyateja Chepuru | Edit</title>
</head>

<body>
	<?php
		$sql = "SELECT * FROM autos WHERE auto_id = :ph_autoID";
		$stmt = $pdo->prepare($sql);
		$stmt->execute( array(':ph_autoID' => $_GET["userID"]) );
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		if($row === FALSE)
		{
			$_SESSION["error"] = "Bad User ID";
			header("Location: index.php");
			return;
		}
		if(isset($_SESSION["error"]))
		{
			echo '<p style="color:red">'.$_SESSION["error"].'</p>';
			unset($_SESSION["error"]);
		}	
	?>
	<form method="post">
		<p>Make: <input type="text" name="make" value="<?= htmlentities($row["auto_make"]); ?>"/></p>
		<p>Model: <input type="text" name="model" value="<?= htmlentities($row["auto_model"]); ?>"/></p>
		<p>Year: <input type="text" name="year" value="<?= htmlentities($row["auto_year"]); ?>"/></p>	
		<p>Mileage: <input type="text" name="mileage" value="<?= htmlentities($row["auto_mileage"]); ?>"/></p>
		<input type="hidden" name="userID" value="<?= $_GET['userID']; ?>" />
		<input type="submit" name = "EditMember" value="Save"/> <button><a href="index.php">Cancel</a>	
	</form>
</body>

</html>