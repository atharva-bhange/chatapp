<?php
	session_start();
	require_once "pdo.php"; 

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
				array_push($friends, $relation['frnd_2']);

			}else{
				array_push($friends, $relation['frnd_1']);
			}
		}

	$all_posts = array();
		
	}
	foreach ($friends as $friend) {
		$stmt2 = $pdo->prepare("SELECT * FROM post WHERE user_id = :ud;");
		$stmt2->execute(array(
			':ud' => $friend
		));
		$row2 = $stmt2->fetchAll(PDO::FETCH_ASSOC);

		foreach ($row2 as $post) {
			array_push($all_posts, $post);
		}

	}

	function date_compare($a, $b){
    $t1 = strtotime($a['date']);
    $t2 = strtotime($b['date']);
    return $t2 = $t1;
	}    

	usort($all_posts, 'date_compare');

	if (count($all_posts) > 20){
		$all_posts = array_slice($all_posts, 0,21);
	}
	
	$final_name = array();
	$final_post = array();

	foreach ($all_posts as $actual_post) {
		$frnd_id = $actual_post["user_id"];
		$frnd_post = $actual_post['post'];

		$stmt3 = $pdo->prepare("SELECT username FROM user WHERE user_id = :ud");
		$stmt3->execute(array(
			':ud' => $frnd_id
		));
		$row3 = $stmt3->fetch(PDO::FETCH_ASSOC);

		$name = $row3['username'];
		array_push($final_name, $name);
		array_push($final_post, $frnd_post);
	}
	
	$raw_data = array($final_name , $final_post);
	$data = json_encode($raw_data);

	echo $data;
?>