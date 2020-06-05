<?php
	

	function idtoname($id, $pdo){

		$stmt = $pdo->prepare('SELECT * FROM user');
		$stmt->execute();

		$row = $stmt->fetchAll(PDO::FETCH_ASSOC);

		$info = array();

		foreach ($row as $us) {
			$info[$us["user_id"]] = $us['username'];
		}
	
		return $info[$id];
	}

	function nametoid($name , $pdo){

		$stmt = $pdo->prepare('SELECT * FROM user');
		$stmt->execute();

		$row = $stmt->fetchAll(PDO::FETCH_ASSOC);

		$info = array();

		foreach ($row as $us) {
			$info[$us["username"]] = $us['user_id'];
		}
	
		return $info[$name];		

	}
?>