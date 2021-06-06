
<div class="row">
	<div class="col-md-2"></div>
	<div class="col-md-8">
		<div class="well login-area">
			<h2 class="login-title">Register</h2>

			<?php if(isset($error)) echo $error; ?>

			<form method="post" action="<?= site_url("register"); ?>">
			  	<div class="form-group">
			    	<label class="req">Full Name</label>
			    	<input type="text" name="name" value="" class="form-control" id="name" placeholder="Full Name">
			  	</div>
			  	<div class="form-group">
			    	<label class="req">User Name</label>
			    	<input type="text" class="form-control" name="username" value="" id="username" placeholder="User Name">
			  	</div>
			  	<div class="form-group">
			    	<label class="req">Email</label>
			    	<input type="email" class="form-control" name="email" value="" id="email" placeholder="Email">
			  	</div>
			  	<div class="form-group">
			    	<label class="req">Password</label>
			    	<input type="password" class="form-control" name="password" value="" id="password" placeholder="Password">
			  	</div>
			  	<div class="form-group">
			    	<label class="req">Re Type Password</label>
			    	<input type="password" class="form-control" name="cpassword" value="" id="cpassword" placeholder="Re Type Password">
			  	</div>
			  	<div class="checkbox">
			    	<label>
			      		<input name="terms" id="terms" type="checkbox"> I agree <a class="text-primary" href="<?= site_url("terms-conditions"); ?>">Terms & Conditions</a>
			    	</label>
			  	</div>
			  	<div class="form-group">
					<?= $widget; ?>
					<?= $script; ?>
			  	</div>
			  	<div class="form-group">
			  		<button type="submit" class="btn btn-primary login-btn">Submit</button>
			  	</div>
			</form>
		</div>
	</div>
</div>