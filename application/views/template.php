<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$meta_title = (!empty($page['meta_title'])) ? $page['meta_title'] : $this->config->item("meta_title");
$meta_keyword = (!empty($page['meta_keyword'])) ? $page['meta_keyword'] : $this->config->item("meta_keyword");
$meta_description = (!empty($page['meta_description'])) ? $page['meta_description'] : $this->config->item("meta_description");
$canonical_url = (!empty($page['url'])) ? base_url() . $page['url'] : base_url();
$meta_image = (isset($page['meta_image']) && !empty($page['meta_image'])) ? $page['meta_image'] : "";
$meta_type = (isset($page['type']) && !empty($page['type'])) ? $page['type'] : "";
?>
<!doctype html>
<html>
<head prefix="og: http://ogp.me/ns#">
    <title><?= $meta_title; ?></title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Language" content="bn"/>
    <meta name="google" content="notranslate"/>
    <meta name="robots" content="index, follow">
    <meta name="distribution" content="Global"/>
    <meta name="rating" content="General"/>
    <meta name="revisit-after" content="21 days"/>
    <meta name="classification" content="Newspaper, Artical, Bangladesh News Portal"/>
    <?php metaAuthor() ?>

    <meta name="keywords" content="<?= $meta_keyword; ?>"/>
    <meta name="description" content="<?= $meta_description; ?>"/>
    <link rel="icon" href="<?= site_url('img/favicon.png'); ?>">
    <meta property="fb:app_id" content="731516030320292"/>
    <meta property="og:url" content="<?= $canonical_url; ?>"/>
    <meta property="og:title" content="<?= $meta_title; ?>"/>
    <meta property="og:description" content="<?= $meta_description; ?>"/>
    <?php
    if ($meta_image) {
        list($width, $height) = getimagesize($meta_image);
        if (($width > 200) && ($height > 200)) {
            ?>
            <meta property="og:type" content="article"/>
            <meta property="og:image" content="<?= $meta_image; ?>"/>
        <?php } else { ?>
            <meta property="og:type" content="website"/>
            <meta property="og:image" content="<?= base_url(); ?>img/t-icon.png"/>
        <?php }
    } else { ?>
        <meta property="og:type" content="website"/>
        <meta property="og:image" content="<?= base_url(); ?>img/t-icon.png"/>
    <?php }


    include 'js.php';
    ?>

    <?php if (isset($segment) && ($segment == "welcome")) {
        echo link_tag($siteDir . 'css/slider.min' . $cs);
        ?>
        <script type="text/javascript">
            $(document).ready(function () {
                var totalSlider = $('.oim-slider li').length;
                var currentSlider = 1;
                var timeDuration = 800;
                var liWidth = $('.oim-slider li').width();
                var navigation = '<div class="oim-navigation"><ul>';
                for (var i = 0; i < totalSlider; i++)
                    navigation = navigation + '<li></li>';
                navigation = navigation + '</ul></div>';
                $('.oim-wrapper').append('<img class="oim-previous" src="<?= base_url(); ?>img/left.jpg" />');
                $('.oim-wrapper').append('<img class="oim-next" src="<?= base_url(); ?>img/right.jpg" />');
                $('.oim-wrapper').append(navigation);
                $('.oim-navigation li:nth-child(1)').addClass('active');
                $('.oim-previous').hover(function () {
                    $(this).attr("src", "<?= base_url(); ?>img/oim-slider-previous-active.png");
                }, function () {
                    $(this).attr("src", "<?= base_url(); ?>img/left.jpg");
                });
                $('.oim-next').hover(function () {
                    $(this).attr("src", "<?= base_url(); ?>img/oim-slider-next-active.png");
                }, function () {
                    $(this).attr("src", "<?= base_url(); ?>img/right.jpg");
                });

                $('.oim-previous').click(function () {
                    if (currentSlider > 1) {
                        $('.oim-slider').animate({
                            left: '+=' + liWidth + 'px'
                        }, timeDuration);
                        $('.oim-navigation li:nth-child(' + currentSlider + ')').removeClass('active');
                        currentSlider = currentSlider - 1;
                        $('.oim-navigation li:nth-child(' + currentSlider + ')').addClass('active');
                    } else {
                        $('.oim-slider').css({
                            left: '-' + (liWidth * (totalSlider - 1)) + 'px'
                        });
                        $('.oim-navigation li:nth-child(' + currentSlider + ')').removeClass('active');
                        currentSlider = totalSlider;
                        $('.oim-navigation li:nth-child(' + currentSlider + ')').addClass('active');
                    }
                });

                $('.oim-next').click(function () {
                    if (currentSlider < totalSlider) {
                        $('.oim-slider').animate({
                            left: '-=' + liWidth + 'px'
                        }, timeDuration);
                        $('.oim-navigation li:nth-child(' + currentSlider + ')').removeClass('active');
                        currentSlider = currentSlider + 1;
                        $('.oim-navigation li:nth-child(' + currentSlider + ')').addClass('active');
                    } else {
                        $('.oim-slider').css({
                            left: '0px'
                        });
                        $('.oim-navigation li:nth-child(' + currentSlider + ')').removeClass('active');
                        currentSlider = 1;
                        $('.oim-navigation li:nth-child(' + currentSlider + ')').addClass('active');
                    }
                });

                $('.oim-navigation li').click(function () {
                    var navigationClick = $(this).index() + 1;
                    if (currentSlider != navigationClick) {
                        if (currentSlider > navigationClick) {
                            var move = currentSlider - navigationClick;
                            $('.oim-slider').animate({
                                left: '+=' + (liWidth * (move)) + 'px'
                            }, timeDuration);
                        } else {
                            var move = navigationClick - currentSlider;
                            $('.oim-slider').animate({
                                left: '-=' + (liWidth * (move)) + 'px'
                            }, timeDuration);
                        }
                        $('.oim-navigation li:nth-child(' + currentSlider + ')').removeClass('active');
                        $('.oim-navigation li:nth-child(' + navigationClick + ')').addClass('active');
                        currentSlider = navigationClick;
                    }
                });
                var time;

                function startOIMSlider() {
                    if (currentSlider < totalSlider) {
                        $('.oim-slider').animate({
                            left: '-=' + liWidth + 'px'
                        }, timeDuration);
                        $('.oim-navigation li:nth-child(' + currentSlider + ')').removeClass('active');
                        currentSlider = currentSlider + 1;
                        $('.oim-navigation li:nth-child(' + currentSlider + ')').addClass('active');
                    } else {
                        $('.oim-slider').css({
                            left: '0px'
                        });
                        $('.oim-navigation li:nth-child(' + currentSlider + ')').removeClass('active');
                        currentSlider = 1;
                        $('.oim-navigation li:nth-child(' + currentSlider + ')').addClass('active');
                    }
                    clearTimeout(time);
                    time = setTimeout(function () {
                        startOIMSlider()
                    }, 5000);
                }

                time = setTimeout(function () {
                    startOIMSlider()
                }, 5000);
                $('.oim-wrapper').hover(function () {
                    clearTimeout(time);
                }, function () {
                    time = setTimeout(function () {
                        startOIMSlider()
                    }, 5000);
                });
            });
        </script>
    <?php } ?>

<!--    <script async src="--><?//= site_url($ast . 'cdn-draft/gtagjs.js') ?><!--"></script>-->
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <!--    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-124217859-1"></script>-->
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }

        gtag('js', new Date());

        gtag('config', 'UA-124217859-1');
    </script>

    <!--  from css.php-->
    <?php
    include 'css.php';
    ?>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@300;400;700;900&family=Mina:wght@700&display=swap" rel="stylesheet">
</head>
<body>
<?php include 'fb-root.php'; ?>

<?php include 'header.php'; ?>

<div class="nav-menu sticky-top">
    <?php $top_menu = top_menu(array("parent_id" => 0, "main_menu" => 1, "enabled" => 1));
    echo $top_menu['all']; ?>
</div>
  
<div class="c-background">
    <div class="container">
        <div class="container-content">
            <!--end top_header row-->
                    <?php
                    $justinnews = $this->config->item("just_in_news");
                    if ($justinnews) {
                        ?>
                       
                        <div class="widget_color_" id="widget_18473">
                            <div class="pa_breaking_news_widget widget">
                                <div class="breaking_light_blue" id="widget18473">
                                    <div class="break_news_caption">এই মাত্র :</div>
                                    <div title="Close breaking news" class="break_close"><span>&nbsp;</span></div>
                                    <div class="break_news">
                                        <marquee truespeed="" scrolldelay="30" scrollamount="2" direction="left"
                                                 behavior="scroll" align="top">
                                            <?= $justinnews; ?>
                                        </marquee>
                                    </div>
                                </div>
                                <script type="text/javascript">
                                    $('.break_close').click(function () {
                                        $("#widget_18473").hide();
                                    });
                                </script>
                            </div>
                        </div>
                    <?php } ?>


                    <!-- <div class="ticker_widget widget">
                        <div class="ticker_holder" id="ticker_widget_47647">
                            <div class="ticker_heading">
                                শিরোনাম :
                            </div>
                            <div class="ticker_slider widget_marquee">
                                <marquee class="headingnews" truespeed="truespeed" scrolldelay="50" scrollamount="1"
                                         direction="up" align="top" onmouseover="this.stop();"
                                         onmouseout="this.start();">
                                    <?php $top_letest_news = top_letest_news(array("blog.enabled" => 1, "blog.recent" => 1), 8); ?>
                                    <?= $top_letest_news; ?>
                                </marquee>
                            </div>
                        </div>
                    </div> -->

                    <script type="text/javascript">
                        $('.headingnews').mouseover(function () {
                            $(this).attr('scrollamount', 0);
                        }).mouseout(function () {
                            $(this).attr('scrollamount', 1);
                        });
                    </script>
               
               
            
            <div class="adds-wrap">
            <div class="row">
                <div class="col-md-12 text-center">
                    <div class="headerbottom-adds">
                        <?php
                        $advertisement = cur_advertisement(array("position" => "Home List 1", "enabled" => 1), array("table" => "advertisement", "limit" => 1));
                        if ($advertisement) echo "{$advertisement}";
                        ?>
                    </div>
                </div>
            </div>
            </div>
            <div class="row">
                <?php if (isset($right_side) && $right_side === FALSE) { ?>
                    <div class="col-md-12">
                        <?php if (isset($segment)) $this->load->view($segment); elseif (isset($content)) echo $content; ?>
                    </div>
                <?php } else { ?>
                    <div class="col-md-8">
                        <?php if (isset($blog_data['user_id'])) { ?>
                            <?php
                            if ($blog_data['publisher']) {
                                $userdata = get_rows(array("table" => "users", "limit" => 1), array("id" => $blog_data['user_id']));
                                if (isset($userdata['id'])) {
                                    $image = ($userdata['image'] && (file_exists("./uploads/agents/{$userdata['image']}"))) ? base_url() . "uploads/agents/{$userdata['image']}" : "";
                                    ?>
                                    <div class="pull-left">
                                        <?php if ($image) { ?>
                                            <img style="width: 38px; height: 38px;" class="img-responsive"
                                                 src="<?= $image; ?>"/>
                                        <?php } else { ?>
                                            <i style="font-size: 38px;" class="fa fa-user"></i>
                                        <?php } ?>
                                    </div>
                                    <div class="pull-left">
                                        <div style="margin-left: 5px; <?php if (empty($blog_data['publisher_title'])) echo "margin-top: 10px;"; ?>">
                                            <p style="color: #000;">
                                                <?= $userdata['first_name'] . " " . $userdata['last_name']; ?>
                                                <?php if (!empty($blog_data['publisher_title'])) echo "<br />{$blog_data['publisher_title']}"; ?>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                <?php }
                            } ?>
                        <?php } ?>

                        <?php if (isset($blog_data['user_id'])) { ?>
                            <div class="pull-left">
                                <?php if (isset($breadcrumb)) { ?>
                                    <div class="btn-group btn-breadcrumb">
                                        <a href="<?= base_url(); ?>" class="btn btn-default">প্রচ্ছদ</a>
                                        <?= $breadcrumb; ?>
                                    </div>
                                <?php } ?>
                            </div>
                            <div class="pull-right">
                                <a target="_blank"
                                   href="<?php if (isset($page['url'])) echo site_url($page['url']); ?>?print=print"
                                   class="btn btn-default"><i class="fa fa-print"></i> প্রিন্ট</a>
                            </div>
                            <div class="clearfix"></div>
                        <?php } else { ?>
                            <?php if (isset($breadcrumb)) { ?>
                                <div class="btn-group btn-breadcrumb">
                                    <a href="<?= base_url(); ?>" class="btn btn-default"><i
                                                class="fa fa-home"></i></a>
                                    <a href="<?= base_url(); ?>" class="btn btn-default">প্রচ্ছদ</a>
                                    <?= $breadcrumb; ?>
                                </div>
                            <?php } ?>
                        <?php } ?>

                        <?php if (isset($segment)) $this->load->view($segment); elseif (isset($content)) echo $content; ?>

                        <!--Start Ads secation-->
                        <div class="h-ads">
                            <div class="row">
                                <div class="col-xs-12 col-sm-6 col-md-6">
                                <?php
                                    $advertisement = cur_advertisement(array("position" => "Home List 2", "enabled" => 1), array("table" => "advertisement", "limit" => 1));
                                    if ($advertisement) echo "<br />{$advertisement}";
                                ?>
                                </div>
                                <div class="col-xs-12 col-sm-6 col-md-6">
                                    <?php
                                        $advertisement = cur_advertisement(array("position" => "Home List 2", "enabled" => 1), array("table" => "advertisement", "limit" => 1));
                                        if ($advertisement) echo "<br />{$advertisement}";
                                    ?>
                                </div>
                            </div>
                        </div><!--End Ads secation-->

                         <!--Start Internation secation-->
                        <div class="internation-wrap">
                            <div class="row">
                                <div class="col-xs-12 col-sm-6 col-md-6">
                                    <div class="title-left-renew">
                                        <h4 class="catTitle">
                                            <a href="#">
                                               আন্তর্জাতিক
                                            </a>
                                        </h4>
                                    </div> 

                                    <div class="main_internation">
                                        <?= grid_style(array("আন্তর্জাতিক"), array("limit" => 5, "image_show" => 1)); ?>
                                    </div>
                                </div>

                                <div class="col-xs-12 col-sm-6 col-md-6">
                                    <div class="rajnithi-area">
                                         <div class="title-left-renew">
                                        <h4 class="catTitle">
                                            <a href="#">
                                               আইন আদালত
                                            </a>
                                        </h4>
                                    </div> 
                                       <?= grid_style_custom(array("রাজনীতি"), array("limit" => 5, "image_show" => 1)); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--End Internation secation-->

                        <!--Start Play secation-->
                            
                            <?= play_list_style(array("category" => "খেলা", "limit" => 8)); ?>
                           
                        <!--End Play secation-->

                            <!--Start ads secation-->
                            <!-- <div class="h-ads">
                                <div class="row">
                                    <div class="col-xs-12 col-sm-6 col-md-6">
                                        <?php
                                        $advertisement = cur_advertisement(array("position" => "Home List 3", "enabled" => 1), array("table" => "advertisement", "limit" => 1));
                                        if ($advertisement) echo "<br />{$advertisement}";
                                        ?>
                                    </div>
                                    <div class="col-xs-12 col-sm-6 col-md-6">
                                        <?php
                                        $advertisement = cur_advertisement(array("position" => "Home List 3", "enabled" => 1), array("table" => "advertisement", "limit" => 1));
                                        if ($advertisement) echo "<br />{$advertisement}";
                                        ?>
                                    </div>
                                </div>
                            </div> --><!--End ads secation-->

                        

                            <!--Start ads secation-->
                            <div class="international-wrap">
                                <div class="ads-area h-ads">
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-6 col-md-6">
                                            <?php
                                            $advertisement = cur_advertisement(array("position" => "Home List 4", "enabled" => 1), array("table" => "advertisement", "limit" => 1));
                                            if ($advertisement) echo "<br />{$advertisement}";
                                            ?>
                                        </div>
                                        <div class="col-xs-12 col-sm-6 col-md-6">
                                            <?php
                                            $advertisement = cur_advertisement(array("position" => "Home List 4", "enabled" => 1), array("table" => "advertisement", "limit" => 1));
                                            if ($advertisement) echo "<br />{$advertisement}";
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div> <!--End ads secation-->

                            <!--Start Entertainment secation-->
                            <?= play_list_style(array("category" => "বিনোদন", "limit" => 8)); ?>
                            <!--End Entertainment secation-->
                                                                                   
                            <div class="h-ads ads-pbottom">
                                <div class="row">
                                    <div class="col-xs-12 col-sm-6 col-md-6">
                                        <?php
                                        $advertisement = cur_advertisement(array("position" => "Home List 5", "enabled" => 1), array("table" => "advertisement", "limit" => 1));
                                        if ($advertisement) echo "<br />{$advertisement}";
                                        ?>
                                    </div>
                                    <div class="col-xs-12 col-sm-6 col-md-6">
                                        <?php
                                        $advertisement = cur_advertisement(array("position" => "Home List 5", "enabled" => 1), array("table" => "advertisement", "limit" => 1));
                                        if ($advertisement) echo "<br />{$advertisement}";
                                        ?>
                                    </div>
                                </div>
                            </div>

                            <!--History and vote category-->
                            <div class="row">
                            <?= grid_style_bottom(array("ইতিহাস ঐতিহ্য", "ভোটের মাঠে"), array("limit" => 5,)); ?>
                        </div>
                            <!--History category-->

                            <!--Environment and lifestyle category-->
                            <div class="row">
                            <?= grid_style_bottom(array( "প্রকৃতি ও পরিবেশ", "লাইফস্টাইল"), array("limit" => 5,)); ?>
                        </div>
                            <!--Environment and lifestyle category-->

                          <!-- <div class="hs-ads">
                                <div class="col-xs-12 col-sm-6 col-md-6">
                                    <?php
                                    $advertisement = cur_advertisement(array("position" => "Home List 6", "enabled" => 1), array("table" => "advertisement", "limit" => 1));
                                    if ($advertisement) echo "<br />{$advertisement}";
                                    ?>
                                </div>
                                <div class="col-xs-12 col-sm-6 col-md-6">
                                    <?php
                                    $advertisement = cur_advertisement(array("position" => "Home List 6", "enabled" => 1), array("table" => "advertisement", "limit" => 1));
                                    if ($advertisement) echo "<br />{$advertisement}";
                                    ?>
                                </div>
                            </div>    -->

                            <!--- Gallery --->
                            <?= picture_list_style(array("category" => "ছবি গ্যালারি", "limit" => 4,)); ?>
                             <!--- Gallery --->

                            <div class="col-md-12">
                                <?php
                                $advertisement = cur_advertisement(array("position" => "Home List 7", "enabled" => 1), array("table" => "advertisement", "limit" => 1));
                                if ($advertisement) echo "<br />{$advertisement}";
                                ?>
                            </div>


                  
                </div><!--End Col-md-8-->

                    <div class="col-xs-12 col-sm-12 col-md-4 mobile-padding-5">
                        <div class="sidebar-widget">
                            <?php if (isset($right_side)) $this->load->view($right_side); else include 'right-side.php'; ?>
                        </div>
                    </div>
                <?php } ?>
            </div>
            <div class="clear-fix"></div>
           
        </div>
    </div>
</div>


<?php include 'footer.php'; ?>


<script>
    $(document).ready(function () {
        $('#facebook_likebox').slideDown(5500);
        $('#closefacebook_likebox').click(function () {
            $(this).fadeOut();
            $('#facebook_Likebox').css('display', 'none');
            $('#facebook_likebox').slideUp(5500);
        });

        $('body').click(function () {
            $('#facebook_likebox').slideUp(5500);
        });
    });
</script>
<div class="only-large">
    <div id="facebook_likebox">
        <div>
            <span id="closefacebook_likebox">
                <img  src="<?= base_url(); ?>img/close.gif" border="0"/>
            </span>
        </div>

        <div>
            <div class="fb-page" data-href="<?= $company_config['facebook']; ?>" data-small-header="true"
                 data-adapt-container-width="false" data-hide-cover="false" data-show-facepile="true">
                <blockquote cite="<?= $company_config['facebook']; ?>" class="fb-xfbml-parse-ignore"><a
                            href="<?= $company_config['facebook']; ?>">mancitra24.com</a></blockquote>
            </div>
        </div>
    </div>
</div>
<input type="hidden" name="base_url" id="base_url" value="<?= base_url(); ?>"/>


<script type="text/javascript">
    $(document).ready(function () {
        jQuery(".header_top_menu li a").each(function () {
            if ($(this).attr("href") == window.location) $(this).addClass("active");
        });

        jQuery("#footer-2 > div > div > ul > li > a").each(function () {
            jQuery(this).prepend('<i class="fa fa-angle-right"></i> ');
        });

        $('.multiple-items').slick({
            infinite: true,
            slidesToShow: 5,
            slidesToScroll: 2,
            autoplay: true,
            autoplaySpeed: 2000,
            responsive: [
                {
                    breakpoint: 1024,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 3,
                        infinite: true,
                        dots: true
                    }
                },
                {
                    breakpoint: 600,
                    settings: {
                        slidesToShow: 2,
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

        <?php if(isset($segment) && $segment == "welcome") { ?>
        /*$('.single-item').slick({
            arrows: false,
            dots: false,
            infinite: false,
              slidesToShow: 1,
              slidesToScroll: 1,
              autoplay: true,
              autoplaySpeed: 2000
        });*/

        $(".loadVideo").bind("click", function (e) {
            e.preventDefault();
            var videoUrl = $(this).data("url");
            $("#embed-video").attr("src", "https://www.youtube.com/embed/" + videoUrl + "?autoplay=1");
        });
        <?php } ?>

        $(".loadVideo1").bind("click", function (e) {
            e.preventDefault();
            var videoUrl = $(this).data("url");
            $("#embed-video1").attr("src", "https://www.youtube.com/embed/" + videoUrl + "?autoplay=1");
        });
    });


    var numbers = {
        0: '০',
        1: '১',
        2: '২',
        3: '৩',
        4: '৪',
        5: '৫',
        6: '৬',
        7: '৭',
        8: '৮',
        9: '৯'
    };

    function replaceNumbers(input) {
        var output = [];
        for (var i = 0; i < input.length; ++i) {
            if (numbers.hasOwnProperty(input[i])) {
                output.push(numbers[input[i]]);
            } else {
                output.push(input[i]);
            }
        }
        return output.join('');
    }


    var curdate = writeIslamicDate();
    curdate = replaceNumbers(curdate);
    $("#curdate").html(curdate);

    function gmod(n, m) {
        return ((n % m) + m) % m;
    }

    function kuwaiticalendar(adjust) {
        var today = new Date();
        if (adjust) {
            adjustmili = 1000 * 60 * 60 * 24 * adjust;
            todaymili = today.getTime() + adjustmili;
            today = new Date(todaymili);
        }
        day = today.getDate();
        day = (day - 1);
        month = today.getMonth();
        year = today.getFullYear();
        m = month + 1;
        y = year;
        if (m < 3) {
            y -= 1;
            m += 12;
        }

        a = Math.floor(y / 100.);
        b = 2 - a + Math.floor(a / 4.);
        if (y < 1583) b = 0;
        if (y == 1582) {
            if (m > 10) b = -10;
            if (m == 10) {
                b = 0;
                if (day > 4) b = -10;
            }
        }

        jd = Math.floor(365.25 * (y + 4716)) + Math.floor(30.6001 * (m + 1)) + day + b - 1524;

        b = 0;
        if (jd > 2299160) {
            a = Math.floor((jd - 1867216.25) / 36524.25);
            b = 1 + a - Math.floor(a / 4.);
        }
        bb = jd + b + 1524;
        cc = Math.floor((bb - 122.1) / 365.25);
        dd = Math.floor(365.25 * cc);
        ee = Math.floor((bb - dd) / 30.6001);
        day = (bb - dd) - Math.floor(30.6001 * ee);
        month = ee - 1;
        if (ee > 13) {
            cc += 1;
            month = ee - 13;
        }
        year = cc - 4716;

        if (adjust) {
            wd = gmod(jd + 1 - adjust, 7) + 1;
        } else {
            wd = gmod(jd + 1, 7) + 1;
        }

        iyear = 10631. / 30.;
        epochastro = 1948084;
        epochcivil = 1948085;

        shift1 = 8.01 / 60.;

        z = jd - epochastro;
        cyc = Math.floor(z / 10631.);
        z = z - 10631 * cyc;
        j = Math.floor((z - shift1) / iyear);
        iy = 30 * cyc + j;
        z = z - Math.floor(j * iyear + shift1);
        im = Math.floor((z + 28.5001) / 29.5);
        if (im == 13) im = 12;
        id = z - Math.floor(29.5001 * im - 29);

        var myRes = new Array(8);

        myRes[0] = day;
        myRes[1] = month - 1;
        myRes[2] = year;
        myRes[3] = jd - 1;
        myRes[4] = wd - 1;
        myRes[5] = id;
        myRes[6] = im - 1;
        myRes[7] = iy;

        return myRes;
    }


    function writeIslamicDate(adjustment) {
        var wdNames = new Array("Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday");
        var iMonthNames = new Array("মহরম", "সফর", "রবিউল আউয়াল", "রবিউস সানী", "জুমা:আউয়াল", "জুমা:সানী", "রজব", "শা`বান", "রমযান", "শাওয়াল", "জিলক্বাদ", "জিলহজ");
        var eMonthNames = new Array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
        var iDate = kuwaiticalendar(adjustment);
        var outputIslamicDate = iDate[5] + " " + iMonthNames[iDate[6]] + " " + iDate[7];
        return outputIslamicDate;
    }

    function writeIslamicMonthID(adjustment) {
        var iMonthNames = new Array("1", "2", "3", "4", "5", "6", "7", "8", "9", "10", "11", "12");
        var iDate = kuwaiticalendar(adjustment);
        var outputIslamicMonth = iMonthNames[iDate[6]];
        return outputIslamicMonth;
    }

    function writeIslamicDayID(adjustment) {
        var iMonthNames = new Array("1", "2", "3", "4", "5", "6", "7", "8", "9", "10", "11", "12", "13", "14", "15", "16", "17", "18", "19", "20", "21", "22", "23", "24", "25", "26", "27", "28", "29", "30");
        var iDate = kuwaiticalendar(adjustment);
        var outputIslamicDay = iDate[5];
        return outputIslamicDay;
    }
</script>
</body>
</html>
