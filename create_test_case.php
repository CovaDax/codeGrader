<?php
	session_start();
	$crn = $_SESSION['crn'];
	$assignmentid = $_SESSION['assignmentid'];

	$testcases = $_POST['testcase'];

	//crn/assignmentid/file
	$file = "resources/uploads/$crn/$assignmentid/testcases.txt";

	// Open the file to get existing content
	$current = file_get_contents($file);
	// Write the contents back to the file
	file_put_contents($file, $testcases);

	header("Location:assignment.php?id=$assignmentid&crn=$crn");
?>