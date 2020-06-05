<?php

// This script is used to load or the friend data corresponding to logged in user.

/**
* Class and Function List:
* Function list:
idtoname()
* Classes list:
*/


session_start();
require_once "pdo.php";
require_once "get_username.php";

$user_id = $_SESSION['user_id'];

$stmt    = $pdo->prepare("SELECT * FROM friend WHERE frnd_1 = :uid1 OR frnd_2 = :uid2 ;");

$stmt->execute(array(
				':uid1'         => $user_id,
				':uid2'         => $user_id
));

$friends = array();

$row     = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Here we are finding all the friends corresponding to logged in user and storing in friends array

if ($row != False)
{
				foreach ($row as $relation)
				{

								if ($relation['frnd_1'] == $user_id)
								{
												array_push($friends, idtoname($relation['frnd_2'], $pdo));

								}
								else
								{
												array_push($friends, idtoname($relation['frnd_1'], $pdo));
								}
				}
}

// Here we are selecting all users which are not logged in user and storing them in all user

$all_users = array();

$stmt      = $pdo->prepare('SELECT user_id FROM user WHERE NOT user_id = :uid');
$stmt->execute(array(
				':uid'     => $user_id
));

$row = $stmt->fetchAll(PDO::FETCH_ASSOC);

foreach ($row as $new_user)
{
				array_push($all_users, idtoname($new_user['user_id'], $pdo));
}

// Here we are subtracting friends from all user to find not_friends users

$not_friends = array_diff($all_users, $friends);

// Here we are finding if the logged in user has sent friend request to not_friends users and toring the users in requested array

$stmt        = $pdo->prepare('SELECT * FROM request WHERE sender = :uid');
$stmt->execute(array(
				'uid'           => $user_id
));

$row       = $stmt->fetchAll(PDO::FETCH_ASSOC);

$requested = array();

foreach ($row as $req)
{
				array_push($requested, idtoname($req['reciever'], $pdo));
}

// Here we are sending all the data to js script but for not_friend we are sending information if the logged in user has sent a friend request to not sent user.

$raw_data = array();

$raw_data['friends']          = $friends;
$raw_data['not_friends']          = $not_friends;
$raw_data['request_status']          = array();
foreach ($not_friends as $not_friend)
{
				if (in_array($not_friend, $requested))
				{
								$raw_data['request_status'][$not_friend]          = 0;
				}
				else
				{
								$raw_data['request_status'][$not_friend]          = 1;
				}
}

$data     = json_encode($raw_data);
echo $data;
?>
