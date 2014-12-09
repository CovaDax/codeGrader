<?php
	session_start();
	$postdir = $_SESSION['directory'];
	$newdir = explode("/",$postdir);
	$newdir[4] = $_GET['user'];
	$postdir = $newdir[0]."/".$newdir[1]."/".$newdir[2]."/".$newdir[3]."/".$newdir[4];
	$testfile = $newdir[0]."/".$newdir[1]."/".$newdir[2]."/".$newdir[3]."/testcases.txt";
	$assignmenttitle = $_GET['title'];

	$explosion = explode("/", $postdir);
	$submissionusername = $explosion[4];

	echo "<STYLE>";
		include("resources/bootstrap.css");
	echo "</STYLE>";

	set_time_limit(15);

	include("includes/database.php");

	$query = mysql_query("SELECT * FROM user WHERE username = '$submissionusername'");
	$numrows= mysql_num_rows($query);
	if($numrows!=0){
		while($row = mysql_fetch_assoc($query)){
			$allsix = $row['id'];
		}
	}


	$lastfour = substr($allsix, -4);
	$compilename = "$postdir/" . $assignmenttitle . "_" . $lastfour . ".java";
	$runname = "$postdir/" . $assignmenttitle . "_" . $lastfour . ".class";

	$text = file_get_contents($testfile);

	?>
<?php 
	$query2 = mysql_query("SELECT * FROM submission WHERE files='$postdir'");
	$numrows2 = mysql_num_rows($query2);
	if($numrows2!=0){
		while($row2 = mysql_fetch_assoc($query2)){
			$submissionid = $row2['id'];
		}
	}
	echo "<form class='form-horizontal' action='grade.php?id=$submissionid' method='POST'>";	?>
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

	<?php
	passthru("rm " . $runname);
	if(file_exists($compilename)){
		passthru("javac $postdir/" . $assignmenttitle . "_" . $lastfour . ".java", $output);
		if(file_exists($runname)){
			foreach(preg_split("/((\r?\n)|(\r\n?))/", $text) as $line){
				$query = mysql_query("UPDATE submission SET compiled='1' WHERE files='$postdir'");
				echo "<div class='alert alert-dismissable alert-success'>";
				echo "<button type='button' class='close' data-dismiss='alert'></button>";
				echo "<PRE>";
					echo $compiled;
					system("java -cp " . $postdir . " " . $assignmenttitle . "_" . $lastfour . " " . $line . " 2>&1");
				echo "</PRE>";
				echo "</div>";
			}
		} else {
			$query = mysql_query("UPDATE submission SET compiled='0' WHERE files=$postdir");

			echo "<div class='alert alert-dismissable alert-warning'>";
			echo "<button type='button' class='close' data-dismiss='alert'></button>";
			echo "<PRE>";
				echo "Student's File did not compile";
			echo "</PRE>";
			echo "</div>";
		}
	} else {
			echo "<div class='alert alert-dismissable alert-danger'>";
				echo "<h2>NO FILE SUBMITTED</h2>";
			echo "</div>";
	}
	

	// if(file_exists($compilename)){
	// 	echo "<div class='alert alert-dismissable alert-success'>";
	// 	  	echo "<button type='button' class='close' data-dismiss='alert'>×</button>";
	// 	  	echo "<PRE>";
	// 	  	//passthru("javac $postdir/" . $assignmenttitle . "_" . $lastfour . ".java 2>&1", $output);
	// 	  	//passthru("javac CodeGrader.java 2>&1");
	// 		system("java CodeGrader " . $postdir . " " . $compilename . " 2>&1");
	// 	  	echo "</PRE>";	
	// 	echo "</div>";

	// } else {
	// 	echo "<div class='alert alert-dismissable alert-danger'>";
	// 		echo "<H2>No File Submitted</H2>";	
	// 	echo "</div>";
	// }
?>