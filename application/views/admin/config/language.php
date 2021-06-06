<div class="row">
	<div class="col-lg-6">
		<h1 class="page-title txt-color-blueDark">
			<i class="fa-fw fa fa-pencil-square-o"></i> Variable Languages
		</h1>
	</div>
	<div class="col-lg-6">
		<div class="btn-group btn-sm pull-right">
			<button data-url="#config/languages" class="btn btn-success pull-right changeURL"><i class="fa fa-navicon"></i> Variable Language List</button>
			<button data-url="#config/languages/add" class="btn btn-danger pull-right changeURL"><i class="fa fa-list-alt"></i> Add Variable Language</button>
		</div>
	</div>
</div>

<?php include 'find-language.php'; ?>

<div class="row">
	<div class="col-md-6">
		<div class="panel panel-default">
		  	<div class="panel-heading">
		  		Variable Language List
		  	</div>
			<table class="table table-bordered">
			    <thead>
			        <tr>
			        	<th>Key</th>
						<th>Language</th>
						<th>Set</th>
						<th>Text</th>
						<th width="15%">Action</th>
					</tr>
	        	</thead>
	        	<tbody>
                	<?php
                	if(count($rows) > 0) {
                		foreach ($rows as $row) {
                	?>
	        		<tr id="hiderow<?= $row['id']; ?>">
	        			<td style="max-width: 120px;">
	        				<small><?= $row['key']; ?></small>
	        			</td>
	        			<td><?= $row['language']; ?></td>
	        			<td><?= $row['set']; ?></td>
	        			<td><?= $row['text']; ?></td>
						<td>
							<div class="btn-group">
								<a href="#config/languages/edit/<?= $row['id']; ?>" class="btn btn-default btn-xs" title="Edit"><i class="fa fa-pencil"></i></a>
								<a class="btn btn-default btnDel btn-xs" data-toggle="modal" data-target="#myModal" data-url="<?= site_url("controlpanel/config/languages/delete/"); ?>" id="<?= $row['id'] ?>" title="Delete" ><i class="fa fa-trash-o"></i></a>							
							</div>
						</td>
	        		</tr>
	        		<?php }
						} else echo '<tr><td colspan="4">No Result Found</td></tr>'; ?>
	        	</tbody>		
	        </table>
	        <?php if(!empty($pagination)) { ?>
	        <div class="panel-footer">
	        	<div class="text-right">
	        		<?= $pagination; ?>
	        	</div>
	        </div>
	        <?php } ?>
		</div>
	</div>

	<?php
		$form_action_id = (isset($translation_id) && !empty($translation_id)) ? $translation_id : $lan_id;
	?>

	<div class="col-md-6">
		<div class="panel panel-default">
		  	<div class="panel-heading"><?= ucfirst($mode); ?> Variable Language</div>
		  	<div class="panel-body">
				<form action="<?= site_url("controlpanel/config/languages/{$mode}/{$form_action_id}"); ?>" method="post" id="validate-language">
		    		<div class="formSep">
		    			<div class="row">
		    				<div class="col-md-6">
				    			<label class="req">Key</label>
		                		<input class="form-control" type="text" name="key" id="key" placeholder="Enter key" value="<?php if(isset($lang_data['key'])) echo $lang_data['key']; ?>" />
		    				</div>

		    				<div class="col-md-6">
								<label class="req">Language</label>
								<select name="language" id="language" class="select2">
					    	    	<?php $selected_lang = (isset($lang_data['language']) && $lang_data['language']) ? $lang_data['language'] : "en"; ?>
					    			<?php
					    			    $options = options(array('table'=>'language', 'limit'=>1000, 'option_value'=>'lang', 'option'=>'language', 'default'=>$selected_lang, 'oder_by'=>'language', 'order_type'=>'asc'), array());
					    			    echo $options['option_list'];
					    			?>
								</select>
		    				</div>
		    			</div>
					</div>

		    		<hr />
		    		
		    		<div class="formSep">
		    			<div class="row">
		    				<div class="col-md-6">
				    			<label class="req">Set</label>
		                		<input class="form-control" type="text" name="set" id="set" placeholder="Enter set" value="<?php if(isset($lang_data['set'])) echo $lang_data['set']; else echo "all"; ?>" />
		    				</div>
		    				<div class="col-md-6">
				    			<label class="req">Text</label>
		                		<input class="form-control" type="text" name="text" id="text" placeholder="Enter text" value="<?php if(isset($lang_data['text'])) echo $lang_data['text']; ?>" />
		    				</div>
		    			</div>
		    		</div>

					<hr />

					<div class="formSep">
						<input type="hidden" name="id" value="<?php if(isset($lan_id)) echo $lan_id; ?>" />
						<button type="submit" class="btn btn-primary">Save</button>
					</div>
		   		</form>
		  	</div>
		</div>
	</div>
</div>

<?php $this->load->view("controlpanel/common-delete-modal"); ?>

<script src="<?= base_url(); ?>assets/controlpanel/js/custom.js"></script>
<script type="text/javascript">
	pageSetUp();    

	var pagefunction = function() {
		var $checkoutForm = $('#validate-language').validate({
			rules : {
				key : {
					required : true
				},
				set : {
					required : true
				},
				text : {
					required : true
				}
			},
			messages : {
				key : {
					required : 'Please enter key'
				},
				set : {
					required : 'Please enter set'
				},
				text : {
					required : 'Please enter text'
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
		    	$("#key").val('');
		    	$("#text").val('');
		    }
		};
	};

	loadScript("<?= base_url(); ?>assets/controlpanel/js/plugin/jquery-form/jquery-form.min.js", pagefunction);
</script>