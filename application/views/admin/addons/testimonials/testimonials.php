<div class="row">
	<div class="col-lg-6">
		<h1 class="page-title txt-color-blueDark">
			<i class="fa-fw fa fa-pencil-square-o"></i> Testimonials
		</h1>
	</div>
	<div class="col-lg-6">
		<div class="btn-group btn-sm pull-right">
			<button class="btn btn-success pull-right changeURL" data-url="#testimonials/"><i class="fa fa-list"></i> Testimonial List</button>
			<button class="btn btn-danger pull-right changeURL" data-url="#testimonials/manage/"><i class="fa fa-plus-circle"></i> Add Testimonial</button>
		</div>
	</div>
</div>

<?php include 'testimonials-search.php'; ?>


<div class="panel panel-primary">
  	<div class="panel-heading">
  		<div class="pull-left">
  			<h4>Testimonial List</h4>
  		</div>
  		<div class="pull-right">
  			<a class="btn btn-xs btn-default" href="#testimonials/manage/"><i class="fa fa-plus-circle"></i> Add Testimonial</a>
  		</div>
  		<div class="clearfix"></div>
  	</div>
  	<?php $total_rows = count($rows); ?>
	<table class="table table-bordered">
	    <thead>
	        <tr>
	        	<th><small>Photo</small></th>
	        	<th><small>Name</small></th>
                <th><small>Web</small></th>
	        	<th><small>Contacts</small></th>
				<th><small>Status</small></th>
				<th style="width: 65px;"><small>Action</small></th>
			</tr>
    	</thead>
    	<tbody>
    	<?php
     	if($total_rows > 0) {
    		foreach ($rows as $row) {
				$label = ($row['enabled'] == "1") ? 'label-success' : 'label-danger';
				$status = ($row['enabled'] == "1") ? 'Enabled' : 'Disabled';
				$image = (!empty($row['image'])) ? base_url().'uploads/testimonials/'.$row['image'] : "holder.js/60x60";
    		?>
    		<tr id="hiderow<?= $row['id']; ?>">
    			<td>
    				<img style="height: 60px; width: 60px;" class="img-thumbnail" alt="<?= $row['name']; ?>" title="<?= $row['name']; ?>" src="<?= $image; ?>" />
    			</td>
    			<td>
    				<small>
        				<i class="fa fa-user"></i> <?= "{$row['name']}"; ?>
        				<br />
        				<i class="fa fa-building"></i> <?= "{$row['company_name']}"; ?>
    				</small>
    			</td>
                <td>
                    <small>
                        <?php if(!empty($row['website'])) echo "<a href=\"{$row['website']}\" target=\"_blank\">".str_replace(array("http://", "https://"), '', $row['website'])."</a>"; else echo "N/A"; ?>
                    </small>
                 </td>
				<td>
					<?php
						if($row['mobile']) echo "<i class=\"fa fa-mobile\"></i> {$row['mobile']}";
						if($row['email']) echo "<br /><i class=\"fa fa-envelope-o\"></i> {$row['email']}";
						if($row['web']) echo "<br /><i class=\"fa fa-crosshairs\"></i> {$row['web']}";
						if(!$row['mobile'] && !$row['email'] && !$row['web']) echo "N/A";
					?>
				</td>
    			<td>
					<a data-original-title="Select Status" data-url="<?= site_url("admin/testimonials/ajax_status_update"); ?>" data-value="<?= $row['enabled']; ?>" data-pk="<?= $row['id'] ?>" data-type="select" data-name="enabled" name="enabled" class="rstatusopt" href="#">
					 	<span class="label <?= $label; ?>"><?= $status; ?></span>
					</a>
    			</td>
				<td>
					<div class="btn-group">
						<a href="#testimonials/manage/edit/<?= $row['id']; ?>" class="btn btn-default btn-xs" title="Edit"><i class="fa fa-pencil"></i></a>
						<a class="btn btn-default btnDel btn-xs" data-url="<?= site_url("admin/testimonials/manage/delete/"); ?>" data-toggle="modal" data-target="#myModal" id="<?= $row['id'] ?>" title="Delete" ><i class="fa fa-trash-o"></i></a>							
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

<?php $this->load->view("admin/common-delete-modal"); ?>

<script src="<?= base_url(); ?>assets/admin/js/custom.js"></script>
<script src="<?= base_url(); ?>assets/js/holder.min.js"></script>
<script type="text/javascript">
	pageSetUp();
</script>