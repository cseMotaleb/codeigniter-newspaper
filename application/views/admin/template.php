<?php
$user_image = $this->session->userdata('image');
$user_image = (($user_image) && file_exists("./uploads/agents/{$user_image}")) ? base_url() . "uploads/agents/{$user_image}" : base_url() . "img/avatars/avatar.png";

$astAdmin = 'assets/admin/';
$cs = '.css';
$jsDir = $astAdmin . 'js/';
$js = '.js';
$minjs = '.min' . $js;
?>

<!DOCTYPE html>
<html lang="en-us">
<head>
    <meta charset="utf-8">
    <title>admin | mancitra24.com</title>
    <meta name="description" content="">

    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

    <!-- iOS web-app metas : hides Safari UI Components and Changes Status Bar Appearance -->
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <link rel='icon' href="<?= site_url($astAdmin . 'img/sa-default.png') ?>" type='image/x-icon'
    / >

    <?php
    metaAuthor();

    /*#CSS Links*/
    /*Basic Styles*/

    echo link_tag('assets/admin/css/bootstrap.min.css', "stylesheet", "text/css", "", "screen");
    echo link_tag('assets/font-awesome/css/font-awesome.min.css', "stylesheet", "text/css", "", "screen");

    /*SmartAdmin Styles : Please note (smartadmin-production.css) was created using LESS variables*/
    echo link_tag('assets/admin/css/smartadmin-production.min.css', "stylesheet", "text/css", "", "screen");
    echo link_tag('assets/admin/css/smartadmin-skins.min.css', "stylesheet", "text/css", "", "screen");
    echo link_tag('assets/admin/css/custom.css');

    scriptTag(array($jsDir . 'libs/jquery-2.2.4' . $minjs, $jsDir . 'libs/jquery-ui-1.10.3' . $minjs));
    ?>
    <style type="text/css">
        #custom-search-input {
            padding: 3px;
            border: solid 1px #E4E4E4;
            border-radius: 6px;
            background-color: #fff;
        }

        #custom-search-input input {
            border: 0;
            box-shadow: none;
        }

        #custom-search-input button {
            margin: 2px 0 0 0;
            background: none;
            box-shadow: none;
            border: 0;
            color: #666666;
            padding: 0 8px 0 10px;
            border-left: solid 1px #ccc;
        }

        #custom-search-input button:hover {
            border: 0;
            box-shadow: none;
            border-left: solid 1px #ccc;
        }

        #custom-search-input .glyphicon-search {
            font-size: 23px;
        }
    </style>
</head>
<body class="">
<!-- #HEADER -->
<header id="header">
    <div id="logo-group">
				<span id="logo">
				    <img style="width: 195px; height: 45px; margin-top:-11px;"
                         src="<?= site_url('img/logo-footer.png') ?>" alt="Logo">
				</span>
    </div>

    <div class="pull-right">
        <!-- collapse menu button -->
        <div id="hide-menu" class="btn-header pull-right">
            <span> <a href="javascript:void(0);" data-action="toggleMenu" title="Collapse Menu"><i
                            class="fa fa-reorder"></i></a> </span>
        </div>
        <!-- Top menu profile link : this shows only when top menu is active -->
        <ul id="mobile-profile-img" class="header-dropdown-list hidden-xs padding-5">
            <li class="">
                <a href="#" class="dropdown-toggle no-margin userdropdown" data-toggle="dropdown">
                    <img src="<?= $user_image; ?>"
                         alt="<?= $this->session->userdata('first_name') . " " . $this->session->userdata('last_name'); ?>"
                         class="online"/>
                </a>
            </li>
        </ul>
        <!-- logout button -->
        <div id="logout" class="btn-header transparent pull-right">
            <span> <a href="<?= site_url('admin/login/logout') ?>" title="Sign Out" data-action="userLogout"
                      data-logout-msg="You can improve your security further after logging out by closing this opened browser"><i
                            class="fa fa-sign-out"></i></a> </span>
        </div>
        <!-- end logout button -->
        <!-- search mobile button (this is hidden till mobile view port) -->
        <div class="btn-header transparent pull-right">
            <span> <a href="<?= $this->config->item('base_url'); ?>" target="_blank" title="View Site"><i
                            class="fa fa-desktop"></i></a> </span>
        </div>
        <!-- end search mobile button -->
        <div id="fullscreen" class="btn-header transparent pull-right">
            <span> <a href="javascript:void(0);" data-action="launchFullscreen" title="Full Screen"><i
                            class="fa fa-arrows-alt"></i></a> </span>
        </div>
    </div>
</header>
<!-- END HEADER -->

<aside id="left-panel">
    <!-- User info -->
    <div class="login-info">
				<span> <!-- User image size is adjusted inside CSS, it should stay as is -->
					<a href="javascript:void(0);" id="show-shortcut" data-action="toggleShortcut">
						<img src="<?= $user_image; ?>" alt="Freight" class="online"/>
						<span>
							<?= $this->session->userdata('first_name') . " " . $this->session->userdata('last_name'); ?>
						</span>
						<i class="fa fa-angle-down"></i>
					</a>
				</span>
    </div>
    <nav>
        <?php include 'menu.php'; ?>
    </nav>
    <span class="minifyme" data-action="minifyMenu"> <i class="fa fa-arrow-circle-left hit"></i> </span>
</aside>
<!-- #MAIN PANEL -->
<div id="main" role="main">
    <!-- RIBBON -->
    <div id="ribbon">
				<span class="ribbon-button-alignment">
					<span id="refresh" class="btn btn-ribbon" data-action="resetWidgets" data-title="refresh"
                          rel="tooltip" data-placement="bottom"
                          data-original-title="<i class='text-warning fa fa-warning'></i> Warning! This will reset all your widget settings."
                          data-html="true"
                          data-reset-msg="Would you like to RESET all your saved widgets and clear LocalStorage?"><i
                                class="fa fa-refresh"></i></span>
				</span>
        <!-- breadcrumb -->
        <ol class="breadcrumb">
            <!-- This is auto generated -->
        </ol>
    </div>

    <div id="content">

    </div>

</div>
<!-- END #MAIN PANEL -->
<div class="page-footer">
    <div class="row">
        <div class="col-xs-12 col-sm-6">
            <span class="txt-color-white">&copy;  All Right Reserved</span>
        </div>
        <!-- end col -->
    </div>
    <!-- end row -->
</div>
<!-- END FOOTER -->


<!-- IMPORTANT: APP CONFIG -->
<?php
$plugDir = $jsDir . 'plugin/';
$src = array(
    $jsDir . 'app.config' . $js,
    $jsDir . 'common.users' . $js,
    $jsDir . 'bootstrap-fileupload' . $js,
    $plugDir . 'ckeditor/ckeditor' . $js,

    $plugDir . 'jquery-touch/jquery.ui.touch-punch' . $minjs,
    $jsDir . 'bootstrap/bootstrap' . $minjs,
    $jsDir . 'notification/SmartNotification' . $minjs,
    $jsDir . 'smartwidgets/jarvis.widget' . $minjs,

    $plugDir . 'easy-pie-chart/jquery.easy-pie-chart' . $minjs,
    $plugDir . 'sparkline/jquery.sparkline' . $minjs,
    $plugDir . 'jquery-validate/jquery.validate' . $minjs,
    $plugDir . 'masked-input/jquery.maskedinput' . $minjs,
    $plugDir . 'select2/select2' . $minjs,

    $plugDir . 'bootstrap-slider/bootstrap-slider' . $minjs,
    $plugDir . 'msie-fix/jquery.mb.browser' . $minjs,
    $plugDir . 'fastclick/fastclick' . $minjs,
    $jsDir . 'app' . $minjs,
    $jsDir . 'speech/voicecommand' . $minjs,
    $plugDir . 'x-editable/moment' . $minjs,
    $plugDir . 'x-editable/x-editable' . $minjs,
);
scriptTag($src);
?>
</body>
</html>