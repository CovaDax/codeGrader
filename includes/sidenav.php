<div id="wrapper">
    <!-- Sidebar -->
    <div id="sidebar-wrapper">
        <ul class="sidebar-nav"  style="padding-right: 10px">
          	<li><a href='index.php' class="list-group-item">Home</a></li>
			<?php	
				echo "<li><a class='list-group-item' href='members.php?crn=" . $dbcoursecrn . "'>People</a></li>";	?>
			<?php
				if($_SESSION['role'] == "INSTRUCTOR" || $_SESSION['role'] == "ADMIN") {
					echo $link;
					echo $link2;
				} 
			?>
        </ul>
</div>
<!-- /#sidebar-wrapper -->

