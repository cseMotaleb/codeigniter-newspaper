<style type="text/css">
.box-unit1 {
    background-color: #EEEEEE;
    border-radius: 6px;
    color: inherit;
    line-height: 30px;
    margin-bottom: 30px;
    padding: 15px;
}
</style>
<div class="row">
	<div class="col-lg-6">
		<h1 class="page-title txt-color-blueDark">
			<i class="fa-fw fa fa-pencil-square-o"></i> Manage Menu Builder
		</h1>
	</div>
	<div class="col-lg-6">
		<div class="btn-group btn-sm pull-right">
			<a href="#menu_builder" class="btn btn-success pull-right"><i class="fa fa-list"></i> Menu List</a>
			<a href="#menu_builder/manage" class="btn btn-danger pull-right"><i class="fa fa-plus-circle"></i> Add menu</a>
		</div>
	</div>
</div>

<form action="<?= site_url("admin/menu_builder/manage/{$mode}/{$current_id}"); ?>" method="post" id="validate-menu">	
	<div class="panel panel-primary">
		<div class="panel-heading">
			<h4><?= ucfirst($mode); ?> Menu</h4>
		</div>
		<div class="panel-body">		    		
		    <div class="formSep">
				<div class="row">
	    			<div class="col-md-5">
			    		<div class="formSep">
			    			<label class="req">Menu Name</label>
			    			<input name="name" id="menuname" class="form-control" placeholder="Enter menu name" value="<?php if(isset($menu['name'])) echo $menu['name']; else echo set_value('name'); ?>" type="text" />
			    		</div>
						
						<br />
						
			    		<div class="formSep">
			    			<label class="req">Status</label>
		 	                   <select name="enabled" id="enabled" class="select2">
		                        <option value="1" <?php if(isset($menu['enabled']) && $menu['enabled'] == 1) echo "selected=\"selected\"";?>>Enabled</option>
		                        <option value="0" <?php if(isset($menu['enabled']) && $menu['enabled'] == 0) echo "selected=\"selected\"";?>>Disabled</option>
		                    </select> 
			    		</div>

			    		<br />

			    		<div class="formSep">
			    			<label class="req">Menu ID</label>
			    			<input name="menuid" id="menuid" class="form-control" placeholder="Type menu id." value="<?php if(isset($menu['menu_id'])) echo $menu['menu_id']; else echo set_value('menu_id'); ?>" type="text" />
			    		</div>

			    		<br />

			    		<div class="formSep">
			    			<label>Menu Class</label>
			    			<input name="menuclass" id="menuclass" class="form-control" placeholder="Type menu class." value="<?php if(isset($menu['menu_class'])) echo $menu['menu_class']; else echo set_value('menu_class'); ?>" type="text" />
			    		</div>

			    		<br />
			    	</div>
					<div class="col-md-7">
						<div class="formSep">
							<div id='jqxWidget'>
								<div style='float: left;'>
									<div class="row">
										<div class="col-md-6">
											<div class="formSep">
												<label>List of Webpages</label>
												<div id='treeA'>
													<ul>
														<?php $menus = menus(array('status !='=>'Draft')); echo $menus['page_list']; ?>
													</ul>
												</div>
											</div>
										</div>
										<div class="col-md-6">
											<div class="formSep">
												<label>Menu</label>
												<div id="treeB">
													<?php 
													if(isset($menu['content'])) echo str_replace('nav navbar-nav navbar-right', '', $menu['content']); 
													else {
													?>
													<ul class="primary-nav" id="primary-nav-id">
														<li><a href="<?= base_url()?>">Home</a></li>
													</ul>
													<?php } ?>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<br /><br />
										<div class="well">
											<h4>Add New Menu Item</h4>
											<span id="itmurlerrmsg" class="text-error"></span>
											<div class="row">
												<div class="col-md-4">
													<label>Item Title</label>
													<input name="new_link_title" id="new_link_title" class="form-control" placeholder="Enter New Link Title" value="" type="text" />
												</div>
												<div class="col-md-4">
													<label>Item URL</label>
													<input name="new_link_url" id="new_link_url" class="form-control" placeholder="Enter New Link URL" value="" type="text" />
												</div>
												<div class="col-md-4">
													<label>&nbsp;</label>
													<button class="btn btn-primary" type="button" id="add_menu_item">Add Menu Item</button>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>	
						</div>	
					</div>
		    	</div>
		    </div>
		</div>
		
		<div class="panel-footer">
			<input type="hidden" name="mymenu" id="mymenu" />	
			<input type="hidden" name="id" value="<?php if(isset($current_id)) echo $current_id; ?>" />
	    	<button class="btn btn-primary" type="submit"><i class="fa fa-floppy-o"></i> Save Menu</button>  
		</div>
	</div>
</form>



<link rel="stylesheet" href="<?= base_url(); ?>assets/admin/js/libs/jqwidgets/jqx.base.css" type="text/css" />
<script type="text/javascript" src="<?= base_url(); ?>assets/admin/js/libs/jqwidgets/jqxcore.js"></script>
<script type="text/javascript" src="<?= base_url(); ?>assets/admin/js/libs/jqwidgets/jqxbuttons.js"></script>
<script type="text/javascript" src="<?= base_url(); ?>assets/admin/js/libs/jqwidgets/jqxscrollbar.js"></script>
<script type="text/javascript" src="<?= base_url(); ?>assets/admin/js/libs/jqwidgets/jqxpanel.js"></script>
<script type="text/javascript" src="<?= base_url(); ?>assets/admin/js/libs/jqwidgets/jqxdragdrop.js"></script>
<script type="text/javascript" src="<?= base_url(); ?>assets/admin/js/libs/jqwidgets/jqxtree.js"></script>
<script type="text/javascript" src="<?= base_url(); ?>assets/admin/js/libs/jQuery.htmlClean/jQuery.htmlClean.js"></script>
<script src="<?= base_url(); ?>assets/admin/js/libs/filter-input/jquery.filter_input.js"></script>


<script type="text/javascript">
	pageSetUp();

	$(document).ready(function () {
		$('#menuname').filter_input({regex:'[a-zA-Z0-9_]'});
		$('#add_menu_item').on('click', function (event) {
			if($('#new_link_title').val() != '' && $('#new_link_url').val() != '') {
				$('#treeB').jqxTree('addTo', { label: '<a href=\''+$('#new_link_url').val()+'\'>'+$('#new_link_title').val()+'</a>' });
				$('#itmurlerrmsg').html('Menu Item added successfully!');
			}
			else {
				$('#itmurlerrmsg').html('Please enter Item Title and URL');
			}
		});

		$('#validate-menu').on('submit', function (event) {
			getmenu();
		});

		$("#treeA, #treeB").on('click', function (event) {
			event.preventDefault();
		});	
		
		var theme = "";
		$('#treeA').jqxTree({ allowDrag: true, allowDrop: true, height: '300px', width: '220px', theme: theme,
			dragStart: function (item) {
				if (item.label == "Community")
				return false;
			}
		});
		
		$('#treeB').jqxTree({ allowDrag: true, allowDrop: true, height: '300px', width: '220px', theme: theme,
			dragEnd: function (item, dropItem, args, dropPosition, tree) {
				if (item.label == "Forum")
				return false;
			}
		});
		
		$("#treeA, #treeB").on('dragStart', function (event) {
			$("#dragStartLog").text("Drag Start: " + event.args.label);
			$("#dragEndLog").text("");
		});
	
		$("#treeA, #treeB").on('dragEnd', function (event) {
			getmenu();
	
		});
	});

	function getmenu() {
		html = $($("#treeB").html()).find('.jqx-widget-content').html();
		//alert(html);
		html = $.htmlClean(html, { format: true, removeTags: ["p","span", "div"], allowedClasses: ["primary-nav"<?php if(isset($menu['menu_class']) && !empty($menu['menu_class'])) echo ", \"{$menu['menu_class']}\"";?>] });	
		
		var cmenuid = $('#menuid').val();
		var cmenuclass = $('#menuclass').val();
	
		
		if(cmenuid == '') cmenuid = $('#menuname').val();
		<?php if(isset($menu['menu_class']) && !empty($menu['menu_class'])) {$varclass = $menu['menu_class'];} else $varclass='primary-nav';?>
		if(cmenuid != '') html = html.replace('<ul class="<?= $varclass;?>">', '<ul class="<?= $varclass;?>" id="'+cmenuid+'">');
		if(cmenuid != '') html = html.replace('<ul>', '<ul class="<?= $varclass;?>" id="'+cmenuid+'">');
		if(cmenuclass != '') html = html.replace('<?= $varclass;?>', cmenuclass);
		if(cmenuclass != '') html = html.replace('<?= $varclass;?>', cmenuclass);

		$('#mymenu').val(html);	
	}
	
	var pagefunction = function() {
		var $checkoutForm = $('#validate-menu').validate({
			rules : {
				name : {
					required : true
				},
				status : {
					required : true
				},
				menuid : {
					required : true
				}
			},
			messages : {
				name : {
					required : 'Please enter Menu Name'
				},
				status : {
					required : 'Please select status'
				},
				menuid : {
					required : 'Please enter Menu ID'
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
		    	$("#validate-menu").attr("action", "<?= site_url("admin/menu_builder/manage"); ?>/" + obj.data_mode + "/" + obj.zone_id);
		    	$('#zone_id').val(obj.data_listing_id);
		    	window.history.pushState("string", "Menu Builder", "#menu_builder/manage/" + obj.data_mode + "/" + obj.zone_id);
		    }
		};
	};	
	
	loadScript("<?=  base_url();?>assets/admin/js/plugin/jquery-form/jquery-form.min.js", pagefunction);
</script>