<?php

// This is a helper script in which two main functions are defined

/**
* Class and Function List:
* Function list:
* - idtoname()
* - nametoid()
* Classes list:
*/


function idtoname($id, $pdo)
{
	/**
	Use: This function takes user id of a user and fetchs the user name of the user  
	Input: id :- Id of the registered user
		   database connection :- THe variable which stores connection to database.
	Return: username corresponding to user id
	**/

				$stmt = $pdo->prepare('SELECT * FROM user');
				$stmt->execute();

				$row  = $stmt->fetchAll(PDO::FETCH_ASSOC);

				$info = array();

				foreach ($row as $us)
				{
								$info[$us["user_id"]]      = $us['username'];
				}

				return $info[$id];
}

function nametoid($name, $pdo)
{
	/**
	Use: This function takes user name of a user and fetchs the user id of the user  
	Input: name :- user name of the registered user
		   database connection :- THe variable which stores connection to database.
	Return: userid corresponding to user name
	**/

				$stmt = $pdo->prepare('SELECT * FROM user');
				$stmt->execute();

				$row  = $stmt->fetchAll(PDO::FETCH_ASSOC);

				$info = array();

				foreach ($row as $us)
				{
								$info[$us["username"]]      = $us['user_id'];
				}

				return $info[$name];

}
?>
