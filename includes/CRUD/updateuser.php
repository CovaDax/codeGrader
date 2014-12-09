<?php
	session_start();
	//$postid = $_POST['id'];
	$postusername = $_POST['username'];
	$postpassword = $_POST['password'];
	$postfirstName = $_POST['firstName'];
	$postlastName = $_POST['lastName'];
	$postemail = $_POST['email'];
	$postrole = $_POST['role'];
	echo $currentuser;
	$currentuser = $_SESSION['currentuser'];

	include("../database.php");
	$query = mysql_query("UPDATE user
        					SET username = '$postusername',
        						firstName = '$postfirstName', 
        						lastName = '$postlastName', 
        						email = '$postemail', 
        						role = '$postrole'
        					WHERE id = '$currentuser'");
	$numrows = mysql_num_rows($query);
	header("Location:../../index.php");
?>