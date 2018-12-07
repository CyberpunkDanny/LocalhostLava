<?php
	require_once "pdo.php";
	
	$warningMsg = FALSE;
	$successMsg = FALSE;
	
	if(!isset($_GET["user"]))
	{
		echo "<p><a href = 'index.php'>Go Back</a></p>";
		die("Name parameter missing");
	}

	if(isset($_POST["LogoutButton"])){
		header("Location: index.php");
	}
	
	if(isset($_POST["make"]) && isset($_POST["year"]) && isset($_POST["mileage"]))
	{
		if(strlen($_POST["make"])<1 || strlen($_POST["year"])<1 || strlen($_POST["mileage"])<1)
			$warningMsg = "Make is required";
		else 
		{
			if(is_numeric($_POST["year"]) && is_numeric($_POST["mileage"])){
				$successMsg = "Record Inserted";
				//ph - Place holder
				$sql = "INSERT INTO autos(auto_make, auto_year, auto_mileage) VALUES(:ph_make, :ph_year, :ph_mileage)";
				$stmt = $pdo->prepare($sql);
				$stmt->execute(array(
									'ph_make' => $_POST["make"],
									'ph_year' => $_POST["year"],
									'ph_mileage' => $_POST["mileage"]
									)
								);
			}
			else
				$warningMsg = "Mileage and year must be numeric";
		}
	}
?>

<html lang="en">

<head>
	<meta charset = "UTF-8">
	<title>Divyateja Chepuru | Autos </title>
	
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

	<!-- Optional theme -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">
	
	<style>
		#successMsg, #warningMsg {
			font-size: 14px;
		}
		#successMsg{
			color: green;
		}
		#warningMsg{
			color: red;
		}
	</style>
</head>

<body>
	<div class ="container">
	<h1>Tracking Autos for <?= htmlentities($_GET["user"]);?></h1>
	<p id = "warningMsg"><?= htmlentities($warningMsg);?></p>
	<p id = "successMsg"><?= htmlentities($successMsg);?></p>
	<form method = "post">
		<p>Make <input type="text" name = "make" /></p>
		<p>Year <input type="text" name = "year" /></p>
		<p>Mileage <input type="text" name = "mileage" /></p>		
		<p>
			<input type = "submit" value = "Add"/>
			<input type = "submit" name = "logout" value = "Logout"/>
		</p>
	</form>
	<?php 
	$stmt = $pdo->query("SELECT * FROM autos");
	echo "<h1>Automobiles List</h1><ul>";
	while($row = $stmt->fetch(PDO::FETCH_ASSOC))
	{
		echo "<li>".htmlentities($row['auto_year'])." ".htmlentities($row['auto_make'])." / ".
						htmlentities($row['auto_mileage'])."</li>" ;
	}
	echo "</ul>";
	?>
	</div>
</body>

</html>

