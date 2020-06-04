<?php
	error_log("errors.php opened");
	session_start();
	if (isset($_SESSION['msg'])) {
		error_log("msg recienved");
		echo $_SESSION['msg'];
		unset($_SESSION['msg']);
	}
	
?>