<?php

//This script is used to determine if the username is in use on the register page.

/**
* Class and Function List:
* Function list: - 
* Classes list: - 
*/

require_once "pdo.php";

$stmt = $pdo->prepare('SELECT username FROM user ');
$stmt->execute();

$rows                = $stmt->fetchAll(PDO::FETCH_ASSOC);

$registered_username = array();

// We make a list of registered usernames here.

foreach ($rows as $row)
{
                array_push($registered_username, $row['username']);
}

$requested_username = $_REQUEST['username'];

// We make comparisin and respond accordingly.

if (in_array($requested_username, $registered_username))
{
                echo 'false';
}
else
{
                echo 'true';
}
?>
