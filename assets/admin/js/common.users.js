function make_select2(query, url, custom_input) {
	$.getJSON(url, function(datajson) {
		var data = {results: []}, i, j, s;
		if(custom_input == 1) {
			data.results.push({id: query.term, text: query.term + ' (Create New)'});
		}
		$.each(datajson, function(key, val) {
			//data.results.push({id: key, text: val});
			data.results.push({id: val.opt_code, text: val.opt_name});
		});
		query.callback(data);
	});	
}