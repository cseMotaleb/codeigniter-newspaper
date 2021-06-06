<div class="row">
	<div class="col-lg-6">
		<h1 class="page-title txt-color-blueDark">
			<i class="fa-fw fa fa-pencil-square-o"></i> News Comments
		</h1>
	</div>
	<div class="col-lg-6">
		<div class="btn-group btn-sm pull-right">
			<button class="btn btn-success changeURL" data-url="#news/"><i class="fa fa-navicon"></i> News List</button>
			<button class="btn btn-danger changeURL" data-url="#news/manage/"><i class="fa fa-list-alt"></i> Add News</button>
		</div>
	</div>
</div>

<div class="panel panel-primary">
  	<div class="panel-heading">
  		<h4>News Comment List</h4>
  	</div>
  	<?php $total_rows = count($rows); ?>
	<table class="table table-bordered">
	    <thead>
	        <tr>
	        	<th>News</th>
	        	<th>Comment</th>
	        	<th>Date</th>
				<th>Status</th>
				<th colspan="2" class="text-center">Action</th>
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
    			<td><?= $row['title']; ?></td>
    			<td><?= $row['comment']; ?></td>
    			<td><?= date("Y-m-d", strtotime($row['date'])); ?></td>
    			<td>
					<a data-original-title="Select Status" data-url="<?= site_url("admin/news/ajax_comment_status_update"); ?>" data-value="<?= $row['enabled']; ?>" data-pk="<?= $row['id'] ?>" data-type="select" data-name="enabled" name="enabled" class="rstatusopt" href="#">
					 	<span class="label <?= $label; ?>"><?= $status; ?></span>
					</a>
    			</td>
				<td class="text-center">
					<a href="#news/comment/edit/<?= $row['id']; ?>" class="btn btn-primary btn-xs" title="Edit"><i class="fa fa-pencil"></i></a>
				</td>
				<td class="text-center">
					<a class="btn btn-danger btnDel btn-xs" data-url="<?= site_url("admin/news/comment/delete/"); ?>" data-toggle="modal" data-target="#myModal" id="<?= $row['id'] ?>" title="Delete" ><i class="fa fa-trash-o"></i></a>
				</td>
    		</tr>
    		<?php }
			} else echo '<tr><td colspan="6">No Result Found</td></tr>'; ?>
    	</tbody>
    </table>
    
    <?php if(!empty($pagination)) { ?>
    <div class="panel-footer">
    	<?= $pagination; ?>
    </div>
    <?php } ?>
</div>

<?php $this->load->view("admin/common-delete-modal"); ?>

<script src="<?= base_url(); ?>assets/admin/js/custom.js"></script>
<script type="text/javascript">
	pageSetUp();


</script>