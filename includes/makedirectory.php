<?php
	#session_start();
	#$sessioncrn = $_SESSION['crn'];
	#$sessionid = $_SESSION['assignmentid'];
	$sessionuserid = $_SESSION['userid'];

	$directory = "resources/uploads/".$sessioncrn."/".$sessionid."/".$_SESSION['username'];

	echo $directory . "</BR>";

	//include('database.php');

	if(!file_exists($directory)){
		if(!mkdir($directory, 0777, true)){
			die("failed to create folders");
		} else {
			chmod("includes/",0777);
			chmod("includes/uploads", 0777);
			chmod("includes/uploads/".$sessioncrn,0777);
			chmod("includes/uploads/".$sessioncrn."/".$sessionid,0777);
			chmod("includes/uploads/".$sessioncrn."/".$sessionid."/".$_SESSION['username'],0777);
		}
	}
		$query = mysql_query("SELECT * FROM submission WHERE files = '$directory'");
		$numrows = mysql_num_rows($query);
		if($numrows < 1){
			$query = mysql_query("INSERT INTO submission (files) VALUES ('$directory')");
		} 


		$getid = mysql_query("SELECT * FROM submission WHERE files='$directory'");
		$numrows = mysql_num_rows($getid);
		if($numrows!=0){
			while($row = mysql_fetch_assoc($getid)){
				$dbsubmissionid = $row['id'];
			}
		}

		$query = mysql_query("SELECT * FROM submission_user WHERE user_id = '$sessionuserid' AND submission_id = '$dbsubmissionid'");
		$numrows = mysql_num_rows($query);
		if($numrows < 1){
			$query = mysql_query("INSERT INTO submission_user (user_id, submission_id) VALUES ('$sessionuserid','$dbsubmissionid')");
		} 

		$UserAssignmentID = mysql_query("SELECT id FROM assignment_submission WHERE assignment_id = '$sessionid' AND submission_id = '$dbsubmissionid'");
		$numrows = mysql_num_rows($UserAssignmentID);
		if($numrows < 1){
			$query = mysql_query("INSERT INTO assignment_submission (assignment_id, submission_id) VALUES ('$sessionid','$dbsubmissionid')");
		} 
	
?>