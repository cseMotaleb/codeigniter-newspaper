<?php /*
<div style="cursor: pointer; margin-bottom: 15px; margin-top: 15px;">
	<a href="<?= site_url("video"); ?>">
		<img style="width: 100%;" alt="ভিডিও সংবাদ" src="<?= base_url(); ?>img/heading/heading11.jpg" />
	</a>
</div>
*/ ?>
<div class="new-title">
	<div class="title-left">
		<a href="<?= site_url("video"); ?>">
			ভিডিও সংবাদ
		</a>
	</div>
	<div class="title-border"></div>
	<div class="title-right title-right-video">
		<div class="pull-right">
			<a href="<?= site_url("video"); ?>" class="btn btn-default title-btn">আরো সংবাদ</a>
		</div>
	</div>
</div>
<div class="clear-fix"></div>

<div class="row">
	<?php
	$category_url = (isset($category_data['category_url'])) ? site_url("category/{$category_data['category_url']}") : "#";
	$total_entertainment = count($entertainment_list);
	$i = 0;
	foreach ($entertainment_list as $key => $row) {
		$url = site_url("article/{$row['id']}");
	?>
	
	<?php if($i == 0) { ?>
	<div class="col-md-9 col-xs-12">
		<div class="embed-responsive embed-responsive-4by3">
		  	<iframe class="embed-responsive-item" id="embed-video" src="https://www.youtube.com/embed/<?= $row['videos'][0]['url']; ?>"></iframe>
		</div>
		<h4>
			<a class="text-primary" href="<?= $url; ?>">
				<?= $row['title']; ?>
			</a>
		</h4>
		<p><?= word_limiter(strip_tags($row['details']), 30); ?></p>
	</div>
	<?php } else { ?>
		
		<?php if($i == 1) echo '<div class="col-md-3 col-xs-12">'; ?>
		<a class="loadVideo" data-url="<?= $row['videos'][0]['url']; ?>" href="#">
			<div class="show_btn"></div>
			<img class="img-responsive" alt="<?= $row['title']; ?>" src="<?= $row['default_image']; ?>" />
		</a>
		<h4>
			<a class="text-primary" href="<?= $url; ?>">
				<?= $row['title']; ?>
			</a>
		</h4>
		<?php if(($i + 1) == $total_entertainment) echo '</div>'; ?>
	
	<?php } ?>
	
	<?php
	$i++;
	} ?>
</div>