<?php
	require_once '../config.php';

	session_start();
    if(!isset($_SESSION["username"])){
    	if($_SESSION['role']!="ADMIN"){
        	header("Location:http://" . $relative . "/index.php");
        }
    }

	$postassignmenttitle = $_POST['title'];
	$postdeadlinedate = $_POST['deadlinedate'];
	$postdeadlinetime = $_POST['deadlinetime'];
	$postdescription = $_POST['description'];

	$sessioncrn = $_SESSION['crn'];

	//Check if the assignment from POST exists
	$db = new Database($config['db']);
	$sql = "SELECT * FROM assignment WHERE title = '$postassignmenttitle' AND description = '$postdescription'";
	$results = $db->query($sql);
	if($result->num_rows < 1){
		$sql = "INSERT INTO assignment (title, description, deadline) 
						VALUES ('$postassignmenttitle',
								'$postdescription',
								'$postdeadlinedate $postdeadlinetime')";
		$results = $db->query($sql);
		$sql = "SELECT * FROM assignment WHERE title = '$postassignmenttitle' 
										AND description = '$postdescription'";
		$results = $db->query($sql);
		if($results->num_rows == 1){
			while($row = mysql_fetch_assoc($query)){
				$dbassignmentid = $row['id'];
			}
		}

		$sql = "INSERT INTO assignment_course (course_id, assignment_id) 
				VALUES ('$sessioncrn', '$dbassignmentid')";
		$results = $db->query($sql);

	}

	exec("mkdir resources/uploads/" . $sessioncrn . "/" . $dbassignmentid);
	header("Location:http://" . $relative . "/view/course.php?crn=" . $sessioncrn);
?>
