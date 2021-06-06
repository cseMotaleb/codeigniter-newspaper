<?php

$category_url = (isset($category_data['category_url'])) ? site_url("category/{$category_data['category_url']}") : "#";
$category_name = (isset($category_data['category'])) ? $category_data['category'] : "";

$category1_url = (isset($category1_data['category_url'])) ? site_url("category/{$category1_data['category_url']}") : "#";
$category1_name = (isset($category1_data['category'])) ? $category1_data['category'] : "";
?>

<div class="gallery-area">
    <div class="new-title-renew">
        <div class="title-left-renew">
            <h4 class="catTitle">
                <?php if ($category_name == 'ছবি গ্যালারি') : ?>
                    <a href="<?= $category_url; ?>">
                        <?php if (isset($category_name)) echo $category_name; else echo "খেলাধুলা"; ?>
                    </a>
                <?php else : ?>
                    <a href="<?= $category_url; ?>">
                        <?php if (isset($category_name)) echo $category_name; else echo "খেলাধুলা"; ?>
                    </a>
                <?php endif; ?>
            </h4>
        </div> 
    </div>
        <div class="row">
            <?php if (isset($category_data['category']) && $category_data['category'] == "ছবি গ্যালারি") { ?>
            <div class="col-xs-12 col-sm-12 col-md-8">
                <div class="pic-single-item">
                    <?php
                    $p_category = picture_category();
                    $limit = 4;
                    $filters = array(
                        'blog_id' => $p_category['id']
                    );
                    $picture_gellary = $this->batch_model->get_rows(array("table" => "blog_images", "limit" => $limit, "order_by" => "id", "order_type" => "desc"), $filters);
                    ?>
                    <?php if (is_countable($picture_gellary) && count($picture_gellary) > 0) : ?>
                        <?php foreach ($picture_gellary as $gellary) :
                            $image = (!empty($gellary['image']) && file_exists("./uploads/news/{$gellary['blog_id']}/{$gellary['image']}")) ? base_url() . "uploads/news/{$gellary['blog_id']}/{$gellary['image']}" : base_url() . "img/blank.jpg";
                            $url = site_url("article/{$gellary['blog_id']}");
                            ?>
                            <div>
                                <a href="<?= $url; ?>">
                                    <img class="img img-responsive img_thumbnail lazyload"
                                         data-src="<?= $image; ?>"/>
                                </a>
                                <!-- <h4>
								<a style="font-size: 24px;" class="text-primary" href="<?= $url; ?>">
									<?php //echo $category['title']; ?>
								</a>
							</h4> -->
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
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
                <?php
                $picture_slide = $this->blog_model->most_readed(array("blog.enabled" => 1, "blog.type" => "Gallery"), $limit = 2, array("latest_news" => 1));
                ?>
                <?php foreach ($picture_slide as $picture) :
                    $url = site_url("article/{$picture['id']}");

                    $default_image = newsDefaultImage($picture, array('imgwidth' => 168, 'imgheight' => 107));

                    ?>
                    <div class="col-xs-6 col-sm-6 col-md-4">
                        <div class="gallery-img">
                            <a href="<?= $url; ?>"><img data-src="<?= $default_image; ?>" class="img img-responsive lazyload">
                            </a>
                        </div>
                        <h4 class="news-title">
                            <a class="text-primary" href="<?= $url; ?>">
                                  <?= word_limiter($picture['title'], 5, " ..."); ?>
                            </a>
                        </h4>
                    </div>
                <?php endforeach; ?>
           
            <?php } else { ?>
            <?php
            $total_entertainment = count($entertainment_list);
            $i = 0;
            foreach ($entertainment_list

            as $key => $row) {
            $url = site_url("article/{$row['id']}");
            ?>

            <?php if ($i == 0) { ?>
                <div class="row">
                    <div class="col-xs-6 col-sm-6 col-md-6">
                        <a href="<?= $url; ?>">
                            <img class="img-responsive <?= $row['img_thumbnail']; ?>"
                            alt="<?= $row['title']; ?>" src="<?= $row['default_image']; ?>"/>
                        </a>
                    </div>
                    <div class="col-xs-6 col-sm-6 col-md-5">
                        <h4>
                            <a href="<?= $url; ?>">
                                <?= word_limiter($row['title'], 8, " ..."); ?>
                            </a>
                        </h4>

                        <p><?= word_limiter(strip_tags($row['details']), 14, "..."); ?></p>

                        <div class="text-right">
                            <a class="btn btn-xs btn-default"  href="<?= $url; ?>">বিস্তারিত</a>
                        </div>
                    </div>
                
            <?php } else { ?>

                <?php if ($i == 1) echo '<div class="row">'; ?>
                <div class="col-xs-6 col-sm-4 col-md-4">
                    <div class="gallery-img">
                        <a href="<?= $url; ?>">
                            <img class="img-responsive <?= $row['img_thumbnail']; ?>"
                                 alt="<?= $row['title']; ?>" src="<?= $row['default_image']; ?>"/>
                        </a>
                    </div>
                    <small><?= $row['small_title']; ?></small>
                    <h4 class="news-title">
                        <a href="<?= $url; ?>">
                            <?= word_limiter($row['title'], 3, " ..."); ?>
                        </a>
                    </h4>
                </div>
                <?php if ($i == 3) echo '</div>'; ?>

            <?php } ?>

                <?php
                $i++;
            } ?>
            <?php } ?>

        </div>
     
           <!--  <div class="col-xs-12 col-sm-4 col-md-4">
                <div class="gallery-ads">
                <?php
                $advertisement = cur_advertisement(array("position" => "Right Sidebar 2", "enabled" => 1), array("table" => "advertisement", "limit" => 1));
                if ($advertisement) echo "{$advertisement}<br />";
                ?>
                <br/>
                <?php
                $advertisement = cur_advertisement(array("position" => "Right Sidebar 2", "enabled" => 1), array("table" => "advertisement", "limit" => 1));
                if ($advertisement) echo "{$advertisement}<br />";
                ?>
            </div>
        </div> -->
    
    </div>
