<script>
	jssor_slider1_starter = function (containerId) {
	    var options = {
	        $AutoPlay:true,
	        $AutoPlayInterval: 8000,
	        $PauseOnHover: 1,
	        $ArrowKeyNavigation: true,
	        $SlideDuration: 800,
	        $MinDragOffsetToSlide: 20,
	        $SlideHeight: 300,
	        $SlideSpacing: 0,
	        $DisplayPieces: 1,
	        $ParkingPosition: 0,
	        $UISearchMode: 1,
	        $PlayOrientation: 1,
	        $DragOrientation: 1,
	        $ArrowNavigatorOptions: {
	        	$Class: $JssorArrowNavigator$,
	        	$ChanceToShow: 1,
	        	$AutoCenter: 2,
	        	$Steps: 1
	        },

	        $ThumbnailNavigatorOptions: {
	        	$Class: $JssorThumbnailNavigator$,
	        	$ChanceToShow: 2,
	        	$ActionMode: 2,
	        	$AutoCenter: 0,
	        	$Lanes: 1,
	        	$SpacingX: 3,
	        	$SpacingY: 3,
	        	$DisplayPieces: 9,
	        	$ParkingPosition: 260,
	        	$Orientation: 1,
	        	$DisableDrag: false
	        }
	    };

	    var jssor_slider1 = new $JssorSlider$(containerId, options);

	    function ScaleSlider() {
	        var bodyWidth = document.body.clientWidth;
	        if (bodyWidth)
	            jssor_slider1.$ScaleWidth(Math.min(bodyWidth, 800));
	        else
	            $Jssor$.$Delay(ScaleSlider, 30);
	    }

	    ScaleSlider();
	    $Jssor$.$AddEvent(window, "load", ScaleSlider);

	    $Jssor$.$AddEvent(window, "resize", $Jssor$.$WindowResizeFilter(window, ScaleSlider));
	    $Jssor$.$AddEvent(window, "orientationchange", ScaleSlider);
	};
</script>


<div id="slider1_container">
    <!-- Loading Screen -->
    <div u="loading">
        <div>
        </div>
        <div>
        </div>
    </div>
    <!-- Slides Container -->
    <div u="slides">

		<?php
		$total_slider = count($slider_news);
		$i = 0;
		foreach ($slider_news as $key => $row) {
			if($i < 6) {
			$url = site_url("article/{$row['id']}");
		?>
	    <div>
            <div>
                <div>
	                <div>
		                <?php if($row['small_title']) { ?><small><?= $row['small_title']; ?></small><?php } ?>
		                <span>
							<a class="slider-title" href="<?= $url; ?>"><?= $row['title']; ?></a>
						</span> 
		                <br />
		                <span>
		                	<?= word_limiter(strip_tags($row['details']), 35, ' '); ?>
		                </span>
	                </div>
	                <div class="text-right"><a class="btn btn-xs btn-default top9-btn" href="<?= $url; ?>">বিস্তারিত</a></div>
              	</div>
            </div>
            <a href="<?= $url; ?>">
            	<img src="<?= $row['default_image']; ?>" />
            </a>
            <img u="thumb" src="<?= $row['default_image']; ?>" />
        </div>
        <?php
		$i++;
			}	
		} ?>

    </div>

    <span u="arrowleft" class="jssora07l"></span>
    <span u="arrowright" class="jssora07r"></span>

	<div u="thumbnavigator" class="jssort04">
	    <div u="slides">
	        <div u="prototype" class="p">
	            <div class=w><div u="thumbnailtemplate" class="t"></div></div>
	            <div class=c></div>
	        </div>
	    </div>
	</div>
</div>
<script>
    jssor_slider1_starter('slider1_container');
</script>


<div class="row">
	<?php
	$i=0;
	foreach ($slider_news as $key => $row) {
		if($i > 5) {
		$url = site_url("article/{$row['id']}");
	?>
	<div class="col-md-4">
		<div class="top9-box">
			<small style="color: #df384c;"><?= $row['small_title']; ?></small>
			<h2><a style="color: #336699;" href="<?= $url; ?>"><?= $row['title']; ?></a></h2>
			<div class="">
				<a href="<?= $url; ?>">
					<img class="<?= $row['img_thumbnail']; ?>" alt="<?= $row['title']; ?>" src="<?= $row['default_image']; ?>" />
				</a>
				<p><?= word_limiter(strip_tags($row['details']), 15, ' '); ?></p>
			</div>
		</div>

		<div class="text-right"><a class="btn btn-xs btn-default top9-btn" href="<?= $url; ?>">বিস্তারিত</a></div>
	</div>
	<?php
		}
	$i++;
	}
	?>
</div>

<hr />