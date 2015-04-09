<?php
	$userid = $_GET['uin'];
	$db = new Database($config['db']);
	$users = array();
	$results = $db->query("SELECT * FROM user WHERE id = '$userid'");
	if($results->num_rows > 0){
		while($row = $results->fetch_assoc()){
			$users[] = $row;
		}
	}

	$courses = array();
	$results = $db->query("SELECT * FROM course c
							WHERE NOT EXISTS (
						    	SELECT uc.user_id FROM user_course uc
						        WHERE uc.course_id = c.crn
						        AND uc.user_id = " . $users[0]['id'] . "
						    	)");
	if($results->num_rows > 0){
		while($row = $results->fetch_assoc()){
			$courses[] = $row;
		}
	}
?>