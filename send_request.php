<?php
	session_start();
	require_once "pdo.php"; 
	require_once "get_username.php";

	$name = $_POST['req_name'];

	$sender = $_SESSION['user_id'];
	$receiver = nametoid($name,$pdo);

	$stmt = $pdo->prepare('INSERT INTO request (sender , reciever) VALUES ( :sn, :rs)');

	$stmt->execute(array(
		':sn' => $sender,
		':rs' => $receiver
	));

?>