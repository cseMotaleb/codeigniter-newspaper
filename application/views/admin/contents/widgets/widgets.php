<div class="row">
	<div class="col-lg-6">
		<h1 class="page-title txt-color-blueDark">
			<i class="fa-fw fa fa-pencil-square-o"></i> Widgets
		</h1>
	</div>
	<div class="col-lg-6">
		<div class="btn-group btn-sm pull-right">
			<button class="btn btn-success pull-right changeURL" data-url="#widgets/"><i class="fa fa-navicon"></i> Widgets List</button>
			<button class="btn btn-danger pull-right changeURL" data-url="#widgets/index/"><i class="fa fa-list-alt"></i> Add Widgets</button>
		</div>
	</div>
</div>

<?php include 'widget-search.php'; ?>

<div class="row">
	<div class="col-md-7">
		<div class="panel panel-default">
		  	<div class="panel-heading">
		  		Widgets
		  	</div>
	  		<form id="BulkDeleteForm" method="post" action="<?= site_url("admin/widgets/index/bulk_delete"); ?>">
				<table class="table table-bordered">
				    <thead>
				        <tr>
				        	<th>
				        		<input name="all_bulk" id="all_bulk" value="" type="checkbox" />
				        	</th>
                            <th><small>Widget (section_id)</small></th>
				        	<th><small>Title</small></th>
				        	<th><small>Status</small></th>
							<th style="width: 65px;"><small>Action</small></th>
						</tr>
		        	</thead>
		        	<tbody>
                	<?php
                	if(count($rows) > 0) {
                		foreach ($rows as $row) {
							$label = ($row['enabled'] == 1) ? 'label-success' : 'label-danger';
							$status = ($row['enabled'] == 1) ? 'Enabled' : 'Disabled';
                		?>
		        		<tr id="hiderow<?= $row['id']; ?>">
		        			<td>
		        				<input name="bulk_delete[]" class="bulk_checkbox" value="<?= $row['id']; ?>" type="checkbox" />
		        			</td>
		        			<td>
		        			    <small><?= "{$row['section_id']}"; ?></small>
		        			</td>
		        			<td>
		        				<small><?= "{$row['title']}"; ?></small>
							</td>  
		        			<td>
								<a data-original-title="Select Status" data-url="<?= site_url("admin/widgets/ajax_status_update"); ?>" data-value="<?= $row['enabled']; ?>" data-pk="<?= $row['id'] ?>" data-type="select" data-name="enabled" name="enabled" class="rstatusopt" href="#">
								 	<span class="label <?= $label; ?>"><?= $status; ?></span>
								</a>
		        			</td>
							<td>
								<div class="btn-group">
									<a href="#widgets/index/edit/<?= $row['id']; ?>" class="btn btn-default btn-xs" title="Edit"><i class="fa fa-pencil"></i></a>
									<a class="btn btn-default btnDel btn-xs" data-toggle="modal" data-url="<?= site_url("admin/widgets/index/delete/"); ?>" data-target="#myModal" id="<?= $row['id'] ?>" title="Delete" ><i class="fa fa-trash-o"></i></a>
								</div>
							</td>
		        		</tr>
		        		<?php }
						} else echo '<tr><td colspan="5">No Result Found</td></tr>'; ?>
		        	</tbody>
	        		<tfoot>
	        			<tr>
	        				<td colspan="5" class="text-right">
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
		        </table>
		  	</form>
		</div>
	</div>
	
	<div class="col-md-5">
		<form action="<?= site_url("admin/widgets/index/{$mode}/{$current_id}"); ?>" method="post" id="validate-form">
		<div class="panel panel-default">
			  	<div class="panel-heading">
			  		<div class="pull-left">
				    	<h3 class="panel-title">
				    		<span class="text-danger"><strong><?= ucfirst($mode); ?></strong></span> Widgets Name
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
			    	<div class="formSep">
					   	<label class="req">Widget</label>
					   	<input class="form-control" type="text" name="section_id" id="section_id" placeholder="Enter widgets name" value="<?php if(isset($row_data['section_id'])) echo $row_data['section_id']; ?>" />
					</div>
					
					<hr />
					  		
			    	<div class="formSep">
	    				<?php $selected_image = isset($row_data['image']) ? $row_data['image'] : ''; ?>
					  	<label>Image</label>
					    <select name="image" id="image" class="select2" style="width: 100%;">
						  <?php
						  		$homepage_images = get_image_list($filters=array('status'=>'Enabled'), $selected_image); 
							  	echo $homepage_images['image_list']; 
						  ?>
					   </select>
			    	</div>

			    	<hr />

	    			<div class="formSep">
					   	<label class="req">URL</label>
					  	<input class="form-control" type="text" name="url" id="url" placeholder="Enter url" value="<?php if(isset($row_data['url'])) echo $row_data['url']; ?>" />
				   </div>
				   
				   <hr />

    				<div class="formSep">
				   		<label class="req">Title</label>
				  		<input class="form-control" type="text" name="title" id="title" placeholder="Enter title" value="<?php if(isset($row_data['title'])) echo $row_data['title']; ?>" />
			  		</div>

					<hr />

					<div class="formSep">
			    		<div class="row">
			    			<div class="col-md-12">
							   	<div class="panel panel-default">
									<div class="panel-heading">Description</div>
					    			<textarea class="ckeditor" id="description" name="description"><?php if(isset($row_data['description'])) echo $row_data['description']; else echo set_value('description');?></textarea>
						   		</div>
						   	</div>
			    		</div>
			    	</div>

					<hr />

					<div class="formSep">
						<input type="hidden" name="id" value="<?php if(isset($current_id)) echo $current_id; ?>" />
						<button type="submit" class="btn btn-primary">Save</button>
					</div>
				</div>
			</div>
		</form>
	</div>
</div>

<?php $this->load->view("admin/common-delete-modal"); ?>

<script src="<?= base_url(); ?>assets/js/holder.min.js"></script>
<script src="<?= base_url(); ?>assets/admin/js/custom.js"></script>
<script type="text/javascript">
	pageSetUp();

	$(document).ready(function() {
	     function format(state) { var originalOption = state.element; return "<img class='flag' src='" + $(originalOption).data('image') + "' alt='" + $(originalOption).data('title') + "' />" + state.text;}

        if($('#image').length) {
            $('#image').select2({
            	placeholder: "Select a image",
            	allowClear: true,
            	formatResult: format,
				formatSelection: format,
            	escapeMarkup: function(m) { return m; }
            });
        };

		var pagefunction = function() {
			CKEDITOR.instances['description'].on('change', function() { CKEDITOR.instances['description'].updateElement() });
			var $checkoutForm = $('#validate-form').validate({
				rules : {
					section_id : {
						required : true
					},
    				title : {
    					required : true
    				}
				},
				messages : {
					section_id : {
						required : 'Please enter section id'
					},
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
			
			<?php if(isset($row_data['url']) && $row_data['url'] != '') { ?>
				$("#url").select2("data", {id: "<?= $row_data['url']; ?>", text: "<?= $row_data['url']; ?>"});
			<?php } ?>

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
			    	$("#validate-form").attr("action", "<?= site_url("admin/widgets/index"); ?>/" + obj.data_mode + "/" + obj.return_id);
			    	if(obj.data_mode != '') window.history.pushState("string", "Widgets", "#widgets/index/" + obj.data_mode + "/" + obj.return_id);
			    	if(obj.data_mode != 'edit') location.reload();
			    }
			};
		};

	   loadScript("<?= site_url('assets/admin/js/plugin/jquery-form/jquery-form.min.js'); ?>", pagefunction);
	});
</script>