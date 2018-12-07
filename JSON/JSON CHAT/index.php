<?php
	if(isset($_POST["chatMsg"]))
	{
		$_POST["chatMsg"] = $_SESSION["message"];
	}
	if(isset($_POST[""]))
?>
<html>

<head>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.2.1.js" integrity="sha256-DZAnKJ/6XZ9si04Hgrsxu/8s717jcIzLy3oi35EouyE=" crossorigin="anonymous"></script>
<head/>

<body>
	<h2></h2>
	<div class="container">
	<form method="post">
		<input type="textbox" name="chatMsg" id="chatMsg" value=""/>
		<input type="submit" value="Send" id="sendButton" />
		<input type="submit" value="Reset" id="resetButton" />
	</form>
	<div id="spinner"></div>
	<img src="spinner.gif" id="spinner" />
	</div>
	<script type="text/javascript">
		$(document).ready(function(){
				$("#sendButton").onclick(function(event){
					event.preventDefault();
					$.post("json.php",function(data){
						console.log(data);
						$("#spinner").hide();
						for(i=0; i<data.length; i++)
							$("#content").html(data.i);
					}).error();
				})
		});
	</script>
</body>
</html>