<?php
	session_start();
	require_once "pdo.php"; 
	require_once "get_username.php"; 


	$sender = nametoid($_POST['frnd_name'], $pdo);

	$frnd_1 = $sender;
	$frnd_2 = $_SESSION['user_id'];

	$stmt = $pdo->prepare('SELECT * FROM friend WHERE frnd_1 =:frn1 AND frnd_2 =:frn2');
	$stmt->execute(array(
		':frn1' => $frnd_1,
		':frn2' => $frnd_2
	));

	$rows = $stmt->fetch(PDO::FETCH_ASSOC);

	if($rows != False){
		$rel_id =  $rows['rel_id'];

		$stmt = $pdo->prepare('DELETE FROM friend WHERE rel_id = :rid');
		$stmt->execute(array(
			':rid'=> $rel_id
		));

	}else{
		$stmt = $pdo->prepare('SELECT * FROM friend WHERE frnd_1 =:frn1 AND frnd_2 =:frn2');
		$stmt->execute(array(
			':frn1' => $frnd_2,
			':frn2' => $frnd_1
		));

		$rows = $stmt->fetch(PDO::FETCH_ASSOC);

		if($rows != False){
			$rel_id =  $rows['rel_id'];
			$stmt = $pdo->prepare('DELETE FROM friend WHERE rel_id = :rid');
			$stmt->execute(array(
				':rid'=> $rel_id
			));

		}

	}


?>