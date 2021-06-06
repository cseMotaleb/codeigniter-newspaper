<div class="row">
	<div class="col-lg-6">
		<h1 class="page-title txt-color-blueDark">
			<i class="fa-fw fa fa-pencil-square-o"></i> Media Images
		</h1>
	</div>
	<div class="col-lg-6">
		<div class="btn-group btn-sm pull-right">
			<button data-url="#media" class="btn btn-success pull-right changeURL"><i class="fa fa-navicon"></i> Media List</button>
			<?php /* <button data-url="#media/index" class="btn btn-danger pull-right changeURL"><i class="fa fa-list-alt"></i> Add New</button> */ ?>
		</div>
	</div>
</div>

<?php
	$row_image = (isset($row_data['url']) && file_exists("{$row_data['url']}")) ? base_url() . "{$row_data['url']}" : "holder.js/165x160";
?>
<form id="validate-media" method="post" enctype="multipart/form-data" action="<?= site_url("admin/media/manage/{$mode}/{$current_id}"); ?>">
	<div class="panel panel-default">
	  	<div class="panel-heading">
	  		<div class="pull-left">
	  			<h4>Media</h4>
	  		</div>
	  		<div class="pull-right">
				<select name="status" id="status">
					<option <?php if(isset($row_data['status']) && $row_data['status'] == 'Enabled') echo 'selected'; ?> value="Enabled">Enabled</option>
					<option <?php if(isset($row_data['status']) && $row_data['status'] == 'Disabled') echo 'selected'; ?> value="Disabled">Disabled</option>
				</select>
	  		</div>
	  		<div class="clearfix"></div>
	  	</div>
	
	  	<div class="panel-body">
			<div class="row">
				<div class="col-md-8">
					<div class="form_sep">
						<label class="req">Title</label>
						<input name="title" class="form-control" placeholder="Title" value="<?php if(isset($row_data['title'])) echo $row_data['title']; ?>" type="text" />
					</div>
				</div>
				<div class="col-md-4">
					<div class="form_sep">
						<label>URL</label>
						<input name="other_link" id="other_link" class="form-control" placeholder="Enter URL" value="<?php if(isset($row_data['other_link'])) echo $row_data['other_link']; ?>" type="text" />
					</div>
				</div>
			</div>
			
			<hr />
			<input type="hidden" name="type" value="<?= (isset($row_data['type'])) ? $row_data['type'] : ''; ?>" />
			<input type="hidden" name="page_id" value="<?= (isset($row_data['page_id'])) ? $row_data['page_id'] : ''; ?>" />
			<input type="hidden" name="position" value="<?= (isset($row_data['position'])) ? $row_data['position'] : ''; ?>" />
			<input type="hidden" name="details" value="<?= (isset($row_data['details'])) ? $row_data['details'] : ''; ?>" />
			<?php /*
	    	<div class="row">
	    		<div class="col-md-4">
		            <div class="form_sep">
			    		<label class="req">Type</label>
						<select name="type" id="type" class="select2" style="width: 100%;">
		                   <?php $selected_type = (isset($row_data['type'])) ? $row_data['type'] : '' ;
								echo enum_list($table='media', $list='type', $selected_type);	  
							?>
						</select>
		            </div> 
	    		</div>
                <div class="col-md-4">
                    <label>Page Type</label>
                    <select name="page_id" id="page_id" class="select2">
                        <option value="">--- SELECT ---</option>
                        <?php
                            $selected_type_id = (isset($row_data['page_id']) && $row_data['page_id']) ? $row_data['page_id'] : 0;
                            $options = options(array('table'=>'page_types', 'limit'=>1000, 'option_value'=>'id', 'option'=>'type', 'default'=>$selected_type_id, 'oder_by'=>'type', 'order_type'=>'asc'), array()); 
                            echo $options['option_list'];
                        ?>
                    </select>
                </div>
                <div class="col-md-4">
                    <label>Position</label>
                    <input name="position" class="form-control" placeholder="Position" value="<?php if(isset($row_data['position'])) echo $row_data['position']; ?>" type="text" />
                </div>
			</div>

			<hr />
			
			<div class="form_sep">
              	<label>Details</label>
              	<textarea name="details" id="details" class="form-control" placeholder="Details" rows="5"><?php if(isset($row_data['details'])) echo $row_data['details']; ?></textarea>
			</div>
			
			<hr /> */ ?>
			
	    	<div class="form_sep">
         		<label for="userName">Photo</label>
                <div class="fileupload fileupload-new" data-provides="fileupload">
                    <div class="fileupload-new img-thumbnail" style="width: 178px; height: 120px;">
                    	<img src="<?= $row_image; ?>" alt="<?php if(isset($row_data['title'])) echo $row_data['title']; else echo "Media Image"; ?>">
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

			<hr />

			<footer>
				<div class="text-center">
					<input type="hidden" name="id" value="<?php if(isset($current_id)) echo $current_id; ?>" />
					<button type="submit" class="btn btn-lg btn-primary"><?php if($mode == "edit") echo "Update"; else echo "Save"; ?> Media</button>
				</div>
			</footer>
	  	</div>
	</div>
</form>

<script src="<?= base_url(); ?>assets/admin/js/custom.js"></script>
<script src="<?= base_url(); ?>assets/js/holder.min.js"></script>
<script type="text/javascript">
	pageSetUp();

	var pagefunction = function() {
		var $checkoutForm = $('#validate-media').validate({
			rules : {
				title : {
					required : true
				},
				type : {
					required : true
				},
				status : {
					required : true
				}
			},
			messages : {
				title : {
					required : 'Please enter title'
				},
				meta_title : {
					required : 'Please enter type'
				},
				status : {
					required : 'Please enter status'
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
		    	$("#validate-media").attr("action", "<?= site_url("admin/media/manage"); ?>/" + obj.data_mode + "/" + obj.zone_id);
		    	$('#zone_id').val(obj.data_listing_id);
		    	window.history.pushState("string", "Media Images", "#media/manage/" + obj.data_mode + "/" + obj.zone_id);
		    }
		    
			setTimeout(function() {
		   		//location.reload();
		  	}, 500);
		};
	};

    $('#type').select2({
    	placeholder: "Select ...."
    });   

	loadScript("<?=  base_url();?>assets/admin/js/plugin/jquery-form/jquery-form.min.js", pagefunction);
</script>