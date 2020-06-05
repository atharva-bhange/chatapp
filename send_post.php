<?php

	session_start();
	require_once "pdo.php";

	$text = $_POST['text'];
	$text = htmlentities($text);

	$stmt = $pdo->prepare("INSERT INTO post (user_id , post) VALUES ( :uid, :ps)");
	$stmt->execute(array(
		':uid' => $_SESSION['user_id'] ,
		':ps' => $text
	));

	echo '1';

?>