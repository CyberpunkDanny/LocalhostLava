<?php
	require_once "pdo.php";
	session_start();
	
	if(!isset($_SESSION["activeAccount"])){
		die("Not Logged In");
	}
	
	if(isset($_POST["addProfile"]))
	{
		if(strlen($_POST["first_name"])<1 || strlen($_POST["last_name"])<1 || strlen($_POST["email"])<1 
				|| strlen($_POST["headline"])<1 || strlen($_POST["summary"])<1)
		{
			$_SESSION["serverValErrorMsg"] = "All values are required";
			header("Location: add.php");
			return;
		}
		$sql = "INSERT INTO profile(profile_firstName, profile_lastName, profile_email, profile_headline,
				 profile_summary, profile_userid) VALUES(:ph_firstName, :ph_lastName, :ph_email, :ph_headline, 
				 :ph_summary, :ph_userId)";
		$stmt = $pdo->prepare($sql);
		//echo $_SESSION["fetchedUserId"];
		$stmt->execute( array( 
							':ph_firstName' => $_POST["first_name"],
							':ph_lastName' => $_POST["last_name"],
							':ph_email' => $_POST["email"],
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
	<h2>Adding Profile for <?php echo $_SESSION["activeAccount"]; ?></h2>
	<p id="warningMsg"></p>
	<form method="post">
		<p>First Name <br/><input type="text" name="first_name" id="firstName"/> </p>
		<p>Last Name <br/><input type="text" name="last_name" id="lastName"/> </p>
		<p>Email <br/><input type="text" name="email" id="emailAddr"/> </p>
		<p>Headline <br/><input type="text" name="headline" id="headline" size="80"/> </p>
		<p>Summary <br/><textarea name="summary" id="summary" rows="8" cols="82"></textarea></p>
		<input type="hidden" name="userId" value="<?= $_SESSION["fetchedUserId"];?>" />
		<input type="submit" onclick="return validateProfile();" name="addProfile" value="Add" /> <button><a href="index.php">Cancel</a></button>
	</form>
</body>

</html>