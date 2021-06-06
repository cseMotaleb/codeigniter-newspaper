<?php
function pageview_counter(){
if (isset($visitor)){
if ($visitor=="visited")
include("pageview-counter.txt");
} else {
$file=fopen("pageview-counter.txt","r+");
$result=fread($file,filesize("pageview-counter.txt"));
fclose($file);
$result += 1;
$file=fopen("pageview-counter.txt","w+");
fputs($file,$result);
fclose($file);
include("pageview-counter.txt");
}
}
?>