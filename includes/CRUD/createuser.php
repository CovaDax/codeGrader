<?php
	session_start();
	$postid = $_POST['id'];
	$postusername = $_POST['username'];
	$postpassword = $_POST['password'];
	$postfirstName = $_POST['firstName'];
	$postlastName = $_POST['lastName'];
	$postemail = $_POST['email'];
	$postrole = $_POST['role'];

	include("../database.php");
	$query = mysql_query("SELECT * FROM user WHERE id = '$postid'");
	$numrows = mysql_num_rows($query);
	if($numrows < 1){
		$query = mysql_query("INSERT INTO user (id, firstName, lastName, username, password, email, role) VALUES 
											   ('$postid', 
											   	'$postfirstName', 
											   	'$postlastName', 
											   	'$postusername', 
											   	'$postpassword', 
											   	'$postemail', 
											   	'$postrole')");
	}
	header("Location:../../index.php");
?>
