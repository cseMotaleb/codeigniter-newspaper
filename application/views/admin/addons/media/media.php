<div class="row">
	<div class="col-lg-6">
		<h1 class="page-title txt-color-blueDark">
			<i class="fa-fw fa fa-pencil-square-o"></i> Media Images
		</h1>
	</div>
	<div class="col-lg-6">
		<div class="btn-group btn-sm pull-right">
			<button data-url="#media" class="btn btn-success pull-right changeURL"><i class="fa fa-navicon"></i> Media List</button>
			<?php // <button data-url="#media/manage" class="btn btn-danger pull-right changeURL"><i class="fa fa-list-alt"></i> Add New</button> ?>
		</div>
	</div>
</div>

<div class="panel panel-primary">
  	<div class="panel-heading">
  		Media Image List
  	</div>	
	<table class="table table-bordered">
		<thead>
			<tr>
				<th>Image</th>
				<th>File Name</th>
				<th>File Link - Copy</th>
				<th class="text-center">Action</th>
			</tr>
		</thead>
		<tbody class="MediaData">
			<?php include 'media-list.php'; ?>
		</tbody>
	</table>
	<div class="panel-footer">
		<?php if(!empty($pagination)) echo $pagination; ?> 
	</div>
</div>

<?php $this->load->view("admin/common-delete-modal"); ?>
<script src="<?= base_url(); ?>assets/admin/js/custom.js"></script>
<script src="<?= base_url(); ?>assets/js/holder.min.js"></script>
<script type="text/javascript">
	pageSetUp();

	$(document).ready(function() {
		$(".autosize_textarea").focus(function() {
		    var $this = $(this);
		    $this.select();

		    $this.mouseup(function() {
		        $this.unbind("mouseup");
		        return false;
		    });
		});
	});
</script>