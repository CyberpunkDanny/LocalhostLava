<?php
/*$pdoOld = new PDO('mysql:host=localhost;port=8889;dbname=misc', 
   'fred', 'zap');
 */
$pdo = new PDO('mysql: host=localhost;port=3306;dbname=userDB', 'cyberpunk', 'hello123'); 
 
// See the "errors" folder for details...
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);



