<style type="text/css">

</style>
<?php
$i=0;
foreach ($rows as $key => $row) {
	$url = site_url("article/{$row['id']}");
?>
<?php if($i==0) { ?>
<div class="lead_mega_menu_summary_block">
	<a href="<?= $url; ?>">
		<div class="img" style="background:#f7f7f7 url('<?= $row['default_image']; ?>') center no-repeat; background-size:cover"></div>
		<div class="hl">
			<h4><?= $row['title']; ?></h4>
		</div>
	</a>
</div>
<?php } else { ?>
<ul class="more_mega_news">
	<li><i class="fa fa-square-o"></i>&nbsp;<a href="<?= $url; ?>"><?= $row['title']; ?></a></li>
</ul>
<?php } ?>
<?php
$i++;
	}
?>