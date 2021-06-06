<?php include("pageview-counter.php"); ?>
<?php
$footer_blog = footer_blog(array("blog.enabled" => 1, "blog.type" => "List", "blog_groups.category" => "ক্রাইম রিপোর্ট"), array("limit" => 12));
$cat_url = (isset($footer_blog[0]['category_url'])) ? site_url("category/{$footer_blog[0]['category_url']}") : "#";

?>
<?php
$cover_image = get_rows(array("table" => "media", "limit" => 1), array("type" => "Slider Image"));
$cover_image = (isset($cover_image['id']) && file_exists("./{$cover_image['url']}")) ? base_url() . "{$cover_image['url']}" : base_url() . "img/cover.png";
?>

<div class="footer-wrap">
    <div class="container-content">
        <div id="footer">
            <?php /*
			<div class="new-title">
				<div class="title-left">
					<a href="<?= $cat_url; ?>">
						ক্রাইম রিপোর্ট
					</a>
				</div>
				<div class="title-border"></div>
			</div>
			<div class="clear-fix"></div>

			<div style="padding: 30px;" class="footer-2">
				<div class="slider multiple-items">
		    		<?php
		    		$total_news = count($footer_blog);
					$i = 0;
		    		foreach ($footer_blog as $key => $row) {
		    			$url = site_url("article/{$row['id']}");
		    		?>
		    		<div class="slick-item">
		    			<?php if($row['type'] == "Video") echo '<div class="show_btn"></div>'; ?>
			    		<img style="height: 120px;" class="img-responsive" alt="<?= $row['title']; ?>" src="<?= $row['default_image']; ?>" />
			    		<h4>
			    			<a href="<?= $url; ?>"><?= $row['title']; ?></a>
			    		</h4>
			    	</div>
		    		<?php } ?>
				</div>
				
				<?php
					$advertisement = cur_advertisement(array("position"=>"Footer", "enabled"=>1), array("table"=>"advertisement", "limit"=>1));
					if($advertisement) echo "<br />{$advertisement}";
				?>
				
				<div class="row">
					<div class="col-md-6">
						<?php
							$advertisement = cur_advertisement(array("position"=>"Footer Small 1", "enabled"=>1), array("table"=>"advertisement", "limit"=>1));
							if($advertisement) echo "<br />{$advertisement}<br />";
						?>
					</div>
					<div class="col-md-6">
						<?php
							$advertisement = cur_advertisement(array("position"=>"Footer Small 2", "enabled"=>1), array("table"=>"advertisement", "limit"=>1));
							if($advertisement) echo "<br />{$advertisement}<br />";
						?>
					</div>
				</div>
			</div> */ ?>

            <div class="footer-hass">
                <?php /*
				<div class="new-title">
					<div class="title-left">
						<a href="#">
							জনপ্রিয় বিষয় সমূহ
						</a>
					</div>
					<div class="title-border"></div>
				</div>
				<div class="clear-fix"></div>
			
				<div style="padding: 20px;" class="footer-2" id="footer-2">
					<div class="row">
						<div class="col-md-2 col-xs-6">
							<?php if(isset($footer_1['description'])) echo $footer_1['description']; ?>
						</div>
						<div class="col-md-2 col-xs-6">
							<?php if(isset($footer_2['description'])) echo $footer_2['description']; ?>
						</div>
						<div class="col-md-2 col-xs-6">
							<?php if(isset($footer_3['description'])) echo $footer_3['description']; ?>
						</div>
						<div class="col-md-2 col-xs-6">
							<?php if(isset($footer_4['description'])) echo $footer_4['description']; ?>
						</div>
						<div class="col-md-2 col-xs-6">
							<?php if(isset($footer_5['description'])) echo $footer_5['description']; ?>
						</div>
						<div class="col-md-2 col-xs-6">
							<?php if(isset($footer_6['description'])) echo $footer_6['description']; ?>
						</div>
					</div>
				</div> */ ?>

                <div class="foot-2x-bd"></div>

                <!--time-tune24-family-->
                <div class="main-footer">
                    <div class="footer-one">
                        <div class="container">
                            <div class="row">
                            	<div class="col-xs-12 col-sm-6 col-md-6">
                            		<div class="footer-logo">
                                       <a href="<?= base_url(); ?>"> <img class="img img-responsive center" alt="footer logo"
                                             src="<?= $cover_image; ?>"/></a>
                                    </div>
                            	</div>
                            	<div class="col-xs-12 col-sm-6 col-md-4">
                            		 <div class="form-group subscribe">
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="exampleInputAmount"
                                                   placeholder="Email Address">
                                            <div class="input-group-addon input-addon-c">সাবস্ক্রাইব</div>
                                        </div>
                                         </div>
                            	</div>

                               
                            </div>
                        </div>
                    </div>
                    <div class="footer-two">
                        <div class="container">
                            <?php
                            $top_menu = $this->blog_model->categories(array("bottom_menu" => 1, "enabled" => 1));

                            $i = 0;
                            $count = 0;
                            ?>
                            <div class="row">
                                <?php if (is_countable($top_menu) && count($top_menu) > 0): ?>
                                    <?php foreach ($top_menu as $fmenu) :
                                        $url = base_url() . 'category/' . $fmenu['category_url'];
                                        $i++;
                                        $count++;
                                        if ($count == 19) {
                                            break;
                                        }
                                        if ($i == 1) {
                                            echo "<div class='col-xs-6 col-sm-4 col-md-2'>";
                                        }
                                        ?>
                                        <ul class="footer_menu">
                                            <li>
                                                <a href="<?= $url; ?>"><?= $fmenu['category'];; ?></a>
                                            </li>
                                        </ul>
                                        <?php
                                        if ($i == 3) {
                                            echo "</div>";
                                            $i = 0;
                                        }
                                        ?>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <div class="footer-three">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="footer-end-author">
                                        <?php if (isset($footer_address_1['description'])) echo $footer_address_1['description']; ?>
                                    </div>
                                    <div class="footer-end-author">
                                        <?php if (isset($footer_address_2['description'])) echo $footer_address_2['description']; ?>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="footer-end-author visitor">
                                        <p>Total Visitor List :
                                            <strong><?= pageview_counter(); ?></strong></p>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="social-media">
                                        <div class="fb-page" data-href="<?= $company_config['facebook']; ?>"
                                             data-small-header="false" data-adapt-container-width="true"
                                             data-hide-cover="false" data-show-facepile="true">
                                            <div class="fb-xfbml-parse-ignore">
                                                <blockquote cite="<?= $company_config['facebook']; ?>"><a
                                                            href="<?= $company_config['facebook']; ?>"><?= $company_config['company_name']; ?></a>
                                                </blockquote>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div><!--end footer-->
    </div>
</div>
