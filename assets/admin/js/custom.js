+function ($) { "use strict";

	jQuery("#all_bulk").click(function () {
		if(jQuery(this).prop('checked') == true){
			jQuery('.bulk_checkbox').each(function() {
				this.checked = true;
			});
		}
		else {
			jQuery('.bulk_checkbox').each(function() {
				this.checked = false;
			});
		}
	});

	jQuery(".edatepicker").each(function() {
		var a = jQuery(this).attr("id");
		jQuery("#"+a).datepicker({
			dateFormat : 'yy-mm-dd',
			prevText : '<i class="fa fa-chevron-left"></i>',
			nextText : '<i class="fa fa-chevron-right"></i>'
		});
	});

	jQuery(".ctags").each(function() {
		var a = jQuery(this).attr("id");
	    $('#'+a).select2({
	        tags: [],
	        tokenSeparators: [",", " "]
	    });
	}); 

	jQuery(".bulkConfirm").click(function (event) {
		jQuery.ajax({
			async: false,
			type:'POST',
			url: jQuery("#BulkDeleteForm").attr("action"),
			data: jQuery("#BulkDeleteForm").serializeArray(),
			success: function(response) {
		  		jQuery('.bulk_checkbox').each(function() {
		  			var sThisVal = (this.checked ? 1 : 0);
		  			if(sThisVal) {
		  				var id = jQuery(this).val();
		  				jQuery("#hiderow"+id).hide();
		  			}
		  		});
			}
		});
	});

	jQuery(".changeURL").click(function (event) {
		event.preventDefault();
		var url = jQuery(this).data("url");
		var p = location.pathname;
		p = p.substring(p.length-1) == '/' ? p.substring(0, p.length-1) : p;
		p.split('/').pop();
		window.location.href = p+url;
	});

    jQuery("#find_lang").change(function (event) {
		event.preventDefault();
		var $this = jQuery(this),
			id = $this.val(),
			lang_url = $this.data("lang_url"),
			url = $this.data("url"),
			p = location.pathname;
		p = p.substring(p.length-1) == '/' ? p.substring(0, p.length-1) : p;
		p.split('/').pop();
		if(id) window.location.href = p+lang_url+id;
		else window.location.href = p+url;
		location.reload();
	});

    jQuery(".btnDel").click(function (event) {
		event.preventDefault();
		var id = jQuery(this).attr('id');
		$("#hidden_input_id").val(id);
	});

	jQuery(".ConfirmDel").click(function (event) {
		event.preventDefault();
		var id = jQuery("#hidden_input_id").val(),
			url = jQuery(".btnDel").data("url");
		jQuery.get(url+"/"+id, function(response) {
			jQuery("#hiderow"+id).hide();
		});
	});

	jQuery('.rstatusopt').editable({
	    url      : jQuery(this).data('url'),
	    success  : function(response, newValue) {             
	       processJson(response);
	    },
	    source: [{value: '1', text: 'Enabled'},{value: '0', text: 'Disabled'}],  
	});

	function processJson(data) {
		var obj = jQuery.parseJSON( data );
	    jQuery.bigBox({
	      title: obj.mtitle,
	      content: obj.mcontent,
	      color: obj.mcolor,
	      iconSmall: obj.miconSmall,
	      timeout: 10000
	    });
    };

	jQuery(".small_ckeditor").each(function() {
		var $this = jQuery(this),
			a = $this.attr("id");
		if($("#"+a).length) {
			var basicConfig = {
				height: 150,
				plugins: 'basicstyles,clipboard,indent,enterkey,entities,link,pastetext,toolbar,undo,wysiwygarea',
				removeButtons: 'Anchor,Strike,Subscript,Superscript',
				toolbarGroups: [
					{ name: 'document',	   groups: [ 'mode', 'document', 'doctools' ] },
					{ name: 'editing',     groups: [ 'find', 'selection', 'spellchecker' ] },
					{ name: 'forms' },
					{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
					{ name: 'paragraph',   groups: [ 'list', 'blocks', 'align' ] },
					{ name: 'insert' },
					{ name: 'tools' },
				]
			};

			CKEDITOR.replace( a ,
				CKEDITOR.tools.extend( basicConfig )
			);
		};
	});

	jQuery(".ckeditor").each(function() {
		var $this = jQuery(this),
			a = $this.attr("id");
		if(a.length) {
	        CKEDITOR.replace( a, {
	            toolbar: 'Standard'
	        });
	    };
	});
}(window.jQuery);