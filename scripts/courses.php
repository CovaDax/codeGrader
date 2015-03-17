<?php
	function __AUTOLOAD($class_name){
		include_once(ROOT_PATH . "/models/" . $class_name . ".php");
	}

	session_start();
    if(!isset($_SESSION["username"])){
        header("Location:http://" . $relative . "/index.php");
    }

    $db = new Database($config['db']);
    $sql;
	if($_SESSION['role'] == "ADMIN") {
		$sql = "SELECT * FROM course";
	} elseif($_SESSION['role'] == "STUDENT") {
	 	$sql = "SELECT * FROM course
		INNER JOIN user_course ON crn = course_id AND user_id = '" . $_SESSION['userid']
		. "' LIMIT 0, 30 ";
	} elseif($_SESSION['role'] == "BATMAN") {
	 	//relocate to BATMAN
	}
    $results = $db->query($sql);
    $courses = array();
    if($results->num_rows > 0){
    	while($row = $results->fetch_assoc()){
    		$courses[] = $row;
    		//add classes here if needed
    	}
    }
?>