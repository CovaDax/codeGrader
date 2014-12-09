<?php
	$urlcrn = $_GET['crn'];
	$urlassignmentid = $_GET['id'];

	echo $urlcrn . "</BR>";
	echo $urlassignmentid;

	include('../database.php');

	$query = mysql_query("DELETE FROM assignment_submission WHERE assignment_id = '$urlassignmentid'");
	$query = mysql_query("DELETE FROM assignment_course WHERE assignment_id = '$urlassignmentid'");
	$query = mysql_query("DELETE FROM assignment WHERE id = '$urlassignmentid'");

	header("Location: ../../course.php?crn=$urlcrn");
?>