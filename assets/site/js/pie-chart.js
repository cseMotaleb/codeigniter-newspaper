/*----------------------------------------------------------------------
| Script Name: Pie Chart
------------------------------------------------------------------------
| Author: Orangebd
------------------------------------------------------------------------*/
// function for create object
function createObj(selector) {
	arrObj = [];
	$(selector).each(function() {
		if($(this).attr("exploded")=='yes'){
			arrObj.push({
				y: $(this).attr("title"),
				label: $(this).val(),
				exploded: true
			});
		}else{
			arrObj.push({
				y: $(this).attr("title"),
				label: $(this).val()					
			});
		}
	});			
	return arrObj;
}

// function for pie report
function pie_report(container,header_text,data,chart_type,bg_color){
	if(chart_type=='') chart_type = 'pie';
	if(bg_color=='') bg_color = '#fff';
	var chart = new CanvasJS.Chart(container,
	{
		backgroundColor: bg_color,
		title:{
			text: header_text
		},
		exportFileName: chart_type + " Chart",
		exportEnabled: false,
		theme: "theme2",
		legend:{
			verticalAlign: "center",
			horizontalAlign: "left",
			fontSize: 14,
			fontFamily: "SolaimanLipi"
		},
		data: [{			
			type: chart_type,
			indexLabelFontSize: 14,
			indexLabelFontFamily: "SolaimanLipi",       
			indexLabelFontColor: "#666",
			indexLabelLineColor: "#ccc",        
			indexLabelPlacement: "outside",
			startAngle:0,
			showInLegend: false,
			toolTipContent: "{y} %", 					

			dataPoints: data
		}]
	});

	chart.render();
}

// function for load_poll_pie_chart
function load_pie_chart(data_container,container,header_text,chart_type,bg_color){
	/**
	 * Doughnut graph reports for requests data
	 */
	data = createObj(data_container);
	pie_report(container,header_text,data,chart_type,bg_color);
}