<?php
$ast = 'assets/';
$siteDir = $ast . "site/";
$cs = '.css';
$jsDir = $ast . 'js/';
$js = '.js';
$minjs = '.min' . $js;

$src = array(
    $ast . 'admin/js/libs/jquery-2.2.4' . $minjs,
//    $jsDir . 'bootstrap' . $minjs,
//    $siteDir . 'js/canvasjs' . $minjs,
//        $siteDir . 'js/pie-chart' . $js,
//    $ast . 'slick/slick' . $minjs,
);

scriptTag($src);

?>



<script async src="<?= site_url($jsDir . 'main-async' . $minjs)?>"></script>
<script defer src="<?= site_url($jsDir . 'main-defer' . $minjs)?>"></script>

<script src="<?= site_url($jsDir . 'lazysizes' . $minjs)?>" async></script>


