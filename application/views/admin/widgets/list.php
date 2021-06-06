<div class="row">
	<div class="col-lg-6">
		<h1 class="page-title txt-color-blueDark">
			<i class="fa-fw fa fa-pencil-square-o"></i> Widgets
		</h1>
	</div>
	<div class="col-lg-6">
		<div class="btn-group btn-sm pull-right">
			<button class="btn btn-success changeURL" data-url="#widgets/"><i class="fa fa-list"></i> Widget List</button>
			<button class="btn btn-danger changeURL" data-url="#widgets/manage"><i class="fa fa-plus-circle"></i> Add Widget</button>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-12">
		<div class="panel panel-primary">
		  	<div class="panel-heading">
		  		Widget List
		  	</div>
		  	<?php $total_rows = count($rows); ?>
			<table class="table table-bordered">
			    <thead>
			        <tr>
			        	<th>Widget</th>
			        	<th>Title</th>
						<th>Status</th>
						<th style="width: 85px;">Action</th>
					</tr>
	        	</thead>
	        	<tbody>
            	<?php
            	if($total_rows > 0) {
            		foreach ($rows as $row) {
						$label = ($row['enabled'] == 1) ? 'label-success' : 'label-danger';
						$status = ($row['enabled'] == 1) ? 'Enabled' : 'Disabled';
            		?>
	        		<tr id="hiderow<?= $row['id']; ?>">
	        			<td><?= $row['section_id']; ?></td>
	        			<td><?= $row['title']; ?></td>
	        			<td>
							<a data-original-title="Select Status" data-url="<?= site_url("admin/widgets/ajax_status_update"); ?>" data-value="<?= $row['enabled']; ?>" data-pk="<?= $row['id'] ?>" data-type="select" data-name="enabled" name="enabled" class="rstatusopt" href="#">
							 	<span class="label <?= $label; ?>"><?= $status; ?></span>
							</a>
	        			</td>
						<td>
							<div class="btn-group">
								<a href="#widgets/manage/edit/<?= $row['id']; ?>" class="btn btn-default btn-xs" title="Edit"><i class="fa fa-pencil"></i></a>
								<?php /*
								<a class="btn btn-default btnDel btn-xs" data-url="<?= site_url("admin/widgets/manage/delete/"); ?>" data-toggle="modal" data-target="#myModal" id="<?= $row['id'] ?>" title="Delete" ><i class="fa fa-trash-o"></i></a>							
								*/ ?>
							</div>
						</td>
	        		</tr>
	        		<?php }
					} else echo '<tr><td colspan="4">No Result Found</td></tr>'; ?>
	        	</tbody>
	        </table>
		  	<?php if(!empty($pagination)) { ?>
		  	<div class="panel-footer">
		  		<?= $pagination; ?>
		  	</div>
		  	<?php } ?>
		</div>
	</div>
</div>

<div class="modal fade" id="myModal">
  	<div class="modal-dialog">
    	<div class="modal-content">
      		<div class="modal-header">
        		<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        		<h4 class="modal-title">Delete</h4>
      		</div>
      		<div class="modal-body">
        		<p>Are you sure to delete this data?</p>
      		</div>
      		<div class="modal-footer">
				<button type="submit" data-dismiss="modal" class="btn btn-danger">Cancel</button>
				<button type="submit" data-dismiss="modal" class="btn btn-primary ConfirmDel">Confirm</button>
      		</div>
    	</div>
  	</div>
</div>
<input type="hidden" name="hidden_input_id" id="hidden_input_id" value="" />

<script src="<?= base_url(); ?>assets/admin/js/custom.js"></script>
<script type="text/javascript">
	pageSetUp();
</script>