<?php 
  require_once '../../config.php';

  session_start(); 
	if($_SESSION['role']!="ADMIN"){
		header("Location:http://" . $relative . "/index.php");
	}

	echo "<STYLE>";
		include_once ROOT_PATH . '/css/bootstrap.css';
	echo "</STYLE>";
?>

<form class="form-horizontal" action='../../scripts/create_course.php' method="POST">
  <fieldset>
    <legend>Create Course</legend>
    <div class="form-group">
    	<!--username-->	
		<label for="inputDefault" class="col-lg-2 control-label">Title</label>
		<div class="col-lg-4">
			<input type="text" class="form-control" id="inputDefault" placeholder="Introduction to Programming" name="title">
			<input type="text" class="form-control" id="inputDefault" placeholder="12345" name="crn">
		</div>
    </div>

    <div class="form-group">
	    <label for="inputDefault" class="col-lg-2 control-label">Catalog</label>
		<div class="col-lg-2">
			<input type="text" class="form-control" id="inputDefault" placeholder="COP" name="department">
		</div>

		<div class="col-lg-2">
			<input type="text" class="form-control" id="inputDefault" placeholder="2001" name="section">
		</div>
    </div>
    
    <div class="form-group">
      <div class="col-lg-10 col-lg-offset-2">
        <button class="btn btn-default">Cancel</button>
        <input type="submit" class="btn btn-primary">
      </div>
    </div>
  </fieldset>
</form>
Back to topBlogRSSTwitterGitHubAPISupport
Made by Thomas Park. Contact him at thomas@bootswatch.com.
Code released under the MIT License.
Based on Bootstrap. Icons from Font Awesome. Web fonts from Google.