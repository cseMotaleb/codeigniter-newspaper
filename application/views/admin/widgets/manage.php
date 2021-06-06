<div class="row">
	<div class="col-lg-6">
		<h1 class="page-title txt-color-blueDark">
			<i class="fa-fw fa fa-pencil-square-o"></i> Manage Widget
		</h1>
	</div>
	<div class="col-lg-6">
		<div class="btn-group btn-sm pull-right">
			<a class="btn btn-success" href="#widgets/"><i class="fa fa-navicon"></i> Widget List</a>
			<a class="btn btn-danger" href="#widgets/manage"><i class="fa fa-list-alt"></i> Add Widget</a>
		</div>
	</div>
</div>


<form id="validate-form" method="post" action="<?= site_url("admin/widgets/manage/{$mode}/{$current_id}"); ?>">
	<div class="panel panel-blue">
	  	<div class="panel-heading">
	  		<div class="pull-left">
	  			<?= ucfirst($mode); ?> Widget
	  		</div>
	  		<div class="pull-right">
	  			<select style="color: #000;" name="enabled" id="enabled">
	  				<option value="1" <?php if(isset($widget['enabled']) && $widget['enabled'] == 1) echo "selected"; ?>>Enabled</option>
	  				<option value="0" <?php if(isset($widget['enabled']) && $widget['enabled'] == 0) echo "selected"; ?>>Disabled</option>
	  			</select>
	  		</div>
	  		<div class="clearfix"></div>
	  	</div>
	  	<div class="panel-body">
			<div class="formSep">
				<label class="req">Title</label>
				<input name="title" id="title" class="form-control" placeholder="Title" value="<?php if(isset($widget['title'])) echo $widget['title']; ?>" type="text" />
			</div>

			<hr />

			<div class="formSep">
				<label>URL</label>
				<div class="input-group">
				  	<span class="input-group-addon"><?= base_url(); ?></span>
				  	<input name="url" id="url" class="form-control" placeholder="URL" value="<?php if(isset($widget['url'])) echo $widget['url']; ?>" type="text" />
				</div>   	 				
			</div>	

			<hr />

		    <div class="panel panel-default">
				<div class="panel-heading">Description</div>
    			<textarea name="description" id="description" cols="30" rows="10"><?php if(isset($widget['description'])) echo $widget['description']; ?></textarea>
		    </div>
   		</div>
		<div class="panel-footer">
			<div class="text-center">
				<input type="hidden" name="id" value="<?php if(isset($current_id)) echo $current_id; ?>" />
				<button type="submit" class="btn btn-lg btn-primary">&nbsp;&nbsp;&nbsp;<?php if($mode == "edit") echo "Update"; else echo "Save"; ?> Widget&nbsp;&nbsp;&nbsp;</button>
			</div>
		</div>
	</div>
</fomr>


<script type="text/javascript">
	pageSetUp();

	var pagefunction = function() {
		CKEDITOR.instances['description'].on('change', function() { CKEDITOR.instances['description'].updateElement() });

		var $checkoutForm = $('#validate-form').validate({
			rules : {
				page : {
					required : true
				},
				meta_title : {
					required : true
				},
				meta_keyword : {
					required : true
				},
				meta_description : {
					required : true
				}
			},
			messages : {
				page : {
					required : 'Please enter page name'
				},
				meta_title : {
					required : 'Please enter meta title'
				},
				meta_keyword : {
					required : 'Please enter meta keyword'
				},
				meta_description : {
					required : 'Please enter meta description'
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

		    if(obj.mcode == 200) document.getElementById('validate-form').reset();
		};
	};

	$(document).ready(function() {
		if($('#description').length) { 
		    CKEDITOR.replace( 'description', {
				toolbar: 'Standard'
		    });
		};
	});

	loadScript("<?=  base_url();?>assets/admin/js/plugin/jquery-form/jquery-form.min.js", pagefunction);
</script>