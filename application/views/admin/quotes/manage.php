<div class="row">
	<div class="col-lg-6">
		<h1 class="page-title txt-color-blueDark">
			<i class="fa-fw fa fa-pencil-square-o"></i> Manage Quote
		</h1>
	</div>
	<div class="col-lg-6">
		<div class="btn-group btn-sm pull-right">
			<button class="btn btn-success changeURL" data-url="#quotes/"><i class="fa fa-list"></i> Quote List</button>
			<button class="btn btn-danger changeURL" data-url="#quotes/manage/"><i class="fa fa-plus-circle"></i> Add Quote</button>
		</div>
	</div>
</div>

<form id="validate-page" method="post" action="<?= site_url("admin/quotes/manage/{$mode}/{$current_id}"); ?>">
	<div class="panel panel-primary">
	  	<div class="panel-heading">
	  		<div class="pull-left">
	  			<h4><i class="fa fa-plus-circle"></i> <?= ucfirst($mode); ?> Quote</h4>
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
	  		<div class="panel panel-default">
	  			<div class="panel-heading">
	  				<h4>Property Info.</h4>
	  			</div>
	  			<div class="panel-body">
	  				<div class="row">
	  					<div class="col-md-4">
				        	<div class="formSep">
				                <label>Roof Type</label>
				                <select name="roof_type" id="roof_type" class="select2">
				                    <option value="Tile Roof" <?php if(isset($row_data['roof_type']) && $row_data['roof_type'] == "Tile Roof") echo 'selected'; ?>>Tile Roof</option>
				                    <option value="Tin Roof" <?php if(isset($row_data['roof_type']) && $row_data['roof_type'] == "Tin Roof") echo 'selected'; ?>>Tin Roof</option>
				                </select>
				            </div>
	  					</div>
	  					<div class="col-md-4">
				        	<div class="formSep">
				                <label>Stories</label>
				                <select name="stories" id="stories" class="select2">
				                    <option value="1 Storey" <?php if(isset($row_data['stories']) && $row_data['stories'] == "1 Storey") echo 'selected'; ?>>1 Storey</option>
				                    <option value="2 Storeys" <?php if(isset($row_data['stories']) && $row_data['stories'] == "2 Storeys") echo 'selected'; ?>>2 Storeys</option>
				                    <option value="3+ Storeys" <?php if(isset($row_data['stories']) && $row_data['stories'] == "3+ Storeys") echo 'selected'; ?>>3+ Storeys</option>
				                </select>
				            </div>
	  					</div>
	  					<div class="col-md-4">
				        	<div class="formSep">
				                <label>System Size</label>
				                <select name="system_size" id="system_size" class="select2">
				                    <option value="1.5kW" <?php if(isset($row_data['system_size']) && $row_data['system_size'] == "1.5kW") echo 'selected'; ?>>1.5kW</option>
				                    <option value="2kW" <?php if(isset($row_data['system_size']) && $row_data['system_size'] == "2kW") echo 'selected'; ?>>2kW</option>
				                    <option value="3kW" <?php if(isset($row_data['system_size']) && $row_data['system_size'] == "3kW") echo 'selected'; ?>>3kWs</option>
				                    <option value="4kW" <?php if(isset($row_data['system_size']) && $row_data['system_size'] == "4kW") echo 'selected'; ?>>4kW</option>
				                    <option value="5+kW" <?php if(isset($row_data['system_size']) && $row_data['system_size'] == "5+kW") echo 'selected'; ?>>5+kW</option>
				                </select>
				            </div>
	  					</div>
	  				</div>
	  			</div>
	  		</div>

	  		<div class="panel panel-default">
	  			<div class="panel-heading">
	  				<h4>Personal Details</h4>
	  			</div>
	  			<div class="panel-body">
	  				<div class="row">
	  					<div class="col-md-3">
		   	 				<div class="formSep">
		   	 					<label class="req">First Name</label>
		   	 					<input name="first_name" id="first_name" class="form-control" placeholder="First Name" value="<?php if(isset($row_data['first_name'])) echo $row_data['first_name']; ?>" type="text" />
		   	 				</div>
	  					</div>
	  					<div class="col-md-3">
		   	 				<div class="formSep">
		   	 					<label>Last Name</label>
		   	 					<input name="last_name" id="last_name" class="form-control" placeholder="Last Name" value="<?php if(isset($row_data['last_name'])) echo $row_data['last_name']; ?>" type="text" />
		   	 				</div>
	  					</div>
	  					<div class="col-md-3">
		   	 				<div class="formSep">
		   	 					<label>Contact Number</label>
		   	 					<input name="contact_number" id="contact_number" class="form-control" placeholder="Contact Number" value="<?php if(isset($row_data['contact_number'])) echo $row_data['contact_number']; ?>" type="text" />
		   	 				</div>
	  					</div>
	  					<div class="col-md-3">
		   	 				<div class="formSep">
		   	 					<label>Alt. Phone</label>
		   	 					<input name="phone" id="phone" class="form-control" placeholder="Phone" value="<?php if(isset($row_data['phone'])) echo $row_data['phone']; ?>" type="text" />
		   	 				</div>
	  					</div>
	  				</div>

	  				<hr />

   	 				<div class="formSep">
   	 					<label>Address</label>
   	 					<input name="address" id="address" class="form-control" placeholder="Address" value="<?php if(isset($row_data['address'])) echo $row_data['address']; ?>" type="text" />
   	 				</div>

	  				<hr />

	  				<div class="row">
	  					<div class="col-md-4">
		   	 				<div class="formSep">
		   	 					<label>Suburb</label>
		   	 					<input name="suburb" id="suburb" class="form-control" placeholder="Suburb" value="<?php if(isset($row_data['suburb'])) echo $row_data['suburb']; ?>" type="text" />
		   	 				</div>
	  					</div>
	  					<div class="col-md-4">
		   	 				<div class="formSep">
		   	 					<label>State</label>
		   	 					<input name="state" id="state" class="form-control" placeholder="State" value="<?php if(isset($row_data['state'])) echo $row_data['state']; ?>" type="text" />
		   	 				</div>
	  					</div>
	  					<div class="col-md-4">
		   	 				<div class="formSep">
		   	 					<label>Postcode</label>
		   	 					<input name="postcode" id="postcode" class="form-control" placeholder="Postcode" value="<?php if(isset($row_data['postcode'])) echo $row_data['postcode']; ?>" type="text" />
		   	 				</div>
	  					</div>
	  				</div>
	  			</div>
	  		</div>

			<div class="row">
				<div class="col-md-6">
					<div class="formSep">
						<label>Details</label>
						<textarea name="details" id="details" class="form-control" rows="5"><?php if(isset($row_data['details'])) echo $row_data['details']; ?></textarea>
					</div>
				</div>
				<div class="col-md-6">
					<div class="formSep">
						<label>Internal Details</label>
						<textarea name="internal_details" id="internal_details" class="form-control" rows="5"><?php if(isset($row_data['internal_details'])) echo $row_data['internal_details']; ?></textarea>
					</div>
				</div>
			</div>
	  	</div>

	  	<div class="panel-footer">
			<input type="hidden" name="id" value="<?php if(isset($current_id)) echo $current_id; ?>" />
			<button type="submit" class="btn btn-lg btn-primary">
				<i class="fa fa-floppy-o"></i> &nbsp;<?php if(isset($mode) && $mode == "edit") echo "Update"; else echo "Save"; ?> Quote&nbsp;&nbsp;&nbsp;
			</button>
	  	</div>
	</div>
</form>

<script src="<?= base_url(); ?>assets/admin/js/custom.js"></script>
<script type="text/javascript">
	pageSetUp();
	$(document).ready(function() {
		
	});
	
	var pagefunction = function() {
		var $checkoutForm = $('#validate-page').validate({
			rules : {
				first_name : {
					required : true
				}
			},
			messages : {
				first_name : {
					required : 'Please enter first name'
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