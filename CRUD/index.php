<?php
	require_once "pdo.php";
	session_start();
?>
<html lang="en">

<head>
	<meta charset="utf-8"/>
	<title>Members | Home</title>
</head>

<body>
	<?php 
		if(isset($_SESSION["success"]))
		{
			echo '<p style="color:green">'.$_SESSION["success"].'</p>';
			unset($_SESSION["success"]);
		}
		if(isset($_SESSION["warning"]))
		{
			echo '<p style="color:orange">'.$_SESSION["warning"].'</p>';
			unset($_SESSION["warning"]);
		}
	?>
	<table border="1">
	<?php
		$sql = "SELECT * FROM members"; 
		$stmt = $pdo->query($sql);
		while($row = $stmt->fetch(PDO::FETCH_ASSOC))
		{	
			echo '<tr><td>'.htmlentities($row["member_name"]).'</td><td>'.htmlentities($row["member_email"]).
					'</td><td><p><a href="edit.php?userID='.$row["member_id"].'">Edit</a> / <a href="delete.php?userID='.
						$row["member_id"].'">Delete</a></p></tr>';
		}
	?>
	</table>

	<br/>
	<button><a href="add.php">Add New</a></button>

</body>

</html>