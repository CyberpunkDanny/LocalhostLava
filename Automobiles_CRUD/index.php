<?php
	require_once "pdo.php";
	session_start();
?>

<html lang="en">
	<head>
		<meta charset="utf-8"/>
		<title>Divyateja Chepuru | Home</title>
	</head>
	
	<body>
		<h2>Welcome to the Automobiles Database</h2>
		<?php
		//FLASH MESSAGES
			if(isset($_SESSION["success"]))
			{
				echo '<p style="color:green">'.$_SESSION["success"].'</p>';
				unset($_SESSION["success"]);
			}
			if(isset($_SESSION["error"]))
			{
				echo '<p style="color:red">'.$_SESSION["error"].'</p>';
				unset($_SESSION["error"]);
			}
			if(isset($_SESSION["warning"]))
			{
				echo '<p style="color:orange">'.$_SESSION["warning"].'</p>';
				unset($_SESSION["warning"]);
			}
		?>
		<?php
			$x = ("fred"+1);
			echo $x;
			if(!isset($_SESSION["account"]))
			{
				echo '<p><a href="login.php">Please log in</a></p>'	;
				echo '<p>Attempt to go to <a href="add.php">add data</a> without logging in would fail</p>';	
			}
			else
			{
				$sql = "SELECT * FROM autos";
				$stmt = $pdo->query($sql);
				if($stmt->fetch(PDO::FETCH_ASSOC) === FALSE) //Remember, once fetched it's gone FOREVER
				{
					echo "<p>No rows found</p>";
				}
				else
				{
					$sql = "SELECT * FROM autos"; // Same query again
					$stmt = $pdo->query($sql);
					echo '<table border="1">';
					echo '<tr><th>Make</th><th>Model</th><th>Year</th><th>Mileage</th><th>Action</th></tr>';
					while($row = $stmt->fetch(PDO::FETCH_ASSOC))
					{
						echo '<tr><td>'.$row["auto_make"].'</td><td>'.$row["auto_model"].'</td><td>'.
							 $row["auto_year"].'</td><td>'.$row["auto_mileage"].'</td><td>'.
							 '<p><a href="edit.php?userID='.$row["auto_id"].'">Edit</a>/'.
							 '<a href="delete.php?userID='.$row["auto_id"].'">Delete</a></p>'.'</td></tr>';
					}
					echo '</table>';
				}
				echo '<p><a href="add.php">Add New Entry</a></p>';
				echo '<p><a href="logout.php">Logout</a></p>';
			}
		?>
		
	</body>
</html>