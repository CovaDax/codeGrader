<?php
	session_start();
	include("../database.php");

	$query = mysql_query("SELECT * FROM user");
	$numrows= mysql_num_rows($query);
?>

<HTML>
<TABLE style="width:30%">
		<CAPTION><H2>Users</H2></CAPTION>
		<TR>
			<TH>Assignment</TH>
			<TH>Deadline</TH>
		</TR>
		<?php
			if($numrows!=0){
				while($row = mysql_fetch_assoc($query)){
					echo "<TR>";
						echo "<TD>" . $row['username'] . "</TD>";
						echo "<TD>" . $row['firstName'] . "</TD>";
						echo "<TD>" . $row['lastName'] . "</TD>";
						echo "<TD>" . $row['email'] . "</TD>";
						echo "<TD>" . $row['role'] . "</TD>";
						if($row['username'] != $_SESSION['username']){
							echo "<TD><a href='../CRUD/deleteuser.php?id=" . $row['id'] . "'>Delete</TD>";
						}
					echo "</TR>";
				}
			}
		?>
</TABLE>
</HTML>