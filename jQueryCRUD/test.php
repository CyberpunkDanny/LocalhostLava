<?php
	require_once "pdo.php";
	session_start();
?>

<html lang="en">

<head>
	<title>Divyateja Chepuru | Index</title>
	<meta charset="utf-8">
	
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">
	
	<script src="https://code.jquery.com/jquery-3.2.1.js" integrity="sha256-DZAnKJ/6XZ9si04Hgrsxu/8s717jcIzLy3oi35EouyE=" crossorigin="anonymous"></script>
	<script type="text/javascript">
		var count=0;

		$(document).ready(function(){
			$('#addPos').click(function(event){
			event.preventDefault();
				count++;
				console.log("Value of Count inside jQuery AddPos Func ::: "+count);
				var div = '<div id="positionDiv'+count+'"></div>';
				$('#posDiv').append(div);
				var year = '<label>Year </label> <input type="text" name="AddProfYear'+count+'" id="AddProfYear'+count+'"/> ';
				var removeButton = '<span id="removePos'+count+'"><button class="btn btn-default btn-sm">-</button></span><br/>';
				var desc = '<label>Description</label> <br/><textarea name="AddProfDesc'+count+'" id="AddProfDesc'+count+'" rows="8" cols="82"></textarea><br/>';
				$('#positionDiv'+count).append(year, removeButton, desc);
				console.log("AddProfYear"+count);
				//console.dir(document.getElementById("AddProfYear"+count));
				//console.dir(document.getElementById("AddProfDesc"+count));
				$('#posDiv').append(div, year, removeButton, desc, divEnd);
				//debugger;
			});
			$("#removePos").click(function(){
				$('positionDiv1').remove();
			});/*for(i=1; i<=count; i++)
			{
				$('#removePos'+i).click(function(event){
					event.preventDefault();
					console.log("removePos"+i);
					$('positionDiv'+i).remove();
					//count--;
					//console.log("Value of Count inside jQuery removePos Func ::: "+count);
					
				});
			}*/
		});
	
	</script>
</head>

<body>
	<div class="container">
		<label>Position</label> <span id="addPos"><button class="btn btn-default btn-sm">+</button></span><br/><br/>
		<div id="posDiv"></div>
	</div>
</body>

</html>