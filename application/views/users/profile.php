<style type="text/css">
.req::after {
    color: #cc0000;
    content: "*";
    font-size: 14px;
    padding-left: 4px;
}
</style>
<?php if(isset($error)) echo $error; ?>
<div class="row">
	<div class="col-md-6">
		<form method="post" action="<?= site_url("profile"); ?>">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h4 class="panel-title">Basic Information</h4>
				</div>

				<div class="panel-body">
				  	<div class="form-group">
				    	<label class="req">Full Name</label>
				    	<input type="text" class="form-control" name="name" value="<?php if(isset($row_data['name'])) echo $row_data['name']; ?>" id="name" placeholder="Full Name">
				  	</div>
				  	<div class="form-group">
				    	<label>About Me</label>
				    	<textarea name="about" id="about" class="form-control" placeholder="About Me"><?php if(isset($row_data['about'])) echo $row_data['about']; ?></textarea>
				  	</div>
				  	<div class="form-group">
				    	<label>Gender</label>
				    	<select name="gender" id="gender" class="form-control">
							<option value="Not Specified" <?php if(isset($row_data['gender']) && $row_data['gender'] == "Not Specified") echo 'selected="selected"'; ?>>Not Specified</option>
							<option value="Male" <?php if(isset($row_data['gender']) && $row_data['gender'] == "Male") echo 'selected="selected"'; ?>>Male</option>
							<option value="Female" <?php if(isset($row_data['gender']) && $row_data['gender'] == "Female") echo 'selected="selected"'; ?>>Female</option>
						</select>	
				  	</div>
				  	<div class="form-group">
				    	<label>Address</label>
				    	<textarea name="address" id="address" class="form-control" placeholder="Address"><?php if(isset($row_data['address'])) echo $row_data['address']; ?></textarea>
				  	</div>
				  	<div class="form-group">
				    	<label>City</label>
				    	<input type="text" class="form-control" name="city" value="<?php if(isset($row_data['city'])) echo $row_data['city']; ?>" id="city" placeholder="City">
				  	</div>
				  	<div class="form-group">
				    	<label>Country</label>
				    	<input type="text" class="form-control" name="country" value="<?php if(isset($row_data['country'])) echo $row_data['country']; ?>" id="country" placeholder="Country">
				  	</div>
				  	<div class="form-group">
				    	<label>Contact Number</label>
				    	<input type="text" class="form-control" name="contact" value="<?php if(isset($row_data['contact'])) echo $row_data['contact']; ?>" id="contact" placeholder="Contact Number">
				  	</div>
				</div>
				
				<div class="panel-footer">
				  	<div class="form-group">
				  		<button type="submit" class="btn btn-primary">Update Profile</button>
				  	</div>
				</div>
			</div>
		</form>
	</div>

	<div class="col-md-6">
		<form method="post" action="<?= site_url("profile"); ?>">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h4 class="panel-title">Account Information</h4>
				</div>
				<div class="panel-body">
				  	<div class="form-group">
				    	<label>User Name</label>
				    	<input type="text" readonly="readonly" class="form-control" name="username" value="<?php if(isset($row_data['username'])) echo $row_data['username']; ?>" id="username" placeholder="User Name">
				  	</div>
				  	<div class="form-group">
				    	<label>Email</label>
				    	<input type="email" readonly="readonly" class="form-control" name="email" value="<?php if(isset($row_data['email'])) echo $row_data['email']; ?>" id="email" placeholder="E-name">
				  	</div>
				  	<div class="form-group">
				    	<label>Password</label>
				    	<input type="password" class="form-control" name="password" value="" id="password" placeholder="Password">
				  	</div>
				  	<div class="form-group">
				    	<label>Re Type Password</label>
				    	<input type="password" class="form-control" name="cpassword" value="" id="cpassword" placeholder="Re Type Password">
				  	</div>
				  	<div class="form-group">
				    	<label>Verify by Old Password</label>
				    	<input type="password" class="form-control" name="oldpassword" value="" id="oldpassword" placeholder="Verify by Old Password">
				  	</div>
				</div>
				<div class="panel-footer">
				  	<div class="form-group">
				  		<input type="hidden" name="cp" value="Change Password" />
				  		<button type="submit" class="btn btn-primary">Change Password</button>
				  	</div>
				</div>
			</div>
		</form>
	</div>
</div>