<?php
$category_url = (isset($category_data['category_url'])) ? site_url("category/{$category_data['category_url']}") : "#";
$category_name = (isset($category_data['category'])) ? $category_data['category'] : "";

$category1_url = (isset($category1_data['category_url'])) ? site_url("category/{$category1_data['category_url']}") : "#";
$category1_name = (isset($category1_data['category'])) ? $category1_data['category'] : "";
?>

<div class="plays-section">
	<div class="row">
		<div class="col-md-8">
			<div class="new-title-renew">
				<div class="title-left-renew">
					<h4 class="catTitle">
						<a href="<?= $category_url; ?>">
							<?php if(isset($category_name)) echo $category_name; else echo "খেলাধুলা"; ?>
						</a>
						
					</h4>
				</div>
				
			</div>
			<div class="clear-fix"></div>

			<?php if(isset($category_data['category']) && $category_data['category'] == "ছবি গ্যালারি") { ?>
			<div class="pic-single-item">
				<?php
				foreach ($entertainment_list as $key => $row) {
					$url = site_url("article/{$row['id']}");
				?>
			  	<div>
					<a href="<?= $url; ?>">
						<img class="img-responsive <?= $row['img_thumbnail']; ?>" alt="<?= $row['title']; ?>" src="<?= $row['default_image']; ?>" />
					</a>
					<h4>
						<a style="font-size: 24px;" class="text-primary" href="<?= $url; ?>">
							<?= $row['title']; ?>
						</a>
					</h4>
			  	</div>
			  	<?php } ?>
			</div>
			<script type="text/javascript">
				$('.pic-single-item').slick({
				  	dots: false,
				  	infinite: false,
				  	speed: 300,
				  	slidesToShow: 1,
				  	adaptiveHeight: true,
				  	autoplay: true,
				  	autoplaySpeed: 2500,
				  	arrows: true
				});
			</script>
			<?php } else { ?>
				<?php
				$total_entertainment = count($entertainment_list);
				$i = 0;
				foreach ($entertainment_list as $key => $row) {
					$url = site_url("article/{$row['id']}");
				?>
			
					<?php if($i == 0) { ?>
					<div class="row">
						<div class="col-md-7">
							<a href="<?= $url; ?>">
								<img class="img-responsive <?= $row['img_thumbnail']; ?>" alt="<?= $row['title']; ?>" src="<?= $row['default_image']; ?>" />
							</a>
						</div>
						<div class="col-md-5">
							<h4>
								<a class="text-primary" href="<?= $url; ?>">
									<?= $row['title']; ?>
								</a>
							</h4>
			
							<p><?= word_limiter(strip_tags($row['details']), 14, "..."); ?></p>
			
							<div class="text-right">
								<a class="btn btn-xs btn-default" href="<?= $url; ?>">বিস্তারিত</a>
							</div>
						</div>
					</div>
					<?php } else { ?>
					
					<?php if($i == 1) echo '<br /><div class="row">'; ?>
					<div class="col-xs-12 col-sm-6 col-md-4">
						<a href="<?= $url; ?>">
							<img class="img-responsive <?= $row['img_thumbnail']; ?>" alt="<?= $row['title']; ?>" src="<?= $row['default_image']; ?>" />
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
			
				<?php 
				$i++;
				} ?>
			<?php } ?>
		</div>
		
		<div class="col-xs-12 col-sm-6 col-md-4">
			<div class="new-title-renew">
				<div class="title-left-renew">
					<h4 class="catTitle">
						<a href="<?= $category1_url; ?>">
							<?php if(isset($category1_data['category'])) echo $category1_data['category']; ?>
						</a>
						
					</h4>
				</div>
				<div class="title-border"></div>
			</div>
			<div>
					<?php
					$i = 0;
					foreach ($news1 as $key => $row) {
						if(isset($row['id'])) {
						$url = site_url("article/{$row['id']}");
					?>
					
						<?php if($i == 0) { ?>
						<div class="grid-content">
							
						<?php if($row['small_title']) { ?>
						<small><a href="<?= $url; ?>"><?= $row['small_title']; ?></a></small>
						<?php } ?>

						<a href="<?= $url; ?>">
							<img class="img-responsive <?= $row['img_thumbnail']; ?>" alt="<?= $row['title']; ?>" src="<?= $row['default_image']; ?>" />
						</a>
						<h4 style="font-size: 16px;">
							<a href="<?= $url; ?>">
								<?= $row['title']; ?>
							</a>
						</h4>


						<ul >
						<?php } else { ?>
						<li>
							<!-- <h4><i class="fa fa-arrow-right"></i> <a href="<?= $url; ?>"><?= $row['title']; ?></a></h4> -->
							<div class="row">
								<div class="col-xs-12 col-sm-6 col-md-4">
									<img class="img-responsive"  src="<?= $row['default_image']; ?>" />
								</div>
								<div  class="col-md-8 col-xs-8">
									<h4><a href="<?= $url; ?>"><?= word_limiter($row['title'], 4, " ..."); ?></a></h4>
								</div>
							</div>
						</li>
						<?php } ?>
						
					<?php
						}
					$i++; 
						}
					?>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>