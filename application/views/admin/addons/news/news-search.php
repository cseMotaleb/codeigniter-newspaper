<section id="widget-grid" class="">
	<div class="jarviswidget" <?php if(isset($_GET['search'])) echo ''; else echo 'data-widget-collapsed="true"'; ?> id="wid-id-0" data-widget-colorbutton="false" data-widget-editbutton="false" data-widget-fullscreenbutton="false">
		<header>
			<span class="widget-icon"> <i class="fa fa-eye"></i> </span>
			<h2>Find News</h2>
		</header>

		<div>
			<div class="jarviswidget-editbox"></div>
			<div class="widget-body">
				<form action="#news/index/" method="get">
					<div class="row">
						<div class="col-md-4">
							<label>News Title</label>
							<input type="text" class="form-control" name="title" id="title" placeholder="Enter title" value="<?php if(isset($title)) echo $title; ?>">
						</div>

						<div class="col-md-4">
							<label>Date</label>
							<input type="text" class="form-control edatepicker" name="publish_date" id="publish_date" placeholder="Publish date" value="<?php if(isset($publish_date)) echo $publish_date; ?>">
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
</section>