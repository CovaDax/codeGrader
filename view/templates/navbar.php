<?php
  session_start();
?>
<STYLE><?php include ROOT_PATH . "/css/bootstrap.css"; ?></STYLE>

<nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
        <?php
          echo "<a href='" . $root . "/view/templates/forms/update_user_form.php' class='navbar-brand'>" . $_SESSION['firstName'] . " " .  $_SESSION['lastName'] . "</a>";
    ?>
    </div>

    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <?php
          echo "<li class='active'><a href='http://" . $root . "/index.php'>Home <span class='sr-only'>(current)</span></a></li>";
          //echo "<li><a href='" . $root . "/scripts/allusers.php'>Users</a></li>";
      if($_SESSION['role'] == "ADMIN"){
        echo "<li><a href='http://" . $root . "/view/allusers.php'>Users</a></li>";
        echo "<li><a href='http://" . $root . "/view/templates/create_user.php'>Create New User</a></li>";
        echo "<li><a href='http://" . $root . "/view/templates/create_course.php'>Create New Course</a></li>";
      }
    ?>
        </li>
      </ul>
      <form class="navbar-form navbar-left" role="search">

      </form>
      <ul class="nav navbar-nav navbar-right">
    <?php
      if(isset($_SESSION['username']))
          echo "<li><a href='http://" . $root . "/scripts/logout.php'>Logout</a></li>";
        else 
          echo "<li><a href='http://" . $root . "/view/templates/forms/login_form.php'>Login</a></li>";
    ?>
      </ul>
    </div>
  </div>
</nav>