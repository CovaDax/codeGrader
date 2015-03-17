<?php
	function __AUTOLOAD($class_name){
		include_once(ROOT_PATH . "/models/" . $class_name . ".php");
	}

	session_start();
    if(!isset($_SESSION["username"])){
        header("Location:http://" . $relative . "/index.php");
    }

	$_SESSION['crn'] = $_GET['crn'];
	$sessioncrn = $_SESSION['crn'];
	$db = new Database($config['db']);

	$sql = "SELECT * FROM course WHERE crn ='" . $_SESSION['crn'] . "'";
	$result = $db->query($sql);
	$course = array();
	if($result->num_rows > 0){
		while($row = $result->fetch_assoc()){
			$course[] = $row;
			//add classes here if needed
		}
	}

	$sql = "SELECT * FROM assignment a
				INNER JOIN assignment_course 
				ON course_id = '$sessioncrn' 
			WHERE assignment_id = a.id
			LIMIT 0, 30"; 
	$result = $db->query($sql);
	$assignments = array();
	if($result->num_rows > 0){
		while($row = $result->fetch_assoc()){
			$assignments[] = $row;
			//add classes here if needed
		}
	}


?>