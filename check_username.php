<?php
    require_once "pdo.php";

    $stmt = $pdo->prepare('SELECT username FROM user ');
    $stmt->execute();

    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $registered_username = array();

    foreach ($rows as $row) {
        array_push($registered_username, $row['username']);
    }


    $requested_username  = $_REQUEST['username'];

    if( in_array($requested_username, $registered_username) ){
        echo 'false';
    }
    else{
        echo 'true';
    }
?>