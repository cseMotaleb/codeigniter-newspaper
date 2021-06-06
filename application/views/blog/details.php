<?php
$ip = $_SERVER['REMOTE_ADDR'];
?>

<script type="text/javascript">var switchTo5x = false;</script>
<!--<script type="text/javascript" src="https://w.sharethis.com/button/buttons.js"></script>-->
<script type="text/javascript" src="<?= site_url('assets/sharethis/buttons.js')?>"></script>
<script type="text/javascript">
    stLight.options({
        publisher: "93aefefa-1dc5-479c-9a40-03338898851f",
        doNotHash: true,
        doNotCopy: true,
        hashAddressBar: false,
        shorten: false
    });
</script>



<?php if (is_countable($blog_data['images']) && count($blog_data['images']) > 1) { ?>
    <?php if ($blog_data['type'] == 'List') { ?>
        <script type="text/javascript" src="<?= base_url(); ?>assets/jssor.slider/js/jssor.slider.mini.js"></script>
        <script type="text/javascript">
            jQuery(document).ready(function ($) {

                var _CaptionTransitions = [];
                _CaptionTransitions["CLIP|LR"] = {$Duration: 900, $Clip: 3, $Easing: $JssorEasing$.$EaseInOutCubic};

                var jssor_1_SlideshowTransitions = [{
                    $Duration: 1200,
                    $Opacity: 2
                }];

                var options = {
                    $AutoPlay: true,
                    $SlideshowOptions: {
                        $Class: $JssorSlideshowRunner$,
                        $Transitions: jssor_1_SlideshowTransitions,
                        $TransitionsOrder: 1
                    },
                    $ArrowNavigatorOptions: {
                        $Class: $JssorArrowNavigator$
                    },
                    $BulletNavigatorOptions: {
                        $Class: $JssorBulletNavigator$
                    },
                    $CaptionSliderOptions: {
                        $Class: $JssorCaptionSlider$,
                        $CaptionTransitions: _CaptionTransitions,
                        $PlayInMode: 1,
                        $PlayOutMode: 3
                    }
                };
                var jssor_slider1 = new $JssorSlider$('jssor_1', options);

                function ScaleSlider() {
                    var parentWidth = $('#jssor_1').parent().width();
                    if (parentWidth) {
                        jssor_slider1.$ScaleWidth(parentWidth);
                    } else
                        window.setTimeout(ScaleSlider, 30);
                }

                ScaleSlider();

                $(window).bind("load", ScaleSlider);
                $(window).bind("resize", ScaleSlider);
                $(window).bind("orientationchange", ScaleSlider);


                /*
                 var jssor_1_SlideshowTransitions = [{
                       $Duration:1200,
                       $Opacity:2
                   }];

                 var jssor_1_options = {
                       $AutoPlay: true,
                       $SlideshowOptions: {
                         $Class: $JssorSlideshowRunner$,
                         $Transitions: jssor_1_SlideshowTransitions,
                         $TransitionsOrder: 1
                       },
                       $ArrowNavigatorOptions: {
                         $Class: $JssorArrowNavigator$
                       },
                       $BulletNavigatorOptions: {
                         $Class: $JssorBulletNavigator$
                       }
                 };

                 var jssor_1_slider = new $JssorSlider$("jssor_1", jssor_1_options);

                 function ScaleSlider() {
                     var refSize = jssor_1_slider.$Elmt.parentNode.clientWidth;
                     if (refSize) {
                         refSize = Math.min(refSize, 600);
                         jssor_1_slider.$ScaleWidth(refSize);
                     }
                     else {
                         window.setTimeout(ScaleSlider, 30);
                     }
                 };

                 ScaleSlider();
                 $(window).bind("load", ScaleSlider);
                 $(window).bind("resize", ScaleSlider);
                 $(window).bind("orientationchange", ScaleSlider);*/
            });
        </script>
    <?php }
} ?>

<?php
$user_id = $this->session->userdata("user_id");
?>
<div id="news_content">
    <?php if (isset($error)) echo $error; ?>
    <?php /*
	<div class="row">
		<div class="col-md-3 col-xs-12">
			<time>
				<?php
					$month = $this->bangla_week_day->get_monthname(date("F", $blog_data['time']));
					echo $this->bangla_number->convert(date("d {$month}, Y H:i", $blog_data['time']));
				?>
			</time>
		</div>
		<div class="col-md-9 col-xs-12">
			<div class="pull-left">
				<div class="share-socialicon">
					<span class='st_sharethis_vcount' displayText='ShareThis'></span>
					<span class="st_fblike_vcount" displayText='Facebook Like'></span>
					<span class='st_facebook_vcount' displayText='Facebook'></span>
					<span class='st_googleplus_vcount' displayText='Google +'></span>
					<span class='st_twitter_vcount' displayText='Tweet'></span>
					<span class='st_linkedin_vcount' displayText='LinkedIn'></span>
					<span class='st_email_vcount' displayText='Email'></span>
				</div>
			</div>
			<div class="pull-right">
				<div class="text-right">
					<a target="_blank" href="<?php if(isset($page['url'])) echo site_url($page['url']); ?>?print=print" class="btn btn-default"><i class="fa fa-print"></i></a>
				</div>
			</div>
			<div class="clearfix"></div>
		</div>
	</div>
	*/ ?>

    <?php if ($blog_data['small_title']) { ?><h4><?= $blog_data['small_title']; ?></h4><?php } ?>
    <div  class="cat-heading">
        <h3><?= $blog_data['title']; ?></h3>
    </div>

    <?php
    $monthname = $this->bangla_number->get_monthname(date("F", $blog_data['time']));
    ?>
    <p class="details-date">
        <?php if (!empty($blog_data['agent'])) echo $blog_data['agent'] . " | প্রকাশিত "; ?> <?= $this->bangla_number->convert(date("d {$monthname}, Y", $blog_data['time'])); ?>
        <i class="fa fa-clock-o"></i> <?= $this->bangla_number->convert(date("H:i:s", $blog_data['time'])); ?>
    </p>


    <div class="slider details-items slider-details-items" style="position: relative;">
        <?php
        if ($blog_data['type'] == "Video") {
            foreach ($blog_data['videos'] as $key => $video) {
                ?>
                <div class="row">
                    <div class="col-md-12 col-xs-12">
                        <div class="embed-responsive embed-responsive-16by9">
                            <iframe class="embed-responsive-item"
                                    src="https://www.youtube.com/embed/<?= $video['url']; ?>"></iframe>
                        </div>
                    </div>
                </div>
            <?php } ?>

        <?php } else {
            $total_images = count($blog_data['images']);
            if ($total_images > 0) {
                if ($blog_data['type'] == 'List') {
                    ?>
                    <?php if ($total_images == 1) { ?>
                        <?php
                        foreach ($blog_data['images'] as $key => $image) {
                            $curimage = (!empty($image['image']) && file_exists("./uploads/news/{$image['blog_id']}/{$image['image']}")) ? base_url() . "uploads/news/{$image['blog_id']}/{$image['image']}" : base_url() . "img/blank.jpg";
                            ?>
                            <img class="img-responsive" alt="<?= $image['caption']; ?>" src="<?= $curimage; ?>"/>
                            <div class="caption-img" u="caption" t="CLIP|LR">
                                <div><?= word_limiter(strip_tags($image['caption']), 5); ?></div>
                            </div>
                        <?php } ?>
                    <?php } else { ?>
                        <div id="jssor_1">
                            <!-- Loading Screen -->
                            <div data-u="loading" style="position: absolute; top: 0px; left: 0px;">
                                <div style="filter: alpha(opacity=70); opacity: 0.7; position: absolute; display: block; top: 0px; left: 0px; width: 100%; height: 100%;"></div>
                                <div style="position:absolute;display:block;background:url('img/loading.gif') no-repeat center center;top:0px;left:0px;width:100%;height:100%;"></div>
                            </div>
                            <div data-u="slides"
                                 style="cursor: default; position: relative; top: 0px; left: 0px; width: 950px; height: 400px; overflow: hidden;">
                                <?php
                                foreach ($blog_data['images'] as $key => $image) {
                                    $curimage = (!empty($image['image']) && file_exists("./uploads/news/{$image['blog_id']}/{$image['image']}")) ? base_url() . "uploads/news/{$image['blog_id']}/{$image['image']}" : base_url() . "img/blank.jpg";
                                    ?>
                                    <div data-p="112.50" style="display: none;">
                                        <img data-u="image" class="img-responsive" caption="<?= $image['caption']; ?>"
                                             alt="<?= $image['caption']; ?>" src="<?= $curimage; ?>"/>
                                    </div>
                                    <?php if ($image['caption']) { ?>
                                        <div class="caption-img" u="caption" t="CLIP|LR"
                                             style="position:absolute; left:2px; color: #FFFFFF; bottom: 0px; width:15%; height:30px;">
                                            <div><?= word_limiter(strip_tags($image['caption']), 5); ?></div>
                                        </div>
                                    <?php } ?>

                                <?php } ?>
                            </div>

                            <!-- Arrow Navigator -->
                            <span data-u="arrowleft" class="jssora12l"
                                  style="top:180px;left:0px;width:30px;height:46px;" data-autocenter="2"></span>
                            <span data-u="arrowright" class="jssora12r"
                                  style="top:180px;right:0px;width:30px;height:46px;" data-autocenter="2"></span>
                        </div>
                    <?php } ?>

                <?php } else { ?>
                    <ul class="pgwSlideshow">
                        <?php
                        foreach ($blog_data['images'] as $key => $image) {
                            $image = (!empty($image['image']) && file_exists("./uploads/news/{$image['blog_id']}/{$image['image']}")) ? base_url() . "uploads/news/{$image['blog_id']}/{$image['image']}" : base_url() . "img/blank.jpg";
                            ?>
                            <li>
                                <img class="img-responsive" alt="<?= $blog_data['title']; ?>" src="<?= $image; ?>"/>
                            </li>
                        <?php } ?>
                    </ul>
                <?php } ?>

            <?php } else { ?>
                <?php
                foreach ($blog_data['images'] as $key => $image) {
                    $image = (!empty($image['image']) && file_exists("./uploads/news/{$image['blog_id']}/{$image['image']}")) ? base_url() . "uploads/news/{$image['blog_id']}/{$image['image']}" : base_url() . "img/blank.jpg";
                    ?>
                    <img class="img-responsive img-thumbnail" alt="<?= $blog_data['title']; ?>" src="<?= $image; ?>"/>
                <?php } ?>
            <?php }
        } ?>
    </div>

    <div id="news_details">
        <?= $blog_data['details']; ?>
    </div>
</div>

<div class="new-title social-share">
    <div class="title-left">
        <a href="#">
            সংবাদটি শেয়ার করুন:
        </a>
    </div>
    <div class="title-border"></div>
    <div class="title-right">
        <div class="pull-right ass">
            <button type="button"><?= $this->bangla_number->convert($blog_data['popularity']); ?></button>
            <span>বার পঠিত</span>
        </div>
    </div>
</div>
<div class="clear-fix"></div>

<?php /*
<div class="cat-heading">
	<h3>
		<div class="pull-left">
			<span style="color: red;">সংবাদটি শেয়ার করুন: </span>
		</div>
		<div class="pull-right">
			<span style="font-size: 16px;"><?= $this->bangla_number->convert($blog_data['popularity']); ?> বার পঠিত</span>
		</div>
		<div class="clearfix"></div>
	</h3>
</div> */ ?>
<div class="share-socialicon">
    <span class='st_sharethis_vcount' displayText='ShareThis'></span>
    <span class='st_fblike_vcount' displayText='Facebook Like'></span>
    <span class='st_facebook_vcount' displayText='Facebook'></span>
    <span class='st_twitter_vcount' displayText='Tweet'></span>
    <span class='st_email_vcount' displayText='Email'></span>
</div>
<style>
    .stButton .stFb, .stButton .stTwbutton, .stButton .stMainServices, .stButton .chicklet{
        height: unset !important;
    }
</style>
<br/>

<div class="comment-area">
    <div class="comment-main">
        <?= news_comments($blog_data['id']); ?>
        <?php
        $user_id = $this->session->userdata("user_id");
        if ($user_id) {
            ?>
            <form method="post" id="validate-comment" action="<?= site_url($page['url']); ?>">
                <textarea rows="5" class="form-control" name="comment" id="comment"></textarea>
                <hr/>
                <span id="detailsError"></span>
                <button class="btn btn-primary ladda-button" type="submit" name="submit" id="comment-submit"
                        data-style="expand-right">
                    <span class="ladda-label">মন্তব্য করুন</span>
                </button>
            </form>
        <?php } else { ?>
            <div class="cat-heading">
                <h3>লগইন করুন</h3>
            </div>
            <div class="row">
                <div class="col-md-9">
                    <form method="post" action="<?= site_url("login"); ?>" class="comment-form">
                        <div class="input-group">
                            <input type="text" class="form-control" name="user" value=""
                                   placeholder="ইউজার নেম / ইমেইল">
                            <span class="input-group-addon" id="basic-addon2"> <i class="far fa-envelope"></i></span>
                        </div>

                        <br/>

                        <div class="input-group">
                            <input type="password" class="form-control" name="password" id="password"
                                   placeholder="পাসওয়ার্ড">
                            <span class="input-group-addon" id="basic-addon2"><i class="fa fa-key"></i></span>
                        </div>

                        <br/>

                        <div class="checkbox remember">
                            <label>
                                <input name="remember" type="checkbox"> লগইন মনে রাখুন
                            </label>
                        </div>

                        <br/>

                        <input type="hidden" name="redirect_url" id="redirect_url" value="<?= $page['url']; ?>"/>
                        <button class="btn btn-primary login-cbtn" type="submit" name="submit">লগইন করুন</button>
                        <div class="m-register">
                            <a class="text-primary" href="<?= site_url("register"); ?>">নতুন একাউন্ট রেজিস্ট্রেশন করতে
                            এখানে ক্লিক করুন</a>
                        </div>
                    </form>
                </div>
            </div>
        <?php } ?>

        <hr/>

        <div class="fb-comment-box">
            <div class="fb-comments" data-href="<?php if (isset($page['url'])) echo base_url() . $page['url']; ?>"
                 data-numposts="5"></div>
        </div>
    </div>
</div>


<?php if ($blog_data['type'] == "Gallery") { ?>
    <div class="cat-heading">
        <h3>আরও এ্যালবাম</h3>
    </div>
    <?php
    $total_blog_list = count($more_news_category);
    $row_counter = 0;
    foreach ($more_news_category as $key => $row) {
        $url = site_url("article/{$row['id']}");
        if ($row_counter == 0) echo '<div class="row">';
        ?>
        <div class="col-md-3">
            <a href="<?= $url; ?>">
                <img style="height: 95px;" class="img-responsive" alt="<?= $row['title']; ?>"
                     src="<?= $row['default_image']; ?>"/>
            </a>
            <h6 style="font-size: 14px;">
                <a href="<?= $url; ?>">
                    <?= $row['title']; ?>
                </a>
            </h6>
        </div>
        <?php
        $row_counter++;
        if ($row_counter == 4) {
            echo '</div>';
            $row_counter = 0;
        }
    }

    if ($total_blog_list % 4 != 0) echo '</div>';
    ?>
<?php } else { ?>
    <?php

    $total_releted_blog = count($releted_blog);
    if ($total_releted_blog > 0) {
        ?>

        <div id="releted_blog">
            <div class="cat-heading relative-title">
                <h3>এ সম্পর্কিত খবর</h3>
            </div>
            <div class="row">
                <?php
                    $row_counter = 0;
                    $i = 0;
                    foreach ($releted_blog as $key => $row) {
                        $url = site_url("article/{$row['id']}");
                        if ($row_counter == 0) echo '<div class="ss">';
                ?>
                <div class="col-xs-12 col-sm-6 col-md-4">
                    <div class="relative-singlepost rlt-pst">
                        <small><?= $row['small_title']; ?></small>
                        <div class="rsinglepost-img">
                            <a href="<?= $url; ?>">
                            <img class="<?= $row['img_thumbnail']; ?>" alt="<?= $row['title']; ?>"
                                 src="<?= $row['default_image']; ?>"/>
                            </a>
                        </div>

                        <div class="rltp-content">
                           <a href="<?= $url; ?>"> <h2 class="news-title"><?= word_limiter(strip_tags($row['title']), 5, '... '); ?>  </h2></a> 
                            <p><?= word_limiter(strip_tags($row['details']), 10, '...'); ?></p>
                            <div class="rpost_readmore">
                                <a class="btn" href="<?= $url; ?>">বিস্তারিত</a>
                            </div>
                        </div>
                    </div>
                </div>
                <?php /*
		<div style="border-bottom: 1px solid #ddd; border-top:  1px solid #ddd; margin-bottom: 10px;" class="">
			<div style="padding-bottom: 3px; padding-top: 3px;">
				<div class="pull-left">
					<img style="height: 95px; width: 95px;" class="img-responsive <?= $row['img_thumbnail']; ?>" alt="<?= $row['title']; ?>" src="<?= $row['default_image']; ?>" />
				</div>
				<div class="pull-left" style="margin-left: 15px;">
					<h3 style="font-size: 18px;"><a style="color: #336699;" href="<?= $url; ?>"><?= $row['title']; ?></a></h3>
					<a style="color: #df384c;" href="<?= $url; ?>">... বিস্তারিত</a>
				</div>
				<div class="clearfix"></div>
			</div>
		</div> */ ?>
                <?php
                $row_counter++;
                $i++;
                if ($row_counter == 3) {
                    echo "</div>";
                    $row_counter = 0;
                    if ($i != $total_releted_blog) echo "<hr class=\"hr-5\" />";
                }
            }
            if ($total_releted_blog % 3 != 0) echo '</div>';
            ?>
        </div>
    </div>
    <?php } ?>
<?php } ?>

<br/>

<?php
$advertisement = cur_advertisement(array("position" => "Details List 1", "enabled" => 1), array("table" => "advertisement", "limit" => 1));
if ($advertisement) echo "{$advertisement}";
?>
<br/>

<?php
$most_readed_total_blog = count($most_readed);
if ($most_readed_total_blog > 0) {
    ?>
    <div id="same-category-most-readed">
        <div class="cat-heading section-title">
            <h3><?php if (isset($category_data['category'])) echo $category_data['category']; ?> বিভাগের সর্বাধিক
                পঠিত</h3>
        </div>
        <div class="row">
            <?php
            $row_counter = 0;
            foreach ($most_readed as $key => $row) {
                $url = site_url("article/{$row['id']}");

                if ($row_counter == 0) echo '<div class="ss">';
                ?>
                <div class="col-xs-12 col-sm-6 col-md-4">
                    <div class="relative-singlepost brltpst">
                        <?php if ($row['type'] == "Video") echo '<div class="show_btn"></div>'; ?>
                         <div class="rsinglepost-img">
                            <a href="<?= $url; ?>">
                                <img class="img-responsive" alt="<?= $row['title']; ?>"
                                src="<?= $row['default_image']; ?>"/>
                            </a>
                         </div>
                        <a href="<?= $url; ?>"><h2 class="news-title brltpst-title"> <?= word_limiter(strip_tags($row['title']), 6, '... '); ?> </h2></a>
                    </div>
                </div>
                <?php
                $row_counter++;
                if ($row_counter == 3) {
                    echo '</div>';
                    $row_counter = 0;
                }
            }

            if ($most_readed_total_blog % 3 != 0) echo '</div>';
            ?>
        </div>
    </div>
<?php } ?>

<link rel="stylesheet" href="<?= base_url(); ?>assets/PgwSlideshow/pgwslideshow.min.css" media="all">
<script type="text/javascript" src="<?= base_url(); ?>assets/PgwSlideshow/pgwslideshow.min.js"></script>
<?php /*
<link rel="stylesheet" href="<?= base_url(); ?>assets/ladda-button/ladda-themeless.min.css" media="all">
<script type="text/javascript" src="<?= base_url(); ?>assets/ladda-button/spin.min.js"></script>
<script type="text/javascript" src="<?= base_url(); ?>assets/ladda-button/ladda.min.js"></script> */ ?>
<style type="text/css">
    .pgwSlideshow .ps-caption {
        font-size: 16px;
    }
</style>
<script type="text/javascript">
    $(document).ready(function () {
        $("#sharejsSocials").jsSocials({
            shares: ["facebook", "googleplus", "twitter", "linkedin"]
        });

        <?php if(is_countable($blog_data['images']) && count($blog_data['images']) > 0) { ?>
        <?php if($blog_data['type'] == 'List') { ?>

        <?php } else { ?>
        $('.pgwSlideshow').pgwSlideshow();
        <?php } ?>
        <?php } ?>

        $('.btn-like').click(function (e) {
            e.preventDefault();
            <?php if($user_id) { ?>
            var id = $(this).data("id");
            jQuery.ajax({
                type: 'GET',
                url: "<?= site_url("ajax/like_dislike_comment"); ?>",
                data: {id: id, blog_id: <?= $blog_data['id']; ?>, like: "like", rand: Math.random()},
                success: function (response) {
                    $("#like-details" + id).html(response.like);
                    $("#dislike-details" + id).html(response.dislike);
                }
            });
            <?php } else { ?>
            alert("Please login to like comment.");
            <?php } ?>
        });

        $('.btn-dislike').click(function (e) {
            e.preventDefault();
            <?php if($user_id) { ?>
            var id = $(this).data("id");
            jQuery.ajax({
                type: 'GET',
                url: "<?= site_url("ajax/like_dislike_comment"); ?>",
                data: {id: id, blog_id: <?= $blog_data['id']; ?>, like: "dislike", rand: Math.random()},
                success: function (response) {
                    $("#like-details" + id).html(response.like);
                    $("#dislike-details" + id).html(response.dislike);
                }
            });
            <?php } else { ?>
            alert("Please login to dislike comment.");
            <?php } ?>
        });

        <?php /*
		$('#comment-submit').click(function(e) {
		 	e.preventDefault();
		 	var l = Ladda.create(this),
		 		f = $("#validate-comment"),
		 		values = f.serializeArray();;
		 	l.start();
		 	
		 	values = jQuery.param(values);
		 	$.post(f.attr("action"), 
		 	    { data : values },
		 	  function(response){
		 	    $("#detailsError").html(response.error);
		 	  }, "json")
		 	.always(function() { l.stop(); });
		 	return false;
		}); */ ?>

        $('#news_details img').each(function () {
            $(this).addClass('img-responsive img-thumbnail');
        });
    });
</script>