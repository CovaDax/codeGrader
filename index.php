<?php
	session_start();

	if($_SESSION['username']){
		$sessionusername = $_SESSION['username'];
		$sessionuserid = $_SESSION['userid'];
		$sessionfirstname = $_SESSION['firstName'];
		$sessionrole = $_SESSION['userrole'];


		$connect = mysql_connect("localhost","root","password") or die("Couldn't Connect!");
		mysql_select_db("codeGraderDB") or die("Couldn't find DB");

		$query = mysql_query("SELECT * FROM users WHERE username = '$sessionusername'");
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
				$dbemail = $row['role'];
			}
		}

		$query2 = mysql_query("SELECT * FROM course 
									INNER JOIN user_course 
									ON id = course_id 
									WHERE user_id = '$sessionuserid' 
									LIMIT 0, 30 ");
		$numrows2 = mysql_num_rows($query2);
	} else {
		header("Location:form_login.php");
	}

?>


<HTML>
<HEAD>
	<TITLE>Your Courses</TITLE>
	<?php include('includes/nav.php'); ?>
	Welcome, <?php echo $sessionfirstname ?> !<br/>
</HEAD>
	
<BODY>
	<TABLE style="width:30%">
		<CAPTION><H2>Your Courses</H2></CAPTION>
		<TR>
			<TH>Title</TH>
			<TH>Section</TH>
			<TH>CRN</TH>
		</TR>
		<?php
			if($numrows2!=0){
				while($row = mysql_fetch_assoc($query2)){
					echo "<TR>";
						echo "<TD><a href='course.php?crn=" . $row['crn'] . "'>" . $row['title'] . "</a></TD>";
						echo "<TD>" . $row['department'] . $row['section'] . "</a></TD>";
						echo "<TD>" . $row['crn'] . "</a></TD>";
					echo "</TR>";
				}
			}
		?>
	</TABLE>
</BODY>

</HTML>