<?php
	session_start();
	require_once "pdo.php"; 
	require_once "get_username.php"; 

	$user_id = $_SESSION['user_id'];

	$stmt = $pdo->prepare("SELECT * FROM friend WHERE frnd_1 = :uid1 OR frnd_2 = :uid2 ;");

	$stmt->execute(array(
		':uid1' => $user_id,
		':uid2' => $user_id
	));

	$friends = array();

	$row = $stmt->fetchAll(PDO::FETCH_ASSOC);

	if($row != False){
		foreach ($row as $relation) {
			
			if ($relation['frnd_1'] == $user_id){
				array_push($friends, idtoname($relation['frnd_2'],$pdo));

			}else{
				array_push($friends, idtoname($relation['frnd_1'],$pdo));
			}
		}
	}

	$all_users = array(); 

	$stmt = $pdo->prepare('SELECT user_id FROM user WHERE NOT user_id = :uid');
	$stmt->execute(array(':uid' => $user_id ));

	$row = $stmt->fetchAll(PDO::FETCH_ASSOC);

	foreach ($row as $new_user) {
		array_push($all_users, idtoname($new_user['user_id'],$pdo));
	}

	$not_friends = array_diff($all_users, $friends);

	$stmt = $pdo->prepare('SELECT * FROM request WHERE sender = :uid');
	$stmt->execute(array(
		'uid' => $user_id
	));

	$row = $stmt->fetchAll(PDO::FETCH_ASSOC);

	$requested = array();

	foreach ($row as $req) {
		array_push($requested, idtoname($req['reciever'],$pdo));
	}

	$raw_data = array();

	$raw_data['friends'] = $friends;
	$raw_data['not_friends'] = $not_friends;
	$raw_data['request_status'] = array();
	foreach ($not_friends as $not_friend) {
		if (in_array($not_friend, $requested)) {
			$raw_data['request_status'][$not_friend] = 0;
		}else{
			$raw_data['request_status'][$not_friend] = 1;
		}
	}

	$data = json_encode($raw_data);
	echo $data;
?>