<?php
	include "../config.php";
	//require_once ROOT_PATH . "/scripts/"

	session_start();
    if(!isset($_SESSION["username"])){
        header("Location:http://" . $relative . "/index.php");
    }

    $crn = $_SESSION['crn'];
    $id = $_SESSION['assignmentid'];

	$testcases = $_POST['testcase'];
	$dir = ROOT_PATH . "/uploads/$crn/$assignmentid";
	$file = ROOT_PATH . "/uploads/$crn/$assignmentid/testcases.txt";
	echo "<PRE>";
	echo $dir . "\n";
	echo $file . "\n";
	// if(!file_exists($dir)){
	// 	if(!mkdir($dir, 0777, true)){
	// 		die("failed to create folders");
	// 	} else {
	// 		echo "no works";
	// 	}
	// } else {
	// 	die "could not find " . $dir;
	// }

	 	// Open the file to get existing content
	//$current = file_get_contents($file);
		// Write the contents back to the file
	//file_put_contents($file, $testcases);
	//exec("chmod 777 " . $file);

	// 	echo "Location:http://" . $relative . "/view/assignment.php?id=$_SESSION['assignmentid']&crn=$_SESSION['crn']";
	echo "test";
?>