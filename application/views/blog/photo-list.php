<div style="margin-top: 20px;" class="row">
	<div class="col-md-12">
		<ul class="pgwSlideshow">
			<?php
			foreach ($slider_news as $key => $row) {
				$url = site_url("article/{$row['id']}");
			?>
			<li>
				<a href="<?= $url; ?>">
					<img class="img-responsive" alt="<?= $row['title']; ?>" src="<?= $row['default_image']; ?>" />
				</a>
			</li>
			<?php } ?>
		</ul>


		<?php
		foreach ($category_rows as $key => $category) {
			$url = site_url("category/{$category['category_url']}") . "?type=photo";
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
		$('.pgwSlideshow').pgwSlideshow();
	});
</script>