<?php
	require_once '../config.php';
	$urlid = $_GET['id'];

	$db = new Database($config['db']);

	$results = $db->query("DELETE FROM submission_user WHERE user_id = '$urlid'");
	$results = $db->query("DELETE FROM user_course WHERE assignment_id = '$urlid'");
	$results = $db->query("DELETE FROM user WHERE id = '$urlid'");

	header("Location:http://" . $relative . "/view/allusers.php");
?>