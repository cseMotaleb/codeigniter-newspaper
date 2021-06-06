<style type="text/css">
	.input-group .form-control {
		z-index: 1;
	}
</style>
<div class="row">
	<div class="col-lg-6">
		<h1 class="page-title txt-color-blueDark">
			<i class="fa-fw fa fa-pencil-square-o"></i> Manage Poll
		</h1>
	</div>
	<div class="col-lg-6">
		<div class="btn-group btn-sm pull-right">
			<button class="btn btn-success changeURL" data-url="#polls/"><i class="fa fa-list"></i> Poll List</button>
			<button class="btn btn-danger changeURL" data-url="#polls/manage/"><i class="fa fa-plus-circle"></i> Add Poll</button>
		</div>
	</div>
</div>

<form id="validate-form" method="post" action="<?= site_url("admin/polls/manage/{$mode}/{$current_id}"); ?>">
	<div class="panel panel-primary">
	  	<div class="panel-heading">
	  		<div class="pull-left">
	  			<h4><i class="fa fa-plus-circle"></i> <?= ucfirst($mode); ?> Poll</h4>
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
				<?php /*
				<div class="col-md-9">
   	 				<div class="formSep">
   	 					<label>Short Title</label>
   	 					<input name="short_title" id="short_title" class="form-control" placeholder="Short Title" value="<?php if(isset($row_data['short_title'])) echo $row_data['short_title']; ?>" type="text" />
   	 				</div>
				</div> */ ?>
				<input name="short_title" id="short_title" class="form-control"  value="" type="hidden" />
				<div class="col-md-4">
   	 				<div class="formSep">
   	 					<label>Date</label>
   	 					<input name="date" id="date" class="form-control edatepicker" placeholder="Date" value="<?php if(isset($row_data['date'])) echo $row_data['date']; ?>" type="text" />
   	 				</div>
				</div>
			</div>

			<hr />

			<div class="formSep">
				<label>Add Option</label>
				<table style="width: 100%;" class="appendo" data-rows="<?= (isset($row_data['options']) && count($row_data['options']) > 0) ? (count($row_data['options']) + 1) : 1; ?>">
					<?php
					if(isset($row_data['options']) && count($row_data['options']) > 0) {
						foreach ($row_data['options'] as $key => $option_row) {
					?>
				  	<tr>
				    	<td>
							<div class="formSep">
								<div class="input-group">
									<span class="input-group-addon" id="sizing-addon2">@</span>
									<input name="options[]" class="form-control" placeholder="Option" value="<?= $option_row['option']; ?>" type="text" />
								</div>
							</div>

							<hr />
				    	</td>
				  	</tr>
				  	<?php }
				  	} ?>
				  	<tr>
				    	<td>
							<div class="formSep">
								<div class="input-group">
									<span class="input-group-addon" id="sizing-addon2">@</span>
									<input name="options[]" class="form-control" placeholder="Option" value="" type="text" />
								</div>
							</div>

							<hr />
				    	</td>
				  	</tr>
				</table>
			</div>

			<hr />

			<div class="panel panel-default">
				<div class="panel-heading">Details</div>
				<textarea class="form-control" rows="5" id="poll" name="poll"><?php if(isset($row_data['poll'])) echo $row_data['poll']; ?></textarea>
			</div>
	  	</div>

	  	<div class="panel-footer">
			<input type="hidden" name="id" value="<?php if(isset($current_id)) echo $current_id; ?>" />
			<button type="submit" class="btn btn-lg btn-primary">
				<i class="fa fa-floppy-o"></i> &nbsp;<?php if(isset($mode) && $mode == "edit") echo "Update"; else echo "Save"; ?> Poll&nbsp;&nbsp;&nbsp;
			</button>
	  	</div>
	</div>
</form>

<script src="<?= base_url(); ?>assets/admin/js/custom.js"></script>
<script src="<?= base_url(); ?>assets/admin/appendo/jquery.appendo.js"></script>
<script type="text/javascript">
	pageSetUp();

	var pagefunction = function() {
		var $checkoutForm = $('#validate-form').validate({
			rules : {
				poll : {
					required : true
				}
			},
			messages : {
				poll : {
					required : 'Please enter poll'
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

	loadScript("<?=  base_url();?>assets/admin/js/plugin/jquery-form/jquery-form.min.js", pagefunction);
</script>