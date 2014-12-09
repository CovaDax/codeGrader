<?php
	// if($handle = opendir($directory)){
	// 	echo $directory;
	// 	while (false !== ($entry = readdir($handle))) {
 //        	if ($entry != "." && $entry != "..") {
 //        		echo "<a href='#'>$entry \t $time</a>";
 //        	}
 //    	}
	// }

	$files = scandir($directory);
	rsort($files);
	foreach ($files as $file) {
	    if ($file != '.' && $file != '..') {
	        echo '<a href="#">' . $directory . $file . '</a>';
	        echo "</BR>";
	    }
	}



	closedir($handle);
?>