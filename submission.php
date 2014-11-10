<?php
	session_start();
	$sessioncrn = $_GET['crn'];
	$sessionuser = $_GET['user'];
	$sessionid = $_GET['id'];
	include('includes/nav.php');

	$directory = "includes/uploads/".$sessioncrn."/".$sessionid."/".$_SESSION['username'];
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


		include('includes/database.php');

		$query = "INSERT INTO submission (files) VALUES ('$directory')";
		mysql_query($query);
			$getid = mysql_query("SELECT id FROM submission WHERE files='$directory");
			echo $getid[0];

		$query = "INSERT INTO submission_user (user_id, submission_id) VALUES '$sessionuser'";
	}


	if(file_exists("includes/codeGrader.java")){
		if(!file_exists("includes/codeGrader.class")){
			echo "Compiling codeGrader".PHP_EOL;
			passthru("javac includes/codeGrader.java 2>&1", $output);
		}
	} else {
		echo "No codeGrader File";
	}
	$runfile = "java -cp includes codeGrader ".$sessioncrn." ".$sessionuser." ".$sessionid." 2>&1";

	echo "<PRE>";
		passthru($runfile, $output);
	echo "</PRE>";

	passthru("rm " . $runfile . ".class");


?>

<HTML>
	<HEAD>
	</HEAD>
	<BODY>
	<form action="upload.php" method="post" enctype="multipart/form-data">
    	Select image to upload:
    	<input type="file" name="fileToUpload" id="fileToUpload">
    	<input type="submit" value="Upload File" name="submit">
	</form>
	</BODY>
</HTML>

