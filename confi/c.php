<?php

	$hostname =  'localhost';
	$username = '';
	$pass = '';
	$dbname = 'mybe';


	try{

		$conn = new PDO('mysql:host='.$hostname.';dbname='.$dbname,$username,$pass);

	}catch(PDOException $e){
		echo $e->getMessage();
	}


?>