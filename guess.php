<!DOCTYPE html>

<html lang = "en">

<head>
	<meta charset = "UTF-8">
	<title>Guessing Game</title>
</head>

<body>
	<?php 
		$oldguess  = isset($_POST['guess'])?$_POST['guess']:'';
	?>
	<p>Guess a number</p>
	<form method="post">
		<p><label for = "guess"> Your Input: </label>
		<!-- Use HTML entities to prevent Cross-site scripting i.e., HTML Injection. 
		Example: User can pass in $oldguess "/><hr/><input type = "submit" value = "Click Me Haha!" -->
		<input type = "text" name = "guess" id = "guess" value = "<?= htmlentities($oldguess) ?>" /></p>
		<input type = "submit" value = "Click here!"/>
	</form>
	
<pre>
$_POST:
<?php print_r($_POST); ?>
<br/>
$_GET:
<?php print_r($_GET); ?>
</pre>
</body>

</html>