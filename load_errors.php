<?php
// This script is used to load errors in the session

/**
* Class and Function List:
* Function list:
* Classes list:
*/
session_start();
if (isset($_SESSION['msg']))
{
				error_log("msg recienved");
				echo $_SESSION['msg'];
				unset($_SESSION['msg']);
}

?>
