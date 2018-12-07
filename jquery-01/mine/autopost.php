<?php ?>
<html lang="en">
<head>
	<title>Gorgeous jQuery</title>
	<meta charset="utf8" />
</head>
<body>

	<form id="target" method="post">
		<p><input type="text" name="one" value="Hello there"/>
		<img id="spinner" src="spinner.gif" height="25" style="vertical-align: middle; display:none;"/></p>
	</form>
	<hr/>
	<div id="result"></div>
	<hr/>
	
	<script type="text/javascript" src="../../jquery.min.js">
	</script>	

	<script type="text/javascript">
		$('#target').change(function(event){
			$('#spinner').show();
			//var form = $('#target');
			var txt = $('#target').find('input[name="one"]').val();
			//$.post().error() takes 3 parameters in post() 
			window.console && console.log('Sending POST');
			$.post('autoecho.php',{'val':txt}, 
			function(data){
				window.console && console.log(data);
				$('#result').empty().append(data);
				$('#spinner').hide();
			}
			).error(function(){
				$('#target').css('background-color','red');
				alert("Bamm!!!");
			});
		});
	</script>	
</body>

</html>
