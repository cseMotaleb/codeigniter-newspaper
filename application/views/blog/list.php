<?php
$news_rows_total_blog = (count($news_rows) - 1);
if(($news_rows_total_blog < 1) && isset($other_news_rows)) {
	$news_rows = $other_news_rows;
	$news_rows_total_blog = (count($news_rows) - 1);

	$other_news_rows = array();
}
if($news_rows_total_blog > 0) {
?>
<div class="category-area">
	<div class="cat-heading">
		<h3><?= $category_data['category']; ?> বিভাগ  </h3>
	</div>
	<?php
		$i = 0;
		$row_counter = 0;
		foreach ($news_rows as $key => $row) {
			$url = site_url("article/{$row['id']}");

			if($i == 0) {
	?>
	<div class="cat-topsection">
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-7 cmb-30">
				<a href="<?= $url; ?>">
					<?php if($row['type'] == "Video") echo '<div class="show_btn"></div>'; ?>
					<img class="img-responsive <?= $row['img_thumbnail']; ?>" alt="<?= $row['title']; ?>" src="<?= $row['default_image']; ?>" />
				</a>
			</div>
			<div class="col-xs-12 col-sm-12 col-md-5 cmb-30 custom-mr">
				<div class="cat-top-post">
					<?= $row['small_title']; ?>
					<div class="newstitle-category">
						<a href="<?= $url; ?>"><h2 class="news-title" ><?= word_limiter(strip_tags($row['title']), 8, '... '); ?> </h2> </a> 
					</div>
					<p class="text-left"><?= word_limiter(strip_tags($row['details']), 24); ?></p>
					<div class="rpost_readmore">
		                <a class="btn" href="<?= $url; ?>">বিস্তারিত</a>
		            </div>
				</div>
			</div>
		</div>
	</div>
	
	<div class="row">
	<?php }
		else {
			if($row_counter == 0) echo '<div class="ss">';
	?>
	<div class="col-xs-12 col-sm-6 col-md-4 custom-mr">
		<div class="relative-singlepost">
			<div class="rsinglepost-img">
				<?php if($row['type'] == "Video") echo '<div class="show_btn"></div>'; ?>
				<a href="<?= $url; ?>">
					<img  class="img-responsive <?= $row['img_thumbnail']; ?>" alt="<?= $row['title']; ?>" src="<?= $row['default_image']; ?>" />
				</a>
			</div>
			<div class="rs-post-content">
				<a href="<?= $url; ?>"><h4 class="news-title"><?= word_limiter(strip_tags($row['title']), 5); ?> </h4></a>
				<p class="text-justify"><?= word_limiter(strip_tags($row['details']), 12); ?></p>
		   		<div class="rpost_readmore">
	               <a class="btn" href="<?= $url; ?>">বিস্তারিত</a>
	        	</div>
			</div>
		</div>
	</div>
	<?php
		$row_counter++;
		if($row_counter == 3) { echo '</div>'; $row_counter = 0; }
			}
		$i++;
		}

		if($news_rows_total_blog % 3 != 0) echo '</div>';
	?>
</div>
</div>

<?php } else { ?>
<div class="alert alert-danger">
	কোন ডাটা পাওয়া যায় নাই ।
</div>
<?php } ?>

<br />
<?php
	$advertisement = cur_advertisement(array("position"=>"Details List 1", "enabled"=>1), array("table"=>"advertisement", "limit"=>1));
	if($advertisement) echo "{$advertisement}";
?>


<?php
if(isset($most_readed)) {
	$most_readed_total_blog = count($most_readed);
	if($most_readed_total_blog > 0) {
?>
<div id="same-category-most-readed">
	<div class="cat-heading">
		<h3><?= $category_data['category']; ?> বিভাগের সর্বাধিক পঠিত</h3>
	</div>
	<div class="row">
	<?php
		
		foreach ($most_readed as $key => $row) {
			$url = site_url("article/{$row['id']}");
	?>
	<div class="col-xs-12 col-sm-6 col-md-4 custom-mr">
		<div class="relative-singlepost rp-sp">
			<div class="rsinglepost-img">
				<a href="<?= $url; ?>">
					<?php if($row['type'] == "Video") echo '<div class="show_btn"></div>'; ?>
					<img class="img-responsive <?= $row['img_thumbnail']; ?>" alt="<?= $row['title']; ?>" src="<?= $row['default_image']; ?>" />
				</a>
				</div>
			<h4>
				<a href="<?= $url; ?>"><?= word_limiter(strip_tags($row['title']), 5); ?></a>
			</h4>
		</div>
	</div>
	<?php
		
		if($row_counter == 3) { echo '</div>'; $row_counter = 0; }
		}
		
		if($most_readed_total_blog % 3 != 0) echo '</div>';
	?>
</div>
</div>
<?php } 
} ?>