<div class="row">
    <div class="col-lg-6">
        <h1 class="page-title txt-color-blueDark">
            <i class="fa-fw fa fa-pencil-square-o"></i> Categories
        </h1>
    </div>
    <div class="col-lg-6">
        <div class="btn-group btn-sm pull-right">
            <button class="btn btn-danger changeURL" data-url="#categories/index/"><i class="fa fa-plus-circle"></i> Add Category</button>
            <button class="btn btn-success changeURL" data-url="#categories/index/"><i class="fa fa-list"></i> Category List</button>
        </div>
    </div>
</div>

<?php
    include 'search.php';
    $total_rows = count($rows);
?>

<div class="row">
	<div class="col-md-7">
		<div class="panel panel-primary">
		    <div class="panel-heading">
		       <h4>Categories</h4>
		    </div>
		
		    <table class="table table-bordered">
		        <thead>
		            <tr>
		                <th>Category</th>
		                <th>Group</th>
		                <th>Parent</th>
		                <th>Sub Parent</th>
		                <th>Status</th>
		                <th style="width: 85px;">Action</th>
		            </tr>
		        </thead>
		        <tbody>
		        <?php
		        $check_parent_category = array();
		        $check_sub_parent_category = array();
		        if($total_rows > 0) {
		            foreach ($rows as $row) {
		                $label = ($row['enabled'] == "1") ? 'label-success' : 'label-danger';
		                $status = ($row['enabled'] == "1") ? 'Enabled' : 'Disabled';
		
		        		$check_parent_category[$row['parent_id']] = get_rows(array("table"=>"categories", "limit"=>1), array("id"=>$row['parent_id']));
		        		$check_sub_parent_category[$row['parent_id']] = get_rows(array("table"=>"categories", "limit"=>1), array("id"=>$row['sub_parent_id']));
		        ?>
		            <tr id="hiderow<?= $row['id']; ?>">
		                <td><?= $row['category']; ?></td>
		                <td><?php if($row['groups'] == "FAQ") echo "FAQ's"; else echo $row['groups']; ?></td>
		                <td>
		                	<?php if(isset($check_parent_category[$row['parent_id']]['category'])) echo $check_parent_category[$row['parent_id']]['category']; else echo "N/A"; ?>
		                </td>
		                <td>
		                	<?php if(isset($check_sub_parent_category[$row['parent_id']]['category'])) echo $check_sub_parent_category[$row['parent_id']]['category']; else echo "N/A"; ?>
		                </td>
		                <td>
		                    <a data-original-title="Select Status" data-url="<?= site_url("admin/categories/ajax_status_update"); ?>" data-value="<?= $row['enabled']; ?>" data-pk="<?= $row['id'] ?>" data-type="select" data-name="enabled" name="enabled" class="rstatusopt" href="#">
		                        <span class="label <?= $label; ?>"><?= $status; ?></span>
		                    </a>
		                </td>
		                <td>
		                    <div class="btn-group">
		                        <a href="#categories/index/edit/<?= $row['id']; ?>" class="btn btn-default btn-xs" title="Edit"><i class="fa fa-pencil"></i></a>
		                        <a class="btn btn-default btnDel btn-xs" data-url="<?= site_url("admin/categories/index/delete/"); ?>" data-toggle="modal" data-target="#myModal" id="<?= $row['id'] ?>" title="Delete" ><i class="fa fa-trash-o"></i></a>                          
		                    </div>
		                </td>
		            </tr>
		            <?php }
		            } else echo '<tr><td colspan="6">No Result Found</td></tr>'; ?>
		        </tbody>
		    </table>
		    <?php if(!empty($pagination)) { ?>
		    <div class="panel-footer">
		    	<?= $pagination; ?>
		    </div>
		    <?php } ?>
		</div>
	</div>
	<div class="col-md-5">
		<?php include 'manage.php'; ?>
	</div>
</div>

<?php $this->load->view("admin/common-delete-modal"); ?>

<script src="<?= base_url(); ?>assets/js/holder.min.js"></script>
<script src="<?= base_url(); ?>assets/admin/js/custom.js"></script>

<script type="text/javascript">
    pageSetUp();

    $(document).ready(function() {
        check_select2();
        jQuery("#parent_id").change(function (event) {
            event.preventDefault();
            get_sub_parent_category($(this));
        });

		<?php if(isset($row_data['parent_id']) && $row_data['parent_id']) { ?>
			get_sub_parent_category($("#parent_id"));
		<?php } ?>
        function get_sub_parent_category ($this) {
            var parent_id = $this.val(),
                sub_parent_id = $("#sub_parent_id"),
                lang_id = $("#lang_id").val();

            check_select2();
            if(parent_id) {
                jQuery.ajax({
                    async: false,
                    type:'Get',
                    url: "<?= site_url("admin/ajax/product_parent_category"); ?>/?category_id="+parent_id+"&lang_id="+lang_id+"&selected=<?= (isset($row_data['sub_parent_id'])) ? $row_data['sub_parent_id'] : 0; ?>",
                    success: function(response) {
                        sub_parent_id.html(response.data);
                        setTimeout(function() {
                            select2_this(sub_parent_id);
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

        function check_select2() {
            var parent_id = $('#parent_id').val();
            if(parent_id) $('#sub_parent_id').select2("enable", true);
            else $('#sub_parent_id').select2("enable", false);
        };
    });

    var pagefunction = function() {
        var $checkoutForm = $('#validate-form').validate({
            rules : {
                category : {
                    required : true
                }
            },
            messages : {
                category : {
                    required : 'Please enter category'
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

    loadScript("<?= base_url(); ?>assets/admin/js/bootstrap-fileupload.js");
    loadScript("<?= site_url('assets/admin/js/plugin/jquery-form/jquery-form.min.js'); ?>", pagefunction);
</script>