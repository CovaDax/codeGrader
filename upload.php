<?php
	session_start();
	$sessioncrn = $_SESSION['crn'];
	$sessionuser = $_SESSION['firstName'];
	$sessionid = $_SESSION['assignmentid'];

	include('includes/database.php');

	$query = mysql_query("SELECT * FROM assignment WHERE id ='$sessionid'");
	$numrows = mysql_num_rows($query);

	if($numrows!=0){
		while($row = mysql_fetch_assoc($query)){
			$dbassignmentid = $row['id'];
			$dbassignmenttitle = $row['title'];
			$dbassignmentdescription = $row['description'];
			$dbassignmentdeadline = $row['deadline'];
		}
	}

	$directory = "resources/uploads/".$sessioncrn."/".$sessionid."/".$_SESSION['username'];

	include("includes/makedirectory.php");

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
	header("Location:assignment.php?id=" . $sessionid . "&crn=" . $sessioncrn);
?>