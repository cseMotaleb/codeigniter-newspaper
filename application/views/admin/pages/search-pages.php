<section id="widget-grid" class="">
	<div class="row">
		<article class="col-sm-12 col-md-12 col-lg-12">
			<div class="jarviswidget" <?php if(isset($_GET['search'])) echo ''; else echo 'data-widget-collapsed="true"'; ?> id="wid-id-0" data-widget-colorbutton="false" data-widget-editbutton="false" data-widget-fullscreenbutton="false">
				<header>
					<span class="widget-icon"> <i class="fa fa-eye"></i> </span>
					<h2>Find Pages</h2>
				</header>
			
				<div>
					<div class="jarviswidget-editbox"></div>
					<div class="widget-body">
						<form action="#pages/index" method="get">
							<div class="row">
								<div class="col-md-4">
									<label>Page</label>
									<input type="text" class="form-control" name="page" id="page" placeholder="Enter page name" value="<?php if(isset($page)) echo $page; ?>">
								</div>
								<div class="col-md-4">
									<label>Title</label>
									<input type="text" class="form-control" name="meta_title" id="meta_title" placeholder="Enter page name" value="<?php if(isset($meta_title)) echo $meta_title; ?>">
								</div>
								<div class="col-md-4">
									<label>Status</label>
				      				<select name="status" id="status" class="select2" style="width:100%">
										<option value="">--- SELECT ---</option>
										<?php
											$status = (isset($status)) ? $status : '';
											echo enum_list('pages', 'status', $status);
										?>
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
