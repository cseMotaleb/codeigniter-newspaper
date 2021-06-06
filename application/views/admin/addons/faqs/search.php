<section id="widget-grid" class="">
	<div class="row">
		<article class="col-sm-12 col-md-12 col-lg-12">
			<div class="jarviswidget" <?php if(isset($_GET['search'])) echo ''; else echo 'data-widget-collapsed="true"'; ?> id="wid-id-0" data-widget-colorbutton="false" data-widget-editbutton="false">
				<header>
					<span class="widget-icon"> <i class="fa fa-eye"></i> </span>
					<h2>Find Faq</h2>
				</header>

				<div>
					<div class="jarviswidget-editbox"></div>
					<div class="widget-body">
						<form action="#faqs/index/search/0/" method="get">
							<div class="row">
								<div class="col-md-4">
									<label>Question</label>
									<input type="text" class="form-control" name="question" id="question" placeholder="Enter country name" value="<?php if(isset($question)) echo $question; ?>">
								</div>

								<div class="col-md-4">
									<label>Group</label>
									<select name="group_id" id="group_id" class="select2">
										<option value="">--- SELECT ---</option>
						    			<?php $options = options(
						    									array(
						    										'table'=>'categories', 
						    										'limit'=>1000,
						    										'option_value'=>'id',
						    										'option'=>'category', 
						    										'order_by'=>'category', 
						    										'order_type'=>'asc', 
						    										'default'=>(isset($group_id)) ? $group_id : ""
																), 
																array("groups"=>"FAQ"));
																
												echo $options['option_list']; ?>
									</select>
								</div>

								<div class="col-md-4">
									<label>Status</label>
				      				<select name="enabled" id="enabled" class="select2" style="width:100%">
										<option value="">--- SELECT ---</option>
				      					<option value="1" <?php if(isset($enabled) && $enabled == '1') echo 'selected="selected"'; ?>>Enabled</option>
				      					<option value="0" <?php if(isset($enabled) && $enabled == '0') echo 'selected="selected"'; ?>>Disabled</option>
				      				</select>
								</div>
							</div>

							<hr />

				    		<div class="form-groups">
				      			<div class="center-block">
				        			<input class="btn btn-primary" name="search" type="submit" value="Search">
				      			</div>
				    		</div>
						</form>
					</div>
				</div>
			</div>
		</article>
	</div>
</section>