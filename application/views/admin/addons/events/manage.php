<div class="row">
	<div class="col-lg-6">
		<h1 class="page-title txt-color-blueDark">
			<i class="fa-fw fa fa-pencil-square-o"></i> Manage Event
		</h1>
	</div>
	<div class="col-lg-6">
		<div class="btn-group btn-sm pull-right">
			<a href="#events/" class="btn btn-success pull-right"><i class="fa fa-list"></i> Event List</a>
			<a href="#events/manage" class="btn btn-danger pull-right"><i class="fa fa-plus-circle"></i> Add Event</a>
		</div>
	</div>
</div>

<form action="<?= site_url("admin/events/manage/{$mode}/{$current_id}"); ?>" method="post" id="validate-form">
	<div class="panel panel-primary">
		<div class="panel-heading">
			<div class="pull-left">
				
			</div>
			<div class="pull-right">
				<select style="color: #000;" name="enabled" id="enabled">
					<option value="1" <?php if(isset($row_data['enabled']) && $row_data['enabled'] == '1') echo 'selected'; ?>>Enabled</option>
					<option value="0" <?php if(isset($row_data['enabled']) && $row_data['enabled'] == '0') echo 'selected'; ?>>Disabled</option>
				</select>
			</div>
			<div class="clearfix"></div>
		</div>
		<div class="panel-body">	
	    	<div class="formSep">
				<label class="req">Title</label>
				<input class="form-control" type="text" name="title" id="title" placeholder="Enter events title" value="<?php if(isset($row_data['title'])) echo $row_data['title']; ?>" />
	    	</div>

	    	<hr />

	    	<div class="formSep">
	    		<div class="row">
	    			<div class="col-md-6">
					   	<label>Start Date</label>
					  	<input class="form-control edatepicker" type="date" name="start_date" id="id_start_date" placeholder="Enter event start date" value="<?php if(isset($row_data['start_date'])) echo $row_data['start_date']; ?>" />
				  	</div>
				   	<div class="col-md-6">
					   	<label>End Date</label>
					  	<input class="form-control edatepicker" type="date" name="end_date" id="id_end_date" placeholder="Enter event end date" value="<?php if(isset($row_data['end_date'])) echo $row_data['end_date']; ?>" />
				  	</div>
	    		</div>
	    	</div>

	    	<hr />

	    	<div class="formSep">
	    		<div class="row">
	    			<div class="col-md-6">
					   	<label>URL</label>
					  	<input class="form-control" type="text" name="internal_url" id="internal_url" placeholder="Enter url" value="<?php if(isset($row_data['internal_url'])) echo $row_data['internal_url']; ?>" />
				   </div>
				   <div class="col-md-6">
					   	<label>Event Address </label>
					  	<input class="form-control" type="text" name="event_address" id="event_address" placeholder="Enter event address " value="<?php if(isset($row_data['event_address'])) echo $row_data['event_address']; ?>" />
				  </div>
	    		</div>
	    	</div>

			<hr />

			<div class="formSep">
	    		<div class="row">
	    			<div class="col-md-12">
					   	<div class="panel panel-default">
							<div class="panel-heading">Description</div>
					        <div class="panel-body">
			    				<textarea class="small_ckeditor" id="description" name="description"><?php if(isset($row_data['description'])) echo $row_data['description']; else echo set_value('description');?></textarea>
			    			</div>
				   		 </div>
				    </div>
	    		</div>
	    	</div>
		</div>
		
		<div class="panel-footer">
			<div class="formSep">
				<input type="hidden" name="id" value="<?php if(isset($current_id)) echo $current_id; ?>" />
				<button type="submit" class="btn btn-lg btn-primary"><i class="fa fa-floppy-o"></i> <?php if($mode == "edit") echo "Update"; else echo "Save"; ?> Event</button>
			</div>
		</div>
	</div>
</form>


<script type="text/javascript">
	pageSetUp();

	$(document).ready(function() {
	 	if($('#description').length) { 
       		CKEDITOR.replace( 'description', {
           		toolbar: 'Standard'
       		});
	  	};

		$('#start_date').datepicker({
			dateFormat : 'yy-mm-dd',
			prevText : '<i class="fa fa-chevron-left"></i>',
			nextText : '<i class="fa fa-chevron-right"></i>'
		});

		$('#end_date').datepicker({
			dateFormat : 'yy-mm-dd',
			prevText : '<i class="fa fa-chevron-left"></i>',
			nextText : '<i class="fa fa-chevron-right"></i>'
		});
	});

	var pagefunction = function() {
		CKEDITOR.instances['description'].on('change', function() { CKEDITOR.instances['description'].updateElement() });

		var $checkoutForm = $('#validate-form').validate({
			rules : {
				title : {
					required : true
				}
			},
			messages : {
				title : {
					required : 'Please enter title'
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
	
	loadScript("<?= base_url(); ?>assets/admin/js/bootstrap-fileupload.js");
	loadScript("<?= site_url('assets/admin/js/plugin/jquery-form/jquery-form.min.js'); ?>", pagefunction);
</script>