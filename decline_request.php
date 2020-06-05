<?php

// This script is used to remove the record in the 
//friend request if a user declines a friend request

/**
* Class and Function List:
* Function list: nametoid()
* Classes list:
*/

session_start();
require_once "pdo.php";
require_once "get_username.php";

$sender = nametoid($_POST['sen_name'], $pdo);

$frnd_1 = $sender;
$frnd_2 = $_SESSION['user_id'];

$stmt   = $pdo->prepare('DELETE FROM request WHERE sender = :sn ');
$stmt->execute(array(
				':sn' => $sender
));

?>
