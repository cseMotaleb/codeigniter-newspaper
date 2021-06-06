<style type="text/css">
.select2-chosen img {
	margin-top: -2px;
	width: 25px !important;
	height: 22px !important;
	display: inline-block;
	clear: left;
}
</style>

<div class="row">
	<div class="col-lg-6">
		<h1 class="page-title txt-color-blueDark">
			<i class="fa-fw fa fa-pencil-square-o"></i> Manage Page
		</h1>
	</div>
	<div class="col-lg-6">
		<div class="btn-group btn-sm pull-right">
			<a href="#pages" class="btn btn-success pull-right"><i class="fa fa-list"></i> Page List</a>
			<?php /*<a href="#pages/manage" class="btn btn-danger pull-right"><i class="fa fa-plus-circle"></i> Add Page</a> */ ?>
		</div>
	</div>
</div>

<div class="panel panel-primary">
  	<div class="panel-heading">
  		<?= ucfirst($mode); ?> Page
  	</div>
  	<div class="panel-body">
  		<form id="validate-page" method="post" action="<?= site_url("admin/pages/manage/{$mode}/{$current_id}"); ?>">
			<div class="formSep">
				<label class="req">Page Name</label>
				<input name="page" id="page" class="form-control" placeholder="Page Name" value="<?php if(isset($page['page'])) echo $page['page']; ?>" type="text" />	   	 				
			</div>

  			<hr />

   	 		<div class="row">
   	 			<div class="col-md-8">
				    <div class="panel panel-default">
						<div class="panel-heading">Meta Data</div>
				        <div class="panel-body">
		   	 				<div class="formSep">
		   	 					<label>Meta Title</label>
		   	 					<input name="meta_title" id="meta_title" class="form-control" placeholder="Meta Title" value="<?php if(isset($page['meta_title'])) echo $page['meta_title']; ?>" type="text" />
		   	 				</div>

		   	 				<hr />

		   	 				<div class="formSep">
		   	 					<label>Meta Keyword</label>
		   	 					<input name="meta_keyword" id="meta_keyword" class="form-control" placeholder="Meta Keyword" value="<?php if(isset($page['meta_keyword'])) echo $page['meta_keyword']; ?>" type="text" />
		   	 				</div>

		   	 				<hr />

		   	 				<div class="formSep">
		   	 					<label>Meta description</label>
		   	 					<input name="meta_description" id="meta_description" class="form-control" placeholder="Meta Description" value="<?php if(isset($page['meta_description'])) echo $page['meta_description']; ?>" type="text" />
		   	 				</div>
		   	 			</div>
		   	 		</div>
   	 			</div>

   	 			<div class="col-md-4">
				    <div class="panel panel-default">
						<div class="panel-heading">Page Info</div>
				        <div class="panel-body">
				    		<div class="formSep">
				                <?php $selected_image = isset($page['page_banner']) ? $page['page_banner'] : ''; ?>
			                	<label>Page Banner</label>
			                	<select name="page_banner" id="page_banner" class="select2" style="width:100%">
		                		<?php 
		                			$page_banner = get_image_list(array('type'=>'Page Banner', 'status'=>'Enabled'), $selected_image); 
		                			echo $page_banner['image_list'];
		                		?>
			                	</select>
				    		</div>

				    		<hr />

				    		<div class="formSep">
				    			<label>Tags</label>
				    			<input name="tags" id="tags" class="tag" style="width:100%" value="<?php if(isset($page['tags'])) echo $page['tags']; ?>" type="text" placeholder="Tags" />
				    		</div>
				    		
				    		<hr />

				    		<div class="formSep">
                                <label class="req">Status</label>
                                <select name="status" id="status" class="select2" style="width:100%">
                                   <?php
                                        $selected_type = (isset($page['status'])) ? $page['status'] : '' ;
                                        echo enum_list('pages', 'status', $selected_type);    
                                    ?>
                                </select>
							</div>
				    	</div>
				    </div>
   	 			</div>
   	 		</div>

		    <div class="panel panel-default">
				<div class="panel-heading">Content</div>
    			<textarea name="content2" class="span12" id="content2" cols="30" rows="10" placeholder="Type content." ><?php if(isset($page['content'])) echo $page['content']; else echo set_value('content');?></textarea>
		    </div>

			<footer>
				<input type="hidden" name="id" value="<?php if(isset($current_id)) echo $current_id; ?>" />
				<div class="text-center">
					<button type="submit" class="btn btn-lg btn-primary">
						<i class="fa fa-floppy-o"></i> &nbsp;&nbsp;&nbsp;<?php if(isset($mode) && $mode == "edit") echo "Update"; else echo "Save"; ?> Page&nbsp;&nbsp;&nbsp;
					</button>
				</div>
			</footer>
  		</form>
  	</div>
</div>

<script type="text/javascript">
	pageSetUp();
	$(document).ready(function() {
		function format(state) {var originalOption = state.element;return "<img style='height: 25px; width: 25px;' class='flag2' src='" + $(originalOption).data('image') + "' alt='" + $(originalOption).data('title') + "' /> " + state.text;}

	    $('#status').select2({
	    	placeholder: "Select ...."
	    });

	    if($('#page_banner').length) {
	        $("#page_banner").select2({
	            placeholder: "Select Page Banner",
	            formatResult: format,
				formatSelection: format,
	            escapeMarkup: function(m) { return m; }
	        });
	    }
	    
	    $('#tags').select2({
	        tags: [],
	        tokenSeparators: [",", " "]
	    }); 
	});
	
	var pagefunction = function() {
		CKEDITOR.instances['content2'].on('change', function() { CKEDITOR.instances['content2'].updateElement() });
		var $checkoutForm = $('#validate-page').validate({
			rules : {
				page : {
					required : true
				}
			},
			messages : {
				page : {
					required : 'Please enter page name'
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

	if($('#content2').length) {
	    	CKEDITOR.replace( 'content2', {
			toolbar: 'Standard'
	    });
	};

	loadScript("<?=  base_url();?>assets/admin/js/plugin/jquery-form/jquery-form.min.js", pagefunction);
</script>