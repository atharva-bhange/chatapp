<?php
// This script is run when user acepts a friend request and adds data to database.

/**
* Class and Function List:
* Function list: -
* Classes list: -
*/

session_start();
require_once "pdo.php";
require_once "get_username.php";

$sender = nametoid($_POST['sen_name'], $pdo);

$frnd_1 = $sender;
$frnd_2 = $_SESSION['user_id'];

// We are deleting the record in friend request table

$stmt   = $pdo->prepare('DELETE FROM request WHERE sender = :sn ');
$stmt->execute(array(
				':sn'      => $sender
));

// We are making a record in the friend table

$stmt = $pdo->prepare('INSERT INTO friend (frnd_1 , frnd_2) VALUES ( :fr1, :fr2)');
$stmt->execute(array(
				':fr1' => $frnd_1,
				':fr2' => $frnd_2
));

echo (1);

?>
