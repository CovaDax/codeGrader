<?php
	session_start();
	include("includes/nav.php");
	$courseid = $_GET['crn'];
	include("includes/database.php");
	$query = mysql_query("SELECT * FROM user
    							INNER JOIN user_course ON course_id = '$courseid'
    						WHERE id = user_id 
    						LIMIT 0, 30 ");
	$numrows = mysql_num_rows($query);
?>
<STYLE>
	<?php 
		include("resources/bootstrap.css"); 
	?>
</STYLE>
<BODY>
		<div class="panel panel-default" style="padding: 1%; margin: 2%	">
			<div class="panel-body" style="padding: 2%; margin: 1%">
		    	<TABLE class="table table-striped table-hover">
					<CAPTION><H2>Classmates</H2></CAPTION>
					<TR>
						<TH>First Name</TH>
						<TH>Last Name</TH>
						<TH>eMail</TH>
						<TH>Role</TH>
					</TR>
					<?php
						if($numrows!=0){
							while($row = mysql_fetch_assoc($query)){
								echo "<TR>";
									echo "<TD>" . $row['firstName'] .  "</TD>";
									echo "<TD>" . $row['lastName'] . "</TD>";
									echo "<TD>" . $row['email'] . "</TD>";
									echo "<TD>" . $row['role'] . "</TD>";
								echo "</TR>";
							}
						}
					?>
				</TABLE>
			</div>
		</div>
</BODY>