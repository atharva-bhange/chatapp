<?php
// This script stores the database connection 

/**
* Class and Function List:
* Function list:
* Classes list:
*/
$pdo = new PDO('mysql:host=localhost;port=3307;dbname=chatapp', 'root', '');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

?>
