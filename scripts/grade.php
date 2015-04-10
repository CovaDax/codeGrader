<?php
	include '../config.php';
	session_start();
	$sessionid = $_GET['id'];
	$grade = $_POST['grade'];
	$sessionassignmentid = $_SESSION['assignmentid'];
	$sessioncrn = $_SESSION['crn'];

	echo $grade;
	echo $sessionid;

	$db = new Database($config['db']);
	$db->query("UPDATE submission SET grade='$grade' WHERE id='$sessionid'");

	header("Location:http://" . $root . "/view/assignment.php?id=".$sessionassignmentid."&crn=".$sessioncrn);
?>