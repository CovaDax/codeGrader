<?php 
	include("../config.php");
?>
<HTML>
	<HEAD>
		<STYLE type="text/css">
		<?php
			echo "body {";
				echo "background-image: url('" . ROOT_PATH . "/view/batman.gif')";
			echo "}";
		?>
		</STYLE>
	</HEAD>
	<BODY background="batman.gif">	
	<audio autoplay loop>
  		<source src="batman.mp3" type="audio/mpeg">
	</audio>
	</BODY>
</HTML>
<?php echo ROOT_PATH ?>