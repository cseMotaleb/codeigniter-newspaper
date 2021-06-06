<div style="margin-top: -25px;">
	<div class="row">
		<div class="col-md-8">
			<br />
			<div style="margin-top: 8px;">
				<?php include 'new-slider.php'; ?>
			</div>
		</div>
		<div class="col-md-4">
			<div style="border-bottom: 1px solid #e31723;">
				<h3 style="color: #e31723; margin-bottom: 5px;">এক নজরে শীর্ষ খবর</h3>
			</div>
			<?php
			$total_homepage_news = count($homepage_news);
			$i = 0;
			foreach ($homepage_news as $key => $row) {
				$i++;
				$url = site_url("article/{$row['id']}");
			?>
			<div <?php if($total_homepage_news != $i) echo 'style="border-bottom: 1px dotted #ddd;"'; ?>>
				<small style="color: #df384c;"><?= $row['small_title']; ?></small>
				<h2 style="font-size: 16px; margin-top: 8px; margin-bottom: 8px;">
					<a href="<?= $url; ?>"><?= $row['title']; ?></a>
				</h2>
			</div>
			<?php } ?>
		</div>
	</div>
</div>


<?php /*
<div style="border-bottom: 0.5px solid #DDDDDD; padding-bottom: 5px;">
<?php
$total_homepage_news = count($homepage_news);
$row_counter = 0;
$i = 0;
foreach ($homepage_news as $key => $row) {
	if($row_counter == 0) echo '<div class="row">';
	$url = site_url("article/{$row['id']}");
?>
	<div class="col-md-4">
		<div class="top9-box">
			<small style="color: #df384c;"><?= $row['small_title']; ?></small>
			<h2 style="font-size: 16px; font-weight: bold; margin-top: 5px;"><a style="color: #336699;" href="<?= $url; ?>"><?= $row['title']; ?></a></h2>
			
			<div class="">
				<a href="<?= $url; ?>">
					<img style="height: 85px; width: 125px; float: left; margin-right: 5px;" class="<?= $row['img_thumbnail']; ?>" alt="<?= $row['title']; ?>" src="<?= $row['default_image']; ?>" />
				</a>
				<p><?= word_limiter(strip_tags($row['details']), 15, ' '); ?></p>
			</div>
		</div>

		<div class="text-right"><a class="btn btn-xs btn-default top9-btn" href="<?= $url; ?>">বিস্তারিত</a></div>
	</div>
<?php
$row_counter++;
$i++;
if($row_counter == 3) { echo "</div>"; $row_counter = 0; if($i != $total_homepage_news) echo "<hr class=\"hr-5\" />"; }
	}

if($total_homepage_news % 3 != 0) echo '</div>';
?>
</div>
*/ ?>

<div style="margin-top: 15px;">
	<?php
		$advertisement = cur_advertisement(array("position"=>"Home List 2", "enabled"=>1), array("table"=>"advertisement", "limit"=>1));
		if($advertisement) echo "<br />{$advertisement}";
	?>
</div>

<div class="row hidden-xs">
	<div class="col-md-6">
		<?php
			$advertisement = cur_advertisement(array("position"=>"Home List Small 3", "enabled"=>1), array("table"=>"advertisement", "limit"=>1));
			if($advertisement) echo "<br />{$advertisement}<br />";
		?>
	</div>
	<div class="col-md-6">
		<?php
			$advertisement = cur_advertisement(array("position"=>"Home List Small 4", "enabled"=>1), array("table"=>"advertisement", "limit"=>1));
			if($advertisement) echo "<br />{$advertisement}<br />";
		?>
	</div>
</div>

<br />

<?php // echo list_style(array("blog.enabled"=>1, "blog.type"=>"List", "blog_groups.category"=>"বিনোদন"), array("limit"=>7, "headerimg"=>"heading7.jpg")); ?>

<?= grid_style(array("রংপুর বিভাগ", "রাজশাহী বিভাগ", "সারা দেশ"), array("limit"=>4)); ?>

<br />

<?php
	$advertisement = cur_advertisement(array("position"=>"Home List 3", "enabled"=>1), array("table"=>"advertisement", "limit"=>1));
	if($advertisement) echo "{$advertisement}";
?>

<div class="row hidden-xs">
	<div class="col-md-6">
		<?php
			$advertisement = cur_advertisement(array("position"=>"Home List Small 5", "enabled"=>1), array("table"=>"advertisement", "limit"=>1));
			if($advertisement) echo "<br />{$advertisement}<br />";
		?>
	</div>
	<div class="col-md-6">
		<?php
			$advertisement = cur_advertisement(array("position"=>"Home List Small 6", "enabled"=>1), array("table"=>"advertisement", "limit"=>1));
			if($advertisement) echo "<br />{$advertisement}<br />";
		?>
	</div>
</div>

<br />

<?= double_list_style(array("category"=>"খেলা", "limit"=>4, "category1"=>"রাজনীতি", "limit1"=>4)); ?>
<?php // echo list_style(array("blog.enabled"=>1, "blog.type"=>"List", "blog_groups.category"=>"খেলা"), array("limit"=>9, "category_title"=>"খেলার", "category"=>"খেলা", "list"=>2, "category_name"=>"খেলা", "headerimg"=>"heading8.jpg")); ?>

<br />

<div style="border: 1px solid #ddd; margin-top: 15px; margin-bottom: 15px;">
	<div style="padding-bottom: 15px;padding-left: 5px;padding-right: 5px;">
		<div style="background-color: #ddd;">
			<h4 style="padding-bottom: 5px; padding-top: 5px; padding-left: 10px; font-size: 24px;">রংপুর স্পেশাল</h4>
		</div>
		
		<?php
		$category_data = get_rows(array('table'=>"blog_groups", "limit"=>1), array("category"=>"রংপুর স্পেশাল"));
		$filters = array("blog.enabled"=>1, "blog.type"=>"List");
		if(isset($category_data['id'])) $filters['blog_categories.category_id'] = $category_data['id'];
		echo small_content_slider($filters, 15, "slide-1");
		?>
	</div>
</div>

<br />

<?= double_list_style(array("category"=>"ছবি গ্যালারি", "limit"=>4, "category1"=>"অপরাধ", "limit1"=>4)); ?>

<br />

<?= double_list_style(array("category"=>"শিক্ষাঙ্গন", "limit"=>4, "category1"=>"আন্তর্জাতিক", "limit1"=>4)); ?>

<br />

<?php
$invisible = $this->config->item("invisible_1");
if($invisible) echo list_style(array("blog.enabled"=>1, "blog.type"=>"List", "blog_groups.category"=>$invisible), array("limit"=>9, "category"=>$invisible, "list"=>2, "category_title"=>$invisible, "category_name"=>$invisible))."<hr />";
?>

<?= grid_style(array("বিশেষ সংবাদ", "অর্থনীতি", "বিজ্ঞান ও প্রযুক্তি"), array("limit"=>4)); ?>

<br />

<?= grid_style(array("ইতিহাস ঐতিহ্য", "চাকুরী চাই", "ফিচার"), array("limit"=>4)); ?>

<br />

<?= list_style(array("blog.enabled"=>1, "blog.type"=>"Video", "blog.homepage"=>1), array("limit"=>4, "list"=>3)); ?>

<?php
$invisible = $this->config->item("invisible_2");
if($invisible) echo list_style(array("blog.enabled"=>1, "blog.type"=>"List", "blog_groups.category"=>$invisible), array("limit"=>9, "category"=>$invisible, "list"=>2, "category_title"=>$invisible, "category_name"=>$invisible))."<hr />";
?>