<?php
	require_once '../../config.php';
?>

<HTML>

	<STYLE>
	    <?php 
	        include ROOT_PATH . "/css/bootstrap.css";
	    ?>
	</STYLE>

	<BODY>
		<div class="panel panel-primary">
		  <div class="panel-heading">
		    <h3 class="panel-title">Login</h3>
		  </div>
		  <div class="panel-body">
		    <div class="container">
				<form class="form-horizontal" action= '../../scripts/login.php' method="POST">
				  <fieldset>
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
			</div>
		  </div>
		</div>
	</BODY>
</HTML>