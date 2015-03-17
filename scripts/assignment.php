<?php
	function __AUTOLOAD($class_name){
		include_once(ROOT_PATH . "/models/" . $class_name . ".php");
	}

	session_start();
    if(!isset($_SESSION["username"])){
        header("Location:http://" . $relative . "/index.php");
    }

    $sessionid = $_GET['id'];
	$sessioncrn = $_GET['crn'];
	$userid = $_SESSION['userid'];

    $db = new Database($config['db']);
    $sql = "SELECT * FROM assignment WHERE id = '$sessionid'";

    $results = $db->query($sql);
    $assignment = array();
    if($results->num_rows > 0){
    	while($row = $results->fetch_assoc()){
    		$assignment[] = $row;
    		//add classes here if needed
    	}
    }

    echo $sessionid;
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