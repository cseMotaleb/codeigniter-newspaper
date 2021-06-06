<div class="row">
	<div class="col-lg-6">
		<h1 class="page-title txt-color-blueDark">
			<i class="fa-fw fa fa-pencil-square-o"></i> Manage currency
		</h1>
	</div>
	<div class="col-lg-6">
		<div class="btn-group btn-sm pull-right">
			<button class="btn btn-success pull-right changeURL" data-url="#currency/"><i class="fa fa-navicon"></i> Currency List</button>
			<button class="btn btn-danger pull-right changeURL" data-url="#currency/manage/"><i class="fa fa-list-alt"></i> Add Currency</button>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-8">
		<form action="<?= site_url("admin/currency/manage/{$mode}/{$current_id}"); ?>" method="post" id="validate-form">		
			<div class="panel panel-primary">
			  	<div class="panel-heading">
			    	<h3 class="panel-title">
			    		<strong><?= ucfirst($mode); ?></strong> Currency
					</h3>
			  	</div>
			
			  	<div class="panel-body">
			    	<div class="formSep">
					   	<label class="req">মুদ্রা</label>
					   	<input class="form-control" type="text" name="currency" id="currency" value="<?php if(isset($row_data['currency'])) echo $row_data['currency']; ?>" />
			    	</div>

		            <hr />

		            <div class="formSep">
		                <label class="req">বিক্রয়</label>
		                <input class="form-control" type="text" name="sale" id="sale" value="<?php if(isset($row_data['sale'])) echo $row_data['sale']; ?>" />
		            </div>

		            <hr />

		            <div class="formSep">
		                <label class="req">ক্রয়</label>
		                <input class="form-control" type="text" name="purchase" id="purchase" value="<?php if(isset($row_data['purchase'])) echo $row_data['purchase']; ?>" />
		            </div>
				</div>

				<div class="panel-footer">
					<div class="text-center">
						<input type="hidden" name="id" value="<?php if(isset($current_id)) echo $current_id; ?>" />
						<button type="submit" class="btn btn-lg btn-primary"><?php if($mode == "edit") echo "Update"; else echo "Add"; ?> Currency</button>
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