<div class="row">
	<div class="col-lg-6">
		<h1 class="page-title txt-color-blueDark">
			<i class="fa-fw fa fa-pencil-square-o"></i> Advertisement
		</h1>
	</div>
	<div class="col-lg-6">
		<div class="btn-group btn-sm pull-right">
			<button class="btn btn-success changeURL" data-url="#advertisement/"><i class="fa fa-list"></i> Advertise List</button>
			<?php /* <button class="btn btn-danger changeURL" data-url="#advertisement/manage/"><i class="fa fa-plus-circle"></i> Add Advertise</button> */ ?>
		</div>
	</div>
</div>


<div class="panel panel-primary">
  	<div class="panel-heading">
  		<div class="pull-left">
  			<h4><i class="fa fa-list"></i> Advertise List</h4>
  		</div>
  		<div class="pull-right">
  		</div>
		<div class="clearfix"></div>
  	</div>
  	<?php $total_rows = count($rows); ?>
	<table class="table table-bordered">
	    <thead>
	        <tr>
	        	<th>Image</th>
	        	<th>Name</th>
	        	<th>Position</th>
				<th>Status</th>
				<th style="width: 115px;">Action</th>
			</tr>
    	</thead>
    	<tbody>
    	<?php
    	if($total_rows > 0) {
    		foreach ($rows as $row) {
				$label = ($row['enabled'] == 1) ? 'label-success' : 'label-danger';
				$status = ($row['enabled'] == 1) ? 'Enabled' : 'Disabled';
				
				$image = (!empty($row['image']) && file_exists("./uploads/media/advertisement/{$row['image']}")) ? base_url() . "uploads/media/advertisement/{$row['image']}" : "holder.js/60x60";
    		?>
    		<tr id="hiderow<?= $row['id']; ?>">
    			<td>
    				<img style="max-height: 160px;" class="img-thumbnail img-responsive" src="<?= $image; ?>" />
    			</td>
    			<td><?= $row['name']; ?></td>
    			<td><?= $row['position']; ?></td>
    			<td>
					<a data-original-title="Select Status" data-url="<?= site_url("admin/advertisement/ajax_status_update"); ?>" data-value="<?= $row['enabled']; ?>" data-pk="<?= $row['id'] ?>" data-type="select" data-name="enabled" name="enabled" class="rstatusopt" href="#">
					 	<span class="label <?= $label; ?>"><?= $status; ?></span>
					</a>
    			</td>
				<td>
					<div class="btn-group">
						<a href="#advertisement/manage/edit/<?= $row['id']; ?>" class="btn btn-default btn-xs" title="Edit"><i class="fa fa-pencil"></i></a>
						<?php /* <a class="btn btn-default btnDel btn-xs" data-url="<?= site_url("admin/advertisement/manage/delete/"); ?>" data-toggle="modal" data-target="#myModal" id="<?= $row['id'] ?>" title="Delete" ><i class="fa fa-trash-o"></i></a> */ ?>							
					</div>
				</td>
    		</tr>
    		<?php }
			} else echo '<tr><td colspan="5">No Result Found</td></tr>'; ?>
    	</tbody>
    </table>
    
    <?php if($pagination) { ?>
    <div class="panel-footer">
    	<?= $pagination; ?>
    </div>
    <?php } ?>
</div>


<?php $this->load->view("admin/common-delete-modal"); ?>

<script src="<?= base_url(); ?>assets/js/holder.min.js"></script>
<script src="<?= base_url(); ?>assets/admin/js/custom.js"></script>
<script type="text/javascript">
	pageSetUp();
</script>