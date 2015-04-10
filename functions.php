<?php

	function __AUTOLOAD($class_name){
		include_once ROOT_PATH . '/models/' . $class_name . '.php';
	}


	function delete_submission($db,$crn,$id,$subid){
		//break submission/assignment relationship
		$db->query("DELETE FROM assignment_submission WHERE submission_id = '$subid'") or die("didn't break sub/ass");
		//delete each submission
		$db->query("DELETE FROM submission WHERE id = $subid") or die("didn't delete submission");
		//delete submission files

	    $dirPath = ROOT_PATH . "/uploads/" . $crn . "/" . $id;
		if (! is_dir($dirPath)) {
	        throw new InvalidArgumentException("$dirPath must be a directory");
	    }

	    if (substr($dirPath, strlen($dirPath) - 1, 1) != '/') {
	        $dirPath .= '/';
	    }
	    $files = glob($dirPath . '*', GLOB_MARK);
	    foreach ($files as $file) {
	        if (is_dir($file)) {
	            self::deleteDir($file);
	        } else {
	            unlink($file);
	        }
	    }
	    unset($connection);
	}

	function delete_assignment($db, $crn, $id){
		echo "TEST";
		$result = $db->query("SELECT * FROM assignment_submission WHERE assignment_id = '$id'");
		if($result->num_rows!=0){
			while($row = $result->fetch_assoc()){
				echo $row['submission_id'];
				delete_submission($db, $crn,$id,$row['submission_id']);
			}
		}
		$db->query("	DELETE FROM assignment_course WHERE assignment_id='$id'") or die(print_r(error_get_last()));
		rmdir(ROOT_PATH . "/uploads/" . $crn . "/" . $id);
	}

	function delete_course($db, $crn){
		$result = $db->query("SELECT * FROM assignment_course WHERE course_id = '$crn'");
		if($result->num_rows > 0){
			while($row = $result->fetch_assoc()){
				delete_assignment($db, $crn, $row['id']);
				$db->query("DELETE FROM assignment_course WHERE course_id='$crn'");
			}
		}
		$db->query("DELETE FROM user_course WHERE course_id = '$crn'") or die("USERCOURSE");
		$db->query("DELETE FROM course WHERE crn = '$crn'");
		rmdir(ROOT_PATH . "/uploads/" . $crn);
	}
?>