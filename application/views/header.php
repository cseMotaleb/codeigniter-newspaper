<?php
$cover_image = get_rows(array("table" => "media", "limit" => 1), array("type" => "Slider Image"));
$cover_image = (isset($cover_image['id']) && file_exists("./{$cover_image['url']}")) ? base_url() . "{$cover_image['url']}" : base_url() . "img/cover.png";
?>
    <div class="container">
        <div id="top-header">
            <div class="row">
                <div class="col-xs-12 col-sm-6 col-md-6">
                    <ul class="top-menu">
                        <li>বাংলাদেশ</li>
                        <li>  
                            <?php
                            $date = $this->bangladate->get_date();
                            $week_day = $this->bangla_week_day->get_dayname();
                            $today = date("d");
                            $getMonth = $this->bangla_week_day->get_monthname(date("F"));
                            $toYear = date("Y");
                            $today_date = $today . " " . $getMonth . " " . $toYear;
                            //echo "বাংলাদেশ {$week_day} {$today_date} - {$date[0]}, {$date[1]}, {$date[2]}";
                            echo "{$week_day} {$today_date} - {$date[0]}, {$date[1]}, {$date[2]}";
                            ?>    
                        </li>
                    </ul>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-6">
                    <ul class="topheader-socail-menu">
                        <li><a href="<?= $company_config['facebook']; ?>"><i class="fab fa-facebook-f"></i></a></li> 
                        <li><a href="<?= $company_config['twitter']; ?>"><i class="fab fa-twitter"></i></a></li> 
                        <li><a href="<?= $company_config['youtube']; ?>"><i class="fab fa-youtube"></i></a></li>
                        <li><a href="<?= $company_config['linkedin']; ?>"><i class="fab fa-linkedin-in"></i></a></li>
                        <li><a href="mailto:<?= $company_config['company_email']; ?>"><i class="far fa-envelope-open"></i></a></li>
                        
                    </ul>
                </div>
            </div>
        </div>
    </div>



<div id="mobile_header" class="visible-xs">
    <div class="row">
        <div class="col-xs-2">
            <div class="m-top">
                <div class="cat_collapse_bar"><i class="fa fa-bars fa-lg"></i></div>
            </div>
        </div>
        <div class="col-xs-10">
            <div class="text-center">
                <a class="text-center" href="<?= base_url(); ?>">
                    <img class="img-responsive center logo-image" alt="Logo" src="<?= $cover_image; ?>"/>
                </a>
            </div>
        </div>
    </div>
</div>

<div class="visible-xs">
    <?php $top_menu = top_menu(array("parent_id" => 0, "enabled" => 1, "main_menu" => 1));
    echo $top_menu['mobile']; ?>
</div>


