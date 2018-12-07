<?php
	require_once "pdo.php";
	session_start();
	
	if(isset($_POST["deleteProf"]))
	{
		$sql = "DELETE FROM profiles WHERE profile_id=:ph_userID";
		$stmt = $pdo->prepare($sql);
		$stmt->execute( array(':ph_userID' => $_POST["deleteProfId"]) );
		$_SESSION["success"] = "Profile Deleted";
		header("Location: index.php");
		return;
	}		
?>

<html lang="en">

<head>
	<title>Divyateja Chepuru | Delete</title>
	<meta charset="utf-8">
	
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">
	
	<script src="https://code.jquery.com/jquery-3.2.1.js" integrity="sha256-DZAnKJ/6XZ9si04Hgrsxu/8s717jcIzLy3oi35EouyE=" crossorigin="anonymous"></script>
</head>

<body>
	<div class="container">
		<h2>Deleting Profile</h2>
		<?php
		if(!isset($_GET["profileID"]))
		{
			$_SESSION["error"] = "Invalid Profile ID";
			header("Location: index.php");
			return;
		}
		$sql = "SELECT * FROM profiles WHERE profile_id=:ph_userID";
		$stmt = $pdo->prepare($sql);
		$stmt->execute( array(':ph_userID' => $_GET["profileID"]) );
		if($stmt->rowCount()<1)
		{
			echo '<p>No profiles found</p>';					
		}
		else
		{
			$row = $stmt->fetch(PDO::FETCH_ASSOC);
			echo '<p>First Name: '.$row["profile_firstName"].'</p>';
			echo '<p>Last Name: '.$row["profile_lastName"].'</p>';				
		}
		?>
		<form method = "post">
			<input type="hidden" name="deleteProfId" value="<?= htmlentities($_GET["profileID"]); ?>"/>
			<input type="submit" class="btn btn-primary" name="deleteProf" value="Delete" /> 
			<a href="index.php" class="btn btn-primary">Cancel</a>
		</form>
	</div>
</body>

</html>