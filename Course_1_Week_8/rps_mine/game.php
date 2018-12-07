<?php
	if( !isset($_GET['userName']) || strlen($_GET['userName'])<1)
	{	
		echo "<p><a href = 'index.php'>Go Back</a></p>";
		die("Name parameter missing");
	}	
	if(isset($_POST['logout'])){
		header("Location: index.php");
		return;
	}
	
	$humanChoice = -1;
	$result = false;
	
	$choices = array();
	$choices[] = 'Rock';
	$choices[] = 'Paper';
	$choices[] = 'Scissors';
	
	if(isset($_POST['human']))
		$humanChoice = $_POST['human']+0; //Remember always to type cast text to int
	
	$computerChoice = rand(0,2);
		
	function check(int $humanChoice, $computerChoice){
	$diff = $humanChoice-$computerChoice;
		if($diff == 0)
			return "Tie";
		else if($diff == -2 || $diff == 1)
			return "You Win!";
		else if($diff == +2 || $diff == -1)
			return "You Lose!";
	}
	
	$result = check($humanChoice, $computerChoice);
?>

<!DOCTYPE html>

<html lang = "en">

<head>
	<meta charset = "UTF-8">
	<!-- <title>Game | Rock Paper Scissors</title> -->
	<title>Divyateja Chepuru 811be42d</title>
</head>

<body>
	<h1>Rock Paper Scissors</h1>
	<p>Welcome <?= htmlentities($_GET['userName'])?> </p>
	<form method = "post">
		<select name = "human" id = "humanChoice">
			<option value = "-1">--Select--</option>
			<option value = "0">Rock</option>
			<option value = "1">Paper</option>
			<option value = "2">Scissors</option>
			<option value = "3">Test</option>
		</select>
		<input type = "submit" name = "play" value = "Play" />
		<input type = "submit" name = "logout" value = "Log Out" />
	</form>
	<?php
	if($humanChoice == -1)
		echo "<p>Please select a strategy to play</p>";
	else if($humanChoice == 3){
		echo "<br/><fieldset>";
		for($i=0; $i<3; $i++){
			for($j=0; $j<3; $j++){
				$result = check($i, $j);

				echo "Your Play=$choices[$i] Computer Play=$choices[$j] Result=$result\n";
			}
		}	
		echo "</fieldset>";
	}
	else {
		echo "Your Play=$choices[$humanChoice] Computer Play=$choices[$computerChoice] Result=$result\n";
	}
	?>
</body>

</html>