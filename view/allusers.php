<?php
	include_once '../config.php';

	session_start();
    if(!isset($_SESSION["username"])){
    	header("Location:http://" . $root . "/index.php");
    }

	$db = new Database($config['db']);
	$sql = "SELECT * FROM user";
	$results = $db->query($sql);
?>

<BODY>
<style>
	<?php
		include_once ROOT_PATH . "/css/bootstrap.css";
		include_once 'templates/navbar.php';
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
				if($results->num_rows > 0){
					while($row = $results->fetch_assoc()){
						if($row['role']!="BATMAN"){
							echo "<TR>";
								echo "<TD>" . $row['id'] . "</TD>";
								echo "<TD><a href='http://" . $root . "/view/register_user.php?uin=". $row['id'] ."'>" . $row['username'] .  "</a></TD>";
								echo "<TD>" . $row['firstName'] .  "</TD>";
								echo "<TD>" . $row['lastName'] . "</TD>";
								echo "<TD>" . $row['email'] . "</TD>";
								echo "<TD>" . $row['role'] . "</TD>";
								echo "<TD class='danger'><a href='http://" . $relative . "/scripts/delete_user.php?id=" . $row['id'] . "'>DELETE</a></TD>";
							echo "</TR>";
						}
					}
				}
			?>
		</tbody>
	</TABLE>
</div>
</BODY>
