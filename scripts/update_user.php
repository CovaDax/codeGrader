<?php
	include '../config.php';

	session_start();
    if(!isset($_SESSION["username"])){
      if($_SESSION['role']!="ADMIN" || $_SESSION['role']!="INSTRUCTOR"){
          header("Location:http://" . $relative . "/index.php");
        }
    }

    function __AUTOLOAD($class_name){
		include_once(ROOT_PATH . "/models/" . $class_name . ".php");
	}

	$postusername = $_POST['username'];
	$postpassword = $_POST['password'];
	$postfirstName = $_POST['firstName'];
	$postlastName = $_POST['lastName'];
	$postemail = $_POST['email'];
	$postrole = $_POST['role'];
	echo $currentuser;
	$currentuser = $_SESSION['currentuser'];

	$db = new Database($config['db']);
	$sql = "UPDATE user
        		SET username = '$postusername',
        		firstName = '$postfirstName', 
        		lastName = '$postlastName', 
        		email = '$postemail', 
        		role = '$postrole'
        		WHERE id = '$currentuser'";
	$results->query($sql);
	header("Location:http://" . $relative . "index.php");
?>