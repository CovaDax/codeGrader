<?php session_start(); 
	if($_SESSION['role']!="ADMIN"){
		header("Location:../../index.php");
	}
	echo "<STYLE>";
		include("../../resources/bootstrap.css");
	echo "</STYLE>";

	$_SESSION['currentuser'] = $_GET['uin'];
?>

<form class="form-horizontal" action='../CRUD/updateuser.php' method="POST">
  <fieldset>
    <legend>Edit User</legend>
    <div class="form-group">
    	<!--username-->	
		<label for="inputDefault" class="col-lg-2 control-label">Username</label>
		<div class="col-lg-10">
			<input type="text" class="form-control" id="inputDefault" placeholder="Username" name="username">
		</div>

		<!-- Password -->
		<label for="inputPassword" class="col-lg-2 control-label">Password</label>
      	<div class="col-lg-10">
        	<input type="password" class="form-control" id="inputPassword" placeholder="Password" name="password">
	  	</div>

		<!--email -->
	    <label for="inputEmail" class="col-lg-2 control-label">Email</label>
	    <div class="col-lg-10">
	    	<input type="text" class="form-control" id="inputEmail" placeholder="Email" name="email">
	    </div>
    </div>

    <div class="form-group">
	    <label for="inputDefault" class="col-lg-2 control-label">First Name</label>
		<div class="col-lg-10">
			<input type="text" class="form-control" id="inputDefault" placeholder="First Name" name="firstName">
		</div>

		<label for="inputDefault" class="col-lg-2 control-label">Last Name</label>
		<div class="col-lg-10">
			<input type="text" class="form-control" id="inputDefault" placeholder="Last Name" name="lastName">
		</div>

    </div>

    <div class="form-group">
      <label class="col-lg-2 control-label">Radios</label>
      <div class="col-lg-10">
        <div class="radio">
          <label>
            <input type="radio" name="role" id="optionsRadios1" value="STUDENT" checked="">
            STUDENT
          </label>
        </div>
        <div class="radio">
          <label>
            <input type="radio" name="role" id="optionsRadios2" value="INSTRUCTOR">
            INSTRUCTOR
          </label>
        </div>

        <div class="radio">
          <label>
            <input type="radio" name="role" id="optionsRadios3" value="ADMIN">
            ADMIN
          </label>
        </div>
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