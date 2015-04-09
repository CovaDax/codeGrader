<?php 
	include "../config.php";
	include_once ROOT_PATH . "/scripts/assignment.php";
?>

<HTML>
	<HEAD>
		<STYLE>
			<?php include "../css/bootstrap.css"; ?>
			<?php include "templates/navbar.php"; ?>
		</STYLE>
		<TITLE><?php echo $assignment[0]['title']; ?></TITLE>
	</HEAD>
	<BODY>
		<?php
		/**
		*		Test Cases
		*/
		if($_SESSION['role']=="INSTRUCTOR" || $_SESSION['role']=="ADMIN") { ?>
			<?php
				echo "<form class='form-horizontal' action='../scripts/testcases.php?id=" . $assignment[0]['id'] . "' method='POST'>";
			?>
			  <fieldset>
			    <div class="form-group">
			      <label for="textArea" class="col-lg-2 control-label">Test Cases</label>
			      <div class="col-lg-7">
			      	<?php 
			      		$text = file_get_contents(ROOT_PATH . "/uploads/$sessioncrn/$sessionid/testcases.txt");
			      		$text = str_replace(",", " ", $text);
			      		$text = str_replace("  ", " ", $text);
			      		$text = ltrim($text);
			      		//exec("chmod 777 resources/uploads/$sessioncrn/$sessionid/testcases.txt");
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
		<?php 	
			}
		?>

		<div class="panel panel-default" style="padding: 1%; margin: 2%">
		<div class="panel-heading"><?php echo $assignment[0]['title']; ?></div>
		<div class="panel-body">
			<?php 
				echo $dbassignmentdescription;
				$assignmenttitle;
				$lastfour = substr($_SESSION['userid'], -4);
				$assignmenttitle = str_replace(" ", "", $assignment[0]['title']);
				$assignmenttitle = str_replace("#", "", $assignmenttitle);
				echo "<P>Your main file must be named " . $assignmenttitle . "_" . str_pad($lastfour, 4, "0", STR_PAD_LEFT) . " or else your assignment may not be graded.";
			?>
		</div>
		</div>

		<div class="panel panel-default" style="padding: 1%; margin: 2%; background-color: dark-gray">
		<div class="panel-heading">		
			<CENTER><STRONG><?php echo $assignment[0]['title'] ?> !</STRONG><br/></CENTER>
		</div>
		<div class="panel-body" style="padding: 2%; margin: 1%">
			<H4><CENTER>Upload the Solutions JavaProgram named Solutions.java</CENTER></H4>
			<?php include 'templates/submit.php'; ?>
			<!-- <div class="form-group">
			<?php
				//echo "<form class='form-horizontal' action='../scripts/output.php?id=" . $assignment[0]['id'] . "' method='POST'>";
			?>
			  <fieldset>
			    <div class="form-group">
			      <label for="textArea" class="col-lg-2 control-label">Test Cases</label>
			      <div class="col-lg-7">
			      	<?php 
			      		//$text = file_get_contents(ROOT_PATH . "/uploads/$sessioncrn/$sessionid/testcases.txt");
			      		//$text = str_replace(",", " ", $text);
			      		//$text = str_replace("  ", " ", $text);
			      		//$text = ltrim($text);
			      		//exec("chmod 777 resources/uploads/$sessioncrn/$sessionid/testcases.txt");
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
			</div> -->
		</div>
		<div class="panel-body" style="padding: 2%; margin: 1%">	
			<TABLE class="table table-striped table-hover" style="margin: 2%; padding: 5%">
				<CAPTION><CENTER><H2>Your Assignments</H2></CENTER></CAPTION>
				<TR>
					<TH>Assignment</TH>
					<TH>Grade</TH>
				</TR>
				<?php
				    foreach($submissions as $key=>$submission){
						if(strlen($submission['files']) > 16){
						if($submission['grade'] >= 80 && $submission['compiled'] == 1) echo "<TR class='success'>";
						else if($submission['grade'] < 80 && $submission['grade'] >=60 && $submission['compiled'] == 1) echo "<TR class='warning'>";
						else if($submission['grade'] <= 59 && $submission['grade']!=NULL || $submission['compiled'] == -1) echo "<TR class='danger'>";
						else { echo "<TR>"; }
							echo "<TD>";
								include ROOT_PATH . "/scripts/readfiles.php";
							echo "<TD>";
								if($submission['compiled'] != 0)
									echo $submission['grade'] . "%";
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
				if((time()-(60*60*24)) > strtotime($dbassignmentdeadline)){
					include("templates/submit.php");
				} else {
					echo "<div class='alert alert-dismissable alert-danger'>";
					  	echo "<button type='button' class='close' data-dismiss='alert'>×</button>";
					  echo "<strong>Assignment is late.</strong>";
					echo "</div>";
				}
			?>
		</div>
		</div>
		</div>
	</BODY>
</HTML>