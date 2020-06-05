<?

// THis script is use to register new user

/**
* Class and Function List:
* Function list:
* Classes list:
*/

require_once "pdo.php";

$salt   = 'phpisawesome';

if (isset($_POST['username']) && isset($_POST['pass1']) && isset($_POST['pass2']))
{

				$name   = htmlentities($_POST["username"]);
				$pass1  = htmlentities($_POST["pass1"]);
				$pass2  = htmlentities($_POST["pass2"]);

				if (strlen($name) > 0 && strlen($pass1) > 0 && strlen($pass2) && $pass1 == $pass2)
				{
								// Salting and hashing
								$salted = $salt . $pass1;

								$hashed = hash('md5', $salted);

								$stmt   = $pdo->prepare('INSERT INTO user (username , password) VALUES ( :un, :ps)');

								$stmt->execute(array(
												':un' => $name,
												':ps' => $hashed
								));

								header("Location: index.html");
								return;

				}
				else
				{
								header("Location: register.html");
								return;
				}

}

?>
