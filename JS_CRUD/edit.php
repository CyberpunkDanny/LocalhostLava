<?php
	require_once "pdo.php";
	session_start();
	
	if(!isset($_SESSION["activeAccount"])){
		die("Not Logged In");
	}
	
	if(isset($_POST["updateProfile"]))
	{
		$sql = "UPDATE profile SET profile_firstname=:ph_firstName, profile_lastname=:ph_lastName,
					profile_email=:ph_email, profile_headline=:ph_headline, profile_summary=:ph_summary
					WHERE profile_id = :ph_profID";
		$stmt = $pdo->prepare($sql);
		//echo $_SESSION["fetchedUserId"];
		$stmt->execute( array( 
							':ph_firstName' => $_POST["first_name"],
							':ph_lastName' => $_POST["last_name"],
							':ph_email' => $_POST["email"],
							':ph_headline' => $_POST["headline"],
							':ph_summary' => $_POST["summary"],
							':ph_profID' => $_GET["profileID"]
						)
					);
		$_SESSION["serverValSuccessMsg"] = "Record updated";
		header("Location: index.php");
		return;
	}
?>
<html lang="en">

<head>
	<title>Divyateja Chepuru | Edit</title>
	<meta charset="utf-8">
	<link rel="shortcut icon" href="#">
	<script type="text/javascript">
		function validateProfile()
		{
			var firstName = document.getElementById("firstName").value;
			var lastName = document.getElementById("lastName").value;
			var emailId = document.getElementById("emailAddr").value;
			var headline = document.getElementById("headline").value;
			var summary = document.getElementById("summary").value;	
			
			if(firstName.length<1 || lastName.length<1 || emailId.length<1 || headline.length<1
				|| summary.length<1)
				{
					document.getElementById("warningMsg").innerHTML = "All values are required";
					document.getElementById("warningMsg").style = "color:red";
					return false;
				}
			
			if(emailId.indexOf('@')<0)
			{
				document.getElementById("warningMsg").innerHTML = "Invalid Email Address";
				document.getElementById("warningMsg").style = "color:red";
				return false;	
			}
			
			return true;
		}
	</script>
</head>
<body>
	<h2>Editing Profile for <?php echo $_SESSION["activeAccount"]; ?></h2>
	<p id="warningMsg"></p>
	<?php
	if(!isset($_GET["profileID"]))
			{
				$_SESSION["serverValErrorMsg"] = "Invalid Profile ID";
				header("Location: index.php");
				return;
	}		
	$sql = "SELECT * FROM profile WHERE profile_id = :ph_profID";
	$stmt = $pdo->prepare($sql);
	$stmt->execute(array(':ph_profID' => $_GET["profileID"]));
	$row = $stmt->fetch(PDO::FETCH_ASSOC);
	?>
	<form method="post">
		<p>First Name <br/><input type="text" name="first_name" id="firstName" value="<?= htmlentities($row["profile_firstName"]);?>"/> </p>
		<p>Last Name <br/><input type="text" name="last_name" id="lastName" value="<?= htmlentities($row["profile_lastName"]);?>"/> </p>
		<p>Email <br/><input type="text" name="email" id="emailAddr" value="<?= htmlentities($row["profile_email"]);?>"/> </p>
		<p>Headline <br/><input type="text" name="headline" id="headline" 
			value="<?= htmlentities($row["profile_headline"]);?>" size="80"/> </p>
		<p>Summary <br/><textarea name="summary" id="summary" rows="8" cols="82" ><?= htmlentities($row["profile_summary"]);?></textarea></p>
		<input type="submit" onclick="return validateProfile();" name="updateProfile" value="Save" /> <button><a href="index.php">Cancel</a></button>
		<input type="hidden" name="userId" value="<?= $_SESSION["fetchedUserId"];?>" />
	</form>
</body>

</html>