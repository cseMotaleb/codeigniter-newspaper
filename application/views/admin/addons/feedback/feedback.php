<div class="row">
	<div class="col-lg-6">
		<h1 class="page-title txt-color-blueDark">
			<i class="fa-fw fa fa-pencil-square-o"></i> Feedback
		</h1>
	</div>
	<div class="col-lg-6">
		<div class="btn-group btn-sm pull-right">
			<button class="btn btn-success pull-right changeURL" data-url="#feedback/"><i class="fa fa-navicon"></i> Feedback List</button>
		</div>
	</div>
</div>

<?php
	include 'feedback-search.php';
	$total_rows = count($rows);
?>

<div class="row">
	<div class="col-md-12">
		<div class="panel panel-primary">
		  	<div class="panel-heading">
		  		feedback
		  	</div>
	  		<form id="BulkDeleteForm" method="post" action="<?= site_url("admin/feedback/index/bulk_delete"); ?>">
				<table class="table table-bordered">
				    <thead>
				        <tr>
				        	<th>
				        		<?php if($total_rows > 0) { ?>
				        		<input name="all_bulk" id="all_bulk" value="" type="checkbox" />
				        		<?php } ?>
				        	</th>
				        	<th><small>Name</small></th>
				        	<th><small>Email</small></th>
				        	<th><small>Message</small></th>
				        	<th><small>Date</small></th>
							<th style="width: 85px;"><small>Action</small></th>
						</tr>
		        	</thead>
		        	<tbody>
                	<?php
                	if($total_rows > 0) {
                		foreach ($rows as $row) {
					?>
		        		<tr id="hiderow<?= $row['id']; ?>">
		        			<td>
		        				<input name="bulk_delete[]" class="bulk_checkbox" value="<?= $row['id']; ?>" type="checkbox" />
		        			</td>
		        			<td><?= $row['name']; ?></td>
		        			<td><?= "{$row['email']}"; ?></td>
		        			<td><?= $row['message']; ?></td>
		        			<td><?= $row['date_timestamp']; ?></td>
							<td>
								<div class="btn-group">
                                    <a href="#feedback/reply/<?= $row['id']; ?>" class="btn btn-default btn-xs" title="Reply"><i class="fa fa-envelope-o"></i></a>
									<a class="btn btn-default btnDel btn-xs" data-url="<?= site_url("admin/feedback/index/delete/"); ?>" data-toggle="modal" data-target="#myModal" id="<?= $row['id'] ?>" title="Delete" ><i class="fa fa-trash-o"></i></a>							
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
	</div>
</div>

<?php $this->load->view("admin/common-delete-modal"); ?>

<script src="<?= base_url(); ?>assets/admin/js/custom.js"></script>
<script type="text/javascript">
	pageSetUp();
</script>