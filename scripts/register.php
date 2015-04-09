<?php
	include_once '../config.php';

	$courseid = $_POST['courses'];
	$userid = $_GET['id'];

	$db = new Database($config['db']);
	$results = $db->query("SELECT * FROM user_course
							WHERE user_id = '$userid'
								AND course_id = '$courseid'");
	if($results->num_rows < 1 && ($courseid != NULL || $userid != NULL)){
		$db->query("INSERT INTO user_course (user_id, course_id)
						VALUES ('$userid','$courseid')");
	} 

	header("Location:http://" . $root . "/index.php");
?>