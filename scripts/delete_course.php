<?php
	
	include_once '../config.php';

  	session_start(); 
	if($_SESSION['role']!="ADMIN"){
		header("Location:http://" . $relative . "/index.php");
	}

	$crn = $_GET['crn'];
	$db = new Database($config['db']);
	delete_course($db, $crn);
	// function __AUTOLOAD($class_name){
	// 	include_once(ROOT_PATH . "/models/" . $class_name . ".php");
	// }

	// $urlcrn = $_GET['crn'];

	// $db = new Database($config['db']);

	// $db->query("DELETE FROM user_course WHERE course_id = '$urlcrn'");
	// $db->query("DELETE FROM assignment_course WHERE course_id = '$urlcrn'");
	// $db->query("DELETE FROM course WHERE crn = '$urlcrn'");

	header("Location:http://" . $relative . "/index.php");
?>