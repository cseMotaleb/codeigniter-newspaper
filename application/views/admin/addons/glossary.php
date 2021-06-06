<div class="row">
	<div class="col-lg-6">
		<h1 class="page-title txt-color-blueDark">
			<i class="fa-fw fa fa-pencil-square-o"></i> Glossary
		</h1>
	</div>
	<div class="col-lg-6">
		<div class="btn-group btn-sm pull-right">
			<button class="btn btn-success changeURL" data-url="#glossary/"><i class="fa fa-list"></i> Glossary List</button>
			<button class="btn btn-danger changeURL" data-url="#glossary/index/"><i class="fa fa-plus-circle"></i> Add Glossary</button>
		</div>
	</div>
</div>

<style type="text/css">
#custom-search-input{
    padding: 3px;
    border: solid 1px #E4E4E4;
    border-radius: 6px;
    background-color: #fff;
}

#custom-search-input input{
    border: 0;
    box-shadow: none;
}

#custom-search-input button{
    margin: 2px 0 0 0;
    background: none;
    box-shadow: none;
    border: 0;
    color: #666666;
    padding: 0 8px 0 10px;
    border-left: solid 1px #ccc;
}

#custom-search-input button:hover{
    border: 0;
    box-shadow: none;
    border-left: solid 1px #ccc;
}

#custom-search-input .glyphicon-search{
    font-size: 23px;
}
</style>

<form method="get" action="#glossary/index/search/0">
	<div class="panel panel-primary">
		<div class="panel-body">
            <div id="custom-search-input">
                <div class="input-group col-md-12">
                    <input type="text" name="title" class="form-control input-lg" value="<?= $this->input->get("title"); ?>" placeholder="Search" />
                    <span class="input-group-btn">
                        <button class="btn btn-info btn-lg" type="submit">
                            <i class="glyphicon glyphicon-search"></i>
                        </button>
                    </span>
                </div>
            </div>
		</div>
	</div>
</form>

<div class="row">
	<div class="col-md-6">
		<div class="panel panel-primary">
		  	<div class="panel-heading">
		  		<h4>Glossary</h4>
		  	</div>
		  	<?php $total_rows = count($rows); ?>
			<table class="table table-bordered">
			    <thead>
			        <tr>
			        	<th><small>Title</small></th>
			        	<th><small>Details</small></th>
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
	        			<td><?= $row['title']; ?></td>
	        			<td><?= $row['details']; ?></td>
	        			<td>
							<a data-original-title="Select Status" data-url="<?= site_url("admin/glossary/ajax_status_update"); ?>" data-value="<?= $row['enabled']; ?>" data-pk="<?= $row['id'] ?>" data-type="select" data-name="enabled" name="enabled" class="rstatusopt" href="#">
							 	<span class="label <?= $label; ?>"><?= $status; ?></span>
							</a>
	        			</td>
						<td>
							<div class="btn-group">
								<a href="#glossary/index/edit/<?= $row['id']; ?>" class="btn btn-default btn-xs" title="Edit"><i class="fa fa-pencil"></i></a>
								<a class="btn btn-default btnDel btn-xs" data-url="<?= site_url("admin/glossary/index/delete/"); ?>" data-toggle="modal" data-target="#myModal" id="<?= $row['id'] ?>" title="Delete" ><i class="fa fa-trash-o"></i></a>							
							</div>
						</td>
	        		</tr>
	        		<?php }
					} else echo '<tr><td colspan="4">No Result Found</td></tr>'; ?>
	        	</tbody>
	        </table>
	        
	        <?php if($pagination) { ?>
	        <div class="panel-footer">
	        	<?= $pagination; ?>
	        </div>
	        <?php } ?>
		</div>
	</div>

	<div class="col-md-6">
		<form action="<?= site_url("admin/glossary/index/{$mode}/{$current_id}"); ?>" method="post" id="validate-form">	
			<div class="panel panel-primary">
			  	<div class="panel-heading">
		    		<div class="pull-left">
		    			<h3 class="panel-title">
		    				<strong><?= ucfirst($mode); ?></strong> Glossary 
						</h3>
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
						<input class="form-control" type="text" name="title" id="title" placeholder="Enter title" value="<?php if(isset($row_data['title'])) echo $row_data['title']; ?>" />
			    	</div>

					<hr />

					<div class="formSep">
						<label class="req">Details</label>
						<textarea class="form-control" rows="5" id="details" name="details"><?php if(isset($row_data['details'])) echo $row_data['details']; ?></textarea>
					</div>
				</div>
				
				<div class="panel-footer">
					<div class="formSep">
						<input type="hidden" name="id" value="<?php if(isset($current_id)) echo $current_id; ?>" />
						<button type="submit" class="btn btn-primary"><i class="fa fa-floppy-o"></i> <?php if($mode == "edit") echo "Update"; echo "Save"; ?> Glossary</button>
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
					details : {
						required : true
					}
				},
				messages : {
					title : {
						required : 'Please enter title'
					},
					details : {
						required : 'Please enter details'
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

		loadScript("<?= site_url('assets/admin/js/plugin/jquery-form/jquery-form.min.js'); ?>", pagefunction);
	});
</script>