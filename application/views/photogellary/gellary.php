<?php
$category_url = (isset($category_data['category_url'])) ? site_url("category/{$category_data['category_url']}") : "#";
$category_name = (isset($category_data['category'])) ? $category_data['category'] : "";

$category1_url = (isset($category1_data['category_url'])) ? site_url("category/{$category1_data['category_url']}") : "#";
$category1_name = (isset($category1_data['category'])) ? $category1_data['category'] : "";
?>

<div class="ccc">
	<div class="row">
		<div class="col-md-8">
			<div class="new-title-renew">
				<div class="title-left-renew">
					<h4 class="catTitle">
						<?php if($category_name == 'ছবি গ্যালারি') :?>
							<a href="multimedia">
								<?php if(isset($category_name)) echo $category_name; else echo "খেলাধুলা"; ?>
							</a>
							<?php else :?>
							<a href="">
								<?php if(isset($category_name)) echo $category_name; else echo "খেলাধুলা"; ?>
							</a>
						<?php endif;?>
						
					</h4>
				</div>
				<div class="title-border"></div>
			</div>
			<div class="clear-fix"></div>

			<?php if(isset($category_data['category']) && $category_data['category'] == "ছবি গ্যালারি") { ?>
	  		<?php 
				$p_category = picture_category();
				// $p_category = $this->blog_model->most_readed(array("blog.type"=>"Gallery", "blog.slider"=>1), $limit=1,array("latest_news"=>1));
				$limit = 4;
				$filters = array(
					'blog_id' => $p_category['id']
				);
				$picture_gellarys = $this->batch_model->get_rows(array("table"=>"blog_images", "limit"=>$limit),$filters);
			?>
			<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
			  	<div class="carousel-inner" role="listbox">
					<?php if(is_countable($picture_gellarys) && count($picture_gellarys)> 0) : $i = 0?>
						<?php foreach($picture_gellarys as $picture_gellary) :
							$image = (!empty($picture_gellary['image']) && file_exists("./uploads/news/{$picture_gellary['blog_id']}/{$picture_gellary['image']}")) ? base_url() . "uploads/news/{$picture_gellary['blog_id']}/{$picture_gellary['image']}" : base_url()."img/blank.jpg";
							// $url = base_url().'article/'.$picture_gellary['blog_id'];
							$url = site_url("article/{$picture_gellary['blog_id']}");
								$i++;
								if ($i == 1) {
									$cls= 'item background-none active';
								}else{
									$cls= 'item background-none';
								}
							?>
						    <div class="<?= $cls;?>">
						    	<a href="<?= $url; ?>">
						    	<img  class="img img-responsive" src="<?= $image;?>">
						    	</a>
						      	<div class="carousel-caption">
						      		<h4>
										<a href="<?= $url;?>" class="text-primary" >
										<?= $category['title']; ?>
										</a>
									</h4>
						      	</div>
						    </div>
						<?php endforeach;?>

					  <!-- Controls -->
				  	<a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
					    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
					    <span class="sr-only">Previous</span>
				  	</a>
				  	<a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
					    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
					    <span class="sr-only">Next</span>
				  	</a>
					<?php endif;?>
			  	</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="row">
						<?php
						$picture_slide = $this->blog_model->most_readed(array("blog.enabled"=>1, "blog.type"=>"Gallery"), $limit=4,array("latest_news"=>1));
						?>
						<?php foreach($picture_slide as $picture) :
		        			$url = site_url("article/{$picture['id']}");

						?>
							<div class="col-md-3">
								<a href="<?= $url; ?>"><img src="<?= $picture['default_image'];?>" class="img img-responsive">
								</a>
								<h4>
									<a class="text-primary" href="<?= $url; ?>">
										<?= $picture['title']; ?>
									</a>
								</h4>
							</div>
						<?php endforeach;?>
					</div>	
				</div>
			</div>
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
					<div class="col-md-4">
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
		<div class="col-md-4">
			<?php
				$advertisement = cur_advertisement(array("position"=>"Right Sidebar 2", "enabled"=>1), array("table"=>"advertisement", "limit"=>1));
				if($advertisement) echo "{$advertisement}<br />";
			?>
			<br />
			<?php
				$advertisement = cur_advertisement(array("position"=>"Right Sidebar 2", "enabled"=>1), array("table"=>"advertisement", "limit"=>1));
				if($advertisement) echo "{$advertisement}<br />";
			?>
		</div>
	</div>
</div>