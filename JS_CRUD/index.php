<?php
	require_once "pdo.php";
	session_start();
?>

<html lang="en">

<head>
	<title>Divyateja Chepuru | Index</title>
	<meta charset="utf-8">
	<link rel="shortcut icon" href="#">
</head>
<body>
	<h2>Resume Registry</h2>
	<?php 
	
	if(!isset($_SESSION["activeAccount"]) && !isset($_SESSION["adminAccount"]))
	{
		echo "<p><a href='login.php'>Please log in</a></p>";
		$sql = "SELECT * FROM profile";
		$stmt = $pdo->query($sql);
		if($stmt->fetch(PDO::FETCH_ASSOC) !== FALSE)
		{		
			$sql = "SELECT * FROM profile";
			$stmt = $pdo->query($sql);
			echo '<table border="1">';
			echo '<tr><th>Name</th><th>Headline</th></tr>';
			while($row = $stmt->fetch(PDO::FETCH_ASSOC))
			{
				echo '<tr><td><a href="view.php?profileID='.$row["profile_id"].'">'.$row["profile_firstName"].' '.$row["profile_lastName"].'</a></td><td>'.$row["profile_headline"]
					.'</td></tr>';
			}
			echo '</table>';
		}
	}
	else 
	{
		//FLASH MESSAGES
		if(isset($_SESSION["serverValSuccessMsg"]))
		{
			echo "<p id='message' style='color:green'>".$_SESSION["serverValSuccessMsg"]."</p>";
			unset($_SESSION["serverValSuccessMsg"]);
		}
		if(isset($_SESSION["serverValErrorMsg"]))
		{
			echo "<p id='message' style='color:red'>".$_SESSION["serverValErrorMsg"];
			unset($_SESSION["serverValErrorMsg"]);
		}
		
		if(isset($_SESSION["adminAccount"]))
		{
			$sql = "SELECT * FROM users";
			$stmt = $pdo->query($sql);
			if($stmt->fetch(PDO::FETCH_ASSOC) === FALSE)
			{
				echo "<p>No Users found</p>";
			}
			else
			{
				$sql = "SELECT * FROM users";
				$stmt = $pdo->query($sql);
				echo '<table border="1">';
				echo '<tr><th>User Name</th><th>User Email</th><th>Action</th></tr>';
				while($row = $stmt->fetch(PDO::FETCH_ASSOC))
				{
					echo '<tr><td>'.$row["user_name"].'</td><td>'.$row["user_email"]
						.'</td><td>'.'<p><a href="editUser.php?userID='.$row["user_id"].'">Edit</a>/'.
						'<a href="deleteUser.php?userID='.$row["user_id"].'">Delete</a></p>'.'</td></tr>';
				}
				echo '</table>';
			}
			echo "<p><a href='addUser.php'>Add New Entry</a></p>";
		}
		else
		{	
			$sql = "SELECT * FROM profile WHERE profile_userid = :ph_userId";
			$stmt = $pdo->prepare($sql);
			$stmt->execute(array(':ph_userId' => $_SESSION["fetchedUserId"]));
			if($stmt->fetch(PDO::FETCH_ASSOC) === FALSE)
			{
				echo "<p>No profiles found</p>";
			}
			else
			{
				$sql = "SELECT * FROM profile WHERE profile_userid = :ph_userId";
				$stmt = $pdo->prepare($sql);
				$stmt->execute(array(':ph_userId' => $_SESSION["fetchedUserId"]));
				echo '<table border="1">';
				echo '<tr><th>Name</th><th>Headline</th><th>Action</th></tr>';
				while($row = $stmt->fetch(PDO::FETCH_ASSOC))
				{
					echo '<tr><td><a href="view.php?profileID='.$row["profile_id"].'">'.$row["profile_firstName"].' '.$row["profile_lastName"].'</a></td><td>'
					.$row["profile_headline"].'</td><td>'.'<p><a href="edit.php?profileID='.$row["profile_id"].'">Edit</a>/'.
						'<a href="delete.php?profileID='.$row["profile_id"].'">Delete</a></p>'.'</td></tr>';
				}
				echo '</table>';
			}
			echo "<p><button><a href='add.php'>Add New Entry</a></button></p>";
		}
		echo "<p><button><a href='logout.php'>Logout</a></button></p>";
	}
	?>
</body>

</html>