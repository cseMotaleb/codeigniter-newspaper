<?php
	$type = $this->input->get("type");
	$type = ($type) ? $type : "List";
	if(isset($row_data['enabled'])) {
		$type = ($row_data['type'] == "Gallery") ? "image" : (($row_data['type'] == "Video") ? "video" : "List");
	}

	if(isset($row_data['id'])) $categories = get_rows(array("table"=>"blog_categories", "limit"=>3), array("blog_id"=>$row_data['id']));
	
	$mode_text = ($mode == "edit") ? "Update" : "Add";
?>
<div class="row">
	<div class="col-lg-6">
		<h1 class="page-title txt-color-blueDark">
			<i class="fa-fw fa fa-pencil-square-o"></i> <?php if($type == "image") echo "{$mode_text} Image Gallery"; elseif($type == "video") echo "{$mode_text} Video Gallery"; else echo 'Manage News'; ?>
		</h1>
	</div>
	<div class="col-lg-6">
		<div class="btn-group btn-sm pull-right">
			<?php if($type == "image") { ?>
			<a href="#news/images" class="btn btn-success pull-right"><i class="fa fa-list"></i> Image Gallery</a>
			<a href="#news/manage?type=image" class="btn btn-danger pull-right"><i class="fa fa-plus-circle"></i> Add Image Gallery</a>
			<?php } elseif($type == "video") { ?>
			<a href="#news/video" class="btn btn-success pull-right"><i class="fa fa-list"></i> Video Gallery</a>
			<a href="#news/manage?type=video" class="btn btn-danger pull-right"><i class="fa fa-plus-circle"></i> Add Video Gallery</a>
			<?php } else { ?>
			<a href="#news" class="btn btn-success pull-right"><i class="fa fa-list"></i> News List</a>
			<a href="#news/manage" class="btn btn-danger pull-right"><i class="fa fa-plus-circle"></i> Add News</a>
			<?php } ?>
		</div>
	</div>
</div>

<form enctype="multipart/form-data" action="<?= site_url("admin/news/manage/{$mode}/{$current_id}"); ?>" method="post" id="validate-form">	
	<div class="panel panel-primary">
	  	<div class="panel-heading">
	    	<div class="pull-left">
	    		<h4><i class="fa fa-plus-circle"></i> <?php if($type == "image") echo "{$mode_text} Image Gallery"; elseif($type == "video") echo "{$mode_text} Video Gallery"; else echo 'Manage News'; ?></h4>
	    	</div>
	  		<div class="pull-right">
				<select name="enabled" id="enabled" style="color: #000;">
					<option value="1" <?php if(isset($row_data['enabled']) && $row_data['enabled'] == '1') echo 'selected'; ?>>Enabled</option>
					<option value="0" <?php if(isset($row_data['enabled']) && $row_data['enabled'] == '0') echo 'selected'; ?>>Disabled</option>
				</select>
	  		</div>
	  		<div class="clearfix"></div>
	  	</div>
	
	  	<div class="panel-body">
	  		<?php if($type == "List") { ?>
	  		<div class="row">
	  			<div class="col-md-7">
			    	<div class="formSep">
					   	<label class="req">Title</label>
					   	<input class="form-control" type="text" name="title" id="title" placeholder="Enter news title" value="<?php if(isset($row_data['title'])) echo $row_data['title']; ?>" />
			    	</div>
	  			</div>
	  			<div class="col-md-5">
			    	<div class="formSep">
					   	<label>Small Title</label>
					   	<input class="form-control" type="text" name="small_title" id="small_title" placeholder="Enter small title" value="<?php if(isset($row_data['small_title'])) echo $row_data['small_title']; ?>" />
			    	</div>
	  			</div>
	  		</div>
	  		<?php } else { ?>
	    	<div class="formSep">
			   	<label class="req">Title</label>
			   	<input class="form-control" type="text" name="title" id="title" placeholder="Enter news title" value="<?php if(isset($row_data['title'])) echo $row_data['title']; ?>" />
	    	</div>
	    	<input type="hidden" name="small_title" id="small_title" value="<?php if(isset($row_data['small_title'])) echo $row_data['small_title']; ?>" />
	  		<?php } ?>

            <hr />

            <div class="formSep">
                <label>Meta Keyword</label>
                <input class="form-control" type="text" name="meta_keyword" id="timeta_keywordtle" placeholder="Enter meta keyword" value="<?php if(isset($row_data['meta_keyword'])) echo $row_data['meta_keyword']; ?>" />
            </div>

			<hr />

            <div class="formSep">
                <label>Meta Description</label>
                <input class="form-control" type="text" name="meta_description" id="meta_description" placeholder="Enter meta description" value="<?php if(isset($row_data['meta_description'])) echo $row_data['meta_description']; ?>" />
            </div>

            <hr />

			<div class="formSep">
            	<label>Tags</label>
            	<input type="text" style="width: 100%;" name="tags" id="tags" placeholder="Tags" value="">
           </div>

			<hr />

			<div class="panel panel-primary">
				<div class="panel-heading">
					<h4>Categories</h4>
				</div>
				<div class="panel-body">
					<?php for ($i=0; $i < 3; $i++) { ?>
					<div class="formSep">
			    		<div class="row">
			    			<div class="col-md-6">
						   		<label>Category</label>
								<select name="category_id[]" id="category_id<?= $i; ?>" class="select2">
									<option value="">--- SELECT ---</option>
					    	    	<?php
					    	    		$selected_option = (isset($categories[$i]['category_id'])) ? $categories[$i]['category_id'] : "";
										$filters = array('parent_id'=>0);
										if(isset($type_post_id)) $filters['lang_id'] = $type_post_id;
						    	    	$options = options(
					    									array(
					    										'table'=>'blog_groups', 
					    										'limit'=>1000,
					    										'option_value'=>'id',
					    										'option'=>'category', 
					    										'order_by'=>'category', 
					    										'order_type'=>'asc', 
					    										'default'=>$selected_option, 
					    										'oder_by'=>'category', 
					    										'order_type'=>'asc'
															), 
															$filters); 
															
														echo $options['option_list'];
									?>
								</select>
							</div>
							<div class="col-md-6">
								<label>Parent Category</label>
								<select name="parent_id[]" id="parent_id<?= $i; ?>" class="select2">
									<option value="">--- SELECT ---</option>
								</select>
							</div>
							<?php /*
							<div class="col-md-4">
								<label>Sub Parent Category</label>
								<select name="sub_parent_id[]" id="sub_parent_id<?= $i; ?>" class="select2">
									<option value="">--- SELECT ---</option>
								</select>
							</div> */ ?>
						</div>
			    	</div>
			    	
			    	<?php if($i != 2) echo "<hr />"; ?>
					<?php } ?>
				</div>
			</div>

			<hr />
	    	
	  		<?php if($type == "List") { ?>
    		<div class="row">
				<div class="col-md-3">
    				<div class="formSep">
						<label>Top Two</label>
						<select name="highlight" id="highlight" class="select2">
							<option value="0" <?php if(isset($row_data['highlight']) && $row_data['highlight'] == 0) echo 'selected'; ?>>No</option>
							<option value="1" <?php if(isset($row_data['highlight']) && $row_data['highlight'] == 1) echo 'selected'; ?>>Yes</option>
						</select>
					</div>
				</div>
				<div class="col-md-3">
    				<div class="formSep">
						<label>Slide Show</label>
						<select name="slider" id="slider" class="select2">
							<option value="0" <?php if(isset($row_data['slider']) && $row_data['slider'] == '0') echo 'selected'; ?>>No</option>
							<option value="1" <?php if(isset($row_data['slider']) && $row_data['slider'] == '1') echo 'selected'; ?>>Yes</option>
						</select>
					</div>
				</div>
				<div class="col-md-3">
    				<div class="formSep">
						<label>Home page 9</label>
						<select name="homepage" id="homepage" class="select2">
							<option value="0" <?php if(isset($row_data['homepage']) && $row_data['homepage'] == 0) echo 'selected'; ?>>No</option>
							<option value="1" <?php if(isset($row_data['homepage']) && $row_data['homepage'] == 1) echo 'selected'; ?>>Yes</option>
						</select>
					</div>
				</div>
				<div class="col-md-3">
    				<div class="formSep">
						<label>Selected</label>
						<select name="selected" id="selected" class="select2">
							<option value="0" <?php if(isset($row_data['selected']) && $row_data['selected'] == '0') echo 'selected'; ?>>No</option>
							<option value="1" <?php if(isset($row_data['selected']) && $row_data['selected'] == '1') echo 'selected'; ?>>Yes</option>
						</select>
					</div>
				</div>
	    	</div>
	    	<?php } else { ?>
    		<div class="row">
				<div class="col-md-3">
    				<div class="formSep">
						<label>Slide Show</label>
						<select name="slider" id="slider" class="select2">
							<option value="0" <?php if(isset($row_data['slider']) && $row_data['slider'] == '0') echo 'selected'; ?>>No</option>
							<option value="1" <?php if(isset($row_data['slider']) && $row_data['slider'] == '1') echo 'selected'; ?>>Yes</option>
						</select>
					</div>
				</div>
			</div>
			<input type="hidden" name="homepage" id="homepage" value="0" />
			<input type="hidden" name="highlight" id="highlight" value="0" />
			<input type="hidden" name="selected" id="selected" value="0" />
	    	<?php } ?>

			<hr />

			<div class="formSep">
			    <div class="panel panel-default">
					<div class="panel-heading">
			    		<div class="pull-left">
			    			<h4>Details</h4>
			    		</div>
			    		<div class="pull-right">

			    		</div>
			    		<div class="clearfix"></div>
					</div>
	    			<textarea class="ckeditor" id="details" name="details"><?php if(isset($row_data['details'])) echo $row_data['details']; else echo set_value('details');?></textarea>
			    </div>
			</div>

			<hr />

			<?php if($type == "video") { ?>
			<div class="formSep">
				<label>Add Video</label>
				<table style="width: 100%;" class="appendo" data-rows="<?= (isset($row_data['videos']) && count($row_data['videos']) > 0) ? (count($row_data['videos']) + 1) : 1; ?>">
					<?php
					if(isset($row_data['videos']) && count($row_data['videos']) > 0) {
						foreach ($row_data['videos'] as $key => $video_row) {
					?>
				  	<tr>
				    	<td>
							<div class="row">
								<div class="col-md-6">
									<div class="formSep">
										<div class="input-group">
											<span class="input-group-addon" id="sizing-addon2">https://www.youtube.com/watch?v=</span>
											<input name="video_link[]" class="form-control" placeholder="Youtube Link Code" value="<?= $video_row['url']; ?>" type="text" />
										</div>
									</div>
								</div>
								<div class="col-md-6">
									<div class="formSep">
										<input name="video_cation[]" class="form-control" placeholder="Video Caption" value="<?= $video_row['caption']; ?>" type="text" />
									</div>
								</div>
							</div>

							<hr />
				    	</td>
				  	</tr>
				  	<?php }
				  	} ?>
				  	<tr>
				    	<td>
							<div class="row">
								<div class="col-md-6">
									<div class="formSep">
										<div class="input-group">
											<span class="input-group-addon" id="sizing-addon2">https://www.youtube.com/watch?v=</span>
											<input name="video_link[]" class="form-control" placeholder="Youtube Link Code" value="" type="text" />
										</div>
									</div>
								</div>
								<div class="col-md-6">
									<div class="formSep">
										<input name="video_cation[]" class="form-control" placeholder="Video Caption" value="" type="text" />
									</div>
								</div>
							</div>

							<hr />
				    	</td>
				  	</tr>
				</table>
				
				<br />
			</div>
			<?php } else { ?>
			<div class="formSep">
				<label>Add Images</label>
				<table style="width: 100%;" class="add-image" data-rows="1">
					<?php if(isset($row_data['images']) && count($row_data['images']) > 0) { ?>
				  	<tr>
				    	<td>
						    <div class="panel panel-default">
								<div class="panel-heading">Uploaded Images</div>
					    		<table class="table table-bordered table-striped">
					    			<thead>
					    				<tr>
					    					<th>Image</th>
					    					<th>Caption</th>
					    					<th>Position</th>
					    					<th>Status</th>
					    					<th style="width: 45px;">Delete</th>
					    				</tr>
					    			</thead>
					    			<tbody>
									<?php
									foreach ($row_data['images'] as $key => $image_row) {
										$image = (!empty($image_row['image']) && file_exists("./uploads/news/{$image_row['blog_id']}/{$image_row['image']}")) ? base_url()."uploads/news/{$image_row['blog_id']}/{$image_row['image']}" : "holder.js/165x160";

										$label = ($image_row['enabled'] == 1) ? 'label-success' : 'label-danger';
										$status = ($image_row['enabled'] == 1) ? 'Enabled' : 'Disabled';
									?>
					    			<tr id="hideimg<?= $image_row['id']; ?>">
					    				<td>
					    					<img style="height: 85px;" class="img-responsive" alt="<?= $row_data['title']; ?>" src="<?= $image; ?>" />
					    				</td>
					    				<td><?= $image_row['caption']; ?></td>
					    				<td><?= $image_row['position']; ?></td>
					        			<td>
											<a data-original-title="Select Status" data-value="<?= $image_row['enabled']; ?>" data-pk="<?= $image_row['id'] ?>" data-type="select" data-name="enabled" name="enabled" class="rimgstatusopt" href="#">
											 	<span class="label <?= $label; ?>"><?= $status; ?></span>
											</a>
					        			</td>
					    				<td>
					    					<a href="#" data-target="#imageModal" data-toggle="modal" id="<?= $image_row['id']; ?>" class="btn btn-sm btn-danger btnDel"><i class="fa fa-trash-o"></i></a>
					    				</td>
					    			</tr>
					  				<?php } ?>
					    			</tbody>
					    		</table>
						    </div>
				    	</td>
				  	</tr>
					<?php } ?>
				  	<tr>
				    	<td>
				    		<div class="row">
				    			<div class="col-md-4">
				    				<input name="image[]" type="file" />
				    			</div>
				    			<div class="col-md-4">
									<input type="text" placeholder="Caption" class="form-control" name="image_caption[]" value="" />
				    			</div>
				    			<div class="col-md-2">
									<input type="text" placeholder="Position" class="form-control" name="image_position[]" value="" />
				    			</div>
				    			<div class="col-md-2">
									<select class="form-control" name="image_enabled[]">
										<option value="1">Enabled</option>
										<option value="0">Disabled</option>
									</select>
				    			</div>
				    		</div>
							<hr />
				    	</td>
				  	</tr>
				</table>
				
				<br />
			</div>
			<?php } ?>

			<?php /*
			$image = "holder.js/165x160";
			if($mode == "edit") {
				$default_image = get_rows(array("table"=>"blog_images", "limit"=>1, "order_by"=>"position", "order_type"=>"asc"), array("blog_id"=>$current_id));
				if(isset($default_image['image']) && !empty($default_image['image']) && file_exists("./uploads/news/{$default_image['image']}")) $image = base_url()."uploads/news/{$default_image['image']}";
			}
            ?>
	  		<div class="form_sep">
         		<label for="userName">Image</label>
                <div class="fileupload fileupload-new" data-provides="fileupload">
                    <div class="fileupload-new img-thumbnail" style="width: 178px; height: 120px;">
                    	<img src="<?= $image; ?>" alt="Image">
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
		</div> */ ?>

		<div class="panel-footer">
			<div class="formSep">
				<input type="hidden" name="type" value="<?php if($type == "image") echo "Gallery"; elseif($type == "video") echo "Video"; else echo "List"; ?>" />
				<input type="hidden" name="id" value="<?php if(isset($current_id)) echo $current_id; ?>" />
				<button type="submit" class="btn btn-lg b btn-primary" id="btn-submit"><i class="fa fa-floppy-o"></i> <?php if($mode == "edit") echo "Update"; else echo "Save"; ?> News</button>
				
				<button type="button" class="btn btn-lg btn-danger" onClick="window.location.reload()">Cancel</button>
			</div>
		</div>
	</div>
</form>


<div class="modal fade" id="imageModal">
  	<div class="modal-dialog">
    	<div class="modal-content">
      		<div class="modal-header">
        		<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        		<h4 class="modal-title">Delete</h4>
      		</div>
      		<div class="modal-body">
        		<p>Are you sure to delete this data?</p>
      		</div>
      		<div class="modal-footer">
				<button type="submit" data-dismiss="modal" class="btn btn-danger">Cancel</button>
				<button type="submit" data-dismiss="modal" class="btn btn-primary ConfirmDelImage">Confirm</button>
      		</div>
    	</div>
  	</div>
</div>
<input type="hidden" name="hidden_input_id" id="hidden_input_id" value="" />


<script src="<?= base_url(); ?>assets/js/holder.min.js"></script>
<script src="<?= base_url(); ?>assets/admin/js/custom.js"></script>
<script type="text/javascript">
	pageSetUp();

	$(document).ready(function() {
		jQuery('.rimgstatusopt').editable({
		    url      : "<?= site_url("news/ajax_update_image_status"); ?>",
		    success  : function(response, newValue) {             
		       processJson(response);
		    },
		    source: [{value: '1', text: 'Enabled'},{value: '0', text: 'Disabled'}],  
		});

	    jQuery(".btnDel").click(function (event) {
			event.preventDefault();
			var id = jQuery(this).attr('id');
			$("#hidden_input_id").val(id);
		});

		jQuery(".ConfirmDelImage").click(function (event) {
			event.preventDefault();
			var id = jQuery("#hidden_input_id").val();
			jQuery.get("<?= site_url("admin/news/del_img"); ?>/"+id, function(response) {
				jQuery("#hideimg"+id).hide();
			});
		});

		<?php for ($i=0; $i < 3; $i++) { ?>
		get_parent_category<?= $i; ?>($("#category_id<?= $i; ?>"));
		jQuery("#category_id<?= $i; ?>").change(function (event) {
			event.preventDefault();
			get_parent_category<?= $i; ?>($(this));
		});

		function get_parent_category<?= $i; ?>($this) {
		  	var category_id = $this.val(),
		  		parent_id = $("#parent_id<?= $i; ?>");

			check_select2();
			if(category_id) {
				jQuery.ajax({
					async: false,
					type:'Get',
					url: "<?= site_url("admin/ajax/blog_parent_category"); ?>/?category_id="+category_id+"&selected=<?= (isset($categories[$i]['parent_id'])) ? $categories[$i]['parent_id'] : 0; ?>",
					success: function(response) {
						parent_id.html(response.data);
						setTimeout(function() {
							select2_this(parent_id);
							<?php /* if(isset($row_data['sub_parent_id']) && $row_data['sub_parent_id']) { ?>
								get_sub_parent_category<?= $i; ?>($("#parent_id<?= $i; ?>"))
							<?php }*/ ?>
						}, 100)
					}
				});
			}
		};

		<?php /*
		jQuery("#parent_id<?= $i; ?>").change(function (event) {
			event.preventDefault();
			get_sub_parent_category<?= $i; ?>($(this));
		});

		function get_sub_parent_category<?= $i; ?>($this) {
		  	var parent_id = $this.val(),
		  		sub_parent_id = $("#sub_parent_id<?= $i; ?>");

			check_select2();
			if(parent_id) {
				jQuery.ajax({
					async: false,
					type:'Get',
					url: "<?= site_url("admin/ajax/blog_sub_parent_category"); ?>/?parent_id="+parent_id+"&selected=<?= (isset($categories[$i]['sub_parent_id'])) ? $categories[$i]['sub_parent_id'] : 0; ?>",
					success: function(response) {
						sub_parent_id.html(response.data);
						setTimeout(function() {
							select2_this(sub_parent_id);
						}, 100)
					}
				});
			}
		}; */ ?>
		<?php } ?>

		function select2_this (a) {
			b=a.attr("data-select-width")||"100%";
			a.select2({
				allowClear:!0,
				width:b
			}),
			a=null;
		};

		function check_select2() {
			<?php for ($i=0; $i < 3; $i++) { ?>
			var category_id = $('#category_id<?= $i; ?>').val();
			if(category_id) $('#parent_id<?= $i; ?>').select2("enable", true);
			else { $('#parent_id<?= $i; ?>').select2("enable", false); $('#parent_id<?= $i; ?>').select2("val", ""); $('#sub_parent_id<?= $i; ?>').select2("val", ""); }

			var parent_id = $('#parent_id<?= $i; ?>').val();
			if(parent_id) $('#sub_parent_id<?= $i; ?>').select2("enable", true);
			else $('#sub_parent_id<?= $i; ?>').select2("enable", false);
			<?php } ?>
		};

        $("#tags").select2({
            tags: true,
            tokenSeparators: [","],
              createSearchChoice: function(term, data) {
               if ($(data).filter( function() { return this.text.localeCompare(term)===0;   
                     }).length===0) {
                    return {id:term, text:term};
                }
              },
            multiple: true,
            ajax: {
                url: '<?= site_url("admin/ajax/blog_tags"); ?>?lang=en',
                dataType: "json",
                data: function(term, page) {
                    return {
                        q: term
                    };
                },
                results: function(data, page) {
                    return {
                        results: data
                    };
                }
            }
        });
        
        <?php if($mode=='edit' && isset($blog_tags)) { ?>
            var tags = <?= $blog_tags; ?>;
            if(typeof tags =='object') jQuery("#tags").select2('data', tags);
        <?php } ?>
	});

	var pagefunction = function() {
	   CKEDITOR.instances['details'].on('change', function() { CKEDITOR.instances['details'].updateElement() });
		var $checkoutForm = $('#validate-form').validate({
			rules : {
				title : {
					required : true
				}
			},
			messages : {
				title : {
					required : 'Please enter title'
				}
			},
			submitHandler : function(form) {
				jQuery("#btn-submit").prop('disabled', true);
				$(form).ajaxSubmit({
					success : processJson
				});
			},
			errorPlacement : function(error, element) {
				error.insertAfter(element.parent());
			}
		});

		function processJson(data) {
			jQuery("#btn-submit").prop('disabled', false);
			var obj = jQuery.parseJSON( data );
		    $.bigBox({
		      	title: obj.mtitle,
		      	content: obj.mcontent,
		      	color: obj.mcolor,
		      	iconSmall: obj.miconSmall,
		      	timeout: 10000
		    });

		    if(obj.mcode == 200) {
            	setTimeout(function() {
            		location.reload();
            	}, 500);
		    }
		};
	};

	loadScript("<?= base_url(); ?>assets/admin/js/bootstrap-fileupload.js");
	loadScript("<?= site_url('assets/admin/js/plugin/jquery-form/jquery-form.min.js'); ?>", pagefunction);
</script>
<script src="<?= base_url(); ?>assets/admin/appendo/jquery.appendo.js"></script>