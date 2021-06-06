<div class="row">
	<div class="col-lg-6">
		<h1 class="page-title txt-color-blueDark">
			<i class="fa-fw fa fa-list"></i> News Categories
		</h1>
	</div>
	<div class="col-lg-6">
		<div class="btn-group btn-sm pull-right">
			<button class="btn btn-danger changeURL" data-url="#news/category"><i class="fa fa-plus-circle"></i> Add Category</button>
			<button class="btn btn-success changeURL" data-url="#news/"><i class="fa fa-list"></i> News List</button>
			<button class="btn btn-danger changeURL" data-url="#news/manage"><i class="fa fa-plus-circle"></i> Add News</button>
		</div>
	</div>
</div>


<form method="get" action="#news/categories">
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


<form id="BulkDeleteForm" method="post" action="<?= site_url("admin/news/categories/bulk_delete"); ?>">
	<div class="panel panel-primary">
	  	<div class="panel-heading">
	  		<h4><i class="fa fa-list"></i> Blog Category</h4>
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
		        	<th>Category</th>
                    <th>Parent</th>
                    <th>Sub Parent</th>
		        	<th>Status</th>
					<th style="width: 155px;">Action</th>
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
        				<input name="bulk_delete[]" class="bulk_checkbox" value="<?= $row['id']; ?>" type="checkbox" />
        			</td>
        			<td><?= "{$row['category']}"; ?></td>
                    <td><?php if(!empty($row['parent_category'])) echo "{$row['parent_category']}"; else echo "N/A"; ?></td>
                    <td><?php if(!empty($row['sub_parent_category'])) echo "{$row['sub_parent_category']}"; else echo "N/A"; ?></td>
	    			<td>
						<a data-original-title="Select Status" data-url="<?= site_url("admin/news/ajax_status_update/1"); ?>" data-value="<?= $row['enabled']; ?>" data-pk="<?= $row['id'] ?>" data-type="select" data-name="enabled" name="enabled" class="rstatusopt" href="#">
						 	<span class="label <?= $label; ?>"><?= $status; ?></span>
						</a>
	    			</td>
					<td>
						<div class="btn-group">
							<a href="#news/position/<?= $row['id']; ?>" class="btn btn-default btn-md" title="News Position"><i class="fa fa-hand-pointer-o"></i></a>
							<a href="#news/category/edit/<?= $row['id']; ?>" class="btn btn-default btn-md" title="Edit"><i class="fa fa-pencil"></i></a>
							<a class="btn btn-default btnDel btn-md" data-url="<?= site_url("admin/news/category/delete/"); ?>" data-toggle="modal" data-target="#myModal" id="<?= $row['id'] ?>" title="Delete" ><i class="fa fa-trash-o"></i></a>
						</div>
					</td>
        		</tr>
        		<?php }
				} ?>
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
		sub_parent_data($("#parent_id"));
		jQuery("#parent_id").change(function (event) {
			event.preventDefault();
			sub_parent_data($(this));
		});

		function sub_parent_data ($this) {
			check_sub_parent($this);
			var parent_id = $this.val();
			if(parent_id) {
				jQuery.ajax({
					async: false,
					type:'Get',
					url: "<?= site_url("admin/ajax/blog_parent_category"); ?>/?category_id="+parent_id+"&selected=<?= (isset($row_data['sub_parent_id'])) ? $row_data['sub_parent_id'] : 0; ?>",
					success: function(response) {
						$("#sub_parent_id").html(response.data);
						setTimeout(function() {
							select2_this($("#sub_parent_id"));
						}, 100)
					}
				});
			}
		};

		function select2_this (a) {
			b=a.attr("data-select-width")||"100%";
			a.select2({
				allowClear:!0,
				width:b
			}),
			a=null;
		};

		function check_sub_parent ($this) {
		  	var parent_id = $this.val();
		  	if(parent_id) $("#hidesubparent").show();
		  	else $("#hidesubparent").hide();
		};

		var pagefunction = function() {
			var $checkoutForm = $('#validate-form').validate({
				rules : {
					name : {
						required : true
					}	
				},
				messages : {
					name : {
						required : 'Please enter name'
					}
				},
				submitHandler : function(form) {
					$(form).ajaxSubmit({
						success : processJson
					});
				},
				errorPlacement : function(error, element) {
					error.insertAfter(element.parent());
				}
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

			    if(obj.mcode == 200) {
			    	
			    }
			};
		};

		loadScript("<?= site_url('assets/admin/js/plugin/jquery-form/jquery-form.min.js'); ?>", pagefunction);
	});
</script>