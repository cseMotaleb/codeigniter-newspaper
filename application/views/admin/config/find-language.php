<section id="widget-grid" class="">
	<div class="row">
		<article class="col-sm-12 col-md-12 col-lg-12">
			<div class="jarviswidget" <?php if(isset($_GET['search'])) echo ''; else echo 'data-widget-collapsed="true"'; ?> id="wid-id-0" data-widget-colorbutton="false" data-widget-editbutton="false">
				<header>
					<span class="widget-icon"> <i class="fa fa-eye"></i> </span>
					<h2>Find Language</h2>
				</header>

				<div>
					<div class="jarviswidget-editbox"></div>
					<div class="widget-body">
						<form action="#config/languages" method="get">
							<div class="row">
								<div class="col-md-3">
									<label>Key</label>
									<input type="text" class="form-control" name="key" id="find_Key" placeholder="Enter Key" value="<?= $this->input->get("key"); ?>">
								</div>

								<div class="col-md-3">
									<label>Language</label>
									<select name="language" id="find_language" class="select2">
										<option value="">--Select--</option>
						    			<?php
						    			   $options = options(array('table'=>'language', 'limit'=>1000, 'option_value'=>'lang', 'option'=>'language', 'default'=>$this->input->get("language"), 'oder_by'=>'language', 'order_type'=>'asc'), array());
						    			   echo $options['option_list'];
						    			?>
									</select>
								</div>

			    				<div class="col-md-3">
					    			<label>Set</label>
			                		<input class="form-control" type="text" name="set" id="find_set" placeholder="Enter set" value="<?= $this->input->get("set"); ?>" />
			    				</div>

			    				<div class="col-md-3">
					    			<label>Text</label>
			                		<input class="form-control" type="text" name="text" id="find_text" placeholder="Enter text" value="<?= $this->input->get("text");; ?>" />
			    				</div>
							</div>

							<hr />

				    		<div class="form-groups">
				      			<div class="center-block">
				        			<input class="btn btn-primary" type="submit" value="Search">
				      			</div>
				    		</div>
						</form>
					</div>
				</div>
			</div>
		</article>
	</div>
</section>	