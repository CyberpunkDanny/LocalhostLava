<?php
	$message = false;
	$guess = '';
	if(isset($_POST["guess"])){
		$guess = $_POST["guess"]+0;
		if($guess<42){
			$message = "Less than 42";
		}else if($guess>42){
			$message = "More than 42";
		}else{
			$message = "Yay! Success";
		}
	}
?>

<html>
	<head></head>
	<body>
		<form method = "post">
			<p>Input Guess: <input type="text" name="guess" <?php echo'value="'.htmlentities($guess).'"';?>/></p>
			<p><input type="submit"/>
		</form>
		<p><?php 
		if(isset($message))
			echo htmlentities($message); 
		?></p>
	</body>
</html>
