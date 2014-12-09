<?php
	session_start();
	$postassignmenttitle = $_POST['title'];
	$postdeadlinedate = $_POST['deadlinedate'];
	$postdeadlinetime = $_POST['deadlinetime'];
	$postdescription = $_POST['description'];

	$sessioncrn = $_SESSION['crn'];

	include("../database.php");
	$query = mysql_query("SELECT * FROM assignment WHERE title = '$postassignmenttitle' AND description = '$postdescription'");
	$numrows = mysql_num_rows($query);
	if($numrows < 1){
		$query = mysql_query("INSERT INTO assignment (title, description, deadline) VALUES ('$postassignmenttitle',
																							'$postdescription',
																							'$postdeadlinedate $postdeadlinetime'
																							)");
		$query = mysql_query("SELECT * FROM assignment WHERE title = '$postassignmenttitle' AND description = '$postdescription'");
		$numrows = mysql_num_rows($query);
		echo $numrows;
		if($numrows==1){
			while($row = mysql_fetch_assoc($query)){
				$dbassignmentid = $row['id'];
			}
		}

		$query = mysql_query("INSERT INTO assignment_course (course_id, assignment_id) VALUES ('$sessioncrn', '$dbassignmentid')");

	}
	echo $sessioncrn;
	header("Location:../../index.php);
?>
