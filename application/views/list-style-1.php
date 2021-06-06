<?php
$category_url = (isset($category_data['category_url'])) ? site_url("category/{$category_data['category_url']}") : "#";
$cur_category = (isset($category_data['category'])) ? $category_data['category'] : "বিনোদন";
$total_entertainment = count($entertainment_list);
?>

<?php /* if(isset($headerimg) && !empty($headerimg)) { ?>
<div style="cursor: pointer; margin-bottom: 15px; margin-top: 15px;">
	<a href="<?= $category_url; ?>">
		<img style="width: 100%;" alt="<?= $cur_category; ?>" src="<?= base_url(); ?>img/heading/<?= $headerimg; ?>" />
	</a>
</div>
<?php }*/ ?>


<?php if($cur_category == "লাইফস্টাইল") { ?>

<?php } ?>
<?php if($cur_category == "শিক্ষা") { ?>

<?php } ?>
<div class="new-title">
	<div class="title-left">
		<a href="<?= $category_url; ?>">
			<?= $cur_category; ?>
		</a>
	</div>
	<div class="title-border"></div>
	<div  class="title-right <?php if($cur_category == "লাইফস্টাইল") echo 'title-right-3'; ?> <?php if($cur_category == "শিক্ষা") echo 'title-right-4'; ?>">
		<div class="pull-right">
			<a href="<?= $category_url; ?>" class="btn btn-default title-btn">আরো সংবাদ</a>
		</div>
	</div>
</div>
<div class="clear-fix"></div>

<div class="category-list-box">
	<div class="row">
	<?php
	//$entertainment_list = get_news_list(array("blog.enabled"=>1, "blog.type"=>"List", "blog_groups.category"=>"বিনোদন"), $limit=7);
	$i = 0;
	foreach ($entertainment_list as $key => $row) {
		$url = site_url("article/{$row['id']}");
	
		if($i == 0) echo '<div class="col-md-4">';
	?>
		<?php if($i > 1) { ?>
			
			<?php
			if(($i + 1) == $total_entertainment) {
			$lasturl = $url;
			?>
			
			<?= '</div>'; ?>
			<div class="col-xs-12 col-sm-6 col-md-6">
				<small><?= $row['small_title']; ?></small>
				<h4>
					<a href="<?= $url; ?>">
						<?= $row['title']; ?>
					</a>
				</h4>
				<a href="<?= $url; ?>">
					<img class="img-responsive <?= $row['img_thumbnail']; ?>" alt="<?= $row['title']; ?>" src="<?= $row['default_image']; ?>" />
				</a>
				
				<p><?= word_limiter(strip_tags($row['details']), 16); ?></p>
			</dvi>
			<?= "</div>"; } else { ?>
			<?php // if($i == 2) echo '<div class="cat-heading"><h3>'.$cur_category.'</h3></div><div class=""><div class="col-md-6">' ?>
			<?php if($i == 2) echo '<div class=""><div class="col-md-6">' ?>
			<div class="row">
				<div class="col-md-4">
					<a href="<?= $url; ?>">
						<img class="img-responsive <?= $row['img_thumbnail']; ?>" alt="<?= $row['title']; ?>" src="<?= $row['default_image']; ?>" />
					</a>
				</div>
				<div class="col-xs-12 col-sm-6 col-md-8">
					<h4>
						<a href="<?= $url; ?>">
							<?= $row['title']; ?>
						</a>
					</h4>
				</div>
			</div>
			<?php } ?>
			
		<?php } else { ?>
			<small><?= $row['small_title']; ?></small>
			<h4 <?php if($i == 0) echo 'style="margin-top: 0;"'; ?>>
				<a href="<?= $url; ?>">
					<?= $row['title']; ?>
				</a>
			</h4>
			<a href="<?= $url; ?>">
				<img  class="img-responsive <?= $row['img_thumbnail']; ?>" alt="<?= $row['title']; ?>" src="<?= $row['default_image']; ?>" />
			</a>
		<?php 
			if($i == 1) echo "</div><div class=\"col-md-8\">";
			}
		?>
	
	<?php 
	$i++;
	if($i == $total_entertainment) echo '</div></div>';
		}
	?>
	</div>
</div>

<div>
	<div class="row">
		<div class="col-md-4"></div>
		<div class="col-md-4">
			<a class="text-primary text-control" href="<?= $category_url; ?>"><?php if(isset($category_title)) echo $category_title; else echo "বিনোদনের"; ?> আরও খবর</a>
		</div>
		<div class="col-md-4">
			<div class="text-right">
				<a class="btn btn-xs btn-default"  href="<?php if(isset($lasturl)) echo $lasturl; echo "#"; ?>">বিস্তারিত</a>
			</div>
		</div>
	</div>
</div>