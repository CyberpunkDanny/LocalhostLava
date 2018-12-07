<?php
	require_once "pdo.php";
	session_start();
	
	if(isset($_POST["AddProfFName"]) && isset($_POST["AddProfLName"]) && isset($_POST["AddProfEmail"])
			&& isset($_POST["AddProfHeadline"]) && isset($_POST["AddProfSummary"]))
	{
		if(strlen($_POST["AddProfFName"])<1 || strlen($_POST["AddProfLName"])<1 || strlen($_POST["AddProfEmail"])<1
				|| strlen($_POST["AddProfHeadline"])<1 || strlen($_POST["AddProfSummary"])<1)
		{
			$_SESSION["error"] = "All fields must be filled out";
			header("Location: addUser.php");
			return;
		}
		if(strpos($_POST["AddProfEmail"], '@')<0)
		{
			$_SESSION["error"] = "Email must contain @ symbol";
			header("Location: addUser.php");
			return;
		}
		
		$sql = "INSERT INTO profiles(profile_firstName, profile_lastName, profile_email, profile_headline,
					profile_summary, profile_userid) VALUES(:ph_firstName, :ph_lastName, :ph_email,
					:ph_headline, :ph_summary, :ph_userId)"; 
		$stmt = $pdo->prepare($sql);
		$stmt->execute( array( 
							':ph_firstName' => $_POST["AddProfFName"],
							':ph_lastName' => $_POST["AddProfLName"],
							':ph_email' => $_POST["AddProfEmail"],
							':ph_headline' => $_POST["AddProfHeadline"],
							':ph_summary' => $_POST["AddProfSummary"],
							':ph_userId' => $_POST["AddProfUserId"]
						)
					);
		$_SESSION["success"] = "New Profile Added Successfully";
		header("Location: index.php");
		return;
	}
?>

<html lang="en">

<head>
	<title>Divyateja Chepuru | Index</title>
	<meta charset="utf-8">
	
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">
	
	<script src="https://code.jquery.com/jquery-3.2.1.js" integrity="sha256-DZAnKJ/6XZ9si04Hgrsxu/8s717jcIzLy3oi35EouyE=" crossorigin="anonymous"></script>
	<script type="text/javascript">
		function validateAddProfFields()
		{
			var fname = document.getElementById("AddProfFName").value;
			var lname = document.getElementById("AddProfFName").value;
			var email = document.getElementById("AddProfEmail").value;
			var headline = document.getElementById("AddProfHeadline").value;
			var summary = document.getElementById("AddProfSummary").value;
			
			if(fname.length<1 || lname.length<1 || email.length<1 || headline.length<1 || summary.length<1)
			{
				document.getElementById("flashMsg").innerHTML = "All fields must be filled out";
				document.getElementById("flashMsg").style.color = "red";
				return false;
			}
			
			if(email.indexOf('@')<0)
			{
				document.getElementById("flashMsg").innerHTML = "Invalid Email Address";
				document.getElementById("flashMsg").style.color = "red";
				return false;
			}
			return true;
		}
	</script>
</head>

<body>
	<div class="container">
		<h2>Adding a new profile</h2>
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
			?>
		</div>
		<form method="post">
			<label>First Name <br/><input type="text" name="AddProfFName" id="AddProfFName"/></label><br/>
			<label>Last Name <br/><input type="text" name="AddProfLName" id="AddProfLName"/></label><br/>			
			<label>Email <br/><input type="text" name="AddProfEmail" id="AddProfEmail"/></label><br/>
			<label>Headline <br/><input type="text" name="AddProfHeadline" id="AddProfHeadline"/></label><br/>
			<label>Summary <br/><textarea name="AddProfSummary" id="AddProfSummary" rows="8" cols="82"></textarea></label><br/>
			<input type="hidden" name="AddProfUserId" value="<?= $_SESSION["fetchedUserId"];?>" />
			<input type="submit" class="btn btn-success" onclick="return validateAddProfFields();" value="Add" /> <a href="index.php" class="btn btn-warning">Cancel</a>
		</form>
	</div>
</body>

</html>