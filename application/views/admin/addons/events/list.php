<div class="row">
	<div class="col-lg-6">
		<h1 class="page-title txt-color-blueDark">
			<i class="fa-fw fa fa-pencil-square-o"></i> Events
		</h1>
	</div>
	<div class="col-lg-6">
		<div class="btn-group btn-sm pull-right">
			<button class="btn btn-success pull-right changeURL" data-url="#events/"><i class="fa fa-navicon"></i> Events List</button>
			<button class="btn btn-danger pull-right changeURL" data-url="#events/manage/"><i class="fa fa-list-alt"></i> Add Events</button>
		</div>
	</div>
</div>

<section id="widget-grid" class="">
	<div class="row">
		<article class="col-sm-12 col-md-12 col-lg-12">
			<?php include 'search.php'; ?>
		</article>
	</div>
</section>


<div class="panel panel-default">
  	<div class="panel-heading">
  		<h4>Events</h4>
  	</div>
  	<?php $total_rows = count($rows); ?>
	<form id="BulkDeleteForm" method="post" action="<?= site_url("admin/events/manage/bulk_delete"); ?>">
		<table class="table table-bordered">
		    <thead>
		        <tr>
		        	<th>
		        		<?php if($total_rows > 0) { ?>
		        		<input name="all_bulk" id="all_bulk" value="" type="checkbox" />
		        		<?php } ?>
		        	</th>
		        	<th>Title</th>
		        	<th>Date</th>
		        	<th>Status</th>
					<th style="width: 65px;">Action</th>
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
        			<td>
        				<small><?= $row['title']; ?></small>
					</td>
					<td>
						<small><?= $row['start_date']; ?></small>
					</td>  
        			<td>
						<a data-original-title="Select Status" data-url="<?= site_url("admin/events/ajax_status_update"); ?>" data-value="<?= $row['enabled']; ?>" data-pk="<?= $row['id'] ?>" data-type="select" data-name="enabled" name="enabled" class="rstatusopt" href="#">
						 	<span class="label <?= $label; ?>"><?= $status; ?></span>
						</a>
        			</td>
					<td>
						<div class="btn-group">
							<a href="#events/manage/edit/<?= $row['id']; ?>" class="btn btn-default btn-xs" title="Edit"><i class="fa fa-pencil"></i></a>
							<a class="btn btn-default btnDel btn-xs" data-url="<?= site_url("admin/events/manage/delete/"); ?>" data-toggle="modal" data-target="#myModal" id="<?= $row['id'] ?>" title="Delete" ><i class="fa fa-trash-o"></i></a>
						</div>
					</td>
        		</tr>
        		<?php }
				} else echo '<tr><td colspan="5">No Result Found</td></tr>'; ?>
        	</tbody>
        	<?php if($total_rows > 0) { ?>
    		<tfoot>
    			<tr>
    				<td colspan="5" class="text-right">
    					<div class="row">
    						<div class="col-md-6">
    							<div class="text-left">
    								<br />
    								<a data-toggle="modal" data-target="#bulkModal" class="btn btn-danger"><i class="fa fa-shirtsinbulk"></i> Bulk Delete</a>
    							</div>
    						</div>
    						<div class="col-md-6">
    							<?= $pagination; ?>
    						</div>
    					</div>
    				</td>
    			</tr>
    		</tfoot>	
    		<?php } ?>	
        </table>
  	</form>
</div>


<?php $this->load->view("admin/common-delete-modal"); ?>

<script src="<?= base_url(); ?>assets/admin/js/custom.js"></script>
<script type="text/javascript">
	pageSetUp();

	$(document).ready(function() {
	    function format(state) {var originalOption = state.element;return "<img class='flag' src='" + $(originalOption).data('image') + "' alt='" + $(originalOption).data('title') + "' />" + state.text;}

        if($('#image').length) {
            $('#image').select2({
            	placeholder: "Select a image",
            	allowClear: true,
            	formatResult: format,
				formatSelection: format,
            	escapeMarkup: function(m) { return m; }
            });
        };

        if($('#url').length) {
            $('#url').select2({
                minimumInputLength: 1,
                query: function (query) {
                	allowClear: true,
					make_select2(query, '<?= site_url('admin/events')?>/search_url/?o=json&t='+query.term, 1);
                }
            });
 	   	};

		var pagefunction = function() {
			CKEDITOR.instances['description'].on('change', function() { CKEDITOR.instances['description'].updateElement() });
			var $checkoutForm = $('#validate-form').validate({
				rules : {
					title : {
						required : true
					},
					enabled : {
						required : true
					}
				},
				messages : {
					title : {
						required : 'Please enter title'
					},
					enabled : {
						required : 'Please select enabled'
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

			<?php 
				if(isset($row_data['url']) && $row_data['url'] != '') {
				$selected_url = $row_data['url']; ?>
				$("#url").select2("data", {id: "<?= $selected_url; ?>", text: "<?= $selected_url; ?>"});
			<?php } ?>

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
			    	$("#validate-form").attr("action", "<?= site_url("admin/events/manage"); ?>/" + obj.data_mode + "/" + obj.return_id);
			    	if(obj.data_mode != '') window.history.pushState("string", "Events", "#events/manage/" + obj.data_mode + "/" + obj.return_id);
			    	if(obj.data_mode != 'edit') location.reload();
			    }
			};
		};

		loadScript("<?= site_url('assets/admin/js/plugin/jquery-form/jquery-form.min.js'); ?>", pagefunction);
	});
</script>