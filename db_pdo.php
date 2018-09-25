<?php

require('conf.php');

go_home();

// PDO 
try {
	$conn = new PDO("mysql:host=$server;dbname=test",$user,$pass);
	$conn -> setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
	echo "<p>PDO ühendus on olemas</p>";
}

catch(PDOException $err) {
	echo "PDO'ga halvasti:".$err -> getMessage();
}

$conn = null;

?>