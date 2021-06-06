<div class="row">
    <div class="col-lg-6">
        <h1 class="page-title txt-color-blueDark">
            <i class="fa-fw fa fa-pencil-square-o"></i> Categories
        </h1>
    </div>
    <div class="col-lg-6">
        <div class="btn-group btn-sm pull-right">
            <button class="btn btn-success changeURL" data-url="#products"><i class="fa fa-navicon"></i> Product List</button>
            <button class="btn btn-danger changeURL" data-url="#products/categories/"><i class="fa fa-list-alt"></i> Add Category</button>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="panel panel-default">
            <div class="panel-heading">Categories</div>
            <?php $total_rows = count($rows); ?>
            <form id="BulkDeleteForm" method="post" action="<?= site_url("admin/products/categories/bulk_delete"); ?>">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>
                                <?php if($total_rows > 0) { ?>
                                <input name="all_bulk" id="all_bulk" value="" type="checkbox" />
                                <?php } ?>
                            </th>
                            <th><small>Category</small></th>
                            <th style="width: 65px;"><small>Action</small></th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    if($total_rows > 0) {
                        foreach ($rows as $row) {
                   	?>
                        <tr id="hiderow<?= $row['id']; ?>">
                            <td>
                                <input name="bulk_delete[]" class="bulk_checkbox" value="<?= $row['id']; ?>" type="checkbox" />
                            </td>
                            <td><?= $row['category']; ?></td>
                            <td>
                                <div class="btn-group">
                                    <a href="#products/categories/edit/<?= $row['id']; ?>" class="btn btn-default btn-xs" title="Edit"><i class="fa fa-pencil"></i></a>
                                    <a class="btn btn-default btnDel btn-xs" data-url="<?= site_url("admin/products/categories/delete/"); ?>" data-toggle="modal" data-target="#myModal" id="<?= $row['id'] ?>" title="Delete" ><i class="fa fa-trash-o"></i></a>                         
                                </div>
                            </td>
                        </tr>
                        <?php }
                        } else echo '<tr><td colspan="4">No Result Found</td></tr>'; ?>
                    </tbody>
                    <?php if($total_rows > 0) { ?>
                    <tfoot>
                        <tr>
                            <td colspan="4" class="text-right">
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
                    <?php }?>   
                </table>
            </form>
        </div>
    </div>


    <div class="col-md-6">
     	<form action="<?= site_url("admin/products/categories/{$mode}/{$current_id}"); ?>" method="post" id="validate-form">      
	        <div class="panel panel-default">
	            <div class="panel-heading">
	                <h3 class="panel-title">
	                    <span class="text-danger"><strong><?= ucfirst($mode); ?></strong></span> Category
	                </h3>
	            </div>
	
	            <div class="panel-body">
                    <div class="formSep">
                        <label class="req">Category</label>
                        <input class="form-control" type="text" name="category" id="category" placeholder="Enter category" value="<?php if(isset($row_data['category'])) echo $row_data['category']; ?>" />
                    </div>

                    <hr />

                    <div class="formSep">
                        <input type="hidden" name="id" value="<?php if(isset($current_id)) echo $current_id; ?>" />
                        <button type="submit" class="btn btn-primary"><?php if($mode == "edit") echo "Update"; else echo "Save"; ?> Category</button>
                    </div>
            	</div>
        	</div>
       	</form>
    </div>
</div>

<?php $this->load->view("admin/common-delete-modal"); ?>

<script src="<?= base_url(); ?>assets/admin/js/custom.js"></script>
<script type="text/javascript">
    pageSetUp();

    $(document).ready(function() {
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
            };
        };

        loadScript("<?= site_url('assets/admin/js/plugin/jquery-form/jquery-form.min.js'); ?>", pagefunction);
    });
</script>