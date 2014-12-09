<?php
	session_start();
	$posttitle = $_POST['title'];
	$postcrn = $_POST['crn'];
	$postdepartment = $_POST['department'];
	$postsection = $_POST['section'];

	include("../database.php");
	$query = mysql_query("SELECT * FROM course WHERE crn = '$postcrn'");
	$numrows = mysql_num_rows($query);
	if($numrows < 1){
		$query = mysql_query("INSERT INTO course (crn, title, department, section) VALUES ('$postcrn',
																							'$posttitle',
																							'$postdepartment',
																							'$postsection'
																							)");
	}
	header("Location:../../course.php?crn=".$postcrn);
?>
