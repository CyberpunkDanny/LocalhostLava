<?php
	require_once "pdo.php";
	session_start();
	
	if(isset($_POST["addProfile"]))
	{
		$sql = "INSERT INTO profile(profile_firstName, profile_lastName, profile_email, profile_headline,
				 profile_summary, profile_userid) VALUES(:ph_firstName, :ph_lastName, :ph_email, :ph_headline, 
				 :ph_summary, :ph_userId)";
		$stmt = $pdo->prepare($sql);
		echo $_SESSION["fetchedUserId"];
		$stmt->execute( array( 
							':ph_firstName' => $_POST["firstName"],
							':ph_lastName' => $_POST["lastName"],
							':ph_email' => $_POST["emailAddr"],
							':ph_headline' => $_POST["headline"],
							':ph_summary' => $_POST["summary"],
							':ph_userId' => $_POST["userId"]
						)
					);
		$_SESSION["serverValSuccessMsg"] = "Record added";
		header("Location: index.php");
		return;
	}
?>
<html lang="en">

<head>
	<title>Divyateja Chepuru | Add</title>
	<meta charset="utf-8">
	<link rel="shortcut icon" href="#">
	
</head>
<body>
	<h2>Profile Information</h2>
		<?php
			if(!isset($_GET["profileID"]))
			{
				$_SESSION["serverValErrorMsg"] = "Invalid Profile ID";
				header("Location: index.php");
				return;
			}		
			$sql = "SELECT * FROM profile WHERE profile_id=:ph_profID";
			$stmt = $pdo->prepare($sql);
			$stmt->execute( array(':ph_profID' => $_GET["profileID"]) );
			$row = $stmt->fetch(PDO::FETCH_ASSOC);
			
			echo '<p><b>First Name:</b> '.$row["profile_firstName"].'</p>';
			echo '<p><b>Last Name:</b> '.$row["profile_lastName"].'</p>';
			echo '<p><b>Email:</b> '.$row["profile_email"].'</p>';
			echo '<p><b>Headline:</b> </br>'.$row["profile_headline"].'</p>';
			echo '<p><b>Summary:</b> </br>'.$row["profile_summary"].'</p>';			
		?>
		<p><a href="index.php">Done</a></p>
</body>

</html>