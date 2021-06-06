<?php
/*
Company : Mutlfirames - www.multiframes.com
Author Mohamad Cheaib Software Engineer
Email: mchoueib@hotmail.com - mohammad.choueib@multiframes.com
Copyright 2010-6-30
*/
require 'GregorianHijri.php';

$today = getdate();
$today = $today['mday'];
if (isset($_REQUEST['day'])){
	$newDay = $_REQUEST['day'];
}
if (isset ( $_REQUEST ["month"] )) {
	$m = $_REQUEST ["month"];
	$a = $_REQUEST ["year"];
	
} else {
	$detail = getdate ();
	$m = $detail ['mon'];
	$a = $detail ['year'];
}
if ($_REQUEST ['actionMonth'] == "previous") {
	$m = $m - 1;
	if ($m < 1) {
		$m = 12;
		$a = $a - 1;
	}
} elseif ($_REQUEST ['actionMonth'] == "next") {
	$m = $m + 1;
	if ($m > 12) {
		$m = 1;
		$a = $a + 1;
	}
} elseif ($_REQUEST ['actionYear'] == "next")
	$a = $a + 1;
elseif ($_REQUEST ['actionYear'] == "previous")
	$a = $a - 1;
	if ($a < 1){
		$a = 1900;
	}
?>

<?php include('calculCalendar.php')?>
