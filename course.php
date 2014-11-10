<?php
	session_start();
	$sessioncrn = $_GET['crn'];
		$connect = mysql_connect("localhost","root","password") or die("Couldn't Connect!");
		mysql_select_db("codeGraderDB") or die("Couldn't find DB");

		$query = mysql_query("SELECT * FROM course WHERE crn ='$sessioncrn'");

		$numrows = mysql_num_rows($query);

		if($numrows!=0){
			while($row = mysql_fetch_assoc($query)){
				$dbcourseid = $row['id'];
				$dbcoursetitle = $row['title'];
				$dbcoursecrn = $row['crn'];
				$dbcoursedepartment = $row['department'];
				$dbcoursesection = $row['section'];
			}
		}

		$query2 = mysql_query("SELECT * FROM assignments
									INNER JOIN assignment_course 
									ON id = assignment_id 
									WHERE course_id = '$dbcourseid' 
									LIMIT 0, 30 ");

		$numrows2 = mysql_num_rows($query2);
?>

<HTML>
<HEAD>
	<TITLE><?php echo $_row['title'] ?></TITLE>
	<?php include('includes/nav.php'); ?>
	<?php include('includes/sidenav.php'); ?>
	<CENTER><STRONG><?php echo $dbcoursetitle ?> !</STRONG><br/></CENTER>
</HEAD>
	
<BODY>
<TABLE style="width:30%">
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
					echo "</TR>";
				}
			}
		?>
	</TABLE>
</BODY>

</HTML>