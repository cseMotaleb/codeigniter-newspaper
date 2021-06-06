<section id="widget-grid" class="">
	<div class="row">
		<article class="col-sm-12 col-md-12 col-lg-12">
			<div class="jarviswidget" <?php if(isset($_GET['search'])) echo ''; else echo 'data-widget-collapsed="true"'; ?> id="wid-id-0" data-widget-colorbutton="false" data-widget-editbutton="false">
				<header>
					<span class="widget-icon"> <i class="fa fa-eye"></i> </span>
					<h2>Find Widgets</h2>
				</header>

				<div>
					<div class="jarviswidget-editbox"></div>
					<div class="widget-body">
						<form action="#widgets/index/search/0/" method="get">
							<div class="row">
								<div class="col-md-4">
									<label>Widget</label>
									<input type="text" class="form-control" name="section_id" id="section_id" placeholder="Enter widgets name" value="<?php if(isset($section_id)) echo $section_id; ?>">
								</div>

								<div class="col-md-4">
									<label>Title</label>
									<input type="text" class="form-control" name="title" id="title" placeholder="Enter title" value="<?php if(isset($title)) echo $title; ?>">
								</div>

								<div class="col-md-4">
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