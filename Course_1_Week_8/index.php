<!DOCTYPE html>
<html lang = "en">
<head>
<meta charset = "UTF-8">
 	<title>PHP</title>
</head>

<body>
	<p>Guessing Game</p>
	<form> <!-- Default is GET. Use <form method = "post" for POST -->
		<fieldset>
		<legend>GET Request Example</legend>
		<label> Input Guess: <input type = "text" name = "guess" id = "guess"/> </label>
		</fieldset>
		<fieldset>
		<legend> Personal Info </legend> 
		
		<label for = "fname"> First Name </label>
		<input type = "text" id = "fname" name = "fname"> 

		<label for = "lname"> Last Name </label>
		<input type = "text" id = "lname" name = "lname"> 
		</fieldset>
		<br/>
		<input type = "submit" value = "Click Here!" />
	</form>
	<?php
	echo "<pre>";
		if($_GET)
		print_r($_GET);
	echo "</pre>";
	/*

	$stuff = array("Hi", "There");
	for($i=0; $i<count($stuff); $i++)
	{
		echo "I = ", $i, " Value = ", $stuff[$i], "<br/>";
	}
	
	echo "<br/>";
	
	$stuff_KV = array( "name" => "Chuck", "course" => "PHP");
	foreach($stuff_KV as $k=>$v)
	{
		echo "Key= ", $k, " Value= ", $v, "<br/>";
	}

	echo "<br/>";
	
	echo "<pre>";
	print_r($stuff);
	echo "<br/>";
	print_r($stuff_KV);
	echo "</pre>";
	
	echo "<br/>";
	
	echo "<pre>";
	var_dump($stuff);
	echo "<br/>";
	var_dump($stuff_KV);
	echo "</pre>";
	
	echo "<br/>";	
	
	$za = array();
	$za[] = "Hello";
	$za[] = "World";
	$za_KV = array();
	$za_KV["Food"] = "Pizza";
	$za_KV["Movie"] = "MI 4";
	
	foreach($za as $k=>$v)
	{
		echo "Key= ", $k, " Value= ", $v, "<br/>";
	}
	echo "<br/>";	
	foreach($za_KV as $k=>$v)
	{
		echo "Key= ", $k, " Value= ", $v, "<br/>";
	}
	
	$mul_arr = array( "Kerala" => array("Kerala_A" => "Munnar", "Kerala_B" => "Allepy", "Kerala_C" => "Kovalam"),
					  "North India" => array("NI_A" => "Dalhousie", "NI_B" => "Shimla", "NI_C" => "Manali"),
					  "AP" => array("AP_A" => "Vizag", "AP_B" => "Hyderabad", "AP_C" => "Vijayawada")
				);
				
	echo "<br/>";
	
	echo "<pre>";
	print_r($mul_arr);
	echo "<br/>";
	var_dump($mul_arr);
	echo "</pre>";
	
	echo "<br/>";	

	foreach($mul_arr as $k=>$v)
	{	
		echo $k, "<br/>";
		foreach($v as $k_inside=>$v_inside )
			echo "Key Inside = ", $k_inside, " Value Inside = ", $v_inside, "<br/>";
	}	
	
	echo "<br/>";
	
	if(isset($za_KV['Food']))
		echo "Food is present in za_KV<br/>";
	else 
		echo "Food is not present<br/>";
	
	echo isset($za_KV['Mall'])? "Mall is present in  za_KV<br/>" : "Mall isn't present in za_KV<br/>";
	echo count($za_KV), " ", count($mul_arr), "<br/>";
	
	if(is_array($za))
		echo "ZA is an array <br/>";
	
	//Null Coalescing Operator ??
	$output = isset($za_KV['Movie'])?? "Movie isn't present in za_KV";
	echo $output, "<br/>";
	
	echo "Let the SORT begin<br/>";
	echo "1.SORT()<br/>";
	echo "<pre>";
	print_r($za_KV);
	echo "<br/>";
	sort($za_KV);
	echo "<br/>";
	print_r($za_KV);
	echo "</pre>";
	
	echo "<br/>";
	
	echo "2.KSORT()<br/>";
	echo "<pre>";
	print_r($stuff_KV);
	echo "<br/>";
	ksort($stuff_KV);
	echo "<br/>";
	print_r($stuff_KV);
	echo "</pre>";
	
	echo "<br/>";

	echo "3.ASORT()<br/>";
	echo "<pre>";
	print_r($stuff_KV);
	echo "<br/>";
	asort($stuff_KV);
	echo "<br/>";
	print_r($stuff_KV);
	echo "</pre>";
	*/
	?>
</body>

</html>
