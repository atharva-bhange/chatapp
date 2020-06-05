<?php
	session_start();
	require_once "pdo.php"; 
	require_once "get_username.php"; 

	$user_id = $_SESSION['user_id'];

	$stmt = $pdo->prepare('SELECT * FROM request WHERE reciever = :rs');
	$stmt->execute(array(
		':rs' => $user_id
	));

	$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

	$senders = array();

	foreach ($rows as $row) {
		array_push($senders, idtoname($row['sender'],$pdo));
	}

	$data = json_encode($senders);
	echo $data;


?>