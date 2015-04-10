<?php
	
	include_once "../config.php";
	include_once 'templates/navbar.php';
	session_start();
	$postdir = $_GET['title'];
	$newdir = explode("/",$postdir);
	$testfile = $newdir[0]."/".$newdir[1]."/".$newdir[2]."/testcases.txt";
	$assignmentid = $newdir[2];
	$assignmenttitle = $_SESSION['assignmenttitle'];
	$submissionusername = $newdir[3];

	echo "<STYLE>";
		include(ROOT_PATH . "/css/bootstrap.css");
	echo "</STYLE>";

	set_time_limit(15);

	$db = new Database($config['db']);

	$sql = "SELECT * FROM user WHERE username = '$submissionusername'";
	$result = $db->query($sql);
	$user = array();
	if($result->num_rows > 0){
		while($row = $result->fetch_assoc()){
    		$user[] = $row;
    		$userid = $row['id'];
		}
	}

	$results = $db->query("SELECT * FROM submission s
							INNER JOIN submission_user su ON s.id = su.submission_id AND user_id = '$userid'
							INNER JOIN assignment_submission sa ON s.id = sa.submission_id AND assignment_id = '$assignmentid'
						LIMIT 0, 30 ");

	$lastfour = substr($userid, -4);
	$compilename = $postdir. "/" . $assignmenttitle . "_" . $lastfour . ".java";
	$runname = $postdir . "/" . $assignmenttitle . "_" . $lastfour . ".class";

	$text = file_get_contents(ROOT_PATH . "/" . $testfile);

	$sql = "SELECT * FROM submission WHERE files='$postdir'";
	$result = $db->query($sql);
	$submissionid;
	if($result->num_rows > 0){
		while($row = $result->fetch_assoc()){
			$submissionid = $row['id'];
		}
	}
	echo "<form class='form-horizontal' action='grade.php?id=" . $submissionid . "' method='POST'>";	
?>
  <fieldset>
    <div class="form-group">
      <label for="textArea" class="col-lg-1 control-label">Grade</label>
      <div class="col-lg-3">
        <input type="text" class="form-control" id="inputDefault" name="grade">
        <span class="help-block">A longer block of help text that breaks onto a new line and may extend beyond one line.</span>
      </div>
      <button class='btn btn-primary' type='submit'>Grade</button>
    </div>
  </fieldset>
</form>

	<div class='alert alert-dismissable alert-success'>
		<?php
			passthru("rm " . ROOT_PATH . "/uploads/" . $newdir[1] . "/" . $assignmentid . "/Solutions.class");
			if(file_exists(ROOT_PATH . "/uploads/" . $newdir[1] . "/" . $assignmentid . "/Solutions.java")){
				echo "<PRE>";
					passthru("javac " . ROOT_PATH . "/uploads/" . $newdir[1] . "/" . $assignmentid . "/Solutions.java");
					if(file_exists(ROOT_PATH . "/uploads/" . $newdir[1] . "/$assignmentid/Solutions.class")){
						system("java -cp " . ROOT_PATH . "/uploads/" . $newdir[1] . "/" . $assignmentid . " Solutions 2>&1");
					} else {
						echo "javac " . ROOT_PATH . "/uploads/" . $newdir[1] . "/" . $assignmentid . "/Solutions.java";
						//echo "java -cp " . ROOT_PATH . "/uploads/" . $newdir[1] . "/" . $assignmentid . "/Solutons 2>&1";
					}
				echo "</PRE>";
			} else {
				echo ROOT_PATH . "/uploads/" . $newdir[1] . "/" . $assignmentid . "/Solutions.java";
			}
		?>
	</div>

	<?php
	passthru("rm " . $runname);
	if(file_exists(ROOT_PATH . "/" . $compilename)){
		passthru("javac " . ROOT_PATH . "/$postdir/" . $assignmenttitle . "_" . $lastfour . ".java", $output);
		if(file_exists(ROOT_PATH . "/" . $runname)){
			foreach(preg_split("/((\r?\n)|(\r\n?))/", $text) as $line){
				$db->query("UPDATE submission SET compiled='1' WHERE files='$postdir'");
				echo "<div class='alert alert-dismissable alert-success'>";
				echo "<button type='button' class='close' data-dismiss='alert'></button>";
				echo "<PRE>";
					system("java -cp " . ROOT_PATH . "/" . $postdir . " " . $assignmenttitle . "_" . $lastfour . " " . $line . " 2>&1");
				echo "</PRE>";
				echo "</div>";
			}
		} else {
			$db->query("UPDATE submission SET compiled='0' WHERE files='$postdir'");	

			echo "<div class='alert alert-dismissable alert-warning'>";
			echo "<button type='button' class='close' data-dismiss='alert'></button>";
			echo "<PRE>";
				echo "Student's File did not compile\n";
			echo "</PRE>";
			echo "</div>";
		}
	} else {
			echo "<div class='alert alert-dismissable alert-danger'>";
				echo "<h2>NO FILE SUBMITTED</h2>";
			echo "</div>";
	}
?>
