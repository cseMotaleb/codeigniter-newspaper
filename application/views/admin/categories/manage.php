<form enctype="multipart/form-data" action="<?= site_url("admin/categories/index/{$mode}/{$current_id}"); ?>" method="post" id="validate-form">
	<div class="panel panel-primary">
	    <div class="panel-heading">
	    	<div class="pull-left">
	        	<h4><span class="text-danger"><strong><?= ucfirst($mode); ?></strong></span> Category</h4>
	    	</div>
	    	<div class="pull-right">
                <select style="color: #000;" name="groups" id="groups">
                    <option value="Page" <?php if(isset($row_data['groups']) && $row_data['groups'] == 'Page') echo 'selected'; ?>>Page</option>
                    <option value="FAQ" <?php if(isset($row_data['groups']) && $row_data['groups'] == 'FAQ') echo 'selected'; ?>>FAQ's</option>
                </select>
                <select style="color: #000;" name="enabled" id="enabled">
                    <option value="1" <?php if(isset($row_data['enabled']) && $row_data['enabled'] == '1') echo 'selected'; ?>>Enabled</option>
                    <option value="0" <?php if(isset($row_data['enabled']) && $row_data['enabled'] == '0') echo 'selected'; ?>>Disabled</option>
                </select>
	    	</div>
	    	<div class="clearfix"></div>
	    </div>
	
	    <div class="panel-body">
        	<div class="formSep">
                <label class="req">Category</label>
                <input class="form-control" type="text" name="category" id="category" placeholder="Enter category" value="<?php if(isset($row_data['category'])) echo $row_data['category']; ?>" />
            </div>
            
            <hr />
            
        	<div class="formSep">
                <label>Parent Category</label>
                <select name="parent_id" id="parent_id" class="select2">
                    <option value="">--- SELECT ---</option>
                    <?php $selected_option = (isset($row_data['parent_id'])) ? $row_data['parent_id'] : 0; ?>
                    <?php $options = options(
                                            array(
                                                'table'=>'categories', 
                                                'limit'=>1000,
                                                'option_value'=>'id',
                                                'option'=>'category', 
                                                'order_by'=>'category', 
                                                'order_type'=>'asc', 
                                                'default'=>$selected_option, 
                                                'oder_by'=>'category', 
                                                'order_type'=>'asc'
                                            ), 
                                            array('parent_id'=>0)); 
                                            
                                        echo $options['option_list'];
                    ?>
                </select>
          	</div>
            
            <hr />

        	<div class="formSep">
                <label>Sub Parent Category</label>
                <select name="sub_parent_id" id="sub_parent_id" class="select2">
                    <option value="">--- SELECT ---</option>
                </select>
            </div>
	    </div>
	    
	    <div class="panel-footer">
	    	<input type="hidden" name="id" value="<?php if(isset($current_id)) echo $current_id; ?>" />
	    	<button type="submit" class="btn btn-lg btn-primary"><i class="fa fa-floppy-o"></i> <?php if($mode == "edit") echo "Update"; else echo "Save"; ?> Category</button>
	    </div>
	</div>
</form>