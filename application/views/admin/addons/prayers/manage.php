<?php
	$default_prayer = get_rows(array("table"=>"prayers", "limit"=>1), array("default"=>1));
?>
<div class="row">
	<div class="col-lg-6">
		<h1 class="page-title txt-color-blueDark">
			<i class="fa-fw fa fa-pencil-square-o"></i> Manage Prayer
		</h1>
	</div>
	<div class="col-lg-6">
		<div class="btn-group btn-sm pull-right">
			<button class="btn btn-success pull-right changeURL" data-url="#prayers/"><i class="fa fa-navicon"></i> Prayer List</button>
			<button class="btn btn-danger pull-right changeURL" data-url="#prayers/manage/"><i class="fa fa-list-alt"></i> Add Prayer</button>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-8">
		<form action="<?= site_url("admin/prayers/manage/{$mode}/{$current_id}"); ?>" method="post" id="validate-form">		
			<div class="panel panel-primary">
			  	<div class="panel-heading">
			    	<h3 class="panel-title">
			    		<strong><?= ucfirst($mode); ?></strong> Prayer
					</h3>
			  	</div>
			
			  	<div class="panel-body">
			  		<div class="row">
			  			<div class="col-md-8">
		    				<div class="formSep">
		    					<label class="req">Date</label>
		        				<input class="form-control edatepicker" type="text" name="date" id="date" value="<?php if(isset($row_data['date'])) echo $row_data['date']; else echo date("Y-m-d"); ?>" />
		    				</div>
			  			</div>
			  			<div class="col-md-4">
		                	<div class="formSep">
		                        <label class="req">Default</label>
		                        <select name="default" id="default" class="select2">
		                            <option value="0" <?php if(isset($row_data['default']) && $row_data['default'] == '0') echo 'selected'; ?>>No</option>
		                            <option value="1" <?php if(isset($row_data['default']) && $row_data['default'] == '1') echo 'selected'; ?>>Yes</option>
		                        </select>
		                  	</div>
			  			</div>
			  		</div>
    				
    				<hr />
    					
			    	<div class="formSep">
					   	<label class="req">ফজর</label>
					   	<input class="form-control" type="text" name="prayer1" id="prayer1" value="<?php if(isset($row_data['prayer1'])) echo $row_data['prayer1']; elseif(isset($default_prayer['prayer1'])) echo $default_prayer['prayer1']; ?>" />
			    	</div>

		            <hr />

		            <div class="formSep">
		                <label class="req">জোহর</label>
		                <input class="form-control" type="text" name="prayer2" id="prayer2" value="<?php if(isset($row_data['prayer2'])) echo $row_data['prayer2']; elseif(isset($default_prayer['prayer2'])) echo $default_prayer['prayer2']; ?>" />
		            </div>

		            <hr />

		            <div class="formSep">
		                <label class="req">আসর</label>
		                <input class="form-control" type="text" name="prayer3" id="prayer3" value="<?php if(isset($row_data['prayer3'])) echo $row_data['prayer3']; elseif(isset($default_prayer['prayer3'])) echo $default_prayer['prayer3']; ?>" />
		            </div>

		            <hr />

		            <div class="formSep">
		                <label class="req">মাগরিব</label>
		                <input class="form-control" type="text" name="prayer4" id="prayer4" value="<?php if(isset($row_data['prayer4'])) echo $row_data['prayer4']; elseif(isset($default_prayer['prayer4'])) echo $default_prayer['prayer4']; ?>" />
		            </div>

		            <hr />

		            <div class="formSep">
		                <label class="req">এশা</label>
		                <input class="form-control" type="text" name="prayer5" id="prayer5" value="<?php if(isset($row_data['prayer5'])) echo $row_data['prayer5']; elseif(isset($default_prayer['prayer5'])) echo $default_prayer['prayer5']; ?>" />
		            </div>
		
		            <hr />
		
		            <div class="formSep">
		                <label class="req">জুম’আ</label>
		                <input class="form-control" type="text" name="prayer6" id="prayer6" value="<?php if(isset($row_data['prayer6'])) echo $row_data['prayer6']; elseif(isset($default_prayer['prayer6'])) echo $default_prayer['prayer6']; ?>" />
		            </div>
				</div>

				<div class="panel-footer">
					<div class="text-center">
						<input type="hidden" name="id" value="<?php if(isset($current_id)) echo $current_id; ?>" />
						<button type="submit" class="btn btn-lg btn-primary"><?php if($mode == "edit") echo "Update"; else echo "Add"; ?> Prayer</button>
					</div>
				</div>
			</div>
		</form>
	</div>
</div>
<?php $this->load->view("admin/common-delete-modal"); ?>

<script src="<?= base_url(); ?>assets/admin/js/custom.js"></script>
<script type="text/javascript">
	pageSetUp();

	$(document).ready(function() {
		var pagefunction = function() {
			var $checkoutForm = $('#validate-form').validate({
				rules : {
					title : {
						required : true
					},
					publish_date : {
						required : true
					}
				},
				messages : {
					title : {
						required : 'Please enter News Title'
					},
					publish_date : {
						required : 'Please enter publish date'
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