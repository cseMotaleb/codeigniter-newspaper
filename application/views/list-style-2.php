<?php
$category_url = (isset($category_data['category_url'])) ? site_url("category/{$category_data['category_url']}") : "#";

/*
if(isset($headerimg) && !empty($headerimg)) {
?>
<div style="cursor: pointer; margin-bottom: 15px; margin-top: 15px;">
	<a href="<?= $category_url; ?>">
		<img style="width: 100%;" alt="<?php if(isset($category_name)) echo $category_name; else echo "খেলাধুলা";; ?>" src="<?= base_url(); ?>img/heading/<?= $headerimg; ?>" />
	</a>
</div>
<?php }*/ ?>
<?php /*
<div class="cat-heading">
	<h3><?php if(isset($category_name)) echo $category_name; else echo "খেলাধুলা"; ?></h3>
</div> */ ?>

<?php if($category_name == "চট্রগ্রাম সব সংবাদ") { ?>
<style type="text/css">
.new-title .title-right-1 {
	width: 67% !important;
}
@media (max-width: 480px) {
	.new-title .title-right-1 {
    	width:  37% !important;
    }
}
</style>
<?php } ?>
<?php if($category_name == "খেলা") { ?>
<style type="text/css">
@media (max-width: 480px) {
	.new-title .title-right-2 {
    	width:  62% !important;
    }
}
</style>
<?php } ?>

<div class="new-title">
	<div class="title-left">
		<a href="<?= $category_url; ?>">
			<?php if(isset($category_name)) echo $category_name; else echo "খেলাধুলা"; ?>
		</a>
	</div>
	<div class="title-border"></div>
	<div class="title-right <?php if($category_name == "চট্রগ্রাম সব সংবাদ") echo 'title-right-1'; ?> <?php if($category_name == "খেলা") echo 'title-right-2'; ?>">
		<div class="pull-right">
			<a href="<?= $category_url; ?>" class="btn btn-default title-btn">আরো সংবাদ</a>
		</div>
	</div>
</div>
<div class="clear-fix"></div>

<div>
	<div class="row">
		<?php
		$total_entertainment = count($entertainment_list);
		$i = 0;
		foreach ($entertainment_list as $key => $row) {
			$url = site_url("article/{$row['id']}");
		
			if($i == 0) echo '<div class="col-md-8">';
		?>
	
			<?php if($i > 3) { ?>
	
			<?php if($i == 4) echo '</div><div class="col-md-4">'; ?>
			<div  class="sport-news">
				<a href="<?= $url; ?>">
					<img class="img-responsive <?= $row['img_thumbnail']; ?>" alt="<?= $row['title']; ?>" src="<?= $row['default_image']; ?>" />
				</a>
				<span style="margin-top: 0; font-size: 16px;">
					<a href="<?= $url; ?>">
						<?= $row['title']; ?>
					</a>
				</span>
			</div>
			
			<div class="clearfix"></div>
			<?php
			if(($i + 1) == $total_entertainment) {
				echo "</div>";
			}
			?>
	
			<?php } else { ?>
	
			<?php if($i == 0) { ?>
			<div class="row">
				<div class="col-md-8">
					<a href="<?= $url; ?>">
						<img class="img-responsive <?= $row['img_thumbnail']; ?>" alt="<?= $row['title']; ?>" src="<?= $row['default_image']; ?>" />
					</a>
				</div>
				<div class="col-md-4">
					<h4>
						<a class="text-primary" href="<?= $url; ?>">
							<?= $row['title']; ?>
						</a>
					</h4>
	
					<p><?= word_limiter(strip_tags($row['details']), 16); ?></p>
	
					<div class="text-right">
						<a class="btn btn-xs btn-default" style="font-size: 16px;" href="<?= $url; ?>">বিস্তারিত</a>
					</div>
				</div>
			</div>
			<?php } else { ?>
			
			<?php if($i == 1) echo '<br /><div class="row">'; ?>
			<div class="col-md-4">
				<a href="<?= $url; ?>">
					<img  class="img-responsive <?= $row['img_thumbnail']; ?>" alt="<?= $row['title']; ?>" src="<?= $row['default_image']; ?>" />
				</a>
				<small><?= $row['small_title']; ?></small>
				<h4>
					<a href="<?= $url; ?>">
						<?= $row['title']; ?>
					</a>
				</h4>
			</div>
			<?php if($i == 3) echo '</div>'; ?>
			
			<?php } ?>
	
			<?php } ?>
	
		<?php 
		$i++;
		} ?>
	</div>
</div>

<?php $c_t = (isset($category_title)) ? $category_title : "বিনোদনের"; ?>
<div>
	<div class="text-right"><a class="text-primary" href="<?= $category_url; ?>"><?= $c_t; ?> আরও খবর</a></div>
</div>