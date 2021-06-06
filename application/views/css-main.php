<link rel="stylesheet" href="<?= base_url(); ?>assets/site/css/bootstrap-3.3.0.min.css" media="all">
<link rel="stylesheet" href="<?= base_url(); ?>assets/site/font-awesome/css/font-awesome.min.css" media="all">
<?php
if (base_url() == "http://sujon-pc/projonmonews24.coma/") {
    $css_list[] = "stylesheet-site.css";
    $css_list[] = "stylesheet-site-header.css";
    $css_list[] = "login.css";
    $css_list[] = "dseshare.css";
    $css_list[] = "slick.css";
    $css_list[] = "slick-theme.css";
    $css_list[] = "custom.css";
    $this->minify->css($css_list);
    echo $this->minify->deploy_css(FALSE);
} else {
    ?>
    <link rel="stylesheet" href="<?= base_url(); ?>assets/site/css/stylesheet-site.css" media="all">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/site/css/stylesheet-site-header.css" media="all">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/site/css/login.css" media="all">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/site/css/dseshare.css" media="all">
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/site/css/slick.css"/>
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/site/css/slick-theme.css"/>
    <link rel="stylesheet" href="<?= base_url(); ?>assets/site/css/custom.css" media="all">
<?php } ?>

<link rel="stylesheet" href="<?= base_url(); ?>assets/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css"
      media="all">
<link rel="stylesheet" href="<?= base_url(); ?>assets/site/css/social-share-kit.css" media="all">
<link rel="stylesheet" href="<?= base_url(); ?>assets/jssocials/jssocials.css" media="all">
<link rel="stylesheet" href="<?= base_url(); ?>assets/jssocials/jssocials-theme-classic.css" media="all">



<!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-social/5.0.0/bootstrap-social.min.css">-->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-social@5.1.1/bootstrap-social.min.css">