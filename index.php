<?php
	session_start();

	if($_SESSION['username']){
		$sessionusername = $_SESSION['username'];
		$sessionuserid = $_SESSION['userid'];
		$sessionfirstname = $_SESSION['firstName'];
		$sessionrole = $_SESSION['role'];

		include ('includes/database.php');

		if($_SESSION['role'] == "ADMIN") {
			$query2 = mysql_query("SELECT * FROM course");
		} else {
			$query2 = mysql_query("SELECT * FROM course 
									INNER JOIN user_course ON crn = course_id AND user_id = '$sessionuserid'
									LIMIT 0, 30 ");
		}
		$numrows2 = mysql_num_rows($query2);

		if($_SESSION['role']=="BATMAN"){
			header("Location:resources/batman.php");
		}

	} else {
		header("Location:includes/forms/login_form.php");
	}

?>


<HTML>
<HEAD>
	<TITLE>Your Courses</TITLE>
	<STYLE>
		<?php include('resources/bootstrap.css'); ?>
	</STYLE>
		<?php include('includes/nav.php'); ?>
	<H3><CENTER>Welcome, <?php echo $sessionfirstname ?> !</CENTER></H3><br/>
</HEAD>
	
<BODY>
	<div class="panel panel-default" style="padding: 1%; margin: 2%	">
		<div class="panel-body" style="padding: 2%; margin: 1%">	
			<TABLE class="table table-striped table-hover" style="margin: 2%; padding: 5%">
				<CAPTION><CENTER><H2>Your Courses</H2></CENTER></CAPTION>
				<TR>
					<TH>Title</TH>
					<TH>Section</TH>
					<TH>CRN</TH>
				</TR>
				<?php
					if($numrows2!=0){
						while($row = mysql_fetch_assoc($query2)){
							$dbcrn = $row['crn'];
							echo "<TR>";
								echo "<TD><a href='course.php?crn=" . $row['crn'] . "'>" . $row['title'] . "</a></TD>";
								echo "<TD>" . $row['department'] . $row['section'] . "</a></TD>";
								echo "<TD>" . $row['crn'] . "</a></TD>";
								if($_SESSION['role'] == "ADMIN"){
									echo "<TD><a href='includes/CRUD/deletecourse.php?crn=" . $dbcrn . "'>Delete</a></TD>";
								}
							echo "</TR>";
						}
					}
				?>
			</TABLE>
		</div>
	</div>
</BODY>

</HTML>
