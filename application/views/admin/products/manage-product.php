<div class="row">
	<div class="col-lg-6">
		<h1 class="page-title txt-color-blueDark">
			<i class="fa-fw fa fa-pencil-square-o"></i> Manage Product
		</h1>
	</div>
	<div class="col-lg-6">
		<div class="btn-group btn-sm pull-right">
			<button class="btn btn-success pull-right changeURL" data-url="#products/"><i class="fa fa-navicon"></i> Product List</button>
			<button class="btn btn-danger pull-right changeURL" data-url="#products/manage/"><i class="fa fa-list-alt"></i> Add Product</button>
		</div>
	</div>
</div>

<form action="<?= site_url("admin/products/manage/{$mode}/{$current_id}"); ?>" method="post" id="validate-form">		
	<div class="panel panel-default">
	  	<div class="panel-heading">
	  		<div class="pull-left">
		    	<h3 class="panel-title">
		    		<span class="text-danger"><strong><?= ucfirst($mode); ?></strong></span> Product
				</h3>
	  		</div>
	  		<div class="pull-right">
                <select name="enabled" id="enabled">
                    <option value="1" <?php if(isset($row_data['enabled']) && $row_data['enabled'] == '1') echo 'selected'; ?>>Enabled</option>
                    <option value="0" <?php if(isset($row_data['enabled']) && $row_data['enabled'] == '0') echo 'selected'; ?>>Disabled</option>
                </select>
	  		</div>
	  		<div class="clearfix"></div>
	  	</div>
	
	  	<div class="panel-body">
	  		<div class="row">
	  			<div class="col-md-4">	
			    	<div class="formSep">
					   	<label class="req">Product Name</label>
					   	<input class="form-control" type="text" name="product_name" id="product_name" placeholder="Enter product name" value="<?php if(isset($row_data['product_name'])) echo $row_data['product_name']; ?>" />
			    	</div>
	  			</div>
	  			<div class="col-md-4">	
			    	<div class="formSep">
					   	<label>URL</label>
					   	<input class="form-control" type="text" name="other_link" id="other_link" placeholder="URL" value="<?php if(isset($row_data['other_link'])) echo $row_data['other_link']; ?>" />
			    	</div>
	  			</div>
	  			<div class="col-md-4">
					<?php $categories = get_rows(array("table"=>"categories", "limit"=>10000, "order_by"=>"category", "order_type"=>"asc"), array()); ?>
					<div class="formSep">
						<label class="req">Category</label>
						<select name="category_id" id="category_id" class="select2">
							<?php
							foreach ($categories as $key => $category) {
								$selected = (isset($row_data['category_id']) && ($row_data['category_id'] == $category['id'])) ? "selected" : 0;
							?>
							<option value="<?= $category['id']; ?>" <?= $selected; ?>><?= $category['category']; ?></option>
							<?php } ?>
						</select>
					</div>
	  			</div>
	  		</div>

            <hr />

            <div class="formSep">
                <label>Meta Title</label>
                <input class="form-control" type="text" name="meta_title" id="meta_title" placeholder="Enter meta title" value="<?php if(isset($row_data['meta_title'])) echo $row_data['meta_title']; ?>" />
            </div>

            <hr />

            <div class="formSep">
                <label>Meta Keyword</label>
                <input class="form-control" type="text" name="meta_keyword" id="meta_keyword" placeholder="Enter meta keyword" value="<?php if(isset($row_data['meta_keyword'])) echo $row_data['meta_keyword']; ?>" />
            </div>

            <hr />

            <div class="formSep">
                <label>Meta Description</label>
                <input class="form-control" type="text" name="meta_description" id="meta_description" placeholder="Enter meta description" value="<?php if(isset($row_data['meta_description'])) echo $row_data['meta_description']; ?>" />
            </div>

			<hr />

			<div class="panel panel-default">
				<div class="panel-heading">Details</div>
				<textarea class="ckeditor" id="details" name="details"><?php if(isset($row_data['details'])) echo $row_data['details']; else echo set_value('details');?></textarea>
			</div>

	    	<hr />

	    	<?php
				$default_image = (isset($row_data['image']) && !empty($row_data['image']) && file_exists("./uploads/products/{$row_data['image']}")) ? base_url()."uploads/products/{$row_data['image']}" : "holder.js/165x160";
            ?>
	  		<div class="form_sep">
         		<label for="userName">News Image</label>
                <div class="fileupload fileupload-new" data-provides="fileupload">
                    <div class="fileupload-new img-thumbnail" style="width: 178px; height: 120px;">
                    	<img src="<?= $default_image; ?>" alt="">
                    </div>
                    <div class="fileupload-preview fileupload-exists img-thumbnail" style="width: 178px; height: 120px"></div>
                    <div>
                        <span class="btn btn-default btn-file">
                        	<span class="fileupload-new">Select image</span>
                        	<span class="fileupload-exists">Change</span>
                        	<input name="userfile" id="userfile" type="file" />
                        </span>
                        <a href="#" class="btn btn-default fileupload-exists" data-dismiss="fileupload">Remove</a>
                    </div>
                </div>
  			</div>
		</div>
		
		<div class="panel-footer">
			<div class="text-center">
				<input type="hidden" name="id" value="<?php if(isset($current_id)) echo $current_id; ?>" />
				<button type="submit" class="btn btn-lg btn-primary"><?php if($mode == "edit") echo "Update"; else echo "Add"; ?> Product</button>
			</div>
		</div>
	</div>
</form>

<?php $this->load->view("admin/common-delete-modal"); ?>

<script src="<?= base_url(); ?>assets/js/holder.min.js"></script>
<script src="<?= base_url(); ?>assets/admin/js/custom.js"></script>
<script type="text/javascript">
	pageSetUp();

	$(document).ready(function() {
		var pagefunction = function() {
			CKEDITOR.instances['details'].on('change', function() { CKEDITOR.instances['details'].updateElement() });

			var $checkoutForm = $('#validate-form').validate({
				rules : {
					title : {
						required : true
					},
					publish_date : {
						required : true
					}
				},
				messages : {
					title : {
						required : 'Please enter News Title'
					},
					publish_date : {
						required : 'Please enter publish date'
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
			};
		};

		loadScript("<?= site_url('assets/admin/js/plugin/jquery-form/jquery-form.min.js'); ?>", pagefunction);
	});
</script>