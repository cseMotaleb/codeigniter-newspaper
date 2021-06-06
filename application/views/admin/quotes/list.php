<div class="row">
	<div class="col-lg-6">
		<h1 class="page-title txt-color-blueDark">
			<i class="fa-fw fa fa-pencil-square-o"></i> Quotes
		</h1>
	</div>
	<div class="col-lg-6">
		<div class="btn-group btn-sm pull-right">
			<button class="btn btn-success changeURL" data-url="#quotes/"><i class="fa fa-list"></i> Quote List</button>
			<button class="btn btn-danger changeURL" data-url="#quotes/manage/"><i class="fa fa-plus-circle"></i> Add Quote</button>
		</div>
	</div>
</div>

<?php include 'search.php'; ?>


<div class="panel panel-primary">
  	<div class="panel-heading">
  		<div class="pull-left">
  			<h4><i class="fa fa-list"></i> Quote List</h4>
  		</div>
  		<div class="pull-right">
  		</div>
		<div class="clearfix"></div>
  	</div>
  	<?php $total_rows = count($rows); ?>
	<table class="table table-bordered">
	    <thead>
	        <tr>
	        	<th>Contact</th>
	        	<th>Address</th>
	        	<th>Roof Details</th>
				<th>Status</th>
				<th style="width: 115px;">Action</th>
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
    				<?php
    					echo "{$row['first_name']} {$row['last_name']}";
    					if($row['contact_number']) echo "<br />{$row['contact_number']}";
    					if($row['phone']) echo "<br />{$row['phone']}";
    					if($row['email']) echo "<br /><a href=\"mailto:{$row['email']}\">{$row['email']}</a>";
					?>
    			</td>
    			<td>
    				<?php
    					echo $row['street_address'];
						if($row['suburb']) echo "<br />{$row['suburb']}";
						if($row['state']) echo ", {$row['suburb']}";
						if($row['postcode']) echo " - {$row['postcode']}";
					?>
    			</td>
    			<td>
    				<?php
    					if($row['roof_type']) echo "<strong>Property: </strong>{$row['roof_type']}<br />";
						if($row['stories']) echo "<strong>Stories: </strong>{$row['stories']}<br />";
						if($row['system_size']) echo "<strong>System Size: </strong>{$row['system_size']}";
    				?>
    			</td>
    			<td>
					<a data-original-title="Select Status" data-url="<?= site_url("admin/quotes/ajax_status_update"); ?>" data-value="<?= $row['enabled']; ?>" data-pk="<?= $row['id'] ?>" data-type="select" data-name="enabled" name="enabled" class="rstatusopt" href="#">
					 	<span class="label <?= $label; ?>"><?= $status; ?></span>
					</a>
    			</td>
				<td>
					<div class="btn-group">
						<a href="#quotes/manage/edit/<?= $row['id']; ?>" class="btn btn-default btn-xs" title="Edit"><i class="fa fa-pencil"></i></a>
						<a href="#quotes/manage/view/<?= $row['id']; ?>" class="btn btn-default btn-xs" title="View"><i class="fa fa-eye"></i></a>
						<a href="#quotes/reply/<?= $row['id']; ?>" class="btn btn-default btn-xs" title="Reply"><i class="fa fa-envelope-o"></i></a>
						<a class="btn btn-default btnDel btn-xs" data-url="<?= site_url("admin/quotes/manage/delete/"); ?>" data-toggle="modal" data-target="#myModal" id="<?= $row['id'] ?>" title="Delete" ><i class="fa fa-trash-o"></i></a>							
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

<script src="<?= base_url(); ?>assets/admin/js/custom.js"></script>
<script type="text/javascript">
	pageSetUp();
</script>