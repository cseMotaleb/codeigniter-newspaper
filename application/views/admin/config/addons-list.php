<script src="<?= base_url();?>assets/controlpanel/js/plugin/jqgrid/jquery.jqGrid.min.js"></script>
<script src="<?= base_url();?>assets/controlpanel/js/plugin/jqgrid/grid.locale-en.min.js"></script>

<!-- widget grid -->
<section id="widget-grid" class="">
	<!-- row -->
	<div class="row">
		<!-- NEW WIDGET START -->
		<article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			<table id="jqgrid"></table>
			<div id="pjqgrid"></div>
		</article>
		<!-- WIDGET END -->
	</div>
	<!-- end row -->
</section>
<!-- end widget grid -->
<script type="text/javascript">
	jQuery(document).ready(function() {
		pageSetUp();

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
		    	$("#smart-form-zone").attr("action", "<?= site_url("controlpanel/addons/index"); ?>/" + obj.data_mode + "/" + obj.zone_id);
		    	$('#zone_id').val(obj.data_listing_id);
		    	window.history.pushState("string", "Addons", "#addons/index/" + obj.data_mode + "/" + obj.zone_id);
		    } 
		};	

		jQuery("#jqgrid").bind("jqGridInlineSuccessSaveRow",     
		function (e, jqXHR, rowid, options) {         
			processJson(jqXHR.responseText);         
			return [true, jqXHR.responseText];     
		});

		jQuery("#jqgrid").jqGrid({
			/*data : jqgrid_data,*/
			url:'<?= site_url("controlpanel/addons/cdata"); ?>',  
			datatype : "json",
			mtype : "get", 
			height : 'auto',
 			loadComplete: function () {                                         
 			},
			colNames : ['ID', 'Add-on', 'Status'],
			colModel : [{
				name : 'id',
				index : 'id',
				sortable : true
			}, {
				name : 'addon',
				index : 'addon',
				sortable : true,
				editable : true
			}, {
				name : 'enabled',
				index : 'enabled',
				editable : true,
				formatter: 'select',
				edittype: 'select',
				editoptions: {
				    value: {
					'1': 'Enabled',
					'0': 'Disabled'
				    },
				    dataEvents: [
					    {
						type: 'change',
						fn: function (e) {
						    var row = $(e.target).closest('tr.jqgrow');
						    var rowId = row.attr('id');
						    jQuery("#jQGrid").saveRow(rowId, false, 'clientArray');
						}
					    }
					]
				}
			}],
			rowNum : 10,
			rowList : [10, 20, 30],
			pager : '#pjqgrid',
			sortname : 'id',
			toolbarfilter : true,
			viewrecords : true,
			sortorder : "asc",
			gridComplete : function() {

			},
			editurl : "<?= site_url('controlpanel/addons/index/edit'); ?>",
			caption : "Add-ons",
			multiselect : true,
			autowidth : true,
		});

		jQuery("#jqgrid").jqGrid('navGrid', "#pjqgrid", {
			edit : true,
			add : true,
			del : true
		});

		jQuery("#jqgrid").jqGrid('inlineNav', "#pjqgrid");

		/* Add tooltips */
		$('.navtable .ui-pg-button').tooltip({
			container : 'body'
		});

		jQuery("#m1").click(function() {
			var s;
			s = jQuery("#jqgrid").jqGrid('getGridParam', 'selarrrow');
			//alert(s);
		});

		jQuery("#m1s").click(function() {
			jQuery("#jqgrid").jqGrid('setSelection', "13");
		});

		// remove classes
		$(".ui-jqgrid").removeClass("ui-widget ui-widget-content");
		$(".ui-jqgrid-view").children().removeClass("ui-widget-header ui-state-default");
		$(".ui-jqgrid-labels, .ui-search-toolbar").children().removeClass("ui-state-default ui-th-column ui-th-ltr");
		$(".ui-jqgrid-pager").removeClass("ui-state-default");
		$(".ui-jqgrid").removeClass("ui-widget-content");

		// add classes
		$(".ui-jqgrid-htable").addClass("table table-bordered table-hover");
		$(".ui-jqgrid-btable").addClass("table table-bordered table-striped");

		$(".ui-pg-div").removeClass().addClass("btn btn-sm btn-primary");
		$(".ui-icon.ui-icon-plus").removeClass().addClass("fa fa-plus");
		$(".ui-icon.ui-icon-pencil").removeClass().addClass("fa fa-pencil");
		$(".ui-icon.ui-icon-trash").removeClass().addClass("fa fa-trash-o");
		$(".ui-icon.ui-icon-search").removeClass().addClass("fa fa-search");
		$(".ui-icon.ui-icon-refresh").removeClass().addClass("fa fa-refresh");
		$(".ui-icon.ui-icon-disk").removeClass().addClass("fa fa-save").parent(".btn-primary").removeClass("btn-primary").addClass("btn-success");
		$(".ui-icon.ui-icon-cancel").removeClass().addClass("fa fa-times").parent(".btn-primary").removeClass("btn-primary").addClass("btn-danger");

		$(".ui-icon.ui-icon-seek-prev").wrap("<div class='btn btn-sm btn-default'></div>");
		$(".ui-icon.ui-icon-seek-prev").removeClass().addClass("fa fa-backward");

		$(".ui-icon.ui-icon-seek-first").wrap("<div class='btn btn-sm btn-default'></div>");
		$(".ui-icon.ui-icon-seek-first").removeClass().addClass("fa fa-fast-backward");

		$(".ui-icon.ui-icon-seek-next").wrap("<div class='btn btn-sm btn-default'></div>");
		$(".ui-icon.ui-icon-seek-next").removeClass().addClass("fa fa-forward");

		$(".ui-icon.ui-icon-seek-end").wrap("<div class='btn btn-sm btn-default'></div>");
		$(".ui-icon.ui-icon-seek-end").removeClass().addClass("fa fa-fast-forward");

	});

	jQuery(window).on('resize.jqGrid', function() {
		jQuery("#jqgrid").jqGrid('setGridWidth', $("#content").width());
	});
</script>