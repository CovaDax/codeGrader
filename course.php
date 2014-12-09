<?php
	session_start();
	$sessioncrn = $_GET['crn'];
	$_SESSION['crn'] = $sessioncrn;

		include("includes/database.php");

		$query = mysql_query("SELECT * FROM course WHERE crn ='$sessioncrn'");

		$numrows = mysql_num_rows($query);

		if($numrows!=0){
			while($row = mysql_fetch_assoc($query)){
				$dbcoursetitle = $row['title'];
				$dbcoursecrn = $row['crn'];
				$dbcoursedepartment = $row['department'];
				$dbcoursesection = $row['section'];
			}
		}

		$_SESSION['crn'] = $dbcoursecrn;

		$query2 = mysql_query("SELECT * FROM assignment a
									INNER JOIN assignment_course 
									ON course_id = '$sessioncrn' 
								WHERE assignment_id = a.id
								LIMIT 0, 30");

		$numrows2 = mysql_num_rows($query2);
		
?>

<HTML>
<HEAD>
	<TITLE><?php echo $dbcoursetitle ?></TITLE>
	<STYLE>
		<?php include("resources/bootstrap.css"); ?>
		<?php include("resources/simple-sidebar.css"); ?>
	</STYLE>
	<?php include('includes/nav.php'); ?>
	<?php $link = "<li><a class='list-group-item' href='includes/forms/create_assignment_form.php?crn=$sessioncrn'>Create Assignment</a></li>"; ?>
	<?php include('includes/sidenav.php'); ?>
	
	<CENTER><STRONG><?php echo $dbcoursetitle ?> !</STRONG><br/></CENTER>
</HEAD>
	
<BODY>
	<div class="panel panel-default" style="padding: 1%; margin: 2%	">
		<div class="panel-body" style="padding: 2%; margin: 1%">
			<TABLE class="table table-striped table-hover" style="margin: 2%; padding: 10%">
				<CAPTION><H2><CETNER>Your Assignments</CETNER></H2></CAPTION>
				<TR>
					<TH>Assignment</TH>
					<TH>Deadline</TH>
				</TR>
				<?php
					if($numrows2!=0){
						while($row = mysql_fetch_assoc($query2)){
							echo "<TR>";
								echo "<TD><a href='assignment.php?id=" . $row['id'] . "&crn=" . $dbcoursecrn . "'>" . $row['title'] . "</a></TD>";
								echo "<TD>" . $row['deadline'] . "</a></TD>";
								if($_SESSION['role']=="INSTRUCTOR" || $_SESSION['role'] == "ADMIN"){
									echo "<TD><a href='includes/CRUD/deleteassignment.php?id=" . $row['id'] . "&crn=" . $dbcoursecrn . "'> Delete </a></TD>";
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
