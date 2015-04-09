<?php	
	include_once '../config.php';

  	session_start(); 
	if($_SESSION['role']!="ADMIN"){
		header("Location:http://" . $relative . "/index.php");
	}

	$postid = $_POST['id'];
	$postusername = $_POST['username'];
	$postpassword = $_POST['password'];
	$postfirstName = $_POST['firstName'];
	$postlastName = $_POST['lastName'];
	$postemail = $_POST['email'];
	$postrole = $_POST['role'];

	$db = new Database($config['db']);

	$results = $db->query("SELECT * FROM user WHERE id = '$postid'");
	if($results->num_rows < 1){
		$db->query("INSERT INTO user (id, firstName, lastName, username, password, email, role) VALUES 
											   ('$postid', 
											   	'$postfirstName', 
											   	'$postlastName', 
											   	'$postusername', 
											   	'$postpassword', 
											   	'$postemail', 
											   	'$postrole')");
	}
	header("Location:http://" . $relative. "/index.php");
?>
