<div style="margin-top: 20px;" class="row">
	<div class="col-md-12">
		<?php
		$i = 0;
		foreach ($slider_news as $key => $row) {
			$url = site_url("article/{$row['id']}");
		?>
		
		<?php
		if($i == 0) {
			if(isset($row['videos'][0]['url'])) {
		?>
			<div class="row">
				<div class="col-md-12 col-xs-12">
					<h2 class="title-s"><a href="<?= $url; ?>"><?= $row['title']; ?></a></h2>
					<div class="embed-responsive embed-responsive-16by9">
					  	<iframe class="embed-responsive-item" src="https://www.youtube.com/embed/<?= $row['videos'][0]['url']; ?>"></iframe>
					</div>
				</div>
			</div>
			<hr />
			
		<?php }
		}
		else {
		if($i == 1) echo '<div style="padding-left: 10px; padding-right: 15px;"><div class="slider autoplay">';
		?>
		<div>
			<a href="<?= $url; ?>">
				<div class="show_btn"></div>
				<img style="height: 95px;" class="img-responsive" alt="<?= $row['title']; ?>" src="<?= $row['default_image']; ?>" />
			</a>
			<h6 style="font-size: 14px;">
				<a href="<?= $url; ?>">
					<?= $row['title']; ?>
				</a>
			</h6>
		</div>
		<?php } ?>
			
		<?php
		$i++;
		}

		if($i > 0) echo '</div></div>';
		?>
		
		
		<?php
		foreach ($category_rows as $key => $category) {
			$url = site_url("category/{$category['category_url']}") . "?type=video";
		?>
		<br />
		<div class="cat-heading">
			<h3><a href="<?= $url; ?>"><?= $category['category']; ?></a></h3>
		</div>
		<?php
		$total_blog_list = count($category['blogs']);
		$row_counter = 0;
		foreach ($category['blogs'] as $key => $row) {
			$url = site_url("article/{$row['id']}");
			if($row_counter == 0) echo '<div class="row">';
		?>
			<div class="col-md-3">
				<a href="<?= $url; ?>">
					<div class="show_btn"></div>
					<img style="height: 95px;" class="img-responsive" alt="<?= $row['title']; ?>" src="<?= $row['default_image']; ?>" />
				</a>
				<h6 style="font-size: 14px;">
					<a href="<?= $url; ?>">
						<?= $row['title']; ?>
					</a>
				</h6>
			</div>
		<?php
		$row_counter++;
		if($row_counter == 4) { echo '</div>'; $row_counter = 0; }
		}
		
		if($total_blog_list % 4 != 0) echo '</div>';
		?>
		<?php } ?>
	</div>
</div>





<link rel="stylesheet" href="<?= base_url(); ?>assets/PgwSlideshow/pgwslideshow.min.css" media="all">
<script type="text/javascript" src="<?= base_url(); ?>assets/PgwSlideshow/pgwslideshow.min.js"></script>
<style type="text/css">
.pgwSlideshow .ps-caption {
	font-size: 16px;
}
</style>
<script type="text/javascript">
	$(document).ready(function() {
		$('.pgwSlideshow').pgwSlideshow({
			displayList : false
		});


		$('.autoplay').slick({
			infinite: true,
		  	slidesToShow: 4,
		  	slidesToScroll: 1,
		  	autoplay: true,
		  	autoplaySpeed: 2000
		});
	});
</script>