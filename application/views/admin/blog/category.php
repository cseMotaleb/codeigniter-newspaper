<div class="row">
	<div class="col-lg-6">
		<h1 class="page-title txt-color-blueDark">
			<i class="fa-fw fa fa-pencil-square-o"></i> Manage News Category
		</h1>
	</div>
	<div class="col-lg-6">
		<div class="btn-group btn-sm pull-right">
			<button class="btn btn-danger changeURL" data-url="#news/categories"><i class="fa fa-plus-circle"></i> Add News Category</button>
			<button class="btn btn-success changeURL" data-url="#news/"><i class="fa fa-list"></i> News List</button>
			<button class="btn btn-danger changeURL" data-url="#news/manage"><i class="fa fa-plus-circle"></i> Add News</button>
		</div>
	</div>
</div>

<form action="<?= site_url("admin/news/category/{$mode}/{$current_id}"); ?>" method="post" id="validate-form">	
	<div class="panel panel-primary">
	  	<div class="panel-heading">
	  		<div class="pull-left">
		    	<h3 class="panel-title">
		    		<strong><?= ucfirst($mode); ?></strong> News Category
				</h3>
	  		</div>
	  		<div class="pull-right">
	
	  		</div>
	  		<div class="clearfix"></div>
	  	</div>
	
	  	<div class="panel-body">
	    	<div class="formSep">
			   	<label class="req">Category Name</label>
			   	<input class="form-control" type="text" name="category" id="category" placeholder="Enter category name" value="<?php if(isset($row_data['category'])) echo $row_data['category']; ?>" />
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

    		<div class="row">
                <div class="col-md-3">
                	<div class="formSep">
                    	<label>Position</label>
                    	<input class="form-control" type="text" name="position" id="position" placeholder="Enter position" value="<?php if(isset($row_data['position'])) echo $row_data['position']; ?>" />
                	</div>
                </div>
    			<div class="col-md-3">
    				<div class="formSep">
						<label>Show Menu</label>
						<select name="main_menu" id="main_menu" class="select2">
							<option value="1" <?php if(isset($row_data['main_menu']) && $row_data['main_menu'] == 1) echo 'selected'; ?>>Main Menu</option>
							<option value="2" <?php if(isset($row_data['main_menu']) && $row_data['main_menu'] == 2) echo 'selected'; ?>>Sub Main Menu</option>
							<option value="0" <?php if(isset($row_data['main_menu']) && $row_data['main_menu'] == 0) echo 'selected'; ?>>Not Show Menu</option>
						</select>
					</div>
				</div>
    			<div class="col-md-3">
    				<div class="formSep">
						<label>Show Bottom Menu</label>
						<select name="bottom_menu" id="bottom_menu" class="select2">
							<option value="0" <?php if(isset($row_data['main_menu']) && $row_data['main_menu'] == 0) echo 'selected'; ?>>No</option>
							<option value="1" <?php if(isset($row_data['main_menu']) && $row_data['main_menu'] == 1) echo 'selected'; ?>>Yes</option>
						</select>
					</div>
				</div>
    			<div class="col-md-3">
    				<div class="formSep">
						<label>Status</label>
						<select name="enabled" id="enabled" class="select2">
							<option value="1" <?php if(isset($row_data['enabled']) && $row_data['enabled'] == 1) echo 'selected'; ?>>Enabled</option>
							<option value="0" <?php if(isset($row_data['enabled']) && $row_data['enabled'] == 0) echo 'selected'; ?>>Disabled</option>
						</select>
					</div>
				</div>
    		</div>
	    	
			<hr />
	    	
	    	<div class="formSep">
				<label>Parent Category</label>
				<select name="parent_id" id="parent_id" class="select2">
					<option value="">--- SELECT ---</option>
	    	    	<?php $selected_parent_id = (isset($row_data['parent_id']) && $row_data['parent_id']) ? $row_data['parent_id'] : 0; ?>
	    			<?php $options = options(
	    									array(
	    										'table'=>'blog_groups', 
	    										'limit'=>1000,
	    										'option_value'=>'id',
	    										'option'=>'category', 
	    										'default'=>$selected_parent_id, 
	    										'oder_by'=>'category', 
	    										'order_type'=>'asc'
											), 
											array('parent_id'=>0)); 
											
										echo $options['option_list']; ?>
				</select>
	    	</div>

	    	<hr />

			<div id="hidesubparent">

				<div class="formSep">
					<label>Sub Parent Category</label>
					<select name="sub_parent_id" id="sub_parent_id" class="select2">
						<option value="">--- SELECT ---</option>
					</select>
				</div>
		    </div>
		</div>

		<div class="panel-footer">
			<div class="formSep">
				<input type="hidden" name="id" value="<?php if(isset($current_id)) echo $current_id; ?>" />
				<button type="submit" class="btn btn-lg btn-primary"><i class="fa fa-floppy-o"></i> <?php if($mode == "edit") echo "Update"; else echo "Save"; ?> Category</button>
			</div>
		</div>
	</div>
</form>

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
		  	if(parent_id) $("#hidesubparent").hide();
		  	else $("#hidesubparent").hide();
		};

		var pagefunction = function() {
			var $checkoutForm = $('#validate-form').validate({
				rules : {
					category : {
						required : true
					}	
				},
				messages : {
					category : {
						required : 'Please enter category name'
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
	            	setTimeout(function() {
	            		location.reload();
	            	}, 500);
			    }
			};
		};

		loadScript("<?= site_url('assets/admin/js/plugin/jquery-form/jquery-form.min.js'); ?>", pagefunction);
	});
</script>