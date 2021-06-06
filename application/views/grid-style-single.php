


<div class="grid-single">
	<?php
	$row_counter = 0;
	foreach ($alldata as $key => $list_data) {
		$category_url = (isset($list_data['category_data']['category_url'])) ? site_url("category/বাংলাদেশ/{$list_data['category_data']['category_url']}") : "#";
	?>
	<div class="" style="<?php if($row_counter == 0) echo "padding-right: 5px"; if($row_counter == 2) ?>">
		<?php if(isset($list_data['category_data']['category'])) { ?>
		<div style="margin-bottom: 0;" class="new-title-renew title-done">
			<div class="title-left-renew">
				<h4 class="catTitle padding-left ml-head">
					<a href="<?= $category_url; ?>">
						<?= $list_data['category_data']['category']; ?>
					</a>
				</h4>
			</div>
			<!-- <div class="title-border"></div> -->
		</div>
		<?php } ?>
		<div class="internation">
			<?php
				$i = 0;
				foreach ($list_data['entertainment_list'] as $key => $row) {
					if(isset($row['id'])) {
					$url = site_url("article/{$row['id']}");
			?>
				<?php
                    if($i == 0) {
                        $default_image = newsDefaultImage($row, array('imgwidth'=>273, 'imgheight'=>151));
                    ?>
				<div class="thumbnail-list">
					<?php if($row['small_title']) { ?>
						<small><a href="<?= $url; ?>"><?= $row['small_title']; ?></a></small>
					<?php } ?>
					<div class="c-image thum-big">
						<a href="<?= $url; ?>">
							<img class="img img-responsive center lazyload" alt="<?= $row['title']; ?>" data-src="<?= $default_image; ?>" />
						</a>
					</div>
					<div class="caption selected-cap">
						<h4 class="news-title"><a href="<?= $url; ?>"><?= word_limiter($row['title'], 8, " ..."); ?></a></h4>
						<ul class="country-newslist">
							<?php } else {
		                    	$default_image = newsDefaultImage($row, array('imgwidth'=>60, 'imgheight'=>40));
			                ?>
								<li>
									<!-- <h4><i class="fa fa-arrow-right"></i> <a href="<?= $url; ?>"><?= $row['title']; ?></a></h4> -->
									<div class="country-listnews">
										<?php if($image_show == 1) :?>
											<div class="country-thum">
												<a href="<?= $url; ?>"> <img class="img-responsive lazyload" data-src="<?= $default_image; ?>" /></a>
											</div>
											<div class="internation-title">
												<h5 class="news-subtitle"><a href="<?= $url; ?>"><?= word_limiter($row['title'], 4, " ..."); ?></a></h5>
											</div>
											<?php else :?>
											<div class="internation-subtitle">
												<h5 class="news-title"><a href="<?= $url; ?>"><?= word_limiter($row['title'], 4, " ..."); ?></a></h5>
											</div>
										<?php endif;?>
									</div>
									<!-- <div class="row">
										<?php if($image_show == 1) :?>
										<div class="col-md-4 col-xs-4">
											<img class="img-responsive lazyload" data-src="<?= $default_image; ?>" />
										</div>
										<div  class="col-md-8 col-xs-8">
											<h5><a href="<?= $url; ?>"><?= word_limiter($row['title'], 4, " ..."); ?></a></h5>
										</div>
										<?php else :?>
										<div class="col-md-12 col-xs-12">
											<h4><a href="<?= $url; ?>"><?= word_limiter($row['title'], 4, " ..."); ?></a></h4>
										</div>
										<?php endif;?>
									</div> -->
								</li>
							<?php } ?>
							<?php
								}
							$i++; 
							}?>
						</ul>
				    </div>
				</div>
				<!-- <div class="text-center">
					<div>
						<?php if(isset($list_data['category_data']['category'])) { ?>
						<a class="text-primary" href="<?= $category_url; ?>">
							<?= $list_data['category_data']['category']; ?> আরও খবর
						</a>
						<?php } ?>
					</div>
				</div> -->
		</div>
	</div>
	<?php
	$row_counter++;
	} ?>
</div>