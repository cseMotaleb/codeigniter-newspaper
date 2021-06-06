<div class="sider-wrap">
	<div class="single-sidebar">
		<div class="new-title-renew">
			<div class="title-left-renew">
				<h4 class="catTitle padding-right">
					<a href="#">
						<?php if(isset($category_data['category'])) echo $category_data['category']; ?>
					</a>
					
				</h4>
			</div>
		</div>

		<?php
		if(isset($last_projonmos['id'])) {
			$url = site_url("article/{$last_projonmos['id']}");

            $default_image = newsDefaultImage($last_projonmos, array('imgwidth'=>360, 'imgheight'=>200));
		?>
		<h2 class="news-title"><a href="<?= $url; ?>"><?= $last_projonmos['title']; ?></a></h2>
		<a href="<?= $url; ?>">
			<img class="img-responsive <?= $last_projonmos['img_thumbnail']; ?> lazyload" alt="<?= $last_projonmos['title']; ?>" data-src="<?= $default_image; ?>" />
		</a>
		<p><?= word_limiter(strip_tags($last_projonmos['details']), 25); ?></p>
		<?php }
		else {
			$i = 0;
			foreach ($last_projonmos as $key => $row) {
				if(isset($row['id'])) {
				$url = site_url("article/{$row['id']}");

                                $default_image = newsDefaultImage($row, array('imgwidth'=>360, 'imgheight'=>200));
			?>

			<?php if($i == 0 && ($top == 0)) { ?>
				<h2 class="news-title"><a href="<?= $url; ?>"><?= $row['title']; ?></a></h2>
				<a href="<?= $url; ?>">
					<img class="img-responsive bottom-img <?= $row['img_thumbnail']; ?> lazyload" alt="<?= $row['title']; ?>" data-src="<?= $default_image; ?>" />
				</a>
				<p><?= word_limiter(strip_tags($row['details']), 25); ?></p>
			<?php } else { ?>
				<div class="sidebar-news d-flex">
					<div class="snews-thum-left">
					<a href="<?= $url; ?>">
						<img class="bottom-img <?= $row['img_thumbnail']; ?> lazyload" alt="<?= $row['title']; ?>" data-src="<?= $default_image; ?>" />
					</a>
					</div>
				<div class="tab-text news-title-right">
					<h2 class="news-title"><a href="<?= $url; ?>"><?= word_limiter(strip_tags($row['title']), 5);?></a></h2>
					<p>
						<?php
							$month = $this->bangla_week_day->get_monthname(date("F", $row['time']));
							echo $this->bangla_number->convert(date("d {$month}, Y H:i", $row['time']));
						?>
					</p>
				</div>
				</div>
			<?php } ?>

			<?php
			}
			$i++;
				}
		}
		?>
	</div>
</div>