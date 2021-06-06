<?php
/*
Company : Mutlfirames - www.multiframes.com
Author Mohamad Cheaib Software Engineer
Email: mchoueib@hotmail.com - mohammad.choueib@multiframes.com
*/
class GregorianHijri {
	public static $GREGORIAN = "GREGORAIN";
	public static $HIJRI = "HIJRI";
	
	public static $AR = 1;
	public static $EN = 2;
	function __construct() {
	
	}
	
	function getMonthName($m, $type, $lang) {
		if ($type == GregorianHijri::$HIJRI) {
			if ($lang == GregorianHijri::$AR) {
				switch ($m) {
					case 1 :
						return 'المحرّم';
					case 2 :
						return 'صفر';
					case 3 :
						return 'ربيع الأوّل';
					case 4 :
						return 'ربيع الثاني';
					case 5 :
						return 'جمادى الأولى';
					case 6 :
						return 'جمادى الثانية';
					case 7 :
						return 'رجب';
					case 8 :
						return 'شعبان';
					case 9 :
						return 'رمضان';
					case 10 :
						return 'شوّال';
					case 11 :
						return 'ذو القعدة';
					case 12 :
						return 'ذو الحجّة';
					default :
						return 'رقم شهري خاطئ';
				}
			} else {
				switch ($m) {
					case 1 :
						return 'Muharram';
					case 2 :
						return 'Safar';
					case 3 :
						return 'Rabbi al-Awwal';
					case 4 :
						return 'Rabbi al-Thanni';
					case 5 :
						return 'Jumada al-Ula';
					case 6 :
						return 'Jumada al-Thanni';
					case 7 :
						return 'Rajab';
					case 8 :
						return 'Shaaban';
					case 9 :
						return 'Ramadhan';
					case 10 :
						return 'Shawwal';
					case 11 :
						return 'Dhul-Qadah';
					case 12 :
						return 'Dhul-Hijjah';
					default :
						return 'Invalid Month Number';
				}
			}
		
		} elseif ($type == GregorianHijri::$GREGORIAN) {
			if ($lang == GregorianHijri::$AR) {
				switch ($m) {
					case 1 :
						return 'يناير';
					case 2 :
						return 'فبراير';
					case 3 :
						return 'مارس';
					case 4 :
						return 'أبريل';
					case 5 :
						return 'مايو';
					case 6 :
						return 'يونيو';
					case 7 :
						return 'يوليو';
					case 8 :
						return 'أغسطس';
					case 9 :
						return 'سبتمبر';
					case 10 :
						return 'أكتوبر';
					case 11 :
						return 'نوفمبر';
					case 12 :
						return 'ديسمبر';
					default :
						return 'رقم شهري خاطئ';
				}
			} else {
				switch ($m) {
					case 1 :
						return 'January';
					case 2 :
						return 'February';
					case 3 :
						return 'March';
					case 4 :
						return 'April';
					case 5 :
						return 'May';
					case 6 :
						return 'June';
					case 7 :
						return 'July';
					case 8 :
						return 'August';
					case 9 :
						return 'September';
					case 10 :
						return 'October';
					case 11 :
						return 'November';
					case 12 :
						return 'December';
					default :
						return 'Invalid Month Number';
				}
			}
		
		}
	}
	
	function hijriDate($year, $month, $day,$lang,$dateFormat) {
		
		$timestamp = time ();
		$timestamp += GregorianHijri::bstOffset ( $timestamp ) * 3600;
		if ($year != "") {
			$thisYear = $year;
		} else {
			$thisYear = strftime ( "%Y", $timestamp );
		}
		
		if ($month != "") {
			$thisMonth = $month;
		} else {
			$thisMonth = strftime ( "%m", $timestamp );
		
		}
		if ($day != "") {
			$thisDay = $day;
		} else {
			$thisDay = trim ( strftime ( "%e", $timestamp ) );
		}
		
		/*if ($thisMonth < 10)
		$thisMonth = substr ( $thisMonth, 1, 1 );*/
		
		//$greg_part = strftime ( "%d %B %YCE", $timestamp );
		

		$hijri_date = GregorianHijri::jd2hijri ( GregorianHijri::greg2jd ( $thisDay, $thisMonth, $thisYear ) );
		
		$hijri_part = sprintf ( $dateFormat, $hijri_date [0], GregorianHijri::hijrimonth2name ( $hijri_date [1],$lang ), $hijri_date [2] );
		//$hijri_part = sprintf ( "%02d", $hijri_date [0]);
		

		//return $greg_part . ' | ' . $hijri_part;
		return $hijri_part;
	}
	
	//return the day of the hijri
	function hijriDay($year, $month, $day,$lang) {
		
		$timestamp = time ();
		$timestamp += GregorianHijri::bstOffset ( $timestamp ) * 3600;
		if ($year != "") {
			$thisYear = $year;
		} else {
			$thisYear = strftime ( "%Y", $timestamp );
		}
		
		if ($month != "") {
			$thisMonth = $month;
		} else {
			$thisMonth = strftime ( "%m", $timestamp );
		
		}
		if ($day != "") {
			$thisDay = $day;
		} else {
			$thisDay = trim ( strftime ( "%e", $timestamp ) );
		}
		
		/*if ($thisMonth < 10)
		$thisMonth = substr ( $thisMonth, 1, 1 );*/
		
		//$greg_part = strftime ( "%d %B %YCE", $timestamp );
		

		$hijri_date = GregorianHijri::jd2hijri ( GregorianHijri::greg2jd ( $thisDay, $thisMonth, $thisYear ) );
		
		//$hijri_part = sprintf ( "%02d %s %dAH", $hijri_date [0], GregorianHijri::hijrimonth2name ( $hijri_date [1] ,$lang), $hijri_date [2] );
		$hijri_part = sprintf ( "%02d-%d", $hijri_date [0], $hijri_date [2] );
		
		//return $greg_part . ' | ' . $hijri_part;
		return $hijri_part;
	}
	
	function hijriMonth($year, $month, $day,$lang) {
		
		$timestamp = time ();
		$timestamp += GregorianHijri::bstOffset ( $timestamp ) * 3600;
		if ($year != "") {
			$thisYear = $year;
		} else {
			$thisYear = strftime ( "%Y", $timestamp );
		}
		
		if ($month != "") {
			$thisMonth = $month;
		} else {
			$thisMonth = strftime ( "%m", $timestamp );
		
		}
		if ($day != "") {
			$thisDay = $day;
		} else {
			$thisDay = trim ( strftime ( "%e", $timestamp ) );
		}
		
		/*if ($thisMonth < 10)
		$thisMonth = substr ( $thisMonth, 1, 1 );*/
		
		//$greg_part = strftime ( "%d %B %YCE", $timestamp );
		

		$hijri_date = GregorianHijri::jd2hijri ( GregorianHijri::greg2jd ( $thisDay, $thisMonth, $thisYear ) );
		
		$hijri_part = sprintf ( "%s", GregorianHijri::hijrimonth2name ( $hijri_date [1] ,$lang) );
		//$hijri_part = sprintf ( "%02d", $hijri_date [0]);
		

		//return $greg_part . ' | ' . $hijri_part;
		return $hijri_part;
	}
	function greg2jd($d, $m, $y) {
		
		//$jd = 367*$y-int((7*($y+5001+int($m-9)/7)))/4)+int((275*$m)/9)+ $d+1729777;
		//$jd = (1461 * ($y + 4800 + ($m - 14) / 12)) / 4 + (367 * ($m - 2 - 12 * (($m - 14) / 12))) / 12 - (3 * (($y + 4900 + ($m - 14) / 12) / 100)) / 4 + $d - 32075;
		if (($y > 1582) || (($y == 1582) && ($m > 10)) || (($y == 1582) && ($m == 10) && ($d > 14))) {
			$jd = ( int ) ((1461 * ($y + 4800 + ( int ) (($m - 14) / 12))) / 4) + ( int ) ((367 * ($m - 2 - 12 * (( int ) (($m - 14) / 12)))) / 12) - ( int ) ((3 * (( int ) (($y + 4900 + ( int ) (($m - 14) / 12)) / 100))) / 4) + $d - 32075;
		} else {
			$jd = 367 * $y - ( int ) ((7 * ($y + 5001 + ( int ) (($m - 9) / 7))) / 4) + ( int ) ((275 * $m) / 9) + $d + 1729777;
		}
		return $jd;
	}
	
	function jd2hijri($jd) {
		$jd = $jd - 1948440 + 10632;
		$n = ( int ) (($jd - 1) / 10631);
		$jd = $jd - 10631 * $n + 354;
		$j = (( int ) ((10985 - $jd) / 5316)) * (( int ) (50 * $jd / 17719)) + (( int ) ($jd / 5670)) * (( int ) ((43 * $jd) / 15238));
		$jd = $jd - (( int ) ((30 - $j) / 15)) * (( int ) ((17719 * $j) / 50)) - (( int ) ($j / 16)) * (( int ) ((15238 * $j) / 43)) + 29;
		$m = ( int ) ((24 * $jd) / 709);
		$d = $jd - ( int ) ((709 * $m) / 24);
		$y = 30 * $n + $j - 30;
		
		return array ($d, $m, $y );
	}
	
	function hijrimonth2name($m,$lang) {
	if ($lang == GregorianHijri::$AR) {
				switch ($m) {
					case 1 :
						return 'المحرّم';
					case 2 :
						return 'صفر';
					case 3 :
						return 'ربيع الأوّل';
					case 4 :
						return 'ربيع الثاني';
					case 5 :
						return 'جمادى الأولى';
					case 6 :
						return 'جمادى الثانية';
					case 7 :
						return 'رجب';
					case 8 :
						return 'شعبان';
					case 9 :
						return 'رمضان';
					case 10 :
						return 'شوّال';
					case 11 :
						return 'ذو القعدة';
					case 12 :
						return 'ذو الحجّة';
					default :
						return 'رقم شهري خاطئ';
				}
			} else {
				switch ($m) {
					case 1 :
						return 'Muharram';
					case 2 :
						return 'Safar';
					case 3 :
						return 'Rabbi al-Awwal';
					case 4 :
						return 'Rabbi al-Thanni';
					case 5 :
						return 'Jumada al-Ula';
					case 6 :
						return 'Jumada al-Thanni';
					case 7 :
						return 'Rajab';
					case 8 :
						return 'Shaaban';
					case 9 :
						return 'Ramadhan';
					case 10 :
						return 'Shawwal';
					case 11 :
						return 'Dhul-Qadah';
					case 12 :
						return 'Dhul-Hijjah';
					default :
						return 'Invalid Month Number';
				}
			}
	}
	
	function bstOffset($currDate) {
		$thisYear = (date ( "Y" ));
		$marStartDate = ($thisYear . "-03-25");
		$octStartDate = ($thisYear . "-10-25");
		$marEndDate = ($thisYear . "-03-31");
		$octEndDate = ($thisYear . "-10-31");
		
		while ( $marStartDate <= $marEndDate ) {
			$day = date ( "l", strtotime ( $marStartDate ) );
			if ($day == "Sunday")
				$bstStartDate = $marStartDate;
			$marStartDate ++;
		}
		
		$bstStartDate = (date ( "U", strtotime ( $bstStartDate ) ) + (60 * 60));
		
		while ( $octStartDate <= $octEndDate ) {
			$day = date ( "l", strtotime ( $octStartDate ) );
			if ($day == "Sunday")
				$bstEndDate = $octStartDate;
			$octStartDate ++;
		}
		
		$bstEndDate = (date ( "U", strtotime ( $bstEndDate ) ) + (60 * 60));
		
		if ($currDate < bstEndDate && $currDate > $bstStartDate)
			return 1;
		else
			return 0;
	}

}

?>