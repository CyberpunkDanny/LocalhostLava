<html>
<head>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.2.1.js" integrity="sha256-DZAnKJ/6XZ9si04Hgrsxu/8s717jcIzLy3oi35EouyE=" crossorigin="anonymous"></script>


<head/>
<body>
	<p id="back"></p>
	<script type="text/javascript">
		who = {	
				"name":"Chuck",
				"age":29,
				"student": true,
				"offices" : ['NHQ', 'B4'],
				"skills" : {
					"C":10,
					"PHP":10,
					"JS":9
				}
		};
		console.log(who);
		document.getElementById("back").innerHTML = JSON.stringify(who, null, 4);//age;

	$(document).ready(function(){
		$.getJSON("json.php", function(data){
			$("#back").html(data.first);
			console.log(data.first);
		})
		
		//Sleep function
		var a = 3;
		var b;
		setTimeout(function() {
			b = a + 4;
			}, (3 * 1000)
			);
			
		$.getJSON("json.php", function(data){
			$("#back").html(data.last);
			console.log(data.last);
		})
	});
	</script>
</body>
