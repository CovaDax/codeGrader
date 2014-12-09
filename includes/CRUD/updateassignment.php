<?php
	session_start();
	$postassignmenttitle = $_POST['title'];
	$postdeadlinedate = $_POST['deadlinedate'];
	$postdeadlinetime = $_POST['deadlinetime'];
	$postdescription = $_POST['description'];

	$sessionassignmentid = $_SESSION['assignmentid'];
	$sessioncrn = $_SESSION['crn'];
	$deadline = $postdeadlinedate . " " . $postdeadlinetime;

	include("../database.php");
	$query = mysql_query("UPDATE assignment 
        					SET title = '$postassignmenttitle', 
        						deadline = '$deadline', 
        						description = '$postdescription'
        					WHERE id = '$sessionassignmentid'");
	$numrows = mysql_num_rows($query);
	header("Location:../../course.php?crn=".$sessioncrn);
?>