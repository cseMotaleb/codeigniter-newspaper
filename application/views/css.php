<?php
$ast = 'assets/';
$site = 'assets/site/';

$all = 'https://use.fontawesome.com/releases/v5.1.0/css/all.css';
$bootstrap = site_url($site . 'css/bootstrap-3.3.0.min.css');


$fontawesome = site_url($site . 'font-awesome/css/font-awesome.min.css');
$login = site_url($site . 'css/login.css');

$dseshare = site_url($site . 'css/dseshare.css');
$slick = site_url($site . 'css/slick.css');
$slicktheme = site_url($site . 'css/slick-theme.css');
$custom = site_url($site . 'css/custom.css');

$datepicker = site_url($ast . 'bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css');
$kitmain = site_url($site . 'css/social-share-kit-main.css');
$jssocials = site_url($ast . 'jssocials/jssocials.css');
$themeclassic = site_url($ast . 'jssocials/jssocials-theme-classic.css');

$bootstrapsocial = 'https://cdn.jsdelivr.net/npm/bootstrap-social@5.1.1/bootstrap-social.min.css';

$cssDefer = site_url($ast . 'css/main-defer.min.css');
$stylesheetsite = site_url($site . 'css/stylesheet-site.css');

?>

<link rel="stylesheet" href="<?= $bootstrap ?>" media="all">
<link rel="stylesheet" href="<?= $stylesheetsite ?>" media="all">

<style type="text/css">
    .datepicker table {
        width: 100%;
    }

    .cat-heading h3 {
        font-size: 26px !important;
    }

    .btn-breadcrumb a {
        font-size: 18px !important;
    }

    .nav-tabs li a {
        font-size: 20px !important;
    }

    /*.fa, .far, .fas {*/
    /*    font-family: !important;*/
    /*}*/
</style>

<script type="text/javascript">
    $(document).ready(function () {
        deferCSS('<?= $all ?>');
        deferCSS('<?= $fontawesome ?>');

        deferCSS('<?= $cssDefer ?>');



        deferCSS('<?= $bootstrapsocial ?>');

        function deferCSS(href) {
            /* Second CSS File */
            var giftofspeed2 = document.createElement('link');
            giftofspeed2.rel = 'stylesheet';
            giftofspeed2.href = href;
            giftofspeed2.type = 'text/css';
            var godefer2 = document.getElementsByTagName('link')[0];
            godefer2.parentNode.insertBefore(giftofspeed2, godefer2);
        }

        function f() {
            deferCSS('<?= $dseshare ?>');
            deferCSS('<?= $slick ?>');
            deferCSS('<?= $slicktheme ?>');
            deferCSS('<?= $custom ?>');
            deferCSS('<?= $datepicker ?>');
            deferCSS('<?= $kitmain ?>');
            deferCSS('<?= $jssocials ?>');
            deferCSS('<?= $themeclassic ?>');
        }
    });
</script>

<noscript>
    <link rel="stylesheet" href="<?= $all ?>"
          integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">
    <link rel="stylesheet" href="<?= $fontawesome ?>">

    <link rel="stylesheet" href="<?= $cssDefer ?>">

    <link rel="stylesheet" href="<?= $bootstrapsocial ?>" media="all">
</noscript>