<?php
	require_once '../config.php';
	$urlid = $_GET['id'];

	$db = new Database($config['db']);

	$results = $db->query("SELECT * FROM user WHERE id = '$urlid'");
	if($results->num_rows > 0){
		while($row = $results->fetch_assoc()){
			echo var_dump($row);
		}
	}

	$db->query("DELETE FROM submission_user WHERE user_id = '$urlid'");
	$db->query("DELETE FROM user_course WHERE user_id = '$urlid'");
	$db->query("DELETE FROM user WHERE id = '$urlid'");

	header("Location:http://" . $relative . "/view/allusers.php");
?>