<?php

	session_start();
    if(!isset($_SESSION["username"])){
        header("Location:http://" . $root . "/index.php");
    }

    $sessionid = $_GET['id'];
	$sessioncrn = $_GET['crn'];
	$userid = $_SESSION['userid'];



    $assignment = array();
    $db = new Database($config['db']);
    $results = $db->query("SELECT * FROM assignment WHERE id = '$sessionid'");
    if($results->num_rows > 0){
    	while($row = $results->fetch_assoc()){
    		$assignment[] = $row;
    		//add classes here if needed
    	}
    }

    $_SESSION['assignmentid'] = $assignment[0]["id"];
    $_SESSION['assignmenttitle'] = str_replace(" #", "", $assignment[0]["title"]);

    if($_SESSION['role'] == "ADMIN" || $_SESSION['role'] == "INSTRUCTOR"){
			$sql = "SELECT * FROM submission s
						INNER JOIN assignment_submission ON assignment_id = '$sessionid' AND submission_id = s.id
						LIMIT 0, 30";
	} else {
			$sql = "SELECT * FROM submission s
							INNER JOIN submission_user su ON s.id = su.submission_id AND user_id = '$userid'
							INNER JOIN assignment_submission sa ON s.id = sa.submission_id AND assignment_id = '$sessionid'
						LIMIT 0, 30 ";
	}
	$results = $db->query($sql);
	$submissions = array();
	if($results->num_rows > 0){
		while($row = $results->fetch_assoc()){
			$submissions[] = $row;
		}
	}
?>