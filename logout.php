<?php

// This script is used to kill a user session and hence logout

/**
* Class and Function List:
* Function list:
* Classes list:
*/
session_start();
if (isset($_SESSION['username']) || isset($_SESSION['user_id']))
{
				unset($_SESSION['username']);
				unset($_SESSION['user_id']);
				header("Location: index.html");
				return;
}

?>
