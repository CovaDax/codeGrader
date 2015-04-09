<?php 
	include "../config.php";
	include_once ROOT_PATH . "/scripts/courses.php";
?>

<HTML>
	<HEAD>
		<STYLE>
			<?php include "../css/bootstrap.css"; ?>
			<?php include "templates/navbar.php"; ?>
		</STYLE>
		<TITLE>Your Courses</TITLE>

	</HEAD>

	<BODY>
		<div class="panel panel-default" style="padding: 1%; margin: 2%; background-color: dark-gray">
			<div class="panel-heading">		
				<H1><CENTER>Welcome, <?php echo $_SESSION['firstName'] ?> !</CENTER></H1>
			</div>
			<div class="panel-body" style="padding: 2%; margin: 1%">	
				<TABLE class="table table-striped table-hover" style="margin: 2%; padding: 5%">
					<CAPTION><CENTER><H2>Your Courses</H2></CENTER></CAPTION>
					<TR>
						<TH>Title</TH>
						<TH>Section</TH>
						<TH>CRN</TH>
					</TR>
					<?php
					    foreach($courses as $key=>$course){
					    	echo "<TR>";
							echo "<TD><a href='course.php?crn=" . $course['crn'] . "'>" . $course['title'] . "</a></TD>";
							echo "<TD>" . $course['department'] . $course['section'] . "</a></TD>";
						 	echo "<TD>" . $course['crn'] . "</a></TD>";
						 	if($_SESSION['role'] == "ADMIN"){
						 		echo "<TD><a href='../scripts/delete_course.php?crn=" . $course['crn'] . "'>Delete</a></TD>";
						 	}
					    }
				    ?>
				</TABLE>
			</div>
		</div>
	</BODY>
</HTML>