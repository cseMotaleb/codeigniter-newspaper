<div class="row">
	<div class="col-lg-6">
		<h1 class="page-title txt-color-blueDark">
			<i class="fa-fw fa fa-pencil-square-o"></i> Services
		</h1>
	</div>
	<div class="col-lg-6">
		<div class="btn-group btn-sm pull-right">
			<button class="btn btn-success pull-right changeURL" data-url="#services/"><i class="fa fa-navicon"></i> Service List</button>
			<button class="btn btn-danger pull-right changeURL" data-url="#services/manage/"><i class="fa fa-list-alt"></i> Add Service</button>
		</div>
	</div>
</div>

<?php include 'search.php'; ?>

<div class="panel panel-default">
  	<div class="panel-heading">
  		Products
  	</div>
  	<?php $total_rows = count($rows); ?>
	<form id="BulkDeleteForm" method="post" action="<?= site_url("admin/services/manage/bulk_delete"); ?>">
		<table class="table table-bordered">
		    <thead>
		        <tr>
		        	<th>
		        		<?php if($total_rows > 0) { ?>
		        		<input name="all_bulk" id="all_bulk" value="" type="checkbox" />
		        		<?php } ?>
		        	</th>
		        	<th><small>Image</small></th>
		        	<th><small>Product Name</small></th>
					<th><small>Homepage</small></th>
					<th><small>Status</small></th>
					<th style="width: 65px;"><small>Action</small></th>
				</tr>
        	</thead>
        	<tbody>
        	<?php
         	if($total_rows > 0) {
        		foreach ($rows as $row) {
					$label = ($row['enabled'] == 1) ? 'label-success' : 'label-danger';
					$status = ($row['enabled'] == 1) ? 'Enabled' : 'Disabled';
					
					$homepage_label = ($row['homepage'] == 1) ? 'label-success' : 'label-danger';
					$homepage = ($row['homepage'] == 1) ? 'Yes' : 'No';
					$image = (!empty($row['image']) && file_exists("./uploads/services/{$row['image']}")) ? base_url().'uploads/services/'.$row['image'] : "holder.js/80x80";
        		?>
        		<tr id="hiderow<?= $row['id']; ?>">
        			<td>
        				<input name="bulk_delete[]" class="bulk_checkbox" value="<?= $row['id']; ?>" type="checkbox" />
        			</td>
        			<td>
        				<img style="height: 60px; width: 60px;" class="img-thumbnail" alt="<?= $row['service_name']; ?>" title="<?= $row['service_name']; ?>" src="<?= $image; ?>" />
        			</td>
        			<td><?= $row['service_name']; ?></td>
        			<td><span class="label <?= $homepage_label; ?>"><?= $homepage; ?></span></td>
        			<td>
						<a data-original-title="Select Status" data-url="<?= site_url("admin/services/ajax_status_update"); ?>" data-value="<?= $row['enabled']; ?>" data-pk="<?= $row['id'] ?>" data-type="select" data-name="enabled" name="enabled" class="rstatusopt" href="#">
						 	<span class="label <?= $label; ?>"><?= $status; ?></span>
						</a>
        			</td>
					<td>
						<div class="btn-group">
							<a href="#services/manage/edit/<?= $row['id']; ?>" class="btn btn-default btn-xs" title="Edit"><i class="fa fa-pencil"></i></a>
							<a class="btn btn-default btnDel btn-xs" data-url="<?= site_url("admin/services/manage/delete/"); ?>" data-toggle="modal" data-target="#myModal" id="<?= $row['id'] ?>" title="Delete" ><i class="fa fa-trash-o"></i></a>
						</div>
					</td>
        		</tr>
        		<?php }
				} else echo '<tr><td colspan="6">No Result Found</td></tr>'; ?>
        	</tbody>
        	<?php if($total_rows > 0) { ?>
    		<tfoot>
    			<tr>
    				<td colspan="6" class="text-right">
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

<?php $this->load->view("admin/common-delete-modal"); ?>

<script src="<?= base_url(); ?>assets/js/holder.min.js"></script>
<script src="<?= base_url(); ?>assets/admin/js/custom.js"></script>
<script type="text/javascript">
	pageSetUp();
</script>