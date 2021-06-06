<div class="row">
	<div class="col-lg-6">
		<h1 class="page-title txt-color-blueDark">
			<i class="fa-fw fa fa-list"></i> Users
		</h1>
	</div>
	<div class="col-lg-6 pull-right">
		<button class="btn btn-primary changeURL pull-right" data-url="#users/userlist"><i class="fa fa-list"></i> User List</button>
		<button class="btn btn-danger changeURL pull-right" data-url="#users/manage"><i class="fa fa-plus-circle"></i> Add User</button>
	</div>
</div>

<div class="row">
    <div class="col-md-8">
        <form action="<?= site_url("admin/users/manage/{$mode}/{$current_id}"); ?>" method="post" id="validate-form">	
                <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title"><strong><?= ucfirst($mode); ?></strong> User</h3>
                        </div>

                        <div class="panel-body">
                                <div class="row">
                                        <div class="col-md-6">
                                        <div class="formSep">
                                                        <label class="req">First Name</label>
                                                        <input class="form-control" type="text" name="first_name" id="first_name" placeholder="Enter first name" value="<?php if(isset($row_data['first_name'])) echo $row_data['first_name']; ?>" />
                                        </div>
                                        </div>
                                        <div class="col-md-6">
                                        <div class="formSep">
                                                        <label class="req">Last Name</label>
                                                        <input class="form-control" type="text" name="last_name" id="last_name" placeholder="Enter last name" value="<?php if(isset($row_data['last_name'])) echo $row_data['last_name']; ?>" />
                                        </div>
                                        </div>
                                </div>

                                <hr />

                                <div class="row">
                                        <div class="col-md-6">
                                        <div class="formSep">
                                                        <label class="req">E-mail</label>
                                                        <input class="form-control" type="email" name="email" id="email" placeholder="Enter email address" value="<?php if(isset($row_data['email'])) echo $row_data['email']; ?>" />
                                        </div>
                                        </div>
                                        <div class="col-md-6">
                                        <div class="formSep">
                                                        <label class="req">Password</label>
                                                        <input class="form-control" type="text" name="password" id="password" placeholder="Enter password" value="<?php if(isset($row_data['password'])) echo $row_data['password']; ?>" />
                                        </div>
                                        </div>
                                </div>

                                <hr />
                                
                                <div class="row">
                                    <div class="col-md-6">
                                        <label class="req">User Type</label>
                                        <select class="select2" name="user_type" id="user_type">
                                            <option value="Admin" <?php if(isset($row_data['user_type']) && ($row_data['user_type'] == 'Admin')) echo 'selected'; ?>>Admin</option>
                                            <option value="Employee" <?php if(isset($row_data['user_type']) && ($row_data['user_type'] == 'Employee')) echo 'selected'; ?>>Employee</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="req">Password</label>
                                        <select class="select2" name="enabled" id="enabled">
                                            <option value="1" <?php if(isset($row_data['enabled']) && ($row_data['enabled'] == 1)) echo 'selected'; ?>>Enabled</option>
                                            <option value="0" <?php if(isset($row_data['enabled']) && ($row_data['enabled'] == 0)) echo 'selected'; ?>>Disabled</option>
                                        </select>
                                    </div>
                                </div>
                                
                                <hr />

                        <?php $image = (isset($row_data['image']) && !empty($row_data['image']) && file_exists("./uploads/agents/{$row_data['image']}")) ? base_url() . "uploads/agents/{$row_data['image']}" : "holder.js/165x160"; ?>
                                <div class="form_sep">
                                <label for="userName">Image</label>
                        <div class="fileupload fileupload-new" data-provides="fileupload">
                            <div class="fileupload-new img-thumbnail" style="width: 178px; height: 120px;">
                                <img src="<?= $image; ?>" alt="">
                            </div>
                            <div class="fileupload-preview fileupload-exists img-thumbnail" style="width: 178px; height: 120px"></div>
                            <div>
                                <span class="btn btn-default btn-file">
                                        <span class="fileupload-new">Select image</span>
                                        <span class="fileupload-exists">Change</span>
                                        <input name="userfile" id="userfile" type="file" />
                                </span>
                                <a href="#" class="btn btn-default fileupload-exists" data-dismiss="fileupload">Remove</a>
                            </div>
                        </div>
                                </div>
                        </div>

                        <div class="panel-footer">
                                <div class="formSep">
                                        <input type="hidden" name="id" value="<?php if(isset($current_id)) echo $current_id; ?>" />
                                        <button type="submit" class="btn btn-lg btn-primary"><i class="fa fa-floppy-o"></i> <?php if($mode == "edit") echo "Update"; else echo "Save"; ?> User</button>
                                </div>
                        </div>
                </div>
        </form>
    </div>
</div>


<?php $this->load->view("admin/common-delete-modal");

?>
<script src="<?= base_url(); ?>assets/js/holder.min.js"></script>
<script src="<?= base_url(); ?>assets/admin/js/custom.js"></script>
<script type="text/javascript">
	pageSetUp();

	$(document).ready(function() {
		var pagefunction = function() {
			var $checkoutForm = $('#validate-form').validate({
				rules : {
					first_name : {
						required : true
					},
					last_name : {
						required : true
					},
					email : {
						required : true
					},
					password : {
						required : true
					}	
				},
				messages : {
					first_name : {
						required : 'Please enter first name'
					},
					last_name : {
						required : 'Please enter last name'
					},
					email : {
						required : 'Please enter email'
					},
					password : {
						required : 'Please enter password'
					}
				},
				submitHandler : function(form) {
					$(form).ajaxSubmit({
						success : processJson
					});
				},
				errorPlacement : function(error, element) {
					error.insertAfter(element.parent());
				}
			});

			function processJson(data) {
				var obj = jQuery.parseJSON( data );
			    $.bigBox({
			      	title: obj.mtitle,
			      	content: obj.mcontent,
			      	color: obj.mcolor,
			      	iconSmall: obj.miconSmall,
			      	timeout: 10000
			    });

			    if(obj.mcode == 200) {
			    	
			    }
			};
		};

		loadScript("<?= site_url('assets/admin/js/plugin/jquery-form/jquery-form.min.js'); ?>", pagefunction);
	});
</script>