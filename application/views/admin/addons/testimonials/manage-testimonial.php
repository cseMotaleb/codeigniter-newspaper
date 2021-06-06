<div class="row">
	<div class="col-lg-6">
		<h1 class="page-title txt-color-blueDark">
			<i class="fa-fw fa fa-pencil-square-o"></i> Manage Testimonial
		</h1>
	</div>
	<div class="col-lg-6">
		<div class="btn-group btn-sm pull-right">
			<button class="btn btn-success pull-right changeURL" data-url="#testimonials/">
				<i class="fa fa-list"></i> Testimonial List
			</button>
			<button class="btn btn-danger pull-right changeURL" data-url="#testimonials/manage/">
				<i class="fa fa-plus-circle"></i> Add Testimonial
			</button>
		</div>
	</div>
</div>

<form action="<?= site_url("admin/testimonials/manage/{$mode}/{$current_id}"); ?>" method="post" id="validate-form">
	<div class="panel panel-primary">
	  	<div class="panel-heading">
	  		<div class="pull-left">
		    	<h3 class="panel-title">
		    		<strong><?= ucfirst($mode); ?></strong> Testimonial
				</h3>
			</div>
			<div class="pull-right">
				<select style="color: #000;" name="enabled" id="enabled">
					<option value="1" <?php if(isset($row_data['enabled']) && $row_data['enabled'] == 1) echo 'selected'; ?>>Enabled</option>
					<option value="0" <?php if(isset($row_data['enabled']) && $row_data['enabled'] == 0) echo 'selected'; ?>>Disabled</option>
				</select>
			</div>
			<div class="clearfix"></div>
	  	</div>

	  	<div class="panel-body">
    		<div class="row">
    			<div class="col-md-4">
	    			<div class="formSep">
					   	<label class="req">Name</label>
					   	<input class="form-control" type="text" name="name" id="name" placeholder="Enter name" value="<?php if(isset($row_data['name'])) echo $row_data['name']; ?>" />
					</div>
				</div>
				<div class="col-md-4">
	    			<div class="formSep">
	    				<label>Company Name</label>
            			<input class="form-control" type="text" name="company_name" id="company_name" placeholder="Enter company name" value="<?php if(isset($row_data['company_name'])) echo $row_data['company_name']; ?>" />
	    			</div>
	    		</div>
	    		<div class="col-md-4">
	    			<div class="formSep">
	    				<label>Designation</label>
            			<input class="form-control" type="text" name="designation" id="designation" placeholder="Enter designation" value="<?php if(isset($row_data['designation'])) echo $row_data['designation']; ?>" />
	    			</div>
				</div>
	    	</div>

	    	<hr />

    		<div class="row">
				<div class="col-md-4">
	    			<div class="formSep">
					   	<label>Phone</label>
					  	<input class="form-control" type="text" name="phone" id="phone" placeholder="Enter phone number" value="<?php if(isset($row_data['phone'])) echo $row_data['phone']; ?>" />
					</div>
				</div>
	    		<div class="col-md-4">
	    			<div class="formSep">
	    				<label>Mobile</label>
            			<input class="form-control" type="text" name="mobile" id="mobile" placeholder="Enter mobile number" value="<?php if(isset($row_data['mobile'])) echo $row_data['mobile']; ?>" />
	    			</div>
	    		</div>
				<div class="col-md-4">
	    			<div class="formSep">
					   	<label>Email</label>
					  	<input class="form-control" type="email" name="email" id="email" placeholder="Enter email address" value="<?php if(isset($row_data['email'])) echo $row_data['email']; ?>" />
					</div>
	    		</div>
	    	</div>

	    	<hr />

    		<div class="row">
    			<div class="col-md-4">
    				<label>Web</label>
        			<input class="form-control" type="text" name="web" id="web" placeholder="Enter web address" value="<?php if(isset($row_data['web'])) echo $row_data['web']; ?>" />
    			</div>
				<div class="col-md-4">
	    			<div class="formSep">
					   	<label>Publish Date</label>
					  	<input class="form-control edatepicker" type="text" name="publish_date" id="publish_date" placeholder="Enter publish date" value="<?php if(isset($row_data['publish_date'])) echo $row_data['publish_date']; ?>" />
					</div>
	    		</div>
				<div class="col-md-4">
	    			<div class="formSep">
					   	<label>Show Home</label>
						<select name="enabled" id="enabled" class="select2">
							<option value="1" <?php if(isset($row_data['show_home']) && $row_data['show_home'] == 1) echo 'selected'; ?>>Yes</option>
							<option value="0" <?php if(isset($row_data['show_home']) && $row_data['show_home'] == 0) echo 'selected'; ?>>No</option>
						</select>
					</div>
				</div>
	    	</div>

			<hr />

			<div class="panel panel-default">
				<div class="panel-heading">Details</div>
    			<textarea class="small_ckeditor" id="testimonial" name="testimonial"><?php if(isset($row_data['testimonial'])) echo $row_data['testimonial']; else echo set_value('testimonial');?></textarea>
	    	</div>

			<?php
				$testimonial_image = (isset($row_data['image']) && !empty($row_data['image']) && file_exists("./uploads/testimonials/{$row_data['image']}")) ? base_url() . "uploads/testimonials/{$row_data['image']}" : "holder.js/165x160";
   			?>
   			 <div class="formSep">
       			 <div class="row">
					<div class="col-md-12">
					    <label for="userName">Image</label>
		                <div class="fileupload fileupload-new" data-provides="fileupload">
		                    <div class="fileupload-new img-thumbnail" style="width: 178px; height: 120px;">
		                    	<img src="<?= $testimonial_image; ?>" alt="">
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
	    	</div>
		</div>
		
		<div class="panel-footer">
			<div class="text-center">
				<input type="hidden" name="id" value="<?php if(isset($current_id)) echo $current_id; ?>" />
				<button type="submit" class="btn btn-lg btn-primary"><i class="fa fa-floppy-o"></i> <?php if($mode == "edit") echo "Update"; else echo "Save"; ?> Testimonial</button>
			</div>
		</div>
	</div>
</form>

<?php $this->load->view("admin/common-delete-modal"); ?>

<script src="<?= base_url(); ?>assets/admin/js/custom.js"></script>
<script src="<?= base_url(); ?>assets/js/holder.min.js"></script>
<script type="text/javascript">
	pageSetUp();

	$(document).ready(function() {
		var pagefunction = function() {
			CKEDITOR.instances['testimonial'].on('change', function() { CKEDITOR.instances['testimonial'].updateElement() });
			var $checkoutForm = $('#validate-form').validate({
				rules : {
					name : {
						required : true
					}
				},
				messages : {
					name : {
						required : 'Please enter name'
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
	            	setTimeout(function() {
	            		location.reload();
	            	}, 500);
	            }
			};
		};

		loadScript("<?= site_url('assets/admin/js/plugin/jquery-form/jquery-form.min.js'); ?>", pagefunction);
	});
</script>