<div class="row">
    <div class="col-lg-6">
        <h1 class="page-title txt-color-blueDark">
            <i class="fa-fw fa fa-pencil-square-o"></i> Blog Options
        </h1>
    </div>
    <div class="col-lg-6">
        <div class="btn-group btn-sm pull-right">
            <a href="#blog" class="btn btn-success pull-right"><i class="fa fa-navicon"></i> Blog List</a>
            <a href="#blog/manage" class="btn btn-danger pull-right"><i class="fa fa-list-alt"></i> Add Blog</a>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="panel panel-default">
            <div class="panel-heading">
               <div>Blog Options</div>
            </div>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th><small>Image</small></th>
                        <th><small>Type</small></th>
                        <th><small>Blog</small></th>
                        <th style="width: 110px;"><small>Action</small></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($rows as $key => $row) {
                        $image = (!empty($row['image'])) ? base_url().'uploads/blog/'.$row['image'] : "holder.js/80x80";
                    ?>
                    <tr id="hiderow<?= $row['id']; ?>">
                        <td>
                            <img style="height: 60px; width: 60px;" class="img-thumbnail" alt="<?= $row['title']; ?>" title="<?= $row['title']; ?>" src="<?= $image; ?>" />
                        </td>
                        <td><?= $row['type']; ?></td>
                        <td><?= $row['title']; ?></td>
                        <td>
                            <div class="btn-group">
                                <a class="btn btn-default btnDel btn-xs" data-url="<?= site_url("controlpanel/blog/options/delete/"); ?>" data-toggle="modal" data-target="#myModal" id="<?= $row['id'] ?>" title="Delete" ><i class="fa fa-trash-o"></i></a>                          
                            </div>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
                <?php if(!empty($pagination)) { ?>
                <tfoot>
                    <tr>
                        <td colspan="4">
                            <div class="text-right">
                                <?= $pagination; ?>
                            </div>
                        </td>
                    </tr>
                </tfoot>
                <?php } ?>
            </table>
        </div>
    </div>

    <div class="col-md-6">
        <div class="panel panel-default">
            <div class="panel-heading">
               <div class="pull-left">
               		<h4>Blog Option</h4>
               	</div>
				<div class="pull-right">
				    <select style="color: #000;" name="website_id" id="website_id">
				        <?php
				            $selected_website_id = (isset($page['website_id']) && $page['website_id']) ? $page['website_id'] : 0;
				            $options = options(array('table'=>'site_websites', 'limit'=>1000, 'option_value'=>'id', 'option'=>'website', 'default'=>$selected_website_id, 'oder_by'=>'type', 'order_type'=>'asc'), array()); 
				            echo $options['option_list'];
				        ?>
				    </select>
				</div>
				<div class="clearfix"></div>
            </div>
        
            <div class="panel-body">
                <form action="<?= site_url("controlpanel/blog/options/{$mode}/{$current_id}"); ?>" method="post" id="validate-form">
                    <div class="formSep">
                        <label class="req">Blog Title</label>
                        <select name="blog_id" id="blog_id" class="select2">
                            <?php $selected_blog_id = (isset($row_data['blog_id']) && $row_data['blog_id']) ? $row_data['blog_id'] : 0; ?>
                            <?php $options = options(
                                                    array(
                                                        'table'=>'blog', 
                                                        'limit'=>1000,
                                                        'option_value'=>'id',
                                                        'option'=>'title', 
                                                        'default'=>$selected_blog_id, 
                                                        'oder_by'=>'id', 
                                                        'order_type'=>'desc'
                                                    ), 
                                                    array());

                                                echo $options['option_list'];
                            ?>
                        </select>
                    </div>
                    
                    <hr />

                    <div class="formSep">
                        <label class="req">Type</label>
                        <select name="type" id="type" class="select2">
                            <option value="Slider">Slider</option>
                            <option value="Feature">Feature</option>
                            <option value="Highlight">Highlight</option>
                        </select>
                    </div>
                    
                    <hr />

                    <div class="formSep">
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php $this->load->view("controlpanel/common-delete-modal"); ?>
<script src="<?= base_url(); ?>assets/js/holder.min.js"></script>
<script src="<?= base_url(); ?>assets/controlpanel/js/custom.js"></script>
<script type="text/javascript">
    pageSetUp();

    var pagefunction = function() {
        var $checkoutForm = $('#validate-form').validate({
            rules : {
                type : {
                    required : true
                }
            },
            messages : {
                type : {
                    required : 'Please select type'
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
                $("#validate-form").attr("action", "<?= site_url("controlpanel/blog/manage"); ?>/" + obj.data_mode + "/" + obj.return_id);
            }
        };
    };

    loadScript("<?=  base_url(); ?>assets/controlpanel/js/plugin/jquery-form/jquery-form.min.js", pagefunction);
</script>