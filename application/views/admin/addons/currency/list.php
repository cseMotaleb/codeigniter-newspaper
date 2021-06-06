<div class="row">
	<div class="col-lg-6">
		<h1 class="page-title txt-color-blueDark">
			<i class="fa-fw fa fa-pencil-square-o"></i> Currency
		</h1>
	</div>
	<div class="col-lg-6">
		<div class="btn-group btn-sm pull-right">
			<button class="btn btn-success pull-right changeURL" data-url="#currency/"><i class="fa fa-navicon"></i> Currency List</button>
			<button class="btn btn-danger pull-right changeURL" data-url="#currency/manage/"><i class="fa fa-list-alt"></i> Add Currency</button>
		</div>
	</div>
</div>

<div class="panel panel-primary">
  	<div class="panel-heading">
  		<h4>Currency List</h4>
  	</div>
  	<?php $total_rows = count($rows); ?>
	<table class="table table-bordered">
	    <thead>
	        <tr>
	        	<th>মুদ্রা</th>
	        	<th>বিক্রয়</th>
	        	<th>ক্রয়</th>
				<th class="text-center" colspan="2">Action</th>
			</tr>
    	</thead>
    	<tbody>
    	<?php
     	if($total_rows > 0) {
    		foreach ($rows as $row) {
    		?>
    		<tr id="hiderow<?= $row['id']; ?>">
    			<td><?= $row['currency']; ?></td>
    			<td><?= $row['sale']; ?></td>
    			<td><?= $row['purchase']; ?></td>
				<td class="text-center">
					<a href="#currency/manage/edit/<?= $row['id']; ?>" class="btn btn-primary btn-xs" title="Edit"><i class="fa fa-pencil"></i></a>
				</td>
				<td class="text-center">
					<a class="btn btn-danger btnDel btn-xs" data-url="<?= site_url("admin/currency/manage/delete/"); ?>" data-toggle="modal" data-target="#myModal" id="<?= $row['id'] ?>" title="Delete" ><i class="fa fa-trash-o"></i></a>
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