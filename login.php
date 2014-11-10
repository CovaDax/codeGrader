<?php

	session_start();

	$username = $_POST['username'];
	$password = $_POST['password'];

	if($username && $password){
		$connect = mysql_connect("localhost","root","password") or die("Couldn't Connect!");
		mysql_select_db("codeGraderDB") or die("Couldn't find DB");

		$query = mysql_query("SELECT * FROM users WHERE username ='$username'");

		$numrows = mysql_num_rows($query);

		if($numrows!=0){
			//code to login
			while($row = mysql_fetch_assoc($query)){
				$dbuserid = $row['id'];
				$dbusername = $row['username'];
				$dbpassword = $row['password'];
				$dbfirstname = $row['firstName'];
				$dblastname = $row['lastName'];
				$dbemail = $row['email'];
				$dbrole = $row['role'];
			}

			if($username==$dbusername && $password==$dbpassword){
				$_SESSION['username']=$dbusername;
				$_SESSION['userid']=$dbuserid;
				$_SESSION['firstName']=$dbfirstname;
				$_SESSION['lastName']=$dblastname;
				$_SESSION['role'] = $dbrole;
				header("Location:index.php");
			} else {
				die("Incorrect email");
			}

		} else {
			die("User doesn't exist");
		}

	} else {
		die("Please enter a username and password!");
	}
?>
