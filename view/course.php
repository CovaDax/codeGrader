<?php 
	include "../config.php";
	include_once ROOT_PATH . "/scripts/course.php";
?>

<HTML>
	<HEAD>
		<STYLE>
			<?php include "../css/bootstrap.css"; ?>
			<?php include "templates/navbar.php"; ?>
		</STYLE>
	</HEAD>
	<BODY>
		<div class="panel panel-default" style="padding: 1%; margin: 2%; background-color: dark-gray">
		<div class="panel-heading">		
			<CENTER><STRONG><?php echo $course[0]['title'] ?> !</STRONG><br/></CENTER>
		</div>
		<div class="panel-body" style="padding: 2%; margin: 1%">	
			<TABLE class="table table-striped table-hover" style="margin: 2%; padding: 5%">
				<CAPTION><CENTER><H2>Your Assignments</H2></CENTER></CAPTION>
				<TR>
					<TH>Assignment</TH>
					<TH>Deadline</TH>
				</TR>
				<?php
				    foreach($assignments as $key=>$assignment){
						echo "<TR>";
							echo "<TD><a href='assignment.php?id=" . $assignment['id'] . "&crn=" . $course[0]['crn'] . "'>" . $assignment['title'] . "</a></TD>";
							echo "<TD>" . $assignment['deadline'] . "</a></TD>";
							if($_SESSION['role']=="INSTRUCTOR" || $_SESSION['role'] == "ADMIN"){
								echo "<TD><a href='../scripts/delete_assignment.php?id=" . $assignment['id'] . "&crn=" . $course[0]['crn'] . "'> Delete </a></TD>";
							}
						echo "</TR>";
				    }
			    ?>
			</TABLE>
		</div>
		</div>
	</BODY>
</HTML>