<?php
	session_start();
	require_once "pdo.php";

	$salt = 'phpisawesome';

	if (isset($_POST['user_name']) && isset($_POST['password'])) {

		$name =  $_POST["user_name"];
		$password = $_POST["password"];


		if(strlen($name) > 0 && strlen($password) > 0 ){

			$salted = $salt.$password;

			$hashed = hash('md5', $salted);

			$stmt = $pdo->prepare('SELECT user_id, username,password FROM user where username= :un and password= :pw');

			$stmt->execute(array(':un' => $name, ':pw' => $hashed));

			$row = $stmt->fetch(PDO::FETCH_ASSOC);

			if($row != False){
				$_SESSION['username'] = $row['username'];
				$_SESSION['user_id'] = $row['user_id'];
				header("Location: profile.html");
				return;
			}else{
				error_log("msgsent");
				$_SESSION['msg'] = "<p style='color:red;'>Wrong username or password.</p>";
				header("Location: index.html");
				return;
			}



		}else{
			header("Location: index.html");
			return;
		}

	}

?>
