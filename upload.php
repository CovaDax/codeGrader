<?php
	session_start();
	$sessioncrn = $_GET['crn'];
	$sessionuser = $_SESSION['firstName'];
	$sessionid = $_GET['id'];
	include('includes/nav.php');

	$connect = mysql_connect("localhost","root","password") or die("Couldn't Connect!");
	mysql_select_db("codeGraderDB") or die("Couldn't find DB");


 	
	//$query = mysql_query("SELECT * FROM assignments WHERE id ='$sessionid'");

	//$numrows = mysql_num_rows($query);

	//if($numrows!=0){
	//	while($row = mysql_fetch_assoc($query)){
	//		$dbassignmentid = $row['id'];
	//		$dbassignmenttitle = $row['title'];
	//		$dbassignmentdescription = $row['description'];
	//		$dbassignmentdeadline = $row['deadline'];
	//	}
	//}
?>