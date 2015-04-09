<?php
	include_once "../config.php";
	session_start();
	$sessioncrn = $_SESSION['crn'];
	$sessionuser = $_SESSION['firstName'];
	$sessionuserid = $_SESSION['userid'];
	$sessionid = $_SESSION['assignmentid'];

	$db = new Database($config['db']);
	$results = $db->query("SELECT * FROM assignment WHERE id ='$sessionid'");

	if($results->num_rows!=0){
		while($row = $results->fetch_assoc()){
			$dbassignmentid = $row['id'];
			$dbassignmenttitle = $row['title'];
			$dbassignmentdescription = $row['description'];
			$dbassignmentdeadline = $row['deadline'];
		}
	}

	$directory = "uploads/".$sessioncrn."/".$dbassignmentid."/".$_SESSION['username'];
	echo $directory;
	if(!file_exists(ROOT_PATH . "/" . $directory)){
		if(!mkdir(ROOT_PATH . "/" . $directory, 0775, true)){
			die("failed to create folders");
		} else {

		}
	}


	//Check if directory is in DB
		//if it is

		//if its not
			//add directory
			//link relation tables

	$submissions[] = array();
	$results = $db->query("SELECT * FROM submission WHERE files = '$directory'");
	if($results->num_rows == 0){
		echo "TEST";
		$db->query("INSERT INTO submission (files) VALUES ('$directory')");
		$results2 = $db->query("SELECT * FROM submission WHERE files = '$directory'");
		if($results2->num_rows > 0){
			while($row = $results2->fetch_assoc()){
				echo $row['id'];	
				$db->query("INSERT INTO assignment_submission (assignment_id, submission_id)
								VALUES ('" . $dbassignmentid . "', '" . $row['id'] . "')");
				$db->query("INSERT INTO submission_user (user_id, submission_id)
								VALUES ('" . $sessionuserid . "', '" . $row['id'] . "')");
			}
		}
	}

	$target_file = $directory . "/" .basename($_FILES["fileToUpload"]["name"]);
	$uploadOk = 1;
	$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

	// Check file size
	if ($_FILES["fileToUpload"]["size"] > 500000) {
	    echo "Sorry, your file is too large.";
	    $uploadOk = 0;
	}

	// Allow certain file formats
	if($imageFileType != "java" && $imageFileType != "zip" && $imageFileType != "rar" && $imageFileType != "pdf" ) {
	    echo "Sorry, only java, zip, rar or pdf files are allowed.";
	    $uploadOk = 0;
	}


	// Check if $uploadOk is set to 0 by an error
	if ($uploadOk == 0) {
	    echo "Sorry, your file was not uploaded.";
	// if everything is ok, try to upload file
	} else {
	    if (move_uploaded_file($_FILES["fileToUpload"]['tmp_name'], $target_file)) {
	        echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
	    } else {
	        echo "Sorry, there was an error uploading your file.";
	    }
	}

	//echo "<a href='assignment.php?id=" . $sessionid . "&crn=" . $sessioncrn . "' onclick=" . return confirm('Are you sure?') . ">My Link</a>";
	header("Location:../view/assignment.php?id=" . $sessionid . "&crn=" . $sessioncrn);
?>