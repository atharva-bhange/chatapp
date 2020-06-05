<?php
	session_start();
	require_once "pdo.php"; 
	require_once "get_username.php"; 

	$sender = nametoid($_POST['sen_name'], $pdo);

	$frnd_1 = $sender;
	$frnd_2 = $_SESSION['user_id'];

	$stmt = $pdo->prepare('DELETE FROM request WHERE sender = :sn ');
	$stmt->execute(array(
		':sn' => $sender
	));

	$stmt = $pdo->prepare('INSERT INTO friend (frnd_1 , frnd_2) VALUES ( :fr1, :fr2)');
	$stmt->execute(array(
		':fr1' => $frnd_1,
		':fr2' => $frnd_2
	));

	echo(1);
 
?>