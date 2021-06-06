<?php
$astAdmin = 'assets/admin/';
$cs = '.css';
?>
<!DOCTYPE html>
<html lang="en-us">
<head>
    <meta charset="utf-8">
    <!--<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">-->
    <title>Admin Login</title>
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <?php
    metaAuthor();
    /*Basic Styles*/
    echo link_tag($astAdmin . 'css/bootstrap.min' . $cs, "stylesheet", "text/css", "", "screen");
    echo link_tag('assets/font-awesome/css/font-awesome.min' . $cs, "stylesheet", "text/css", "", "screen");
    echo link_tag($astAdmin . 'css/smartadmin-production.min' . $cs);
    echo link_tag($astAdmin . 'css/lockscreen.min' . $cs);
    echo link_tag('img/favicon.png', "shortcut icon", "image/x-icon");
    ?>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:400italic,700italic,300,400,700">
</head>
<body>
<div id="main" role="main">
    <!-- MAIN CONTENT -->
    <form class="lockscreen animated flipInY" action="<?= site_url("admin/login/index"); ?>" method="post">
        <div class="logo text-center">
            <h1 class="semi-bold">Cpanel</h1>
            <br/>
        </div>

        <div>
            <div class="text-center">
                <img style="padding: 5px; margin-top: -20px;" src="<?= base_url(); ?>img/logo-footer.png"
                     alt="Logo"/>
            </div>
            <?php if (isset($error)) echo $error; ?>
            <div class="row">
                <div class="col-md-10">
                    <div class="input-group">
                        <input class="form-control" type="text" placeholder="Email" name="email" id="email"
                               style="width: 380px;">
                    </div>

                    <br/>

                    <div class="input-group">
                        <input class="form-control" type="password" placeholder="Password" name="password" id="password"
                               style="width: 380px;">
                    </div>

                    <br/>

                    <?= $widget; ?>
                    <?= $script; ?>
                </div>
                <div class="col-md-2">
                    <br/>
                    <div class="input-group-btn" style="margin-top: 35px;">
                        <button class="btn btn-primary" type="submit">
                            <i class="fa fa-key"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <p class="font-xs margin-top-5">
            Copyright <a href="#" target="_blank"></a>. All Right Reserved
        </p>
    </form>
</div>

<!--================================================== -->
<?php
$jsDir = $astAdmin . 'js/';
$plugDir = $jsDir . 'plugin/';
$js = '.js';
$minjs = '.min' . $js;
$src = [
    $jsDir . 'libs/jquery-3.4.1' . $minjs,
    $plugDir . 'pace/pace' . $minjs,
    $jsDir . 'notification/SmartNotification' . $minjs,
    $jsDir . 'smartwidgets/jarvis.widget' . $minjs,
    $plugDir . 'sparkline/jquery.sparkline' . $minjs,
    $plugDir . 'jquery-validate/jquery.validate' . $minjs,
    $plugDir . 'masked-input/jquery.maskedinput' . $minjs,
    $plugDir . 'bootstrap-slider/bootstrap-slider' . $minjs,
    $plugDir . 'fastclick/fastclick' . $minjs,
//    $jsDir . 'app' . $minjs,
];
scriptTag($src);
?>

</body>
</html>