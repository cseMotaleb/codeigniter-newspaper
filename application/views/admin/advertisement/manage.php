<div class="row">
	<div class="col-lg-6">
		<h1 class="page-title txt-color-blueDark">
			<i class="fa-fw fa fa-pencil-square-o"></i> Manage Advertise
		</h1>
	</div>
	<div class="col-lg-6">
		<div class="btn-group btn-sm pull-right">
			<button class="btn btn-success pull-right changeURL" data-url="#advertisement/"><i class="fa fa-navicon"></i> Advertise List</button>
			<?php /* <button class="btn btn-danger pull-right changeURL" data-url="#advertisement/manage/"><i class="fa fa-list-alt"></i> Add Advertise</button> */?>
		</div>
	</div>
</div>

<form action="<?= site_url("admin/advertisement/manage/{$mode}/{$current_id}"); ?>" method="post" id="validate-form">		
	<div class="panel panel-primary">
	  	<div class="panel-heading">
	  		<div class="pull-left">
		    	<h3 class="panel-title">
		    		<strong><?= ucfirst($mode); ?></strong> Advertise
				</h3>
	  		</div>
	  		<div class="pull-right">
	  		</div>
	  		<div class="clearfix"></div>
	  	</div>
	
	  	<div class="panel-body">
	  		<div class="row">
	  			<div class="col-md-6">	
			    	<div class="formSep">
					   	<label>Name</label>
					   	<input class="form-control" type="text" name="name" id="name" placeholder="Enter name" value="<?php if(isset($row_data['name'])) echo $row_data['name']; ?>" />
			    	</div>
	  			</div>
	  			<div class="col-md-6">	
			    	<div class="formSep">
					   	<label>URL</label>
					   	<input class="form-control" type="text" name="url" id="url" placeholder="Enter URL" value="<?php if(isset($row_data['url'])) echo $row_data['url']; ?>" />
			    	</div>
	  			</div>
	  		</div>
	  		
	  		<hr />
	  		
	  		<div class="row">
	  			<div class="col-md-6">	
			    	<div class="formSep">
					   	<label class="req">Position</label>
					   	<select class="select2" name="position" id="position">
					   		<option value="Top Banner" <?php if(isset($row_data['position']) && $row_data['position'] == "Top Banner") echo 'selected="selected"'; ?>>Top Banner</option>
					   		<option value="Top Banner 1" <?php if(isset($row_data['position']) && $row_data['position'] == "Top Banner 1") echo 'selected="selected"'; ?>>Top Banner 1</option>
					   		<option value="Top Banner 2" <?php if(isset($row_data['position']) && $row_data['position'] == "Top Banner 2") echo 'selected="selected"'; ?>>Top Banner 2</option>
					   		<option value="Top Banner 3" <?php if(isset($row_data['position']) && $row_data['position'] == "Top Banner 3") echo 'selected="selected"'; ?>>Top Banner 3</option>
					   		<option value="Top Banner 4" <?php if(isset($row_data['position']) && $row_data['position'] == "Top Banner 4") echo 'selected="selected"'; ?>>Top Banner 4</option>
					   		<option value="Home List 1" <?php if(isset($row_data['position']) && $row_data['position'] == "Home List 1") echo 'selected="selected"'; ?>>Home List 1 (970px * 90px)</option>
					   		<option value="Home List 2" <?php if(isset($row_data['position']) && $row_data['position'] == "Home List 2") echo 'selected="selected"'; ?>>Home List 2 (970px * 90px)</option>
					   		<option value="Home List 3" <?php if(isset($row_data['position']) && $row_data['position'] == "Home List 3") echo 'selected="selected"'; ?>>Home List 3 (970px * 90px)</option>
					   		<option value="Home List 4" <?php if(isset($row_data['position']) && $row_data['position'] == "Home List 4") echo 'selected="selected"'; ?>>Home List 4 (970px * 90px)</option>
					   		<option value="Home List 5" <?php if(isset($row_data['position']) && $row_data['position'] == "Home List 5") echo 'selected="selected"'; ?>>Home List 5 (970px * 90px)</option>
					   		<option value="Home List 6" <?php if(isset($row_data['position']) && $row_data['position'] == "Home List 6") echo 'selected="selected"'; ?>>Home List 6 (970px * 90px)</option>
					   		<option value="Home List 7" <?php if(isset($row_data['position']) && $row_data['position'] == "Home List 7") echo 'selected="selected"'; ?>>Home List 7 (970px * 90px)</option>
					   		<option value="Home List Small 1" <?php if(isset($row_data['position']) && $row_data['position'] == "Home List Small 1") echo 'selected="selected"'; ?>>Home List Small 1 (480px * 90px)</option>
					   		<option value="Home List Small 2" <?php if(isset($row_data['position']) && $row_data['position'] == "Home List Small 2") echo 'selected="selected"'; ?>>Home List Small 2 (480px * 90px)</option>
					   		<option value="Home List Small 3" <?php if(isset($row_data['position']) && $row_data['position'] == "Home List Small 3") echo 'selected="selected"'; ?>>Home List Small 3 (480px * 90px)</option>
					   		<option value="Home List Small 4" <?php if(isset($row_data['position']) && $row_data['position'] == "Home List Small 4") echo 'selected="selected"'; ?>>Home List Small 4 (480px * 90px)</option>
					   		<option value="Home List Small 5" <?php if(isset($row_data['position']) && $row_data['position'] == "Home List Small 5") echo 'selected="selected"'; ?>>Home List Small 5 (480px * 90px)</option>
					   		<option value="Home List Small 6" <?php if(isset($row_data['position']) && $row_data['position'] == "Home List Small 6") echo 'selected="selected"'; ?>>Home List Small 6 (480px * 90px)</option>
					   		<option value="Home List Small 7" <?php if(isset($row_data['position']) && $row_data['position'] == "Home List Small 7") echo 'selected="selected"'; ?>>Home List Small 7 (480px * 90px)</option>
					   		<option value="Home List Small 8" <?php if(isset($row_data['position']) && $row_data['position'] == "Home List Small 8") echo 'selected="selected"'; ?>>Home List Small 8 (480px * 90px)</option>
					   		<option value="Home List Small 9" <?php if(isset($row_data['position']) && $row_data['position'] == "Home List Small 9") echo 'selected="selected"'; ?>>Home List Small 9 (480px * 90px)</option>
					   		<option value="Home List Small 10" <?php if(isset($row_data['position']) && $row_data['position'] == "Home List Small 10") echo 'selected="selected"'; ?>>Home List Small 10 (970px * 90px)</option>
					   		<option value="Home List Small 11" <?php if(isset($row_data['position']) && $row_data['position'] == "Home List Small 11") echo 'selected="selected"'; ?>>Home List Small 11 (970px * 90px)</option>
					   		<option value="Home List Small 12" <?php if(isset($row_data['position']) && $row_data['position'] == "Home List Small 12") echo 'selected="selected"'; ?>>Home List Small 12 (970px * 90px)</option>
					   		<option value="Home List Small 13" <?php if(isset($row_data['position']) && $row_data['position'] == "Home List Small 13") echo 'selected="selected"'; ?>>Home List Small 13 (970px * 90px)</option>
					   		<option value="Home List Small 14" <?php if(isset($row_data['position']) && $row_data['position'] == "Home List Small 14") echo 'selected="selected"'; ?>>Home List Small 14 (970px * 90px)</option>
					   		<option value="Footer Small 1" <?php if(isset($row_data['position']) && $row_data['position'] == "Footer Small 1") echo 'selected="selected"'; ?>>Footer Small 1 (970px * 90px)</option>
					   		<option value="Footer Small 2" <?php if(isset($row_data['position']) && $row_data['position'] == "Footer Small 2") echo 'selected="selected"'; ?>>Footer Small 2 (970px * 90px)</option>
					   		<option value="Right Sidebar 1" <?php if(isset($row_data['position']) && $row_data['position'] == "Right Sidebar 1") echo 'selected="selected"'; ?>>Right Sidebar 1 (400px * 85px)</option>
					   		<option value="Right Sidebar 2" <?php if(isset($row_data['position']) && $row_data['position'] == "Right Sidebar 2") echo 'selected="selected"'; ?>>Right Sidebar 2 (340px * 280px)</option>
					   		<option value="Right Sidebar 3" <?php if(isset($row_data['position']) && $row_data['position'] == "Right Sidebar 3") echo 'selected="selected"'; ?>>Right Sidebar 3 (340px * 280px)</option>
					   		<option value="Right Sidebar 4" <?php if(isset($row_data['position']) && $row_data['position'] == "Right Sidebar 4") echo 'selected="selected"'; ?>>Right Sidebar 4 (340px * 280px)</option>
					   		<option value="Right Sidebar 5" <?php if(isset($row_data['position']) && $row_data['position'] == "Right Sidebar 5") echo 'selected="selected"'; ?>>Right Sidebar 5 (340px * 280px)</option>
					   		<option value="Right Sidebar 6" <?php if(isset($row_data['position']) && $row_data['position'] == "Right Sidebar 6") echo 'selected="selected"'; ?>>Right Sidebar 6 (340px * 280px)</option>
					   		<option value="Details List 1" <?php if(isset($row_data['position']) && $row_data['position'] == "Details List 1") echo 'selected="selected"'; ?>>Details List 1 (970px * 90px)</option>
					   		<option value="Details Right 1" <?php if(isset($row_data['position']) && $row_data['position'] == "Details Right 1") echo 'selected="selected"'; ?>>Details Right 1 (400px * 85px)</option>
					   		<option value="Footer" <?php if(isset($row_data['position']) && $row_data['position'] == "Footer") echo 'selected="selected"'; ?>>Footer (400px * 85px)</option>
					   	</select>
			    	</div>
	  			</div>
	  			<div class="col-md-6">	
			    	<div class="formSep">
					   	<label class="req">Status</label>
		                <select class="select2" name="enabled" id="enabled">
		                    <option value="1" <?php if(isset($row_data['enabled']) && $row_data['enabled'] == '1') echo 'selected'; ?>>Enabled</option>
		                    <option value="0" <?php if(isset($row_data['enabled']) && $row_data['enabled'] == '0') echo 'selected'; ?>>Disabled</option>
		                </select>
			    	</div>
	  			</div>
	  		</div>

	    	<hr />

	    	<?php $default_image = (isset($row_data['image']) && !empty($row_data['image']) && file_exists("./uploads/media/advertisement/{$row_data['image']}")) ? base_url() . "uploads/media/advertisement/{$row_data['image']}" : "holder.js/165x160"; ?>
	  		<div class="form_sep">
         		<label for="userName">Image</label>
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
				<button type="submit" class="btn btn-lg btn-primary"><?php if($mode == "edit") echo "Update"; else echo "Save"; ?> Advertise</button>
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
			var $checkoutForm = $('#validate-form').validate({
				rules : {
					position : {
						required : true
					}
				},
				messages : {
					position : {
						required : 'Please select position'
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