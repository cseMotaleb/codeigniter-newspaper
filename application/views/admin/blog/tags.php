<div class="row">
    <div class="col-lg-6">
        <h1 class="page-title txt-color-blueDark">
            <i class="fa-fw fa fa-pencil-square-o"></i> Blog Tags
        </h1>
    </div>
    <div class="col-lg-6">
        <div class="btn-group btn-sm pull-right">
            <a href="#blog/tags" class="btn btn-success"><i class="fa fa-navicon"></i> Tag List</a>
            <a href="#blog" class="btn btn-success"><i class="fa fa-navicon"></i> Blog List</a>
            <a href="#blog/manage" class="btn btn-danger"><i class="fa fa-list-alt"></i> Add Blog</a>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="panel panel-default">
            <div class="panel-heading">
                Blog Tags
            </div>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th><small>Tag</small></th>
                        <th style="width: 110px;"><small>Action</small></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($rows as $key => $row) { ?>
                    <tr id="hiderow<?= $row['id']; ?>">
                        <td><?= $row['tag']; ?></td>
                        <td>
                            <div class="btn-group">
                            	<a href="#blog/tags/edit/<?= $row['id']; ?>" class="btn btn-default btn-xs" title="Edit"><i class="fa fa-pencil"></i></a>
                                <a class="btn btn-default btnDel btn-xs" data-url="<?= site_url("controlpanel/blog/tags/delete/"); ?>" data-toggle="modal" data-target="#myModal" id="<?= $row['id'] ?>" title="Delete" ><i class="fa fa-trash-o"></i></a>                          
                            </div>
                        </td>
                    </tr>
                    <?php } ?>
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
                <form action="<?= site_url("controlpanel/blog/tags/{$mode}/{$current_id}"); ?>" method="post" id="validate-form">
                    <div class="formSep">
                        <label class="req">Tag</label>
                        <input name="tag" id="tag" value="<?php if(isset($row_data['tag'])) echo $row_data['tag']; ?>" class="form-control" placeholder="Enter tag" type="text" />
                    </div>
                    
                    <hr />

                    <div class="formSep">
                        <div class="row">
                            <div class="col-md-4">
                                <label>Popularity</label>
                                <input name="popularity" id="popularity" value="<?php if(isset($row_data['popularity'])) echo $row_data['popularity']; ?>" class="form-control" placeholder="Enter popularity" type="text" />
                            </div>
                        </div>
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

            /*if(obj.mcode == 200) {
                $("#validate-form").attr("action", "<?= site_url("controlpanel/blog/manage"); ?>/" + obj.data_mode + "/" + obj.return_id);
            }*/
        };
    };

    loadScript("<?=  base_url(); ?>assets/controlpanel/js/plugin/jquery-form/jquery-form.min.js", pagefunction);
</script>