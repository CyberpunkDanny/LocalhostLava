<!DOCTYPE html>
<html lang = "en">
<head>
<meta charset = "UTF-8">
 	<title>Divyateja Chepuru</title>
</head>

<body>
	<form method = "POST"> 
		<fieldset>
		<legend> Personal Info </legend> 
		
		<p><label for = "fname"> First Name: </label>
		<input type = "text" id = "fname" name = "fname"></p>
		
		<p><label for = "lname"> Last Name: </label>
		<input type = "text" id = "lname" name = "lname"></p>
		
		<p><label for = "account"> Account No: </label>
		<input type = "text" id = "account" name = "account"></p>		
		
		<p><label for = "lname"> Password: </label>
		<input type = "password" id = "password" name = "password"></p>		
		
		<p><label> Gender: </label>
		<input type = "radio" id = "gender" name = "gender" value = "male">Male 
		<input type = "radio" id = "gender" name = "gender" value = "female">Female
		</p>
		
		<p><label> Check your fav movies:</label>
		<input type="checkbox" name = "movie1" id = "movie1" value = "sholay"	>Sholay
		<input type="checkbox" name = "movie2" id = "movie2" value = "don">Don
		<input type="checkbox" name = "movie3" id = "movie3" value = "baazigar">Baazigar
		<input type="checkbox" name = "movie4" id = "movie4" value = "billa">Billa</p>	
		
		<p><label for ="soda">Preferred Soda: </label>
		<select name = "preferSoda" id = "soda">
			<option value = "0">--Please Select--</option>
			<option value = "1">Coke</option>
			<option value = "2">Pepsi</option>
			<option value = "3">Miranda</option>
		</select></p>
		
		<p><label for = "feedback">Give us feedback</label>
		<textarea rows = "5" cols = "30" name = "feedbackInput" id = "feedback"></textarea></p>
		</fieldset>
		<br/>
		<input type = "submit" name = "formSubmit" value = "Click Here!" />
		<input type = "button" name = "resetForm" value = "Reset Form" onclick = "location.href='index1.php'" />
	</form>
	<?php
	echo "<pre>";
		if($_POST)
		print_r($_POST);
	echo "</pre>";
	?>
</body>

</html>
