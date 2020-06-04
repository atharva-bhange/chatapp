<?php
	
	require_once "pdo.php";

	$salt = 'phpisawesome';

	if (isset($_POST['user_name']) && isset($_POST['pass1']) && isset($_POST['pass2']) ){

		$name =  $_POST["user_name"];
		$pass1 = $_POST["pass1"];
		$pass2 = $_POST["pass2"];


		if(strlen($name) > 0 && strlen($pass1) > 0 && strlen($pass2) && $pass1 == $pass2){

			$salted = $salt.$pass1;

			$hashed = hash('md5', $salted);

			$stmt = $pdo->prepare('INSERT INTO user (username , password) VALUES ( :un, :ps)');

			$stmt->execute(array(
			':un' => $name,
			':ps' => $hashed
			));			
			
			header("Location: index.html");
			return;

		}else{
			header("Location: register.html");
			return;
		}

	}

?>