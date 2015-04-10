<?php
	include_once '../config.php';
	$urlid = $_GET['id'];

	$db = new Database($config['db']);

	$db->query("DELETE FROM submission_user WHERE user_id = '$urlid'");
	$db->query("DELETE FROM user_course WHERE user_id = '$urlid'");
	$db->query("DELETE FROM user WHERE id = '$urlid'");

	header("Location:http://" . $root . "/view/allusers.php");
?>
