<?php
	session_start();
	require_once "pdo.php";
	if(!isset($_SESSION["account"]))
	{
		echo "<p><a href='index.php'>Go back</a></p>";
		die("Name parameter missing");
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
	
		if(isset($_SESSION["successInsert"]))
		{
			echo "<p style='color:green'>".$_SESSION["successInsert"]."</p>";
			unset($_SESSION["successInsert"]);
		}
		$sql = "SELECT * FROM autos";
		$stmt = $pdo->query($sql);
		echo "<h2>Automobiles</h2>";
		echo "<ul>";
		while($row = $stmt->fetch(PDO::FETCH_ASSOC))
		{
			echo "<li>".htmlentities($row['auto_year'])." ".htmlentities($row['auto_make'])." / ".
						htmlentities($row['auto_mileage'])."</li>" ;
		}
		echo "</ul>";
	?>
	<p><a href="add.php">Add New</a> | <a href="logout.php">Logout</a></p>
	</body>
</html>
