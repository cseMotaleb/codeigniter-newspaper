<div class="row">
	<div class="col-lg-6">
		<h1 class="page-title txt-color-blueDark">
			<i class="fa-fw fa fa-pencil-square-o"></i> FAQ
		</h1>
	</div>
	<div class="col-lg-6">
		<div class="btn-group btn-sm pull-right">
			<button class="btn btn-danger changeURL" data-url="#faqs/groups"><i class="fa fa-list-alt"></i> Add Group</button>
			<button class="btn btn-success changeURL" data-url="#faqs/"><i class="fa fa-navicon"></i> FAQ List</button>
			<button class="btn btn-danger changeURL" data-url="#faqs/index/"><i class="fa fa-list-alt"></i> Add FAQ</button>
		</div>
	</div>
</div>

<?php include 'search.php'; ?>

<div class="row">
	<div class="col-md-6">
		<div class="panel panel-default">
		  	<div class="panel-heading">
		  		<h4>Faqs</h4>
		  	</div>
		  	<?php $total_rows = count($rows); ?>
	  		<form id="BulkDeleteForm" method="post" action="<?= site_url("admin/faqs/index/bulk_delete"); ?>">
				<table class="table table-bordered">
				    <thead>
				        <tr>
				        	<th>
				        		<?php if($total_rows > 0) { ?>
				        		<input name="all_bulk" id="all_bulk" value="" type="checkbox" />
				        		<?php } ?>
				        	</th>
				        	<th><small>Group</small></th>
				        	<th><small>Question</small></th>
							<th><small>Status</small></th>
							<th style="width: 65px;"><small>Action</small></th>
						</tr>
		        	</thead>
		        	<tbody>
                	<?php
                	if($total_rows > 0) {
                		foreach ($rows as $row) {
							$label = ($row['enabled'] == "1") ? 'label-success' : 'label-danger';
							$status = ($row['enabled'] == "1") ? 'Enabled' : 'Disabled';
                		?>
		        		<tr id="hiderow<?= $row['id']; ?>">
		        			<td>
		        				<input name="bulk_delete[]" class="bulk_checkbox" value="<?= $row['id']; ?>" type="checkbox" />
		        			</td>
		        			<td><?= $row['group_name']; ?></td>
		        			<td><?= $row['question']; ?></td>
		        			<td>
								<a data-original-title="Select Status" data-url="<?= site_url("admin/faqs/ajax_status_update"); ?>" data-value="<?= $row['enabled']; ?>" data-pk="<?= $row['id'] ?>" data-type="select" data-name="enabled" name="enabled" class="rstatusopt" href="#">
								 	<span class="label <?= $label; ?>"><?= $status; ?></span>
								</a>
		        			</td>
							<td>
								<div class="btn-group">
									<a href="#faqs/index/edit/<?= $row['id']; ?>" class="btn btn-default btn-xs" title="Edit"><i class="fa fa-pencil"></i></a>
									<a class="btn btn-default btnDel btn-xs" data-url="<?= site_url("admin/faqs/index/delete/"); ?>" data-toggle="modal" data-target="#myModal" id="<?= $row['id'] ?>" title="Delete" ><i class="fa fa-trash-o"></i></a>
								</div>
							</td>
		        		</tr>
		        		<?php }
						} else echo '<tr><td colspan="4">No Result Found</td></tr>'; ?>
		        	</tbody>
		        	<?php if($total_rows > 0) { ?>
	        		<tfoot>
	        			<tr>
	        				<td colspan="7" class="text-right">
	        					<div class="row">
	        						<div class="col-md-6">
	        							<div class="text-left">
	        								<br />
	        								<a data-toggle="modal" data-target="#bulkModal" class="btn btn-danger"><i class="fa fa-shirtsinbulk"></i> Bulk Delete</a>
	        							</div>
	        						</div>
	        						<div class="col-md-6">
	        							<?= $pagination; ?>
	        						</div>
	        					</div>
	        				</td>
	        			</tr>
	        		</tfoot>
	        		<?php } ?>
		        </table>
		  	</form>
		</div>
	</div>
	
	<div class="col-md-6">
		<div class="panel panel-default">
		  	<div class="panel-heading">
		    	<h3 class="panel-title">
		    		<span class="text-danger"><strong><?= ucfirst($mode); ?></strong></span> Faqs
				</h3>
		  	</div>

		  	<div class="panel-body">
				<form action="<?= site_url("admin/faqs/index/{$mode}/{$current_id}"); ?>" method="post" id="validate-form">
			    	<div class="formSep">
			    		<div class="row">
			    			<div class="col-md-12">
							   	<label class="req">Question</label>
							   	<input class="form-control" type="text" name="question" id="question" placeholder="Enter question" value="<?php if(isset($row_data['question'])) echo $row_data['question']; ?>" />
							</div>
						</div>
			    	</div>

			    	<hr />

		    		<div class="row">
		    			<div class="col-md-6">
							<label>Group</label>
							<select name="group_id" id="group_id" class="select2">
				    	    	<?php 	
			    	    			$selected_option = (isset($row_data['group_id'])) ? $row_data['group_id'] : "";
			    	    			$options = options(
			    									array(
			    										'table'=>'categories', 
			    										'limit'=>1000,
			    										'option_value'=>'id',
			    										'option'=>'category', 
			    										'order_by'=>'category', 
			    										'order_type'=>'asc', 
			    										'default'=>$selected_option
													), 
													array("groups"=>"FAQ"));

												echo $options['option_list'];
								?>
							</select>
						</div>
						<div class="col-md-6">
							<label>Status</label>
							<select name="enabled" id="enabled" class="select2">
								<option value="1" <?php if(isset($row_data['enabled']) && $row_data['enabled'] == '1') echo 'selected'; ?>>Enabled</option>
								<option value="0" <?php if(isset($row_data['enabled']) && $row_data['enabled'] == '0') echo 'selected'; ?>>Disabled</option>
							</select>
						</div>
		    		</div>
		
					<hr />

					<div class="formSep">
						<div class="row">
							<div class="col-md-12">
								<div class="panel panel-default">
									<div class="panel-heading">Answer</div>
							        <div class="panel-body">
					    				<textarea class="ckeditor" id="answer" name="answer"><?php if(isset($row_data['answer'])) echo $row_data['answer']; else echo set_value('answer');?></textarea>
					    			</div>
						    	</div>
							</div>
						</div>
					</div>
					<div class="formSep">
						<input type="hidden" name="id" value="<?php if(isset($current_id)) echo $current_id; ?>" />
						<button type="submit" class="btn btn-primary"><i class="fa fa-floppy-o"></i> <?php if($mode == "edit") echo "Update"; echo "Save"; ?> FAQ's</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<?php $this->load->view("admin/common-delete-modal"); ?>

<script src="<?= base_url(); ?>assets/admin/js/custom.js"></script>
<script type="text/javascript">
	pageSetUp();

	$(document).ready(function() {
		var pagefunction = function() {
			CKEDITOR.instances['answer'].on('change', function() { CKEDITOR.instances['answer'].updateElement() });
			var $checkoutForm = $('#validate-form').validate({
				rules : {
					question : {
						required : true
					}
				},
				messages : {
					question : {
						required : 'Please enter question'
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
			    	$("#validate-form").attr("action", "<?= site_url("admin/faqs/index"); ?>/" + obj.data_mode + "/" + obj.return_id);
			    	if(obj.data_mode != '') window.history.pushState("string", "Faqs", "#faqs/index/" + obj.data_mode + "/" + obj.return_id);
			    	if(obj.data_mode != 'edit') location.reload();
			    }
			};
		};

		loadScript("<?= site_url('assets/admin/js/plugin/jquery-form/jquery-form.min.js'); ?>", pagefunction);
	});
</script>