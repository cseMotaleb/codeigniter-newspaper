<?php
$category_url = (isset($category_data['category_url'])) ? site_url("category/{$category_data['category_url']}") : "#";
$category_name = (isset($category_data['category'])) ? $category_data['category'] : "";
$category1_url = (isset($category1_data['category_url'])) ? site_url("category/{$category1_data['category_url']}") : "#";
$category1_name = (isset($category1_data['category'])) ? $category1_data['category'] : "";
?>

<div>
    <div class="row">
        <div class="col-md-8">
            <div class="new-title-renew">
                <div class="title-left-renew">
                    <h4 class="catTitle padding-left">
                        <?php if ($category_name == 'ছবি গ্যালারি') : ?>
                            <a href="multimedia">
                                <?php if (isset($category_name)) echo $category_name; else echo "খেলাধুলা"; ?>
                            </a>
                        <?php else : ?>
                            <a href="">
                                <?php if (isset($category_name)) echo $category_name; else echo "খেলাধুলা"; ?>
                            </a>
                        <?php endif; ?>
                        
                    </h4>
                </div>
            </div>
        </div>
            <div class="clear-fix"></div>

            <?php if (isset($category_data['category']) && $category_data['category'] == "ছবি গ্যালারি") { ?>
                <div class="pic-single-item">
                    <?php
                    $p_category = picture_category();
                    ?>
                    <?php if (is_countable($p_category) && count($p_category) > 0) : ?>
                        <?php foreach ($p_category as $category) :
                            $limit = 1;
                            $filters = array(
                                'blog_id' => $category['id']
                            );
                            $picture_gellary = $this->batch_model->get_rows(array("table" => "blog_images", "limit" => $limit), $filters);

                            $image = (!empty($picture_gellary['image']) && file_exists("./uploads/news/{$picture_gellary['blog_id']}/{$picture_gellary['image']}")) ? base_url() . "uploads/news/{$picture_gellary['blog_id']}/{$picture_gellary['image']}" : base_url() . "img/blank.jpg";
                            $url = base_url() . 'multimedia/details/' . $picture_gellary['blog_id'];
                            ?>
                            <div>
                                <a href="<?= $url; ?>">
                                    <img style="width: 100%;" class="img-responsive img_thumbnail"
                                         src="<?= $image; ?>"/>
                                </a>
                                <h4>
                                    <a style="font-size: 24px;" class="text-primary" href="<?= $url; ?>">
                                        <?= $category['title']; ?>
                                    </a>
                                </h4>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
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
                <div class="row">
                    <?php
                    $total_entertainment = count($entertainment_list);
                    $i = 0;
                    foreach ($entertainment_list as $key => $row) {
                        $url = site_url("article/{$row['id']}");
                        ?>

                        <?php if ($i < 2) { ?>
                            <div class="col-md-6">
                                <a href="<?= $url; ?>">
                                    <img  class="img-responsive <?= $row['img_thumbnail']; ?>"
                                         alt="<?= $row['title']; ?>" src="<?= $row['default_image']; ?>"/>
                                </a>
                                <h4>
                                    <a class="text-primary" href="<?= $url; ?>">
                                        <?= $row['title']; ?>
                                    </a>
                                </h4>

                                <p><?= word_limiter(strip_tags($row['details']), 14, "..."); ?></p>
                            </div>
                        <?php } ?>

                        <?php
                        $i++;
                    } ?>
                </div>
            <?php } ?>
        </div>

        <div class="col-xs-12 col-sm-6 col-md-4">
            <div>
                <?php
                $i = 0;
                foreach ($entertainment_list

                as $key => $row) {
                if (isset($row['id'])) {
                $url = site_url("article/{$row['id']}");
                ?>

                <?php if ($i == 0) { ?>
                <div class="grid-content">

                    <?php if ($row['small_title']) { ?>
                        <small><a  href="<?= $url; ?>"><?= $row['small_title']; ?></a></small>
                    <?php } ?>

                    <!-- <a href="<?= $url; ?>">
							<img style="height: 150px;" class="img-responsive <?= $row['img_thumbnail']; ?>" alt="<?= $row['title']; ?>" src="<?= $row['default_image']; ?>" />
						</a>
						<h4 style="font-size: 16px;">
							<a style="color:#000;font-weight: 600" href="<?= $url; ?>">
								<?= $row['title']; ?>
							</a>
						</h4> -->


                    <ul>
                        <?php } else { ?>
                            <li>
                                <div class="row">
                                    <div  class="col-md-4 col-xs-4">
                                        <img class="img-responsive"
                                             src="<?= $row['default_image']; ?>"/>
                                    </div>
                                    <div class="col-md-8 col-xs-8">
                                        <h4><a href="<?= $url; ?>"><?= word_limiter($row['title'], 4, " ..."); ?></a>
                                        </h4>
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
