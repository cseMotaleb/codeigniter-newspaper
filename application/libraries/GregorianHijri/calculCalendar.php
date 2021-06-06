<Table class="grayBg" align="center" style="font-family: 'trebuchet MS';font-size:12px" width="200">
    <caption style="font-weight:bold;padding-bottom:2px" class="black font10px">
<?php
/**
  * Company : Mutlfirames - www.multiframes.com
	@author Mohamad Cheaib Software Engineer
	Email: mchoueib@hotmail.com - mohammad.choueib@multiframes.com
	@copyright 2010-6-30
  */  
include 'config.php';

echo GregorianHijri::getMonthName ( $m,GregorianHijri::$GREGORIAN,$GLOBALS['lang']) . ' ' . $a;
?> 
</caption>
<tr style="background:#CCCCCC">
    <th>Mo</th>
    
    
    <th>Tu</th>
    
    
    <th>We</th>
    
    
    <th>Th</th>
    
    
    <th>Fr</th>
    
    
    <th>Sa</th>
    
    
    <th>Su</th>
</tr>    
<?php
/*
Company : Mutlfirames - www.multiframes.com
Author Mohamad Cheaib Software Engineer
Email: mchoueib@hotmail.com - mohammad.choueib@multiframes.com
Copyright 2010-6-30
*/
$ts = mktime ( 1, 0, 0, $m, 1, $a );
$detail = getdate ( $ts );
echo "<tr>";
if ($detail ['wday'] == 0)
    $nb = 6;
else
    $nb = $detail ['wday'] - 1;
for($j = 1; $j <= $nb; $j ++)
    echo "<td>";
$n = $detail ['wday'];
$valid = TRUE;
$j = 1;
$monthsArray = array();
do {
    
    $valid = checkdate ( $m, $j, $a );
    if ($valid) {
    	//$dateOutput = "$a-$m-$j";
    	$dateOutput = sprintf ( $GLOBALS['gregorianDateFormat'], $a,$m,$j);
        $hijriDay = GregorianHijri::hijriDay($a,$m,$j,$GLOBALS['lang']);
        $explod = explode("-",$hijriDay);
        $year = $explod[1];
        $day = $explod[0];
        $hijriDate = GregorianHijri::hijriDate($a,$m,$j,$GLOBALS['lang'],$GLOBALS['hijriDateFormat']);
        $hijriMonth = GregorianHijri::hijriMonth($a,$m,$j,$GLOBALS['lang']);
        array_push($monthsArray,$hijriMonth);
			if(!isset($_REQUEST['day'])){
				if($j == $today){
					$bg = "#cccccc";
				 }else{
					$bg = "";
				 }
			}else{
			
				if($j == $newDay){
			 		$bg = "#cccccc";
			 	}else{
					$bg = "";
				}
			}
            
			 
             $gregorianId = 'gregorianDate'.$j;
             $hijriId = 'hijriDate'.$j;
             $function = "getDateInputs('".$gregorianId."','".$hijriId."')";
        if (($j + $nb) % 7 == 1)
            
            echo "<tr>";
        echo "<td align=center style='font-size:10px;cursor:pointer' bgcolor='$bg' onclick=$function class='cel-calendar-border'>
				<table border='0' class='font10px' width='30' cellspacing='0' cellpadding='0'>
					<tr><td align='left'><span class='black'>$j</span></td></tr>
					<tr><td align='right' class='red'>$day</td></tr></table>";
        echo "<input type='hidden' name=$gregorianId id =$gregorianId value='$dateOutput'>";
     echo "<input type='hidden' name=$hijriId id =$hijriId value='$hijriDate'>";
     $j = $j+1;
     
     
     echo "</td>";
     
    }
   } while ($valid);
   
   $monthsArray = array_unique($monthsArray);
 /**
  * @author Company : Mutlfirames - www.multiframes.com
	Author Mohamad Cheaib Software Engineer
	Email: mchoueib@hotmail.com - mohammad.choueib@multiframes.com
	@copyright 2010-6-30
  */  

?>
</TABLE> 
<div align="center" style="font-size:10px;font-family:'trebuchet MS';padding-top:2px;padding-bottom:2px;font-weight:bold" class="red">
<?php 
$i=0;
foreach ($monthsArray as $key=> $value){ 
    $i++;
    echo $value;
    if ($i < count($monthsArray)){
        echo " / ";
    }
}
echo " ".$year;
?>
</div>
<div align="right" class="tahoma black font10px">powered by <a href="http://www.multiframes.com" target="_blank">Multiframes</a></div>
