<?= '<div class="category-sidebar">'; ?>
<?php
if(isset($more_news)) {
$total_news = count($more_news);
if($total_news) {
?>
<div id="more-news">
	<div class="cat-heading">
		<h3>আরো <?php if(isset($segment) && $segment == "blog/video-list") echo "ভিডিও"; else echo "সংবাদ"; ?></h3>
	</div>
	
	<?php
	$i = 0;
	foreach ($more_news as $key => $row) {
		$url = site_url("article/{$row['id']}");
	?>
	
	<div class="single-catsidebar">
		<div class="catsidebar-img">
			<?php if($row['type'] == "Video") echo '<div class="show_btn"></div>'; ?>
			<a href="<?= $url; ?>"><img class="img-responsive <?= $row['img_thumbnail']; ?>" alt="<?= $row['title']; ?>" src="<?= $row['default_image']; ?>" />
				</a>
		</div>
		<div class="catsidebar-title">
			<h4 class="news-subtitle"><a href="<?= $url; ?>"> <?= word_limiter($row['title'], 5, " ..."); ?></a></h4>
			<span class="time-12">
				<?php
					$month = $this->bangla_week_day->get_monthname(date("F", $row['time']));
					echo $this->bangla_number->convert(date("d {$month}, Y H:i", $row['time']));
				?>
			</span>
		</div>
	</div>

	
	<?php
	$i++;
	if($i != $total_news) echo "<hr class=\"hr-5\" />";
	} ?>
	
	<?php if(isset($category_data['category_url'])) { ?>
	<div class="catesidebar-more">
		<a class="btn btn-text" href="<?= site_url("category/{$category_data['category_url']}") ?>"><?= $category_data['category']; ?>-এর আরো খবর</a>
	</div>
	<?php } ?>
</div>
<?php }
} ?>


<div class="catsidebar-add">
	<?php
		$advertisement = cur_advertisement(array("position"=>"Details Right 1", "enabled"=>1), array("table"=>"advertisement", "limit"=>1));
		if($advertisement) echo "{$advertisement}";
	?>
</div>

<div class="catsidebar-social">
	<div class="fb-page" data-href="<?= $company_config['facebook']; ?>" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><div class="fb-xfbml-parse-ignore"><blockquote cite="<?= $company_config['facebook']; ?>"><a href="<?= $company_config['facebook']; ?>"><?= $company_config['company_name']; ?></a></blockquote></div></div>
</div>


<div id="breaking-news">
	<div class="cat-heading">
		<h3>ব্রেকিং নিউজ</h3>
	</div>
	
	<?php
	$total_news = count($latest_news);
	$i = 0;
	foreach ($latest_news as $key => $row) {
		$url = site_url("article/{$row['id']}");
	?>

	<div class="single-catsidebar">
		<div class="catsidebar-img">
			<?php if($row['type'] == "Video") echo '<div class="show_btn"></div>'; ?>
				<a href="<?= $url; ?>"><img class="img-responsive <?= $row['img_thumbnail']; ?>" alt="<?= $row['title']; ?>" src="<?= $row['default_image']; ?>" />
				</a>
		</div>
		<div class="catsidebar-title">
			<h4 class="news-subtitle"><a href="<?= $url; ?>"> <?= word_limiter($row['title'], 5, " ..."); ?></a></h4>
			<span class="time-12">
				<?php
					$month = $this->bangla_week_day->get_monthname(date("F", $row['time']));
					echo $this->bangla_number->convert(date("d {$month}, Y H:i", $row['time']));
				?>
			</span>
		</div>
	</div>
	<?php
	$i++;
	if($i != $total_news) echo "<hr class=\"hr-5\" />";
	} ?>
</div>
<?= '</div>'; ?>