<div class="pull-left">
	<h1 class="page-title txt-color-blueDark">
		<i class="fa-fw fa fa-pencil-square-o"></i> Configuration
	</h1>
</div>
<div class="pull-right">
	<button class="btn btn-primary btn-md" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus-circle"></i> Add Configuration</button>
</div>
<div class="clearfix"></div>

<?php
	$list_enum = list_enum('config', 'group');
	sort($list_enum);
	$user_type = $this->session->userdata("user_type");
?>
<!--<link rel="stylesheet" href="--><?//= base_url();?><!--assets/admin/js/plugin/sticky/sticky.css">-->
<div class="panel panel-primary">
	<div class="panel-heading">
		<h4><i class="fa fa-cogs"></i> Configuration</h4>
	</div>
	<div class="panel-body">
		<div id="tabs">
			<ul>
				<?php if(count($list_enum) > 0) { 
            		foreach ($list_enum as $enum) {
            			if(!empty($enum)) {
            			$field_id = str_replace(' ', '_', $enum);
            	?>
                <li><a href="#<?= $field_id; ?>"><?= $enum; ?></a></li>
                <?php }
                	}
				} ?>								
			</ul>
			
        	<?php
        	if(count($list_enum) > 0) {
        		foreach ($list_enum as $row) {
        			if(!empty($row)) {
        				$field_id = str_replace(' ', '_', $row);
						$sql_properties['table'] = "config";
						$sql_properties['select'] = "config.*";
						$sql_properties['limit'] = 1500;

						$sql_properties['order_by'][] = "config.option";
						$sql_properties['order_type'][] = "asc";
        				$group_details = get_rows($sql_properties, array('config.group'=>$row));

        	?>								
			<div id="<?= $field_id; ?>">
				<table id="user" class="table table-bordered table-striped" style="clear: both">
					<tbody>
						<?php
	                	if(count($group_details) > 0) {
	                    	foreach ($group_details as $config) { 
	                    	?>                          	
						<tr>
							<td style="width:25%;"><?= ucwords(str_replace('_',' ',$config['option'])); ?></td>
							<td style="width:55%">
								<?php if(($user_type == "Admin") && $config['write'] == 1) { ?>
								<a href="<?= site_url("config/update/edit/{$config['id']}")?>" class="edVal" id="<?= $config['option']; ?>" data-type="text" data-pk="<?= $config['id']; ?>" data-original-title="Enter Value" name="value">
								<?php } elseif($config['option'] == "just_in_news") { ?>
								<a href="<?= site_url("config/update/edit/{$config['id']}")?>" class="edVal" id="<?= $config['option']; ?>" data-type="text" data-pk="<?= $config['id']; ?>" data-original-title="Enter Value" name="value">
								<?php } ?>
								<?= $config['value'];?>
								<?php if(($user_type == "Admin") && $config['write'] == 1) echo "</a>"; elseif($config['option'] == "just_in_news") echo "</a>"; ?>
							</td>
							<td>
								<?php if(($user_type == "Admin") && $config['delete'] == 1) { ?>
									<button class="btnDel" data-toggle="modal" data-target="#DelmyModal" id="<?= $config['id'] ?>"><span class="fa fa-trash-o"></span></button>	
								<?php } else echo 'N/A'; ?>											
							</td>							
						</tr>
						<?php } 
							} else echo "<tr><td colspan=\"4\">No Result Found</td></tr>";
						?>
					</tbody>
				</table>										
			</div>
			<?php }
				}
			} ?>
		</div>
	</div>
</div>



<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
					&times;
				</button>
				<h4 class="modal-title" id="myModalLabel">Add Configuration</h4>
			</div>
			<form id="Configuration-Form" action="<?= site_url("admin/config/manage"); ?>/" method="post">
			<div class="modal-body">
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label for="group"> Group</label>
							<select class="select2" id="group" name="group">
								<?php if(count($list_enum) > 0) {
			                		foreach ($list_enum as $enum) {
			                			if($enum) {
			                	?>
			                	<option value="<?= $enum; ?>"><?= $enum; ?></option>
								<?php }
									}
								} ?>
							</select>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
							<input type="text" name="option" id="option" class="form-control" placeholder="Option" required />
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
							<input type="text" name="value" id="value" class="form-control" placeholder="Value" required />
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<div id="post_response"></div>
				<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
				<button type="submit" class="btn btn-primary">Save</button>
			</div>
			</form>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<div class="modal fade" id="DelmyModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
					&times;
				</button>
				<h4 class="modal-title" id="myModalLabel">Add Configuration</h4>
			</div>
			<div class="modal-body">
				Are you sure to delete this data?
			</div>
			<div class="modal-footer">
				<button type="submit" data-dismiss="modal" class="btn btn-danger">Cancel</button>
				<button type="submit" data-dismiss="modal" class="btn btn-primary ConfirmDel">Confirm</button>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<input type="hidden" name="hidden_input_id" id="hidden_input_id" value="" />

<script type="text/javascript">
pageSetUp();

$(document).ready(function() {   
	$("#Configuration-Form").submit(function (event) {
	    event.preventDefault();	
		$.ajax({async: false, type:'POST',
			url: $("#Configuration-Form").attr("action"),
			data:$("#Configuration-Form").serialize(),
			success: function(response) {
			 	processJson(response);
		}});     
	});

	$('.edVal').editable({
	    url: '<?= site_url("admin/config/ajax_update")?>',
	    type: 'text',
	    name: $(this).attr('id'),
	    title: 'Enter Value',
        validate: function(value) {
           if(value == '') return 'This field is required!'; 
        },	    
        success: function(response, newValue) {             
           processJson(response);
        },             	               
	});

	$(".btnDel").click(function (event) {
		event.preventDefault();
		var id = $(this).attr('id');
		$("#hidden_input_id").val(id);
	});
	
	$(".ConfirmDel").click(function (event) {
		event.preventDefault();
		var id = $("#hidden_input_id").val();
		$.get('<?= site_url("admin/config/delete"); ?>/?id='+id+'&math='+Math.random(), function(response) {
			location.reload();
		});
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
	    }
	$('#tabs').tabs();
});
</script>
