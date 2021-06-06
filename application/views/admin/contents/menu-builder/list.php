<div class="row">
	<div class="col-lg-6">
		<h1 class="page-title txt-color-blueDark">
			<i class="fa-fw fa fa-pencil-square-o"></i> Menu Builder
		</h1>
	</div>
	<div class="col-lg-6">
		<div class="btn-group btn-sm pull-right">
			<button data-url="#menu_builder" class="btn btn-success pull-right changeURL"><i class="fa fa-list"></i> Menu List</button>
			<button data-url="#menu_builder/manage" class="btn btn-danger pull-right changeURL"><i class="fa fa-plus-circle"></i> Add menu</button>
		</div>
	</div>
</div>
<section id="widget-grid" class="">
	<div class="row">
		<article class="col-sm-12 col-md-12 col-lg-12">
			<?php include 'search.php'; ?>
		</article>
	</div>
</section>

<form id="BulkDeleteForm" method="post" action="<?= site_url("admin/menu_builder/manage/bulk_delete"); ?>">
	<div class="panel panel-primary">
	  	<div class="panel-heading">
	  		<h4>Menu Builder</h4>
	  	</div>			
	  	<?php $total_rows = count($rows); ?>
		<table class="table table-bordered">
			<thead>
				<tr>
					<th>
		        		<?php if($total_rows > 0) { ?>
		        		<input name="all_bulk" id="all_bulk" value="" type="checkbox" />
		        		<?php } ?>
		        	</th>
                    <th>Menu Name</th>                              
                    <th>Menu ID</th>                           
                    <th>Menu Class</th>
                    <th>View Code</th>
                    <th>Status</th>
                    <th style="width: 95px;">Action</th>
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
            		<td>
        				<input name="bulk_delete[]" class="bulk_checkbox" value="<?= $row['id']; ?>" type="checkbox" />
        			</td>
            		<td><?= $row['name']; ?></td>
            		<td><?php if(!empty($row['menu_id'])) echo $row['menu_id']; else echo 'N/A'; ?></td>
            		<td><?php if(!empty($row['menu_class'])) echo $row['menu_class']; else echo 'N/A'; ?></td>
            		<td><p align="center"><code><?= '&lt;?php echo widget_menu(array("name"=>"'.$row['name'].'")); ?>'?></code> <br />OR <br />
            			<code><?= '&lt;?php echo widget_menu(array("id"=>"'.$row['menu_id'].'")); ?>'?></code></p>
            		</td> 
        			<td>
						<a data-original-title="Select Status" data-url="<?= site_url("admin/menu_builder/ajax_status_update"); ?>" data-value="<?= $row['enabled']; ?>" data-pk="<?= $row['id'] ?>" data-type="select" data-name="enabled" name="enabled" class="rstatusopt" href="#">
						 	<span class="label <?= $label; ?>"><?= $status; ?></span>
						</a>
        			</td>
            		<td>
            			<div class="btn-group">
							<a href="#menu_builder/manage/edit/<?= $row['id']; ?>" class="btn btn-default btn-xs" title="Edit"><i class="fa fa-pencil"></i></a>
							<a class="btn btn-default btnDel btn-xs" data-url="<?= site_url("admin/menu_builder/manage/delete/"); ?>" data-toggle="modal" data-target="#myModal" id="<?= $row['id'] ?>" title="Delete" ><i class="fa fa-trash-o"></i></a>							
						</div>
            		</td>
            	</tr>
            	<?php }
				} else echo '<tr><td colspan="4">No Result Found</td></tr>'; ?>
            </tbody>
		</table>
		
		<?php if($total_rows > 0) { ?>
		<div class="panel-footer">
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
		</div>
 		<?php } ?>	
	</div>
</form>

<?php $this->load->view("admin/common-delete-modal"); ?>

<script src="<?= base_url(); ?>assets/admin/js/custom.js"></script>
<script type="text/javascript">
	pageSetUp();
</script>