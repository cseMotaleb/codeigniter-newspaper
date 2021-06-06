<section id="widget-grid" class="">
	<div class="row">
		<article class="col-sm-12 col-md-12 col-lg-12">
			<div class="jarviswidget" <?php if(isset($_GET['search'])) echo ''; else echo 'data-widget-collapsed="true"'; ?> id="wid-id-0" data-widget-colorbutton="false" data-widget-editbutton="false" data-widget-fullscreenbutton="false">
				<header>
					<span class="widget-icon"> <i class="fa fa-eye"></i> </span>
					<h2>Find Testimonial</h2>
				</header>

				<div>
					<div class="jarviswidget-editbox"></div>
					<div class="widget-body">
						<form action="#testimonials/index/search/0/" method="get">
							<div class="row">
								<div class="col-md-3">
									<label>Name</label>
									<input type="text" class="form-control" name="name" id="name" placeholder="Enter name" value="<?php if(isset($name)) echo $name; ?>">
								</div>
			
								<div class="col-md-3">
									<label>Company Name</label>
									<input type="text" class="form-control" name="company_name" id="company_name" placeholder="Enter company name" value="<?php if(isset($company_name)) echo $company_name; ?>">
								</div>
			
								<div class="col-md-3">
									<label>Designation</label>
									<input type="text" class="form-control" name="designation" id="designation" placeholder="Enter designation" value="<?php if(isset($designation)) echo $designation; ?>">
								</div>
			
								<div class="col-md-3">
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
		