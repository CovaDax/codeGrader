<?php
	include_once "../config.php";
	session_start();	 
	// Destroy session 
	session_destroy();
	header('Location:http://' . $root . '/index.php');
?>