<!DOCTYPE html>
<HTML>

	<div class="navbar navbar-default">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-responsive-collapse">
			    <span class="icon-bar"></span>
			    <span class="icon-bar"></span>
			    <span class="icon-bar"></span>
			</button>
			<a href="includes/forms/update_user_form.php" class="navbar-brand"><?php echo $_SESSION['firstName'] . " " . $_SESSION['lastName'] ?></a>
		 </div>
  <div class="navbar-collapse collapse navbar-responsive-collapse">
    <ul class="nav navbar-nav">
      <li><a href='index.php'>Home</a></li>

				<?php 
					if($_SESSION['role'] == "ADMIN"){
						echo "<li><a href='allusers.php'>Users</a></li>";
						echo "<li><a href='includes/forms/create_user_form.php'>Create New User</a></li>";
						echo "<li><a href='includes/forms/create_course_form.php'>Create New Course</a></li>";
					}
				?>
    </ul>
    <form class="navbar-form navbar-left">

    </form>

    <ul class="nav navbar-nav navbar-right">
      	<li><a href="logout.php">Log Out</a></li>
      	<li class="divider"></li>
		<li class="navbar-brand"><strong><?php $today = date("F j, Y, g:i a"); echo $today;?></strong></li>
    </ul>
  </div>
</div>
	</HEAD>


	<BODY>
	</BODY>
</HTML>