<?php
	require_once '../config.php';

	session_start();
    if(!isset($_SESSION["username"])){
    	if($_SESSION['role']!="ADMIN" || $_SESSION['role']!="INSTRUCTOR"){
        	header("Location:http://" . $relative . "/index.php");
        }
        header("Location:http://" . $relative . "/index.php");
    }

	$postassignmenttitle = $_POST['title'];
	$postdeadlinedate = $_POST['deadlinedate'];
	$postdeadlinetime = $_POST['deadlinetime'];
	$postdescription = $_POST['description'];

	$sessioncrn = $_SESSION['crn'];

	//Check if the assignment from POST exists
	$db = new Database($config['db']);
	$results = $db->query("SELECT * FROM assignment WHERE title = '$postassignmenttitle' AND description = '$postdescription'");
	if($result->num_rows == 0){
		$sql = "INSERT INTO assignment (title, description, deadline) 
						VALUES ('$postassignmenttitle',
								'$postdescription',
								'$postdeadlinedate $postdeadlinetime')";
		$db->query($sql);

		$sql = "SELECT * FROM assignment WHERE title = '$postassignmenttitle' 
										AND description = '$postdescription'";
		$results = $db->query($sql);
		if($results->num_rows > 0){
			while($row = $results->fetch_assoc()){
				$dbassignmentid = $row['id'];
			}
		}

		$sql = "INSERT INTO assignment_course (course_id, assignment_id) 
				VALUES ('$sessioncrn', '$dbassignmentid')";
		$results = $db->query($sql);

	}
	//exec("mkdir resources/uploads/" . $sessioncrn . "/" . $dbassignmentid);)
	mkdir(ROOT_PATH . "/uploads/" . $sessioncrn . "/" . $dbassignmentid, 0775);
	echo ROOT_PATH . "/uploads/" . $sessioncrn . "/" . $dbassignmentid;
	header("Location:http://" . $relative . "/view/course.php?crn=" . $sessioncrn);
?>
