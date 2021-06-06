<?php
$category_url = (isset($category_data['category_url'])) ? site_url("category/{$category_data['category_url']}") : "#";
$category_name = (isset($category_data['category'])) ? $category_data['category'] : "";
$category1_url = (isset($category1_data['category_url'])) ? site_url("category/{$category1_data['category_url']}") : "#";
$category1_name = (isset($category1_data['category'])) ? $category1_data['category'] : "";
?>
<div class="sports-wrap">
    <div class="new-title-renew">
        <div class="title-left-renew">
            <h4 class="catTitle">
                <?php if ($category_name == 'ছবি গ্যালারি') : ?>
                    <a href="#">
                        <?php if (isset($category_name)) echo $category_name; else echo "খেলাধুলা"; ?>
                    </a>
                <?php elseif ($category_name == 'খেলা') : ?>
                    <a href="#">
                        <?php if (isset($category_name)) echo $category_name; else echo "খেলাধুলা"; ?>
                      

                <?php elseif ($category_name == 'বিনোদন') : ?>
                    <a href="#">
                        <?php if (isset($category_name)) echo $category_name; else echo "খেলাধুলা"; ?>
                       

                <?php else : ?>
                    <a href="#">
                        <?php if (isset($category_name)) echo $category_name; else echo "খেলাধুলা"; ?>
                    </a>
                  
                <?php endif; ?>
               
            </h4>
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
                                <img class="img-responsive img_thumbnail lazyload" data-src="<?= $image; ?>"/>
                            </a>
                            <h4>
                                <a class="text-primary" href="<?= $url; ?>">
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
                    $news_category = $this->blog_model->news_category($row['id']);         
                    $default_image = newsDefaultImage($row, array('imgwidth' => 260, 'imgheight' => 140));
                ?>

                <div class="col-xs-6 col-sm-6 col-md-4">
                    <div class="thumbnails single-sport">
                        <div class="c-image">
                            <a href="<?= $url; ?>">
                                <img  class="img-responsive center lazyload"
                                     alt="<?= $row['title']; ?>" data-src="<?= $default_image; ?>"/>
                            </a>
                        </div>
                        <div class="caption selected-cap">
                            <h4 class="news-title">
                                <a href="<?= $url; ?>"><?= word_limiter($row['title'], 4, " ..."); ?></a>
                            </h4>
                        </div>
                    </div>
                </div>
                <?php
                $i++;
                ?>
               
                <?php
            } ?>
            </div>
        <?php } ?>
   

</div>

