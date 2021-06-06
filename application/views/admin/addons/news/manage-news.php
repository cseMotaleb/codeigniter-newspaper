<div class="row">
	<div class="col-lg-6">
		<h1 class="page-title txt-color-blueDark">
			<i class="fa-fw fa fa-pencil-square-o"></i> Manage News
		</h1>
	</div>
	<div class="col-lg-6">
		<div class="btn-group btn-sm pull-right">
			<button class="btn btn-success pull-right changeURL" data-url="#news/"><i class="fa fa-navicon"></i> News List</button>
			<button class="btn btn-danger pull-right changeURL" data-url="#news/manage/"><i class="fa fa-list-alt"></i> Add news</button>
		</div>
	</div>
</div>

<form action="<?= site_url("admin/news/manage/{$mode}/{$current_id}"); ?>" method="post" id="validate-form">		
	<div class="panel panel-default">
	  	<div class="panel-heading">
	    	<h3 class="panel-title">
	    		<span class="text-danger"><strong><?= ucfirst($mode); ?></strong></span> News
			</h3>
	  	</div>
	
	  	<div class="panel-body">	    		
	    	<div class="formSep">
			   	<label class="req">News Title</label>
			   	<input class="form-control" type="text" name="title" id="title" placeholder="Enter news title" value="<?php if(isset($row_data['title'])) echo $row_data['title']; ?>" />
	    	</div>

            <hr />

            <div class="formSep">
                <label class="req">Meta Keyword</label>
                <input class="form-control" type="text" name="meta_keyword" id="meta_keyword" placeholder="Enter meta keyword" value="<?php if(isset($row_data['meta_keyword'])) echo $row_data['meta_keyword']; ?>" />
            </div>

            <hr />

            <div class="formSep">
                <label class="req">Meta Description</label>
                <input class="form-control" type="text" name="meta_description" id="meta_description" placeholder="Enter meta description" value="<?php if(isset($row_data['meta_description'])) echo $row_data['meta_description']; ?>" />
            </div>

	    	<hr />

    		<div class="row">
    			<div class="col-md-6">
    				<div class="formSep">
    					<label class="req">Date</label>
        				<input class="form-control edatepicker" type="text" name="publish_date" id="date" placeholder="Enter publish date" value="<?php if(isset($row_data['publish_date'])) echo $row_data['publish_date']; else echo date("Y-m-d"); ?>" />
    				</div>
    			</div>
                <div class="col-md-6">
                	<div class="formSep">
                        <label class="req">Status</label>
                        <select name="enabled" id="enabled" class="select2">
                            <option value="1" <?php if(isset($row_data['enabled']) && $row_data['enabled'] == '1') echo 'selected'; ?>>Enabled</option>
                            <option value="0" <?php if(isset($row_data['enabled']) && $row_data['enabled'] == '0') echo 'selected'; ?>>Disabled</option>
                        </select>
                  	</div>
                </div>
    		</div>

			<hr />

			<div class="panel panel-default">
				<div class="panel-heading">Details</div>
				<textarea class="ckeditor" id="details" name="details"><?php if(isset($row_data['details'])) echo $row_data['details']; else echo set_value('details');?></textarea>
			</div>

	    	<hr />

	    	<?php
				$news_image = (isset($row_data['image']) && !empty($row_data['image']) && file_exists("./uploads/news/{$row_data['image']}")) ? base_url()."uploads/news/{$row_data['image']}" : "holder.js/165x160";
            ?>
	  		<div class="form_sep">
         		<label for="userName">News Image</label>
                <div class="fileupload fileupload-new" data-provides="fileupload">
                    <div class="fileupload-new img-thumbnail" style="width: 178px; height: 120px;">
                    	<img src="<?= $news_image; ?>" alt="">
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
				<button type="submit" class="btn btn-lg btn-primary"><?php if($mode == "edit") echo "Update"; else echo "Add"; ?> News</button>
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