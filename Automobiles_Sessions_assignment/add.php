<?php
	session_start();
	require_once "pdo.php";
	
	if(!isset($_SESSION["account"]))
	{
		//echo "<p><a href='index.php'>Go back</a></p>";
		die("Name parameter missing");
	}
	
	if(isset($_POST["make"]) && isset($_POST["year"]) && isset($_POST["mileage"]))
	{
		if(strlen($_POST["make"])<1 || strlen($_POST["year"])<1 || strlen($_POST["mileage"])<1)
		{
			$_SESSION["addNewError"] = "Make is required";
			header("Location: add.php");
			return;	
		}
		else
		{
			if(is_numeric($_POST["year"]) && is_numeric($_POST["mileage"]))
			{
				$sql = "INSERT INTO autos(auto_make, auto_year, auto_mileage) VALUES(:ph_make, :ph_year, :ph_mileage)";
				//ph - placeholder
				$stmt = $pdo->prepare($sql);
				$stmt->execute(array(
									'ph_make' => $_POST["make"],
									'ph_year' => $_POST["year"],
									'ph_mileage' => $_POST["mileage"]
					)
				);
				$_SESSION["successInsert"] = "Record inserted successfully";
				header("Location: view.php");
				return;
			}
			else
			{
				$_SESSION["addNewError"] = "Mileage and year must be numeric";
				header("Location: add.php");
				return;	
			}
		}
	}
	
?>

<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>Divyateja Chepuru | View</title>
	</head>
	
	<body>
	<h3>Tracking Automobiles for <?php if(isset($_SESSION["account"])) echo htmlentities($_SESSION["account"]);?></h3>
	<?php
		echo "<pre>";
		//var_dump($_SESSION);
		echo "</pre>";
		if(isset($_SESSION["addNewError"]))
		{
			echo "<p style='color:red'>".$_SESSION["addNewError"]."</p>";
			unset($_SESSION["addNewError"]);
		}
		
	?>
	<form method="post">
		<p>Make:<input type="text" name="make" value=""/></p>
		<p>Year:<input type="text" name="year" value=""/></p>
		<p>Mileage:<input type="text" name="mileage" value=""/></p>
		<p><input type="submit" value="Add" /> <button><a href="view.php">Cancel</a></button></p>
	</form>
	</body>
</html>
