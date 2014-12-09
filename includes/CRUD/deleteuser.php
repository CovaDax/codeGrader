<?php
	$urlid = $_GET['id'];

	include('../database.php');

	$query = mysql_query("DELETE FROM submission_user WHERE user_id = '$urlid'");
	$query = mysql_query("DELETE FROM user_course WHERE assignment_id = '$urlid'");
	$query = mysql_query("DELETE FROM user WHERE id = '$urlid'");

	header("Location: ../../index.php");
?>