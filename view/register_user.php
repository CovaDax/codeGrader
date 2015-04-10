<?php
	include_once '../config.php';
	include_once '../scripts/register_user.php';
	echo "<STYLE>";
		include_once ROOT_PATH . "/css/bootstrap.css";
		include_once 'templates/navbar.php';
	echo "</STYLE>";
?>

<BODY>
	<div class="jumbotron" style="padding: 30px; margin: 30px">
	<?php echo "<form class='form-horizontal' action='../scripts/register.php?id=" . $users[0]['id'] . "' method='POST' style='padding: 1%'>"; ?>
			<fieldset>
				<legend>Register User</legend>
				<div class="form_group">
					<label for="userName" class="col-lg-2 control-label">
						<?php echo $users[0]['username']; ?>
					</label>
				</div>
				<label for="select" class="col-lg-2 control-label">Selects</label>
			    	<div class="col-lg-8">
				        <select class="form-control" id="select" name="courses">
					          <?php
					          	foreach ($courses as $key => $course) {
					          		echo "<option value=" . $course['crn'] . ">" . $course['title'] . "</option>";
					          	}
					          ?>
					    </select>
			      	</div>
			      	<div class="form-group">
					    <div class="col-lg-10 col-lg-offset-2">
					    	<button class="btn btn-default">Cancel</button>
					        <input type="submit" class="btn btn-primary">
					    </div>
				    </div>
			</fieldset>
		</form>
	</div>
</BODY>