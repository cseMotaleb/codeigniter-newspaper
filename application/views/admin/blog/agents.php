<div class="row">
	<div class="col-lg-6">
		<h1 class="page-title txt-color-blueDark">
			<i class="fa-fw fa fa-list"></i> News Agents
		</h1>
	</div>
	<div class="col-lg-6 pull-right">
		<button class="btn btn-danger changeURL pull-right" data-url="#news/agents"><i class="fa fa-plus-circle"></i> Add Agent</button>
	</div>
</div>

<div class="row">
	<div class="col-md-6">
		<div class="panel panel-primary">
		  	<div class="panel-heading">
		  		<h4><i class="fa fa-list"></i> Agents</h4>
		  	</div>
		  	<?php $total_rows = count($rows); ?>
			<table class="table table-bordered">
			    <thead>
			        <tr>
			        	<th>Image</th>
			        	<th>Name</th>
						<th class="text-center" colspan="2">Action</th>
					</tr>
	        	</thead>
	        	<tbody>
	        	<?php
	        	if($total_rows > 0) {
	        		foreach ($rows as $row) {
	        			$image = (file_exists("./uploads/agents/{$row['image']}")) ? base_url() . "uploads/agents/{$row['image']}" : "";
	        		?>
	        		<tr id="hiderow<?= $row['id']; ?>">
	        			<td>
	        				<img style="width: 65px; height: 65px;" alt="<?= $row['name']; ?>" src="<?= $image; ?>" />
	        			</td>
	        			<td><?= $row['name']; ?></td>
						<td class="text-center">
							<a href="#news/agents/edit/<?= $row['id']; ?>" class="btn btn-primary btn-xs" title="Edit"><i class="fa fa-pencil"></i></a>							
						</td>
						<td class="text-center">
							<a class="btn btn-danger btnDel btn-xs" data-url="<?= site_url("admin/news/agents/delete/"); ?>" data-toggle="modal" data-target="#myModal" id="<?= $row['id'] ?>" title="Delete" ><i class="fa fa-trash-o"></i></a>
						</td>
	        		</tr>
	        		<?php }
					} else echo "<tr><td colspan=\"4\">No resault found.</td></tr>" ?>
	        	</tbody>		
	        </table>

	        <?php if($total_rows > 0) { ?>
	        <div class="panel-footer">
				<div class="text-right">
					<?= $pagination; ?>
				</div>
	        </div>
	        <?php } ?>
		</div>
	</div>
	<div class="col-md-6">
		<form action="<?= site_url("admin/news/agents/{$mode}/{$current_id}"); ?>" method="post" id="validate-form">	
			<div class="panel panel-primary">
			  	<div class="panel-heading">
			    	<h3 class="panel-title">
			    		<strong><?= ucfirst($mode); ?></strong> News Agent
					</h3>
			  	</div>
			
			  	<div class="panel-body">
			    	<div class="formSep">
					   	<label class="req">Name</label>
					   	<input class="form-control" type="text" name="name" id="name" placeholder="Enter name" value="<?php if(isset($row_data['name'])) echo $row_data['name']; ?>" />
			    	</div>

			    	<hr />
		
			    	<?php $image = (isset($row_data['image']) && !empty($row_data['image']) && file_exists("./uploads/agents/{$row_data['image']}")) ? base_url() . "uploads/agents/{$row_data['image']}" : "holder.js/165x160"; ?>
			  		<div class="form_sep">
		         		<label for="userName">Image</label>
		                <div class="fileupload fileupload-new" data-provides="fileupload">
		                    <div class="fileupload-new img-thumbnail" style="width: 178px; height: 120px;">
		                    	<img src="<?= $image; ?>" alt="">
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
					<div class="formSep">
						<input type="hidden" name="id" value="<?php if(isset($current_id)) echo $current_id; ?>" />
						<button type="submit" class="btn btn-lg btn-primary"><i class="fa fa-floppy-o"></i> <?php if($mode == "edit") echo "Update"; else echo "Save"; ?> Agent</button>
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
		var pagefunction = function() {
			var $checkoutForm = $('#validate-form').validate({
				rules : {
					name : {
						required : true
					}	
				},
				messages : {
					name : {
						required : 'Please enter name'
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
			    	
			    }
			};
		};

		loadScript("<?= site_url('assets/admin/js/plugin/jquery-form/jquery-form.min.js'); ?>", pagefunction);
	});
</script>