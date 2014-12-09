<HTML>
<HEAD>
	<TITLE><?php echo $dbcoursetitle ?></TITLE>
	<?php include('includes/nav.php'); ?>
	<?php $link = "<li><a href='includes/forms/create_assignment_form.php?crn=$sessioncrn'>Create Assignment</a></li>"; ?>
	<?php include('includes/sidenav.php'); ?>
	
	<CENTER><STRONG><?php echo $dbcoursetitle ?> !</STRONG><br/></CENTER>
</HEAD>
	
<BODY>
	<TABLE style="width:50%">
		<CAPTION><H2>Your Assignments</H2></CAPTION>
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
</BODY>
</HTML>