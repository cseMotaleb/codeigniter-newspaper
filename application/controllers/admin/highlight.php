<div class="row">
	<div class="col-lg-6">
		<h1 class="page-title txt-color-blueDark">
			<i class="fa-fw fa fa-list"></i> News Position
		</h1>
	</div>
	<div class="col-lg-6">
		<div class="btn-group btn-sm pull-right">
			<button class="btn btn-danger changeURL" data-url="#news/category"><i class="fa fa-plus-circle"></i> Add Category</button>
			<button class="btn btn-success changeURL" data-url="#news/"><i class="fa fa-list"></i> News List</button>
			<button class="btn btn-danger changeURL" data-url="#news/manage"><i class="fa fa-plus-circle"></i> Add News</button>
		</div>
	</div>
</div>

<?php if(isset($error)) echo $error; ?>
<form id="validate-form" method="post" action="<?= site_url("admin/news/highlight"); ?>" role="form" data-toggle="validator">
	<div class="panel panel-primary">
		<div class="panel-heading">
			<h4>Home 9 News Position</h4>
		</div>
		<div class="panel-body">

	    	<div class="form-group">
				<div class="input-group">
	  				<input type="text" class="form-control input-lg" name="k" id="searchrow" placeholder="News" value="">
	  				<span class="input-group-addon" id="basic-addon1">&nbsp;&nbsp;<i class="fa fa-search"></i>&nbsp;&nbsp;</span>
				</div>
			</div>

	  		<?php $total_rows = count($news); ?>
			<table id="ItemTable" class="table table-bordered">
			    <thead>
			        <tr>
			        	<th>Title</th>
			        	<th>News#</th>
			        	<th>Position</th>
			        	<th>Posted By</th>
			        	<th>Date</th>
						<th style="width: 95px;">Action</th>
					</tr>
	        	</thead>
	        	<tbody>
	        	<?php
	        	$i = 1;
	        	if($total_rows > 0) {
	        		$user_data = array();
	        		$highlight = array();
	        		foreach ($news as $row) {
	        			if(!isset($user_data[$row['user_id']]['id'])) $user_data[$row['user_id']] = get_rows(array("table"=>"users", "limit"=>1), array("id"=>$row['user_id']));
	        			if(!isset($highlight[$row['id']]['id'])) $highlight[$row['id']] = get_rows(array("table"=>"highlight_blog", "limit"=>1), array("page"=>"Home", "blog_id"=>$row['id']));
						$blog_url = site_url("article/{$row['id']}");
					?>
	        		<tr class="hiderow" id="hiderow<?= $row['id']; ?>">
	        			<td>
	        				<a target="_blank" href="<?= $blog_url; ?>">
	        					<?= $row['title']; ?>
	        				</a>
	        			</td>
	        			<td class="text-center"><?= $i; ?></td>
	        			<td>
	        				<input name="position[]" value="<?php if(isset($highlight[$row['id']]['position'])) echo $highlight[$row['id']]['position']; ?>" class="form-control" type="text" />
	        				<input type="hidden" name="news[]" value="<?= $row['id']; ?>" />
	        			</td>
	        			<td>
	        				<?php
	        					if(!empty($user_data[$row['user_id']]['first_name'])) echo "{$user_data[$row['user_id']]['first_name']} {$user_data[$row['user_id']]['last_name']}";
								else echo "N/A";
	        				?>
	        			</td>
	        			<td><?= date("dS F, Y", $row['time']); ?></td>
						<td>
							<div class="btn-group">
							  	<button type="button" class="btn btn-xs btn-danger">Action</button>
							  	<button type="button" class="btn btn-xs btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							    	<span class="caret"></span>
							    	<span class="sr-only">Toggle Dropdown</span>
							  	</button>
							  	<ul class="dropdown-menu dropdown-menu-right">
							    	<li><a target="_blank" href="<?= $blog_url; ?>" title="View"><i class="fa fa-rss"></i> View</a></li>
							    	<li><a href="#news/manage/edit/<?= $row['id']; ?>" title="Edit"><i class="fa fa-pencil"></i> Edit</a></li>
							    	<li><a data-url="<?= site_url("admin/news/manage/delete/"); ?>" data-toggle="modal" data-target="#myModal" id="<?= $row['id'] ?>" title="Delete" ><i class="fa fa-trash-o"></i> Delete</a></li>
							    	<li><a href="#">Action</a></li>
							  	</ul>
							</div>
						</td>
	        		</tr>
	        		<?php 
					$i++;
						}
					} else echo '<tr><td colspan="7">No Result Found</td></tr>'; ?>
	        	</tbody>
	        </table>
		</div>
	
		<div class="panel-footer">
			<div class="text-center">
				<input name="page" id="page" value="Category" type="hidden" />
				<button class="btn btn-lg btn-primary" type="submit">Save Home 9 News Position</button>
			</div>
		</div>
	</div>
</form>



<?php $this->load->view("admin/common-delete-modal"); ?>


<script src="<?= base_url(); ?>assets/admin/js/custom.js"></script>
<script type="text/javascript">
	pageSetUp();

	$(document).ready(function() {
	
		var $rows = $('#ItemTable tr.hiderow');
		$('#searchrow').keyup(function() {
		    var val = $.trim($(this).val()).replace(/ +/g, ' ').toLowerCase();
	
		    $rows.show().filter(function() {
		        var text = $(this).text().replace(/\s+/g, ' ').toLowerCase();
		        return !~text.indexOf(val);
		    }).hide();
	
		    if($('#searchrow').val() != "") {
		    	$(".highlight_row").hide();
		    	$(".showwhensearch").show();
		    }
		    else {
		    	$(".highlight_row").show();
		    	$(".showwhensearch").hide();
		    }
		});


		var pagefunction = function() {
			var $checkoutForm = $('#validate-form').validate({
				rules : {
					client : {
						required : true
					}
				},
				messages : {
					client : {
						required : 'Please enter client name'
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

		loadScript("<?=  site_url('assets/admin/js/plugin/jquery-form/jquery-form.min.js'); ?>", pagefunction);
	});






















jQuery.fn.appendo = function(opt)
{
	this.each(function() { jQuery.appendo.init(this,opt); });
	return this;
};

jQuery.appendo = function() {

	var myself = this;

	this.opt = { };

	this.init = function(obj,opt) {

		var options = jQuery.extend({
				labelAdd:		'<i class="fa fa-plus-circle"></i> Add Row',
				labelDel:		'<i class="fa fa-minus-circle"></i> Remove',
				type : 'button',
				allowDelete:	true,
				copyHandlers:	false,
				focusFirst:		true,
				onAdd:			function() { return true; },
				onDel:		function() { return true; },
				maxRows:		0,
				wrapClass:		'appendoButtons',
				wrapStyle:		{ padding: '.4em .2em .5em' },
				buttonStyle:	{ marginRight: '.5em' },
				subSelect:		'tr:last',
				rows : 1
			},
			myself.opt,
			opt
		);

		var $cpy = jQuery(obj).find(options.subSelect).clone(options.copyHandlers);
		var rows = options.rows;
		var $add_btn = new_button(options.labelAdd, "btn btn-warning btn-xs").click(clicked_add),
			$del_btn = new_button(options.labelDel, "btn btn-danger btn-xs").click(clicked_del).hide()
		;

		function add_row()
		{
			var $dup = $cpy.clone(options.copyHandlers);
			$dup.appendTo(obj);
			update_buttons(1);
			if (typeof(options.onAdd) == "function") options.onAdd($dup);
			if (!!options.focusFirst) $dup.find('input:first').focus();

			var id = 0;
			$("select").each(function() {
				id++;
				var l = $('select.select2').length;
				$(this).attr('id', 'row'+id);
				$(this).addClass('row_class'+id);
				if(l == id) {
					$('[id]').each(function () {
					    $('[id="' + this.id + '"]:gt(0)').remove();
					});
				}
				setTimeout(function () {
					$('#row'+id).select2({
				    	width: "100%"
				  	});
				}, 100);
			});
		};

		function del_row()
		{
			var $row = jQuery(obj).find(options.subSelect);
			if ((typeof(options.onDel) != "function") || options.onDel($row))
			{
				$row.remove();
				update_buttons(-1);
			}
		};

		function update_buttons(rowdelta)
		{
			rows = rows + (rowdelta || 0);
			$add_btn.attr('disabled',(!options.maxRows || (rows < options.maxRows))?false:true);
			(options.allowDelete && (rows > 1))? $del_btn.show(): $del_btn.hide();
		};

		function new_button(label, aclass)
		{
			return jQuery('<button />')
				.css(options.buttonStyle)
				.addClass(aclass)
				.attr('type', 'button')
				.html(label);
		};

		function nothing(e)
		{
			e.stopPropagation();
			e.preventDefault();
			return false;
		};

		function clicked_add(e)
		{
			if (!options.maxRows || (rows < options.maxRows)) add_row();
			return nothing(e);
		};

		function clicked_del(e)
		{
			if (rows > 1) del_row(); 
			return nothing(e);
		};

		jQuery('<div />')
			.addClass(options.wrapClass)
			.css(options.wrapStyle)
			.append( $add_btn, $del_btn )
			.insertAfter(obj);

		update_buttons();
	};
	return this;
}();

jQuery(function(){ jQuery('table.appendo').appendo({ rows : $('table.appendo').data("rows") }); });
</script>