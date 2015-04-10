<?php
	include_once '../config.php';
	
	if($_SESSION['role']!="ADMIN"){
		header("Location:http://" . $relative . "/index.php");
	}

	$id = $_GET['id'];
	$crn = $_GET['crn'];

	$db = new Database($config['db']);
	delete_assignment($db, $crn, $id);
?>