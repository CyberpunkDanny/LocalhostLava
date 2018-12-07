<?php ?><html>

<head>

<title>Auto-Refresh DIV</title>

</head>

<body>

<div id="one">One</div>

<div id="auto"></div>

<div id="three">Three</div>

<script
  src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
  integrity="sha256-3edrmyuQ0w65f8gfBsqowzjJe2iM6n0nKciPUp8y+7E="
  crossorigin="anonymous"></script>

<script type="text/javascript">

$(document).ready( function(){

$('#auto').load('test.php');
console.log("Loading test");

refresh();

});

function refresh()

{
console.log("Loading test");
                setTimeout( function() {

                  $('#auto').fadeOut('slow').load('test.php').fadeIn('slow');

                  refresh();

                }, 2000);

}

</script>

</body>

</html>