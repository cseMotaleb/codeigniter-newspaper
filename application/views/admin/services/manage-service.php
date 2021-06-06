<div class="row">
	<div class="col-lg-6">
		<h1 class="page-title txt-color-blueDark">
			<i class="fa-fw fa fa-pencil-square-o"></i> Manage Service
		</h1>
	</div>
	<div class="col-lg-6">
		<div class="btn-group btn-sm pull-right">
			<button class="btn btn-success pull-right changeURL" data-url="#services/"><i class="fa fa-navicon"></i> Service List</button>
			<button class="btn btn-danger pull-right changeURL" data-url="#services/manage/"><i class="fa fa-list-alt"></i> Add Service</button>
		</div>
	</div>
</div>

<form action="<?= site_url("admin/services/manage/{$mode}/{$current_id}"); ?>" method="post" id="validate-form">
	<div class="panel panel-default">
	  	<div class="panel-heading">
	  		<div class="pull-left">
		    	<h3 class="panel-title">
		    		<span class="text-danger"><strong><?= ucfirst($mode); ?></strong></span> Service
				</h3>
	  		</div>
	  		<div class="pull-right">
                <select name="enabled" id="enabled">
                    <option value="1" <?php if(isset($row_data['enabled']) && $row_data['enabled'] == '1') echo 'selected'; ?>>Enabled</option>
                    <option value="0" <?php if(isset($row_data['enabled']) && $row_data['enabled'] == '0') echo 'selected'; ?>>Disabled</option>
                </select>
	  		</div>
	  		<div class="clearfix"></div>
	  	</div>
	
	  	<div class="panel-body">
	  		<div class="row">
	  			<div class="col-md-9">
			    	<div class="formSep">
					   	<label class="req">Service Name</label>
					   	<input class="form-control" type="text" name="service_name" id="service_name" placeholder="Enter service name" value="<?php if(isset($row_data['service_name'])) echo $row_data['service_name']; ?>" />
			    	</div>
	  			</div>
	  			<div class="col-md-3">
					<label>Show Homepage</label>
	                <select name="homepage" id="homepage" class="select2">
	                    <option value="1" <?php if(isset($row_data['homepage']) && $row_data['homepage'] == 1) echo 'selected'; ?>>Yes</option>
	                    <option value="0" <?php if(isset($row_data['homepage']) && $row_data['homepage'] == 0) echo 'selected'; ?>>No</option>
	                </select>
	  			</div>
	  		</div>

            <hr />

            <div class="formSep">
                <label>Meta Title</label>
                <input class="form-control" type="text" name="meta_title" id="meta_title" placeholder="Enter meta title" value="<?php if(isset($row_data['meta_title'])) echo $row_data['meta_title']; ?>" />
            </div>

            <hr />

			<div class="row">
				<div class="col-md-6">
		            <div class="formSep">
		                <label>Meta Keyword</label>
		                <input class="form-control" type="text" name="meta_keyword" id="meta_keyword" placeholder="Enter meta keyword" value="<?php if(isset($row_data['meta_keyword'])) echo $row_data['meta_keyword']; ?>" />
		            </div>
				</div>
				<div class="col-md-6">
		            <div class="formSep">
		                <label>Meta Description</label>
		                <input class="form-control" type="text" name="meta_description" id="meta_description" placeholder="Enter meta description" value="<?php if(isset($row_data['meta_description'])) echo $row_data['meta_description']; ?>" />
		            </div>
				</div>
			</div>

			<hr />

            <div class="formSep">
                <label>Short Description</label>
                <textarea name="short_details" id="short_details" placeholder="Short Description" class="form-control"><?php if(isset($row_data['short_details'])) echo $row_data['short_details']; else echo set_value('short_details'); ?></textarea>
            </div>

			<hr />

			<div class="panel panel-default">
				<div class="panel-heading">Details</div>
				<textarea class="ckeditor" id="details" name="details"><?php if(isset($row_data['details'])) echo $row_data['details']; else echo set_value('details');?></textarea>
			</div>

	    	<hr />

	    	<?php
				$default_image = (isset($row_data['image']) && !empty($row_data['image']) && file_exists("./uploads/services/{$row_data['image']}")) ? base_url()."uploads/services/{$row_data['image']}" : "holder.js/165x160";
            ?>
	  		<div class="form_sep">
         		<label for="userName">News Image</label>
                <div class="fileupload fileupload-new" data-provides="fileupload">
                    <div class="fileupload-new img-thumbnail" style="width: 178px; height: 120px;">
                    	<img src="<?= $default_image; ?>" alt="">
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
			<div class="text-center">
				<input type="hidden" name="id" value="<?php if(isset($current_id)) echo $current_id; ?>" />
				<button type="submit" class="btn btn-lg btn-primary"><?php if($mode == "edit") echo "Update"; else echo "Add"; ?> Service</button>
			</div>
		</div>
	</div>
</form>

<?php $this->load->view("admin/common-delete-modal"); ?>

<script src="<?= base_url(); ?>assets/js/holder.min.js"></script>
<script src="<?= base_url(); ?>assets/admin/js/custom.js"></script>
<script type="text/javascript">
	pageSetUp();

	$(document).ready(function() {
		var pagefunction = function() {
			CKEDITOR.instances['details'].on('change', function() { CKEDITOR.instances['details'].updateElement() });

			var $checkoutForm = $('#validate-form').validate({
				rules : {
					service_name : {
						required : true
					}
				},
				messages : {
					service_name : {
						required : 'Please enter News Title'
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
			};
		};

		loadScript("<?= site_url('assets/admin/js/plugin/jquery-form/jquery-form.min.js'); ?>", pagefunction);
	});
</script>