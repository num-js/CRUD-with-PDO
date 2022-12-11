<?php 
	try{
		$conn = new PDO("mysql:host=localhost;dbname=practice_db","root","");
	}catch(PDOExction $e){
		echo $e->getMessage();
	}
?>