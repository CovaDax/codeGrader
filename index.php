<?php 
    require_once 'config.php';

    session_start();
    if(!isset($_SESSION["username"])){
       	$goto = "http://" . $root . "/view/templates/login.php";
    } else {
    	$goto = "http://" . $root . "/view/courses.php";
    	if($_SESSION['role']=="BATMAN"){
			$goto = "http://" . $root . "/view/batman.php";
		}
	}

	header("Location: " . $goto);
?>