<section id="widget-grid" class="">
	<div class="row">
		<article class="col-sm-12 col-md-12 col-lg-12">
			<div class="jarviswidget" <?php if(isset($_GET['search'])) echo ''; else echo 'data-widget-collapsed="true"'; ?> id="wid-id-0" data-widget-colorbutton="false" data-widget-editbutton="false">
				<header>
					<span class="widget-icon"> <i class="fa fa-eye"></i> </span>
					<h2>Find Feedback</h2>
				</header>

				<div>
					<div class="jarviswidget-editbox"></div>
					<div class="widget-body">
						<form action="#feedback/index/search/0/" method="get">
							<div class="row">
								<div class="col-md-4">
									<label>Name</label>
									<input type="text" class="form-control" name="name" id="name" placeholder="Enter name" value="<?php if(isset($name)) echo $name; ?>">
								</div>
								<div class="col-md-4">
									<label>Email</label>
									<input type="text" class="form-control" name="email" id="email" placeholder="Enter email" value="<?php if(isset($email)) echo $email; ?>">
								</div>
								<div class="col-md-4">
									<label>Date</label>
									<input type="text" class="form-control edatepicker" name="date_timestamp" id="date_timestamp" placeholder="Enter date" value="<?php if(isset($date_timestamp)) echo $date_timestamp; ?>">
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