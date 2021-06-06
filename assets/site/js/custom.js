$(function() {
	$('#btn-poll-vote').click(function(e) {
		var f = $("#validate-poll"),
			values = f.serialize();
        $.ajax({
            url: f.attr("action"),
            type: "POST",
            data: values,
            beforeSend:function(){
                $('#error-vote').html('Loading...');
            },
            success:function(msg) {
            	if(msg.error == 1) {
            		window.location.href = msg.redirect;
            	}
            	else $('#error-vote').html(msg.error);
            }
        });
        
        e.preventDefault();
	});
});

 