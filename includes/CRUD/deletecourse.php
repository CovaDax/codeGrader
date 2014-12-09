<?php
	$urlcrn = $_GET['crn'];

	include('../database.php');

	$query = mysql_query("DELETE FROM user_course WHERE course_id = '$urlcrn'");
	$query = mysql_query("DELETE FROM assignment_course WHERE course_id = '$urlcrn'");
	$query = mysql_query("DELETE FROM course WHERE crn = '$urlcrn'");

	header("Location: ../../index.php");
?>