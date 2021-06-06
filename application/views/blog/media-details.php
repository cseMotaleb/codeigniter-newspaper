<div style="margin-top: 15px;" class="row">
    <div class="col-md-12">
        <div class="details-head-title">
            <h3><?= $blog_rows['title']; ?></h3>
            <h5>
                <?php
                $month = $this->bangla_week_day->get_monthname(date("F", $blog_rows['time']));
                echo $this->bangla_number->convert(date("d {$month}, Y H:i", $blog_rows['time']));
                ?>
            </h5>
        </div>
        <div class="slider details-items slider-details-items">
            <ul class="pgwSlideshow">
                <?php if (is_countable($blog_image) && count($blog_image) > 0) : ?>
                    <?php foreach ($blog_image as $image) :
                        $image = (!empty($image['image']) && file_exists("./uploads/news/{$image['blog_id']}/{$image['image']}")) ? base_url() . "uploads/news/{$image['blog_id']}/{$image['image']}" : base_url() . "img/blank.jpg";
                        ?>
                        <li>
                            <img class="img-responsive" alt="image" src="<?= $image; ?>"/>
                        </li>
                    <?php endforeach; ?>
                <?php endif; ?>
            </ul>
        </div>
        <p style="padding:5px 0; font-weight: 500;"><?= $blog_rows['details']; ?></p>
    </div>
</div>

<div style="margin-top: 50px;" class="row">
    <div class="col-md-12">
        <div class="breadcrumb2">
            <h5>সাম্প্রতিক ছবিঘর</h5>
        </div>
    </div>
</div>
<?php if (is_countable($all_blog_rows) && count($all_blog_rows) > 0) : $i = 0; ?>
    <?php foreach ($all_blog_rows as $blog) :
        if ($blog_rows['id'] == $blog['id']) {
            continue;
        } else {
            $limit = 1;
            $filters = array(
                'blog_id' => $blog['id']
            );
            $picture_gellary = $this->batch_model->get_rows(array("table" => "blog_images", "limit" => $limit), $filters);

            $image = (!empty($picture_gellary['image']) && file_exists("./uploads/news/{$picture_gellary['blog_id']}/{$picture_gellary['image']}")) ? base_url() . "uploads/news/{$picture_gellary['blog_id']}/{$picture_gellary['image']}" : base_url() . "img/blank.jpg";
            $i++;
            $url = base_url() . 'multimedia/details/' . $blog['id'];
        }
        ?>
        <?php
        if ($i == 1) {
            echo '<div style="margin-top: 15px;" class="row">';
        }
        ?>
        <div class="col-md-3">
            <a href="<?= $url; ?>">
                <div class="image">
                    <img style="width:100%" src="<?= $image; ?>" class="img img-responsive">
                </div>
                <h4><?= $blog['title']; ?></h4>
            </a>
        </div>
        <?php
        if ($i == 4) {
            echo '</div>';
            $i = 0;
            echo "<div class='clear-fix'></div>";
        }
        ?>
    <?php endforeach; ?>
    </div>
<?php endif; ?>

<div class="row" style="margin-top:25px;">
    <div class="col-md-12">
        <div class="panel-footer">
            <?= $pagination; ?>
        </div>
    </div>
</div>


<link rel="stylesheet" href="<?= base_url(); ?>assets/PgwSlideshow/pgwslideshow.min.css" media="all">
<script type="text/javascript" src="<?= base_url(); ?>assets/PgwSlideshow/pgwslideshow.min.js"></script>
<style type="text/css">
    .pgwSlideshow .ps-caption {
        font-size: 16px;
    }

    .breadcrumb2 > h5 {
        background: #222B46;
        padding: 10px;
        font-weight: 600;
        color: #fff;
    }

    .details-head-title > h3 {
        font-weight: 700;
        color: #000;
    }

    .details-head-title > h5 {
        line-height: 25px;
        font-weight: 700;
        color: #000;
    }
</style>
<script type="text/javascript">
    $('.pgwSlideshow').pgwSlideshow();
</script>
