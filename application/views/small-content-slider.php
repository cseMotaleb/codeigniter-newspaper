<div>
	<div class="slider responsive" id="<?= $listid; ?>">
		<?php
		foreach ($blogs as $key => $row) {
			$url = site_url("article/{$row['id']}");
		?>
		<div>
			<div>
				<a href="<?= $url; ?>">
					<img class="img-responsive <?= $row['img_thumbnail']; ?>" alt="<?= $row['title']; ?>" src="<?= $row['default_image']; ?>" />
				</a>
				<br />
				<h2><a href="<?= $url; ?>"><?= $row['title']; ?></a></h2>
			</div>
		</div>
		<?php } ?>
	</div>
</div>

<script type="text/javascript">
	$(document).ready(function() {
		$('#<?= $listid; ?>').slick({
		  dots: false,
		  infinite: true,
		  slidesToShow: 5,
		  slidesToScroll: 2,
		  autoplay: true,
		  autoplaySpeed: 2000,
		  responsive: [
		    {
		      breakpoint: 1024,
		      settings: {
		        slidesToShow: 5,
		        slidesToScroll: 2,
		        infinite: true,
		        dots: false
		      }
		    },
		    {
		      breakpoint: 600,
		      settings: {
		        slidesToShow: 3,
		        slidesToScroll: 2
		      }
		    },
		    {
		      breakpoint: 480,
		      settings: {
		        slidesToShow: 1,
		        slidesToScroll: 1
		      }
		    }
		  ]
		});
	});
</script>