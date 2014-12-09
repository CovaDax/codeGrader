<?php session_start(); 
	echo "<STYLE>";
		include("../../resources/bootstrap.css");
	echo "</STYLE>";
?>

<form class="form-horizontal" action='../CRUD/createassignment.php' method="POST">
  <fieldset>
    <legend>Create Assignment</legend>
    <div class="form-group">
    	<!--username-->	
		<label for="inputDefault" class="col-lg-2 control-label">Title</label>
		<div class="col-lg-5">
			<input type="text" class="form-control" id="inputDefault" placeholder="Assignment #1" name="title">
		</div>
    </div>

    <div class="form-group">
	    <label for="inputDefault" class="col-lg-2 control-label">Deadline</label>
		<div class="col-lg-5">
			<input type="date" class="form-control" id="inputDefault" name="deadlinedate">
			<input type="time" class="form-control" id="inputDefault" name="deadlinetime">
		</div>
    </div>

    <div class="form-group">
      <label for="textArea" class="col-lg-2 control-label">Description</label>
      <div class="col-lg-5">
        <textarea class="form-control" rows="3" id="textArea" name="description"></textarea>
        <span class="help-block">A longer block of help text that breaks onto a new line and may extend beyond one line.</span>
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