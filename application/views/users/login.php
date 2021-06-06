<div class="row">
	<div class="col-md-2"></div>
	<div class="col-md-8">
		<div class="well login-area">
			<h2 class="login-title">Login</h2>
			
			<hr />

			<?php if(isset($error)) echo $error; ?>

			<form method="post" action="<?= site_url("login"); ?>">
			  	<div class="form-group">
			    	<label class="req">User Name / Email</label>
			    	<input type="text" class="form-control" name="user" value="" id="user" placeholder="User Name / Email">
			  	</div>
			  	<div class="form-group">
			    	<label class="req">Password</label>
			    	<input type="password" class="form-control" name="password" value="" id="password" placeholder="Password">
			  	</div>
			  	<div class="checkbox">
			    	<label>
			      		<input name="terms" id="terms" type="checkbox"> Remember my login
			    	</label>
			  	</div>
			  	<div class="form-group">
					<?= $widget; ?>
					<?= $script; ?>
			  	</div>
			  	<div class="form-group">
			  		<button type="submit" class="btn btn-primary login-btn">Login</button>
			  	</div>
			  	
			  	<hr />
			  	
			  	<div class="form-group">
			  		<div class="pull-left">
			  			<a class="text-primary" href="<?= site_url("register"); ?>">Don't Have an Account</a>
			  		</div>
			  		<div class="pull-right">
			  			<?php /* <a class="text-primary" href="">Forgot Password?</a> */ ?>
			  		</div>
			  		
			  		<div class="clearfix"></div>
			  	</div>
			</form>
		</div>
	</div>
</div>
