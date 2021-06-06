<div class="history-news">
		<?php
		$row_counter = 0;
		foreach ($alldata as $key => $list_data) {
			$category_url = (isset($list_data['category_data']['category_url'])) ? site_url("category/{$list_data['category_data']['category_url']}") : "#";
		?>
		<div class="col-xs-12 col-sm-6 col-md-6 ">
			<?php if(isset($list_data['category_data']['category'])) { ?>
			<div class="new-title-renew">
				<div class="title-left-renew">
					<h4 class="catTitle">
						<a href="<?= $category_url; ?>">
							<?= $list_data['category_data']['category']; ?>
						</a>
					</h4>
				</div>
				<!-- <div class="title-border"></div> -->
			</div>
			<?php } ?>

			<div class="thumbnail-list">
				<div class="adalod single-history">
					<?php 
						$i = 0;
						foreach ($list_data['entertainment_list'] as $key => $row) {
						if(isset($row['id'])) {
						$url = site_url("article/{$row['id']}");
					?>
					<?php if($i == 0) {
                        $default_image = newsDefaultImage($row, array('imgwidth'=>360, 'imgheight'=>170));
                        if(empty($default_image)){
                            $default_image = $row['default_image'];
                        }
                    ?>
						<?php if($row['small_title']) { ?>
						<small><a href="<?= $url; ?>"><?= $row['small_title']; ?></a></small>
						<?php } ?>
						<div class="c-image history-thum">
							<a href="<?= $url; ?>">
								<img  class="img img-responsive center lazyload" alt="<?= $row['title']; ?>" data-src="<?= $default_image; ?>" />
							</a>
						</div>
						<div class="history-content">
							<div class="caption">
								<h4 class="news-title">
									<a href="<?= $url; ?>">
										<?= word_limiter(strip_tags($row['title']), 4, "");; ?>
									</a>
								</h4>
				
								<ul class="history-list">
									<?php } else { ?>
									<li>
										<h4 class="news-subtitle"> <a href="<?= $url; ?>"><?= word_limiter($row['title'], 4, " ..."); ?></a></h4>	
									</li>
									<?php } ?>
									
									<?php
										}
									$i++; 
										}
									?>
								</ul>
							</div>
							<!-- <div class="text-left">
								<div class="read-more">
									<?php if(isset($list_data['category_data']['category'])) { ?>
									<a class="text-primary" href="<?= $category_url; ?>">
										<?= $list_data['category_data']['category']; ?> আরও খবর
									</a>
									<?php } ?>
								</div>
							</div> -->
						</div>
				</div>
				
			</div>
		</div>
		<?php
		$row_counter++;
		} ?>
</div>