<?php
/**
 * This is for the language 1 for ARABIC, 2 for ENGLISH
 */
$GLOBALS['lang'] = 2;
/**
 * This is the date format which controll the output of the date in the textfield
 * Please use the format of the function sprintf();
 */
$GLOBALS['gregorianDateFormat'] = "%d-%02d-%02d";
$GLOBALS['hijriDateFormat'] = "%02d %s %d";

/* Don't touch*/
if($GLOBALS['lang'] == GregorianHijri::$AR){
	$dir = 'rtl';
}else{
	$dir = 'ltr';
}
?>