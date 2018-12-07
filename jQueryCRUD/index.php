<?php
	require_once "pdo.php";
	session_start();
?>

<html lang="en">

<head>
	<title>Divyateja Chepuru | Index</title>
	<meta charset="utf-8">
	
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">
	
	<script src="https://code.jquery.com/jquery-3.2.1.js" integrity="sha256-DZAnKJ/6XZ9si04Hgrsxu/8s717jcIzLy3oi35EouyE=" crossorigin="anonymous"></script>
</head>

<body>
	<div class="container">
		<h2>Resume Registry</h2>
		<div id="flashMsg">
			<?php
			if(isset($_SESSION["success"])){
				echo '<p style="color:green">'.$_SESSION["success"].'</p>';
				unset($_SESSION["success"]);
			}
			
			if(isset($_SESSION["error"])){
				echo '<p style="color:red">'.$_SESSION["error"].'</p>';
				unset($_SESSION["error"]);
			}
			if(!isset($_SESSION["adminAccount"]) && !isset($_SESSION["activeAccount"]))
			{
				echo '<p><a href="login.php">Please log in</a></p>';
			}
			else
			{
				//echo '<p style="color:green">'.$_SESSION["test"].'</p>';
				if(isset($_SESSION["adminAccount"]))
				{
					$sql = "SELECT * FROM users";
					$stmt = $pdo->query($sql);
					if($stmt->rowCount()<1)
					{
						echo '<p>No users found </p>';
					}
					else
					{
						echo '<table border="1">';
						echo '<tr><th>Username</th><th>Email</th>';
						while($row = $stmt->fetch(PDO::FETCH_ASSOC))
						{
							echo '<tr>';
							echo '<td>'.$row["user_name"].'</td><td>'.$row["user_email"].'</td>';
							echo '</tr>';
						}
						echo '</table>';
						echo '<br/>';
					}
					echo '<p><a href="addUser.php" class="btn btn-info">Add New User</a></p>';
				}
				else
				{
					$sql = "SELECT * FROM profiles WHERE profile_userId=:ph_userID";
					$stmt = $pdo->prepare($sql);
					$stmt->execute( array(':ph_userID' => $_SESSION["fetchedUserId"]) );
					if($stmt->rowCount()<1)
					{
						echo '<p>No profiles found</p>';					
					}
					else
					{
						echo '<table border="1">';
						echo '<tr><th>Username</th><th>Headline</th><th>Action</th></tr>';
						while($row = $stmt->fetch(PDO::FETCH_ASSOC))
						{
							echo '<tr>';
							echo '<td>'.$row["profile_firstName"].' '.$row["profile_lastName"].'</td><td>'.$row["profile_headline"].'</td>';
							echo '<td><a class="btn btn-warning btn-xs" href="edit.php?profileID='.$row["profile_id"].'">Edit</a> 
									  <a class="btn btn-danger btn-xs" href="delete.php?profileID='.$row["profile_id"].'">Delete</a>';
							echo '</tr>';
						}
						echo '</table>';
						echo '<br/>';
					}
					echo '<p><a href="add.php" class="btn btn-info">Add New Profile</a></p>';
				}
				echo '<p><a href="logout.php" class="btn btn-primary">Logout</a></p>';
			}
			?>
		</div>

	</div>
</body>

</html>