<h1 class="page-title txt-color-blueDark">
	<i class="fa-fw fa fa-pencil-square-o"></i> Page List
</h1>
<?php /*
<div class="row">
	<div class="col-lg-6">
		<h1 class="page-title txt-color-blueDark">
			<i class="fa-fw fa fa-pencil-square-o"></i> Page List
		</h1>
	</div>
	<div class="col-lg-6">
		<div class="btn-group btn-sm pull-right">
			<button data-url="#pages/manage" class="btn btn-danger pull-right changeURL"><i class="fa fa-plus-circle"></i> Add Page</button>
		</div>
	</div>
</div> */ ?>

<?php
	include 'search-pages.php';
	$total_rows = count($rows);
?>

<form id="BulkDeleteForm" method="post" action="<?= site_url("admin/pages/manage/bulk_delete"); ?>">
	<div class="panel panel-primary">
	  	<div class="panel-heading">
	  		<h4>Pages List</h4>
	  	</div>
		<table class="table table-bordered">
			<thead>
				<tr>
                    <th>Page</th>
					<th>Title</th>
					<th>Status</th>
					<th style="width: 110px;">Action</th>
				</tr>
			</thead>
			<tbody>
				<?php
				if($total_rows > 0) {
					foreach ($rows as $row) {
					$label = '';
					if(isset($row['status']) && $row['status'] =='Draft') $label = 'label-info'; 
					else if(isset($row['status']) && $row['status'] =='Public') $label = 'label-success';
					else if(isset($row['status']) && $row['status'] =='Private') $label = 'label-danger';

					$enabled = '';
					if(isset($row['status']) && $row['status'] =='Draft') $enabled = 'Draft';
					else if(isset($row['status']) && $row['status'] =='Public') $enabled = 'Public';
					else if(isset($row['status']) && $row['status'] =='Private') $enabled = 'Private';
				?>
				<tr id="hiderow<?= $row['id']; ?>">
					<td><?= $row['page']; ?></td>
					<td><?php if($row['meta_title']) echo $row['meta_title']; else echo $row['page']; ?></td>
					<td><span class="label <?= $label; ?>"><?= $enabled; ?></span></td>
					<td>
						<div class="btn-group">
							<a href="<?= site_url($row['url']); ?>" target="_blank" class="btn btn-default btn-xs" title="View"><i class="fa fa-tasks"></i></a>
							<a href="#pages/manage/edit/<?= $row['id']; ?>" class="btn btn-default btn-xs" title="Edit"><i class="fa fa-pencil"></i></a>
							<?php /*
							<a class="btn btn-default btnDel btn-xs" data-url="<?= site_url("admin/pages/manage/delete/"); ?>" data-toggle="modal" data-target="#myModal" id="<?= $row['id'] ?>" title="Delete" ><i class="fa fa-trash-o"></i></a>							
							*/ ?>
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
</form>

<?php $this->load->view("admin/common-delete-modal"); ?>

<script src="<?= base_url(); ?>assets/admin/js/custom.js"></script>
<script type="text/javascript">
	pageSetUp();
</script>