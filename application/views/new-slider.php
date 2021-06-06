
<div class="oim-wrapper sitewidthleft">
	<ul class="oim-slider">
		<?php
		$total_slider = count($slider_news);
		$i = 0;
		foreach ($slider_news as $key => $row) {
			if($i < 5) {
			$url = site_url("article/{$row['id']}");
		?>
		<li class="sitewidthleft">
			<div class="homeTopLeadSlider">
				<img src="<?= $row['default_image']; ?>" alt="<?= $row['title']; ?>" />

				<br />

				<div class="headline">
					<a href="<?= $url; ?>"><?= $row['title']; ?></a>
				</div>
			</div>
		</li>
        <?php
		$i++;
			}	
		}
		?>
	</ul>
</div>


<br />


<div class="row">
	<?php
	$i=0;
	foreach ($slider_news as $key => $row) {
		if($i < 2) {
		$url = site_url("article/{$row['id']}");
	?>
	<div class="col-md-6">
		<a href="<?= $url; ?>">
			<img class="img-responsive" alt="<?= $row['title']; ?>" src="<?= $row['default_image']; ?>" />
		</a>
		<small><?= $row['small_title']; ?></small>
		<h2 href="<?= $url; ?>"><?= $row['title']; ?></a></h2>
		
	</div>
	<?php
		}
	elseif($i <= 3){
	?>
	<div class="col-md-6">
		<a href="<?= $url; ?>">
			<img class="img-responsive" alt="<?= $row['title']; ?>" src="<?= $row['default_image']; ?>" />
		</a>
		<small><?= $row['small_title']; ?></small>
		<h2><a href="<?= $url; ?>"><?= $row['title']; ?></a></h2>
		
	</div>
	<?php
	}
	$i++;
	}
	?>
</div>