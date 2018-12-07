<?php
	session_start();
	$guess = "";
	if(isset($_POST["guess"])){
		$guess = $_POST["guess"]+0;
		$_SESSION["guess"] = $guess;
		if($guess<42){
			$_SESSION["message"] = "Less than 42";
		}else if($guess>42){
			$_SESSION["message"] = "More than 42";
		}else{
			$_SESSSION["message"] = "Yay! Success";
		}
		header("Location: POST-ReDirect-GET.php");
		return;
	}
?>

<html>
	<head></head>
	<body>
	<?php
		$guess = isset($_SESSION["guess"])? $_SESSION["guess"]:'';
		$message = isset($_SESSION["message"])? $_SESSION["message"]:false;
	?>
	<?php if($message !== false) echo "<p>$message</p>"; ?>		
	<form method = "post">
		<p>Input Guess: <input type="text" name="guess" <?php echo 'value="'.htmlentities($guess).'"'; ?>/></p>
		<p><input type="submit"/>
	</form>
	</body>
</html>
