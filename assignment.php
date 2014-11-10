c<?php
	session_start();
	$sessionid = $_GET['id'];
	$sessioncrn = $_GET['crn'];

		$connect = mysql_connect("localhost","root","password") or die("Couldn't Connect!");
		mysql_select_db("codeGraderDB") or die("Couldn't find DB");

		$query = mysql_query("SELECT * FROM assignments WHERE id ='$sessionid'");

		$numrows = mysql_num_rows($query);

		if($numrows!=0){
			while($row = mysql_fetch_assoc($query)){
				$dbassignmentid = $row['id'];
				$dbassignmenttitle = $row['title'];
				$dbassignmentdescription = $row['description'];
				$dbassignmentdeadline = $row['deadline'];
			}
		}

		$userid = $_SESSION['userid'];


		$query2 = mysql_query("SELECT * FROM submission
									INNER JOIN assignment_submission ON assignment_id = '$dbassignmentid'
									INNER JOIN submission_user ON user_id = '$userid'
								LIMIT 0, 30 ");

		$numrows2 = mysql_num_rows($query2);
?>

<HTML>
<HEAD>
	<TITLE><?php echo $dbassignmenttitle ?></TITLE>
	<?php include('includes/sidenav.php'); ?>
	<CENTER><STRONG><?php echo $dbassignmenttitle ?> !</STRONG><br/></CENTER>
</HEAD>
	
<BODY>

	<?php echo $dbassignmentdescription ?>
<TABLE style="width:30%">
		<CAPTION><H2>Your Submissions</H2></CAPTION>
		<TR>
			<TH>File Link</TH>
		</TR>
		<?php
			if($numrows2!=0){
				while($row = mysql_fetch_assoc($query2)){
					echo "<TR>";
						echo "<TD><a href='submission.php?id=" . $row['id'] . "&crn=" . $sessioncrn . "&user=" . $userid . "'>" . $row['files'] . "</a></TD>";
					echo "</TR>";
				}
			}
		?>
	</TABLE>
</BODY>

</HTML>