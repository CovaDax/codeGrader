	<?php
	session_start();
	$sessionid = $_GET['id'];
	$sessioncrn = $_GET['crn'];
	$userid = $_SESSION['userid'];

	$_SESSION['assignmentid'] = $_GET['id'];
	$_SESSION['crn'] = $sessioncrn;


	include("includes/database.php");

		$query = mysql_query("SELECT * FROM assignment WHERE id ='$sessionid'");

		$numrows = mysql_num_rows($query);

		if($numrows!=0){
			while($row = mysql_fetch_assoc($query)){
				$dbassignmentid = $row['id'];
				$dbassignmenttitle = $row['title'];
				$dbassignmentdescription = $row['description'];
				$dbassignmentdeadline = $row['deadline'];
			}
		}

		$_SESSION['assignmenttitle'] = $dbassignmenttitle;
		$_SESSION['assignmentdescription'] = $dbassignmentdescription;
		$_SESSION['assignmentdeadline'] = $dbassignmentdeadline;


		if($_SESSION['role'] == "ADMIN" || $_SESSION['role'] == "INSTRUCTOR"){
			$query2 = mysql_query("SELECT * FROM submission s
										INNER JOIN assignment_submission ON assignment_id = '$sessionid' AND submission_id = s.id
									LIMIT 0, 30");
		} else {
			$query2 = mysql_query("SELECT * FROM submission s
									INNER JOIN submission_user su ON s.id = su.submission_id AND user_id = '$userid'
									INNER JOIN assignment_submission sa ON s.id = sa.submission_id AND assignment_id = '$sessionid'
								LIMIT 0, 30 ");
		}

		$numrows2 = mysql_num_rows($query2);

		$defaultname = $dbassignmenttitle . "_" . substr($_SESSION['userid'], -4);
		if($_POST != NULL) { $defaultname = $_POST['fileName']; }
?>

<HTML>
<HEAD>
	<TITLE><?php echo $dbassignmenttitle ?></TITLE>
	<STYLE>
		<?php include("resources/bootstrap.css"); ?>
		<?php include("resources/simple-sidebar.css"); ?>
	</STYLE>
	<?php include('includes/nav.php'); ?>
	<?php $link = "<li><a class='list-group-item' href='includes/forms/update_assignment_form.php?id=$sessionid'>Edit Assignment</a></li><br>";
	$dbcoursecrn = $_SESSION['crn'];?>
	<?php include('includes/sidenav.php'); ?>
	<CENTER><STRONG><?php echo $dbassignmenttitle ?> !</STRONG><br/></CENTER>
</HEAD>
	
<BODY>
	<?php if($_SESSION['role']=="INSTRUCTOR" || $_SESSION['role']=="ADMIN") { ?>
		<form class="form-horizontal" action="create_test_case.php" method="POST">
		  <fieldset>
		    <div class="form-group">
		      <label for="textArea" class="col-lg-2 control-label">Test Cases</label>
		      <div class="col-lg-7">
		      	<?php 
		      		$text = file_get_contents("resources/uploads/$sessioncrn/$sessionid/testcases.txt");
		      	?>
		        	<textarea class='form-control' rows='3' id='textArea' name='testcase'> <?php echo $text; ?> </textarea>
		        <span class="help-block">Please input a series of Command Line Arguments to test the students' programs, each on a new line.</span>
		      </div>
		    </div>
		    <div class="form-group">
		      <div class="col-lg-10 col-lg-offset-2">
		        <button type="submit" class="btn btn-primary">Submit</button>
		      </div>
		    </div>
		  </fieldset>
		</form>
	<?php 	}	?>
		<div class="panel panel-default" style="padding: 1%; margin: 2%">
		  <div class="panel-heading"><?php $assignmenttitle ?></div>
		  <div class="panel-body">
				<?php 
					echo $dbassignmentdescription;
					$lastfour = substr($_SESSION['userid'], -4);
					$assignmenttitle = str_replace(" ", "", $dbassignmenttitle);
					$assignmenttitle = str_replace("#", "", $assignmenttitle);
					echo "<P>Your main file must be named " . $assignmenttitle . "_" . $lastfour . " or else your assignment may not be graded.";
				?>
		  </div>
		</div>
		<div class="panel panel-default" style="padding: 1%; margin: 2%	">
			<div class="panel-body" style="padding: 2%; margin: 1%">
		    	<TABLE class="table table-striped table-hover">
					<CAPTION><H2><CENTER>Your Submissions</CENTER></H2></CAPTION>
					<TR>
						<TH>File Link</TH>
						<TH>Grade</TH>
					</TR>
					<?php
						if($numrows2!=0){
							while($row = mysql_fetch_assoc($query2)){
								$directory = $row['files'];
								$time = $row['timestamp'];
								$compiled = $row['compiled'];
								$grade = $row['grade'];
								if($compiled == 1) echo "<TR class='success'>";
								else if($compiled == -1) echo "<TR class='danger'>";
								else echo "<TR>";
									echo "<TD>";
										include("readfiles.php");
									echo "</TD>";

									echo "<TD>";
										if($compiled != 0)
											echo $grade;
									echo "</TD>";
								echo "</TR>";
							}
						}
					?>
				</TABLE>
		  </div>
		  <div class="panel-footer">
			<?php
				$now = date("Y-m-d H:i:s");
				if((time()-(60*60*24)) < strtotime($dbassignmentdeadline)){
					include("includes/forms/submit_form.php");
				} else {
					echo "<div class='alert alert-dismissable alert-danger'>";
					  	echo "<button type='button' class='close' data-dismiss='alert'>×</button>";
					  echo "<strong>Assignment is late.</strong>";
					echo "</div>";
				}
			?>
		  </div>
		</div>
</BODY>

</HTML>