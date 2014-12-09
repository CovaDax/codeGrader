<?php
	session_start();
	$sessionid = $_GET['id'];
	$grade = $_POST['grade'];

	echo $grade;
	echo $sessionid;

	include("includes/database.php");
	$query = mysql_query("UPDATE submission SET grade='$grade' WHERE id='$sessionid'");

	header("Location:index.php");

?>