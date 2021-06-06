<?php
/**
  * Company : Mutlfirames - www.multiframes.com
	@author Mohamad Cheaib Software Engineer
	Email: mchoueib@hotmail.com - mohammad.choueib@multiframes.com
	@copyright 2010-6-30
  */  
require 'GregorianHijri.php';

$today = getdate();
$today = $today['mday'];
include 'config.php';

?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Hijri Calendar</title>
<link href="js/cal.css" rel="stylesheet" type="text/css" />
<script src="js/glm-ajax.js" type="text/javascript"></script>
<script src="js/popupCal.js" type="text/javascript" language="JavaScript1.2"></script>
<script src="js/calAjax.js" type="text/javascript" language="JavaScript1.2"></script>
</head>
<body>
<?php
	$detail = getdate ();
	$m = $detail ['mon'];
	$a = $detail ['year'];

?>
<table border="0" cellspacing="0" cellpadding="0" align="center">
  <tr>
    <td align="right" valign="top">
    	<table border="0" cellspacing="0" cellpadding="0" align="center" 
        style="font-weight:bold;font-size:12px;font-family:'trebuchet MS'">
          <tr>
            <td align="right">Gregorian:&nbsp;</td>
            <td valign="top">
            <input type="text" name="gregorianDateOutput" id="gregorianDateOutput" value="" style="width:200px;font-size:12px;font-family:'trebuchet MS'"  dir="<?= $dir?>">
            </td>
          </tr>
          <tr>
            <td align="right">Hijri:&nbsp;</td>
            <td valign="top">
            <input type="text" name="hijriDateOutput" id="hijriDateOutput" value="" style="width:200px;font-size:12px;font-family:'trebuchet MS'"  dir="<?= $dir?>">
            </td>
          </tr>
        </table>
    </td>
    <td><a href="javascript:showMe();"><img src="ghcal.png" border="0"></a></td>
  </tr>
</table>


<!-- BEGIN FLOATING LAYER CODE //-->
<div id="theLayer" style="position:absolute;width:200px;left:840;top:30;visibility:hidden;">
<table border="0" width="200" class="lightgrayBg" cellspacing="0" cellpadding="5">
<tr>
<td width="100%">
  <table border="0" width="100%" cellspacing="0" cellpadding="0" height="26" style="border:1px solid #666666">
  <tr>
  <td id="titleBar" style="cursor:move;border:1px solid #666666;border-right:none" width="100%">
  <ilayer width="100%" onSelectStart="return false">
  <layer width="100%" onMouseover="isHot=true;if (isN4) ddN4(theLayer)" onMouseout="isHot=false">
  <div class="font10px black bold tahoma" align="center">Gregorian - Hijri Calendar</div>

  </layer>
  </ilayer>
  </td>
  <td style="cursor:hand;border:1px solid #666666;border-left:none" valign="top">
  <a href="#" onClick="hideMe();return false"><img src="dialog-close.png" border="0"></a>
  </td>
  </tr>
  <tr>

  <td width="100%" class="grayBg" style="padding:4px" colspan="2">
  

        <!-- PLACE YOUR CONTENT HERE //-->  
        
            <Table align="center">
                
                <tr>
                <!-- Month-->
                    <td valign="top">
                    	<table border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td style="padding-right:3px"><INPUT type="button" name="previousMonth" id="previousMonth" value='previous' onClick="getCalendar('previousMonth')" class="previous-button"></td>
                            <td><INPUT type="text" name="month" size="2" value="<?= $m; ?>" id="month" class="input-month" onBlur="getCalendar()"></td>
                            <td style="padding-left:3px"><INPUT type="button" NAME="nextMonth" id="nextMonth" value="next" onClick="getCalendar('nextMonth')" class="next-button"></td>
                          </tr>
                        </table>
                    </td>
                    <!-- End Month-->
                    
                    <!-- Year-->
                    <td valign="top">
                    	<table border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td style="padding-right:3px"><INPUT type="button" name="previousYear" value="previous"  id="previousYear" onClick="getCalendar('previousYear')" class="previous-button"></td>
                            <td><INPUT type="text" name="year" id="year" size=4 value=<?= $a; ?> class="input-year" onBlur="getCalendar('')"></td>
                            <td style="padding-left:3px"><INPUT type="button" name="nextYear" value="next"  id="nextYear" onClick="getCalendar('nextYear')" class="next-button"></td>
                          </tr>
                        </table>
                    </td>
                    <!-- End Year-->
                </tr>
            </table>
        
        
        <div id="ajaxResponse" style="min-height:200px;min-width:200px">
        <?php 
		/**
		  * Company : Mutlfirames - www.multiframes.com
			@author Mohamad Cheaib Software Engineer
			Email: mchoueib@hotmail.com - mohammad.choueib@multiframes.com
			@copyright 2010-6-30
		  */  
		include('calculCalendar.php');
		?>
        </div>
        <!-- END OF CONTENT AREA //-->

  </td>
  </tr>
  </table> 

</td>
</tr>
</table>
</div>
<!-- END FLOATING LAYER CODE //--> 
<script type="text/javascript">
window.onload = updateCalendarDay();
</script>

<div class="tahoma black font12px" align="center" style="padding-top:10px">powered by <a href="http://www.multiframes.com" target="_blank">Multiframes</a></div>
</body>
</html>