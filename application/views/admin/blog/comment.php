<div class="row">
	<div class="col-lg-6">
		<h1 class="page-title txt-color-blueDark">
			<i class="fa-fw fa fa-pencil-square-o"></i> News Comments
		</h1>
	</div>
	<div class="col-lg-6">
		<div class="btn-group btn-sm pull-right">
			<button class="btn btn-success changeURL" data-url="#news/comments"><i class="fa fa-navicon"></i> Comment List</button>
		</div>
	</div>
</div>

<form method="post" id="validate-form" action="<?= site_url("admin/news/comment/{$mode}/{$current_id}"); ?>">
	<div class="row">
		<div class="col-md-8">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h4>Manage Comment</h4>
				</div>
				<div class="panel-body">
					<div class="formSep">
						<label class="req">Comment</label>
						<textarea name="comment" id="comment" class="form-control" placeholder="Enter comment" rows="6"><?php if(isset($row_data['comment'])) echo $row_data['comment']; ?></textarea>
					</div>
					
					<hr />
					
					<div class="row">
						<div class="col-md-4">
							<div class="formSep">
								<label class="req">Status</label>
								<select name="enabled" id="enabled" class="select2">
									<option value="1" <?php if(isset($row_data['enabled']) && $row_data['enabled'] == 1) echo 'selected'; ?>>Enabled</option>
									<option value="0" <?php if(isset($row_data['enabled']) && $row_data['enabled'] == 0) echo 'selected'; ?>>Disabled</option>
								</select>
							</div>
						</div>
					</div>
				</div>
				<div class="panel-footer">
					<button type="submit" class="btn btn-lg b btn-primary" id="btn-submit"><i class="fa fa-floppy-o"></i> <?php if($mode == "edit") echo "Update"; else echo "Save"; ?> Comment</button>
				</div>
			</div>
		</div>
	</div>
</form>

<script src="<?= base_url(); ?>assets/admin/js/custom.js"></script>
<script type="text/javascript">
	pageSetUp();

	var pagefunction = function() {
		var $checkoutForm = $('#validate-form').validate({
			rules : {
				comment : {
					required : true
				}
			},
			messages : {
				comment : {
					required : 'Please enter comment'
				}
			},
			submitHandler : function(form) {
				jQuery("#btn-submit").prop('disabled', true);
				$(form).ajaxSubmit({
					success : processJson
				});
			},
			errorPlacement : function(error, element) {
				error.insertAfter(element.parent());
			}
		});

		function processJson(data) {
			jQuery("#btn-submit").prop('disabled', false);
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
</script>