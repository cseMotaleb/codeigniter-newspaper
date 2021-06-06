<?php
	$selected_picture = $this->blog_model->most_readed(array("blog.enabled"=>1, "blog.selected"=>1), $limit=10,array("latest_news"=>1));
	$i = 0;
	$j = 0;
	$k = 0;
	$col = 0;
?>
<!-- Start top section wrapper-->
<div id="topsection-news">
	<div class="row">
		<?php foreach($selected_picture as $select) :
			$i++;
			if($i == 2){
				break;
			}
			$url = site_url("article/{$select['id']}");
			$news_category = $this->blog_model->news_category($select['id']);
			$news_tag = $this->blog_model->tag_category($select['id']);
			// var_dump($select);
			// die();
	        $default_image = newsDefaultImage($select, array('imgwidth'=>502, 'imgheight'=>312));
		?>
			<div class="col-xs-12 col-md-12">
				<div class="thumbnail-list topsec-big-news">
					<div class="c-image">
			      		<a href="<?= $url;?>"><img class="img img-responsive center" src="<?= $default_image; ?>" alt="..."></a>
					</div>
			      	<div class="banner-title">
				        <h3><a href="<?= $url;?>"><?= word_limiter(strip_tags($select['title']), 10, "..."); ?> </a> </h3>
			      	</div>
		    	</div>
			</div>
		<?php endforeach;?>
	</div>	
</div>
<!-- End top section wrapper-->
<!--Start top Bottom section wrapper-->
<div class="topsection-bottomnews">
	<div class="row">
		<?php foreach($selected_picture as $select) :
			$news_category = $this->blog_model->news_category($select['id']);
			$news_tag = $this->blog_model->tag_category($select['id']);
			$k++;
			if ($k <= 4) {
				continue;
			}
			$url = site_url("article/{$select['id']}");
			// if ($col == 0) {
			// 	echo "<div class='row'>";
			// }
	        $default_image = newsDefaultImage($select, array('imgwidth'=>242, 'imgheight'=>130));
		?>
		<div class="col-xs-6 col-sm-6 col-md-4">
			<div class="thumbnail-list top-secbottom-newslist" id="<?= $select['id'];?>">
				<div class="c-image">
		      		<a href="<?= $url;?>"><img class="img img-responsive center lazyload" data-src="<?= $default_image; ?>" alt="..."></a>
				</div>
		      	<div class="caption selected-cap">
			        <h4 class="news-title"><a href="<?= $url;?>"><?= word_limiter(strip_tags($select['title']), 4,"..."); ?></a></h4>
		      	</div>
	    	</div>
		</div>
		<!-- <?php
			$col++;
			if($col == 3){
				echo "</div>";
				$col = 0;
			}
		?> -->
		<?php endforeach;?>
	</div>
</div>
<!--End top Bottom section wrapper-->

