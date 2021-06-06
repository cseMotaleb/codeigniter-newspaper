<div class="row">
	<div class="col-lg-6">
		<h1 class="page-title txt-color-blueDark">
			<i class="fa-fw fa fa-pencil-square-o"></i> News <?php if($type == "image") echo "(Image Gallery)"; elseif($type == "video") echo "(Video Gallery)"; ?>
		</h1>
	</div>
	<div class="col-lg-6">
		<div class="btn-group btn-sm pull-right">
			<button class="btn btn-danger changeURL" data-url="#news/category"><i class="fa fa-plus-circle"></i> Add Category</button>
			<?php if($type == "image") { ?>
			<button class="btn btn-success changeURL" data-url="#news/images"><i class="fa fa-list"></i> Image Gallery</button>
			<button class="btn btn-danger changeURL" data-url="#news/manage?type=image"><i class="fa fa-plus-circle"></i> Add Image Gallery</button>
			<?php } elseif($type == "video") { ?>
			<button class="btn btn-success changeURL" data-url="#news/video"><i class="fa fa-list"></i> Video Gallery</button>
			<button class="btn btn-danger changeURL" data-url="#news/manage?type=video"><i class="fa fa-plus-circle"></i> Add Video Gallery</button>
			<?php } else { ?>
			<button class="btn btn-success changeURL" data-url="#news/"><i class="fa fa-list"></i> News List</button>
			<button class="btn btn-danger changeURL" data-url="#news/manage/"><i class="fa fa-plus-circle"></i> Add News</button>
			<?php } ?>
		</div>
	</div>
</div>

<?php
    $user_type = $this->session->userdata("user_type");
	if($type == "image") $url = "news/images";
	elseif ($type == "video") $url = "news/video";
	else $url = "news/index";
?>

<form method="get" action="#<?= $url; ?>">
	<div class="panel panel-primary">
		<div class="panel-body">
            <div id="custom-search-input">
                <div class="input-group col-md-12">
                    <input type="text" name="k" class="form-control input-lg" value="<?= $this->input->get("k"); ?>" placeholder="Enter Keyword" />
                    <span class="input-group-btn">
                        <button class="btn btn-info btn-lg" type="submit">
                            <i class="glyphicon glyphicon-search"></i>
                        </button>
                    </span>
                </div>
            </div>
		</div>
	</div>
</form>

<style type="text/css">
@media (max-width: 480px) {
	.table {
		font-size: 10px;
	}
	.table > tbody > tr > td, .table > tbody > tr > th, .table > tfoot > tr > td, .table > tfoot > tr > th, .table > thead > tr > td, .table > thead > tr > th {
		padding: 4px 5px;
	}
}
</style>

<form id="BulkDeleteForm" method="post" action="<?= site_url("admin/news/manage/bulk_delete"); ?>">
	<div class="panel panel-primary">
	  	<div class="panel-heading">
	  		<div class="pull-left">
	  			<h4><i class="fa fa-list"></i> News List <?php if($type == "image") echo "(Image Gallery)"; elseif($type == "video") echo "(Video Gallery)"; ?></h4>
	  		</div>
	  		<div class="pull-right">
	
	  		</div>
			<div class="clearfix"></div>
	  	</div>
	  	<?php $total_rows = count($rows); ?>
		<table class="table table-bordered">
		    <thead>
		        <tr>
		        	<th class="hidden-xs">
		        		<?php if($total_rows > 0) { ?>
		        		<input name="all_bulk" id="all_bulk" value="" type="checkbox" />
		        		<?php } ?>
		        	</th>
		        	<th>Title</th>
		        	<th>Category</th>
		        	<th>Posted By</th>
		        	<th class="hidden-xs">Date</th>
					<th class="hidden-xs">Slider</th>
					<th class="hidden-xs">Status</th>
					<th style="width: 95px;">Action</th>
				</tr>
        	</thead>
        	<tbody>
        	<?php
        	if($total_rows > 0) {
        		$categories = array();
        		foreach ($rows as $row) {
					$blog_url = site_url("article/{$row['id']}");

					$label = ($row['enabled'] == 1) ? 'label-success' : (($row['enabled'] == 2) ? 'label-warning' : 'label-danger');
					$status = ($row['enabled'] == 1) ? 'Enabled' : (($row['enabled'] == 2) ? 'Pending' : 'Disabled');

					$slider_css = ($row['slider'] == 1) ? 'label-success' : 'label-danger';
					$slider = ($row['slider'] == 1) ? 'Yes' : 'No';
					
					$categories = get_rows(array("select"=>"blog_groups.*", "table"=>"blog_categories", "limit"=>"3", "glue"=>"blog_groups", "pieces"=>"blog_groups.id = blog_categories.category_id"), array("blog_id"=>$row['id']));
        		?>
        		<tr id="hiderow<?= $row['id']; ?>">
        			<td class="hidden-xs">
        				<input name="bulk_delete[]" class="bulk_checkbox" value="<?= $row['id']; ?>" type="checkbox" />
        			</td>
        			<td>
        				<a target="_blank" href="<?= $blog_url; ?>">
        					<?= $row['title']; ?>
        				</a>
        			</td>
        			<td>
        				<?php
        				$row_counter = 1;
						$total_categories = count($categories);
						$comma = ", ";
        				foreach ($categories as $key => $category) {
        					$category_url = site_url("category/{$category['category_url']}");
        					if($total_categories == $row_counter) $comma = "";
							echo "<a target=\"_blank\" href=\"{$category_url}\">{$category['category']}</a>{$comma}";

							$row_counter++;
						}
						?>
        			</td>
        			<td>
        				<?php
        					if(!empty($row['user_first_name'])) echo "{$row['user_first_name']} {$row['user_last_name']}";
							else echo "N/A";
        				?>
        			</td>
        			<td class="hidden-xs"><?= date("dS F, Y", $row['time']); ?></td>
        			<td class="hidden-xs">
                                    <a data-original-title="Select Status" data-url="<?= site_url("admin/news/ajax_status_update"); ?>" data-value="<?= $row['slider']; ?>" data-pk="<?= $row['id'] ?>" data-type="select" data-name="slider" name="slider" class="rslideropt" href="#">
                                        <span class="label <?= $slider_css; ?>"><?= $slider; ?></span>
                                    </a>
        			</td>
        			<td class="hidden-xs">
                                    <?php if($user_type == "Admin") { ?>
                                    <a data-original-title="Select Status" data-url="<?= site_url("admin/news/ajax_status_update"); ?>" data-value="<?= $row['enabled']; ?>" data-pk="<?= $row['id'] ?>" data-type="select" data-name="enabled" name="enabled" class="rstatusopt1" href="#">
					<span class="label <?= $label; ?>"><?= $status; ?></span>
                                    </a>
                                    <?php } else { ?>
                                    <span class="label <?= $label; ?>"><?= $status; ?></span>
                                    <?php } ?>
        			</td>
					<td>
						<div class="btn-group">
						  	<button type="button" class="btn btn-xs btn-danger">Action</button>
						  	<button type="button" class="btn btn-xs btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						    	<span class="caret"></span>
						    	<span class="sr-only">Toggle Dropdown</span>
						  	</button>
						  	<ul class="dropdown-menu dropdown-menu-right">
						    	<li><a target="_blank" href="<?= $blog_url; ?>" title="View"><i class="fa fa-rss"></i> View</a></li>
						    	<?php if($user_type == "Admin") { ?>
                                                        <li><a href="#news/manage/edit/<?= $row['id']; ?>" title="Edit"><i class="fa fa-pencil"></i> Edit</a></li>
                                                        <li><a class="btnDel" data-url="<?= site_url("admin/news/manage/delete/"); ?>" data-toggle="modal" data-target="#myModal" id="<?= $row['id'] ?>" title="Delete" ><i class="fa fa-trash-o"></i> Delete</a></li>
                                                        <?php } ?>
						  	</ul>
						</div>
					</td>
        		</tr>
        		<?php }
				} else echo '<tr><td colspan="7">No Result Found</td></tr>'; ?>
        	</tbody>
        </table>

	  	<?php if($total_rows > 0) { ?>
	  	<div class="panel-footer">
			<div class="row">
				<div class="col-md-6 hidden-xs">
					<div class="text-left">
						<br />
						<a data-toggle="modal" data-target="#bulkModal" class="btn btn-danger"><i class="fa fa-shirtsinbulk"></i> Bulk Delete</a>
					</div>
				</div>
				<div class="col-md-6">
					<div class="text-right">
						<?= $pagination; ?>
					</div>
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

	$(document).ready(function() {
		jQuery('.rslideropt').editable({
		    url      : jQuery(this).data('url'),
		    success  : function(response, newValue) {             
		       processJson(response);
		    },
		    source: [{value: '1', text: 'Yes'},{value: '0', text: 'No'}],  
		});

		jQuery('.rstatusopt1').editable({
		    url      : jQuery(this).data('url'),
		    success  : function(response, newValue) {             
		       processJson(response);
		    },
		    source: [{value: '1', text: 'Enabled'},{value: '2', text: 'Pending'},{value: '0', text: 'Disabled'}],  
		});


		function processJson(data) {
			var obj = jQuery.parseJSON( data );
		    $.bigBox({
		      title: obj.mtitle,
		      content: obj.mcontent,
		      color: obj.mcolor,
		      iconSmall: obj.miconSmall,
		      timeout: 10000
		    });
		};
	});
</script>