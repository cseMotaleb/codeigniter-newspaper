/*
Company : Mutlfirames - www.multiframes.com
Author Mohamad Cheaib Software Engineer
Email: mchoueib@hotmail.com - mohammad.choueib@multiframes.com
Copyright 2010-6-30
*/
	// Geting the calendar via ajax (using the next and previous)
	function getCalendar(action){
		document.getElementById('ajaxResponse').innerHTML = "<div align='center' style='padding:5px'><img src='js/ajax-loader.gif'></div>";
		var month=document.getElementById('month').value;
		var year=document.getElementById('year').value;
		if (month == "" || month > 12){
			month = 1;
		}else if (month < 1){
			month = 12;
		}
		/*
		Company : Mutlfirames - www.multiframes.com
		Author Mohamad Cheaib Software Engineer
		Copyright 2010-6-30
		*/
		if (year == ""){
			var d = new Date();
			year = d.getFullYear();
		}
		if(action == "nextMonth" || action == "previousMonth"){
			if(action == "nextMonth"){
				newMonthValue = parseInt(month) + 1 ;
				document.getElementById('month').value = newMonthValue;
			}else if(action == "previousMonth"){
				newMonthValue = parseInt(month) - 1 ;
				document.getElementById('month').value = newMonthValue;
			}
			/*
			Company : Mutlfirames - www.multiframes.com
			Author Mohamad Cheaib Software Engineer
			Copyright 2010-6-30
			*/
			if(newMonthValue > 12){
				document.getElementById('month').value = 1;
			}else if(newMonthValue < 1){
				document.getElementById('month').value = 12;
			}
			var actionMonth=document.getElementById(action).value;
		}else if(action == "nextYear" || action == "previousYear"){
			if(action == "nextYear"){
				newYearValue = parseInt(year) + 1 ;
				document.getElementById('year').value = newYearValue;
			}else if(action == "previousYear"){
				newYearValue = parseInt(year) - 1 ;
				document.getElementById('year').value = newYearValue;
			}
			if(newYearValue < 1){
				document.getElementById('year').value = 1900;
			}
			var actionYear=document.getElementById(action).value;
		}
		/*
		Mutlfirames - www.multiframes.com
		*/
		var ajax = new GLM.AJAX();
		var url='calendarAjax.php?month='+month+'&actionMonth='+actionMonth+'&year='+year+'&actionYear='+actionYear;
		ajax.callPage(url, showSubscribeResult, "GET");	
	}
	
	function showSubscribeResult(response){
		document.getElementById('ajaxResponse').innerHTML = response;
	}
	
	/*
	Company : Mutlfirames - www.multiframes.com
	Author Mohamad Cheaib Software Engineer
	Copyright 2010-6-30
	*/
	//
	function getDateInputs(gregorianId,hijriId){
	var gregorianDate = document.getElementById(gregorianId).value;
	var hijriDate = document.getElementById(hijriId).value;
	
	document.getElementById('gregorianDateOutput').value = gregorianDate;
	document.getElementById('hijriDateOutput').value = hijriDate;
	updateCalendarDay();	
	hideMe();
	}
		
	function showSubscribeResult(response){
		document.getElementById('ajaxResponse').innerHTML = response;
	}
	
	/*
	Company : Mutlfirames - www.multiframes.com
	Author Mohamad Cheaib Software Engineer
	Copyright 2010-6-30
	*/
	//updating the day in the calendar when choosing a day 
	function updateCalendarDay(){
	var gregorianDate = document.getElementById('gregorianDateOutput').value;
		if(gregorianDate != ""){
			
			var explode = gregorianDate.split('-');
			var year = explode[0];
			var month = explode[1];
			var day = explode[2];
			document.getElementById('month').value = month;
			document.getElementById('year').value = year;
			
			var ajax = new GLM.AJAX();
			var url='calendarAjax.php?month='+month+'&year='+year+'&day='+day;
			ajax.callPage(url, showSubscribeResult, "GET");
		}
		
	}
	
