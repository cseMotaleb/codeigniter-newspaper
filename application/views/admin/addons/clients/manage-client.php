<div class="row">
	<div class="col-lg-6">
		<h1 class="page-title txt-color-blueDark">
			<i class="fa-fw fa fa-pencil-square-o"></i> Manage Client
		</h1>
	</div>
	<div class="col-lg-6">
		<div class="btn-group btn-sm pull-right">
			<button class="btn btn-success pull-right changeURL" data-url="#clients/"><i class="fa fa-navicon"></i> Client List</button>
			<button class="btn btn-danger pull-right changeURL" data-url="#clients/manage/"><i class="fa fa-list-alt"></i> Add Client</button>
		</div>
	</div>
</div>

<form action="<?= site_url("admin/clients/manage/{$mode}/{$current_id}"); ?>" method="post" id="validate-form">
	<div class="panel panel-default">
	  	<div class="panel-heading">
	  		<div class="pull-left">
		    	<h3 class="panel-title">
		    		<span class="text-danger"><strong><?= ucfirst($mode); ?></strong></span> Client
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
	  			<div class="col-md-8">	
			    	<div class="formSep">
					   	<label class="req">Client Name</label>
					   	<input class="form-control" type="text" name="client" id="client" placeholder="Enter client name" value="<?php if(isset($row_data['client'])) echo $row_data['client']; ?>" />
			    	</div>
	  			</div>
	  			<div class="col-md-4">	
			    	<div class="formSep">
					   	<label class="req">URL</label>
					   	<input class="form-control" type="text" name="url" id="url" placeholder="Enter URL" value="<?php if(isset($row_data['url'])) echo $row_data['url']; ?>" />
			    	</div>
	  			</div>
	  		</div>

			<hr />

			<div class="panel panel-default">
				<div class="panel-heading">Details</div>
				<textarea class="ckeditor" id="details" name="details"><?php if(isset($row_data['details'])) echo $row_data['details']; else echo set_value('details');?></textarea>
			</div>

	    	<hr />

	    	<?php
				$default_image = (isset($row_data['image']) && !empty($row_data['image']) && file_exists("./uploads/clients/{$row_data['image']}")) ? base_url()."uploads/clients/{$row_data['image']}" : "holder.js/165x160";
            ?>
	  		<div class="form_sep">
         		<label for="userName">Client Image</label>
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
				<button type="submit" class="btn btn-lg btn-primary"><?php if($mode == "edit") echo "Update"; else echo "Add"; ?> Client</button>
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
					client : {
						required : true
					}
				},
				messages : {
					client : {
						required : 'Please enter client name'
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