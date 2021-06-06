<section id="widget-grid" class="">
	<div class="row">
		<article class="col-sm-12 col-md-12 col-lg-12">
			<div class="jarviswidget" <?php if(isset($_GET['search'])) echo ''; else echo 'data-widget-collapsed="true"'; ?> id="wid-id-0" data-widget-colorbutton="false" data-widget-editbutton="false" data-widget-fullscreenbutton="false">
				<header>
					<span class="widget-icon"> <i class="fa fa-eye"></i> </span>
					<h2>Find Category</h2>
				</header>
			
				<div>
					<div class="jarviswidget-editbox"></div>
					<div class="widget-body">
						<form action="#categories/index/search/0/" method="get">
							<div class="row">
								<div class="col-md-6">
									<label>Category Name</label>
									<input type="text" class="form-control" name="category_name" id="category_name" placeholder="Enter category name" value="<?php if(isset($category_name)) echo $category_name; ?>">
								</div>

								<div class="col-md-6">
									<label>Status</label>
				      				<select name="enabled" id="enabled" class="select2" style="width:100%">
										<option value="">--- SELECT ---</option>
				      					<option value="1" <?php if(isset($enabled) && $enabled === 1) echo 'selected="selected"'; ?>>Enabled</option>
				      					<option value="0" <?php if(isset($enabled) && $enabled === 0) echo 'selected="selected"'; ?>>Disabled</option>
				      				</select>
								</div>
							</div>

							<hr />

				    		<div class="form-groups">
				    			<button class="btn btn-primary" name="search" value="search" type="submit">
				    				<i class="fa fa-search"></i> Search
				    			</button>
				    		</div>
						</form>
					</div>
				</div>
			</div>
		</article>
	</div>
</section>