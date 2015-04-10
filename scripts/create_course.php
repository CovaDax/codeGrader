<?php
	include_once '../config.php';

  	session_start(); 
	if($_SESSION['role']!="ADMIN"){
		header("Location:http://" . $root . "/index.php");
	}

	$posttitle = $_POST['title'];
	$postcrn = $_POST['crn'];
	$postdepartment = $_POST['department'];
	$postsection = $_POST['section'];

	$db = new Database($config['db']);
	$results = $db->query("SELECT * FROM course WHERE crn = '$postcrn'");;
	if($results->num_rows < 1){
		$results = $db->query("INSERT INTO course (crn, title, department, section) 
									VALUES ('$postcrn',	'$posttitle','$postdepartment','$postsection')") 
					or die("INSERT did not work");
		mkdir(ROOT_PATH . "/uploads/" . $postcrn, 0775) or die("Could not make directory" . $postcrn . "wat");
	}
	//exec("mkdir resources/uploads/" . $sessioncrn);
	header("Location:http://" . $relative . "/view/course.php?crn='".$postcrn."'");
?>
