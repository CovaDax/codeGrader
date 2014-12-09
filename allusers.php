<?php
	session_start();
	include("includes/nav.php");
	if($_SESSION['role']!="ADMIN"){
		header("Location:index.php");
	}
	include("includes/database.php");
	$query = mysql_query("SELECT * FROM user");
	$numrows = mysql_num_rows($query);
?>

<BODY>
<style>
	<?php
		include("resources/bootstrap.css");
	?>
</style>

<div class="jumbotron" style="padding: 30px; margin: 30px">
	<TABLE style="width:100%" class="table-striped table-hover">
		<CAPTION style="align-center"><H2>Users</H2></CAPTION>
		<thead>
			<TR>
				<TH>ID</TH>
				<TH>username</TH>
				<TH>First Name</TH>
				<TH>Last Name</TH>
				<TH>eMail</TH>
				<TH>Role</TH>
			</TR>
		</thead>
		<tbody>
			<?php
				if($numrows!=0){
					while($row = mysql_fetch_assoc($query)){
						echo "<TR>";
							echo "<TD>" . $row['id'] . "</TD>";
							echo "<TD><a href=includes/forms/update_user_form.php?uin=". $row['id'] .">" . $row['username'] .  "</a></TD>";
							echo "<TD>" . $row['firstName'] .  "</TD>";
							echo "<TD>" . $row['lastName'] . "</TD>";
							echo "<TD>" . $row['email'] . "</TD>";
							echo "<TD>" . $row['role'] . "</TD>";
							echo "<TD class='danger'><a href=includes/CRUD/deleteuser.php?id=" . $row['id'] . ">DELETE</a></TD>";
						echo "</TR>";
					}
				}
			?>
		</tbody>
	</TABLE>
</div>
</BODY>