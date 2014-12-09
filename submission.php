<?php
	session_start();
	$sessioncrn = $_GET['crn'];
	$sessionuser = $_GET['user'];
	$sessionid = $_GET['id'];
	include('includes/nav.php');
	include('includes/sidenav.php');


	$directory = "resources/uploads/".$sessioncrn."/".$sessionid."/".$_SESSION['username'];

	echo "<PRE>";
		echo $directory . "</BR>";
		$files = scandir($directory);
		print_r($files);
	echo "</PRE>";


	if(!$fiiles ){

	}

	// if(!glob("*.java"){
	// 	// foreach (glob("*.zip") as $zipfile) {
	// 	// 	passthru("unzip " . $filename, $output);
	// 	// }
	// }

	// if(file_exists("includes/codeGrader.java")){
	// 	if(!file_exists("includes/codeGrader.class")){
	// 		echo "Compiling codeGrader".PHP_EOL;
	// 		passthru("javac includes/codeGrader.java 2>&1", $output);
	// 	}
	// } else {
	// 	echo "No codeGrader File";
	// }
	
	// $runfile = "java -cp includes codeGrader ".$sessioncrn." ".$sessionuser." ".$sessionid." 2>&1";

	// echo "<PRE>";
	// 	passthru($runfile, $output);
	// echo "</PRE>";

	// passthru("rm " . $runfile . ".class");
?>