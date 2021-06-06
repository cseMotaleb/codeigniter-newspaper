<div class="row">
	<div class="col-lg-6">
		<h1 class="page-title txt-color-blueDark">
			<i class="fa-fw fa fa-pencil-square-o"></i> Prayers
		</h1>
	</div>
	<div class="col-lg-6">
		<div class="btn-group btn-sm pull-right">
			<button class="btn btn-success pull-right changeURL" data-url="#prayers/"><i class="fa fa-navicon"></i> Prayer List</button>
			<button class="btn btn-danger pull-right changeURL" data-url="#prayers/manage/"><i class="fa fa-list-alt"></i> Add Prayer</button>
		</div>
	</div>
</div>

<div class="panel panel-primary">
  	<div class="panel-heading">
  		Prayers
  	</div>
  	<?php $total_rows = count($rows); ?>
	<table class="table table-bordered">
	    <thead>
	        <tr>
	        	<th><small>Date</small></th>
	        	<th><small>ফজর</small></th>
	        	<th><small>জোহর</small></th>
				<th><small>আসর</small></th>
				<th><small>মাগরিব</small></th>
				<th><small>এশা</small></th>
				<th><small>জুম’আ</small></th>
				<th><small>Default</small></th>
				<th style="width: 65px;"><small>Action</small></th>
			</tr>
    	</thead>
    	<tbody>
    	<?php
     	if($total_rows > 0) {
    		foreach ($rows as $row) {
				$label = ($row['default'] == 1) ? 'label-success' : 'label-danger';
				$status = ($row['default'] == 1) ? 'Yes' : 'No';
    		?>
    		<tr id="hiderow<?= $row['id']; ?>">
    			<td><?= $row['date']; ?></td>
    			<td><?= $row['prayer1']; ?></td>
    			<td><?= $row['prayer2']; ?></td>
    			<td><?= $row['prayer3']; ?></td>
    			<td><?= $row['prayer4']; ?></td>
    			<td><?= $row['prayer5']; ?></td>
    			<td><?= $row['prayer6']; ?></td>
    			<td>
					<span class="label <?= $label; ?>"><?= $status; ?></span>
    			</td>
				<td>
					<div class="btn-group">
						<a href="#prayers/manage/edit/<?= $row['id']; ?>" class="btn btn-default btn-xs" title="Edit"><i class="fa fa-pencil"></i></a>
						<?php if($row['id'] != 1) { ?>
						<a class="btn btn-default btnDel btn-xs" data-url="<?= site_url("admin/prayers/manage/delete/"); ?>" data-toggle="modal" data-target="#myModal" id="<?= $row['id'] ?>" title="Delete" ><i class="fa fa-trash-o"></i></a>
						<?php } ?>
					</div>
				</td>
    		</tr>
    		<?php }
			} else echo '<tr><td colspan="8">No Result Found</td></tr>'; ?>
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