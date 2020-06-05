<?php
// This script is to check if the user is loged in and send message accordingly.

/**
* Class and Function List:
* Function list: -
* Classes list: -
*/

session_start();
if (!isset($_SESSION['username']) || !isset($_SESSION['user_id']))
{
				$_SESSION["msg"] = "<p style='color:red;'>You are not Logged In. Pls log in.</p>";
				echo '0';
}
else
{
				$session_data = array(
								'username'  => $_SESSION['username'],
								'user_id'   => $_SESSION['user_id']
				);
				$data   	  = json_encode($session_data);

				echo $data;
}
?>
