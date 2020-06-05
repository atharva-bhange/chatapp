<?php

// This script is called when a user tries to login 

/**
* Class and Function List:
* Function list:
* Classes list:
*/
session_start();
require_once "pdo.php";


// This the salt we are going to use to hash password
$salt     = 'phpisawesome';

if (isset($_POST['user_name']) && isset($_POST['password']))
{

				$name     = $_POST["user_name"];
				$password = $_POST["password"];
				//server side validation

				if (strlen($name) > 0 && strlen($password) > 0)
				{

								$salted   = $salt . $password;
								// password gets hashed
								$hashed   = hash('md5', $salted);

								$stmt     = $pdo->prepare('SELECT user_id, username,password FROM user where username= :un and password= :pw');

								$stmt->execute(array(
												':un'     => $name,
												':pw'     => $hashed
								));

								$row = $stmt->fetch(PDO::FETCH_ASSOC);

								// We try to find if the hash is present in the database
								// Then we are setting session data accordingly.

								if ($row != False)
								{
												$_SESSION['username']     = $row['username'];
												$_SESSION['user_id']     = $row['user_id'];
												header("Location: profile.html");
												return;
								}
								else
								{
												error_log("msgsent");
												$_SESSION['msg'] = "<p style='color:red;'>Wrong username or password.</p>";
												header("Location: index.html");
												return;
								}

				}
				else
				{
								header("Location: index.html");
								return;
				}

}

?>
