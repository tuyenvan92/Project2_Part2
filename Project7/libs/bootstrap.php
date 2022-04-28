<?php
	$baseUrl = "http://".$_SERVER['HTTP_HOST']."/eProject";

	

	require("Model.class.php");
	require("Func.class.php");
	require("xtemplate.class.php");

	
	$dbName = 'eyeonic';
	$user = 'root';
	$pass = '';
	
	
	$db = new Model($user,$pass,$dbName);
	$function = new Func;
?>
