<?php
	$files = scandir($submission['files']);
	$newdir = explode("/",$submission['files']);
	rsort($files);
	$userdir = $newdir[4];

	if($_SESSION['role'] == "STUDENT") {
		foreach ($files as $file) {
		    if ($file != '.' && $file != '..') {
		        echo '<a href="#">' . $file . '</a></br>';
		        echo "</br>";
		    }
		}
	} else if ($_SESSION['role'] == "ADMIN" || $_SESSION['role'] == "INSTRUCTOR") {
		echo "<STRONG>" . $newdir[4] . "</STRONG></BR>";

		foreach ($files as $file) {
		    if ($file != '.' && $file != '..') {
		        echo '<a href="#">' . $submission['files'] . "/" . $file . '</a></br>';
		    }
		}

		echo "<FORM action='" . $relative . "/scripts/gradefiles.php?title=" . $submission['files'] . "&user=$userdir' method='post'>";
			echo "<button class='btn btn-primary' type='submit'>Grade</button>";
		echo "</FORM>";


	}
	closedir($handle);
?>
