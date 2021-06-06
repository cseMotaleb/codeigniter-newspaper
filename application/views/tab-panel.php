<?php
foreach ($news as $key => $row) {
	if(isset($row['id'])) {
	$url = site_url("article/{$row['id']}");
?>
<div class="sidebar-tab">
	<a href="<?= $url; ?>">
		<img class="img-responsive <?= $row['img_thumbnail']; ?>" alt="<?= $row['title']; ?>" src="<?= $row['default_image']; ?>" />
	</a>
	<h2><a href="<?= $url; ?>"><?= $row['title']; ?></a></h2>
</div>
<div class="clearfix"></div>
<?php }
} ?>