<?php
	//Do NOT have any output before this statement
	if(!isset($_COOKIE['pizza'])){
		setcookie('pizza', '42', time()+3600); 
	}
?>
<html lang="en">
	<head>
	</head>
	
	<body>
	<h3>Cookie</h3>
		<pre>
<?php 
print_r($_COOKIE);?>
		</pre>
		<p><a href="1_cookie.php">Click Me!</a> or Refresh the page</p>
	</body>
</html>