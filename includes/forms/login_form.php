<HTML>

<STYLE>
	<?php include("../../resources/bootstrap.css"); ?>
</STYLE>

<form class="form-horizontal" action='../../login.php' method="POST">
  <fieldset>
    <legend>Login</legend>
    <div class="form-group">
    	<!--username-->	
		<label for="inputDefault" class="col-lg-2 control-label">Username</label>
		<div class="col-lg-5">
			<input type="text" class="form-control" id="inputDefault" placeholder="username" name="username">
		</div>
    </div>

    <div class="form-group">
	    <label for="inputDefault" class="col-lg-2 control-label">Password</label>
		<div class="col-lg-5">
			<input type="password" class="form-control" id="inputDefault" placeholder="password" name="password">
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

</HTML>