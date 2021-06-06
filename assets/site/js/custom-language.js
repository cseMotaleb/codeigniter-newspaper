$(document).ready(function(){
	var totalSpan = $('.custom-language-box .ln').length;
	var totalln = ["à¦…","à¦«","E"];
	if(totalSpan<totalln.length)
	{
		$('.custom-language-box').append('<div class="ln-select"></div>');
		$('.custom-language-box div').css({'display':'inline-block'});
			for(var i=0; i<totalln.length; i++)
		$('.custom-language-box .ln-select').append('<span class="ln">'+totalln[i]+'</span>');
		$('.custom-language-box .ln-select').css({'position':'absolute','bottom':'3px'});
	}
	$('.custom-language-box .ln-select').css({'position':'relative','display':'none', 'height':'1px'});
	$('.custom-language-box .ln-select .ln').css({'margin-right':'5px','margin-top':'-20px','padding':'3px 7px 3px 7px','font-size':'15px','background-color':'#000','color':'#FFF','cursor':'pointer'});
	$('.custom-language-box .ln-select .ln:first-child').css({'background':'#FF0000'});
	
	$('.custom-language-box .ln').click(function(){
		var par = $(this).parents('.custom-language-box');
		par.find('.ln').css({'background':'#000'});
		$(this).css({'background':'#FF0000'});
		var ran = $.now();
		var temp = '';
		if(par.find('.custom-language-text').attr('id'))
			temp = par.find('.custom-language-text').attr('id');
		else
		{
			par.find('.custom-language-text').attr('id',ran);
			temp = ran;
		}

		if($(this).index()==0)
		makeUnijoyEditor(temp);
		else if($(this).index()==1)
		makePhoneticEditor(temp);
		else if($(this).index()==2)
		$('.custom-language-box').find('.custom-language-text').removeAttr("id");
	});

	$('.custom-language-text').click(function(){
		var par = $(this).parents('.custom-language-box');
		par.children('.ln-select').fadeIn();
		var ran = $.now();

		if(!$(this).attr('id'))
		{
			$(this).attr('id',ran);
			makeUnijoyEditor(ran);
		}
		
		setTimeout(function(){
        	par.children('.ln-select').fadeOut();
		},5000);
	});
});
function checkKeyDown(e){var n=window.event?event.keyCode:e.which;"17"==n&&(ctrlPressed=!0)}function checkKeyUp(e){var n=window.event?event.keyCode:e.which;"17"==n&&(ctrlPressed=!1)}function parsePhonetic(e){var n=(document.getElementById(activeta),window.event?event.keyCode:e.which);if("113"==n&&ctrlPressed)return switched=!switched,!0;if(switched)return!0;ctrlPressed&&(n=0);var t=String.fromCharCode(n);return 8==n||32==n?(carry=" ",void(old_len=1)):(lastcarry=carry,carry+=""+t,bangla=parsePhoneticCarry(carry),tempBangla=parsePhoneticCarry(t),".."==tempBangla||".."==bangla?!1:"+"==t?"++"==carry?(insertJointAtCursor("+",old_len),old_len=1,!1):(insertAtCursor("à§"),old_len=1,carry2=carry,carry="+",!1):0==old_len?(insertJointAtCursor(bangla,1),old_len=1,!1):"ao"==carry?(insertJointAtCursor(parsePhoneticCarry("ao"),old_len),old_len=1,!1):"ii"==carry?(insertJointAtCursor(phonetic.ii,1),old_len=1,!1):"oi"==carry?(insertJointAtCursor("à§ˆ",1),!1):"o"==t?(old_len=1,insertAtCursor("à§‹"),carry="o",!1):"ou"==carry?(insertJointAtCursor("à§Œ",old_len),old_len=1,!1):""==bangla&&""!=tempBangla?(bangla=tempBangla,""==bangla?void(carry=""):(carry=t,insertAtCursor(bangla),old_len=bangla.length,!1)):""!=bangla?(insertJointAtCursor(bangla,old_len),old_len=bangla.length,!1):void 0)}function parsePhoneticCarry(e){return phonetic[e]?phonetic[e]:""}function insertAtCursor(e){var n=document.getElementById(activeta);if(document.selection)n.focus(),sel=document.selection.createRange(),sel.text=e,sel.collapse(!0),sel.select();else if(n.selectionStart||0==n.selectionStart){var t=n.selectionStart,o=n.selectionEnd,i=n.scrollTop;t=-1==t?n.value.length:t,n.value=n.value.substring(0,t)+e+n.value.substring(o,n.value.length),n.focus(),n.selectionStart=t+e.length,n.selectionEnd=t+e.length,n.scrollTop=i}else{var i=n.scrollTop;n.value+=e,n.focus(),n.scrollTop=i}}function insertJointAtCursor(e,n){var t=document.getElementById(activeta);if(document.selection)t.focus(),sel=document.selection.createRange(),t.value.length>=n&&sel.moveStart("character",-1*n),sel.text=e,sel.collapse(!0),sel.select();else if(t.selectionStart||0==t.selectionStart){t.focus();var o=t.selectionStart-n,i=t.selectionEnd,c=t.scrollTop;o=-1==o?t.value.length:o,t.value=t.value.substring(0,o)+e+t.value.substring(i,t.value.length),t.focus(),t.selectionStart=o+e.length,t.selectionEnd=o+e.length,t.scrollTop=c}else{var c=t.scrollTop;t.value+=e,t.focus(),t.scrollTop=c}}function makePhoneticEditor(e){activeTextAreaInstance=document.getElementById(e),activeTextAreaInstance.onkeypress=parsePhonetic,activeTextAreaInstance.onkeydown=checkKeyDown,activeTextAreaInstance.onkeyup=checkKeyUp,activeTextAreaInstance.onfocus=function(){activeta=e}}function makeVirtualEditor(e){activeTextAreaInstance=document.getElementById(e),activeTextAreaInstance.onfocus=function(){activeta=e}}function checkKeyDown(e){var n=window.event?event.keyCode:e.which;"17"==n&&(ctrlPressed=!0)}function checkKeyUp(e){var n=window.event?event.keyCode:e.which;"17"==n&&(ctrlPressed=!1)}function parseunijoy(e){var n=(document.getElementById(activeta),window.event?event.keyCode:e.which);if("113"==n&&ctrlPressed)return switched=!switched,!0;if(switched)return!0;ctrlPressed&&(n=0);var t=String.fromCharCode(n);return 8==n||32==n?(carry=" ",void(old_len=1)):(lastcarry=carry,carry+=""+t,bangla=parseunijoyCarry(carry),tempBangla=parseunijoyCarry(t),".."==tempBangla||".."==bangla?!1:"g"==t?"gg"==carry?(insertConjunction("à§â€Œ",old_len),old_len=1,!1):(insertAtCursor("à§"),old_len=1,carry="g",!1):0==old_len?(insertConjunction(bangla,1),old_len=1,!1):"A"==t?(newChar=unijoy.v+"à§",insertAtCursor(newChar),old_len=1,!1):""==bangla&&""!=tempBangla?(bangla=tempBangla,""==bangla?void(carry=""):(carry=t,insertAtCursor(bangla),old_len=bangla.length,!1)):""!=bangla?(insertConjunction(bangla,old_len),old_len=bangla.length,!1):void 0)}function parseunijoyCarry(e){return unijoy[e]?unijoy[e]:""}function insertAtCursor(e){lastInserted=e;var n=document.getElementById(activeta);if(document.selection)n.focus(),sel=document.selection.createRange(),sel.text=e,sel.collapse(!0),sel.select();else if(n.selectionStart||0==n.selectionStart){var t=n.selectionStart,o=n.selectionEnd,i=n.scrollTop;t=-1==t?n.value.length:t,n.value=n.value.substring(0,t)+e+n.value.substring(o,n.value.length),n.focus(),n.selectionStart=t+e.length,n.selectionEnd=t+e.length,n.scrollTop=i}else{var i=n.scrollTop;n.value+=e,n.focus(),n.scrollTop=i}}function insertConjunction(e,n){lastInserted=e;var t=document.getElementById(activeta);if(document.selection)t.focus(),sel=document.selection.createRange(),t.value.length>=n&&sel.moveStart("character",-1*n),sel.text=e,sel.collapse(!0),sel.select();else if(t.selectionStart||0==t.selectionStart){t.focus();var o=t.selectionStart-n,i=t.selectionEnd,c=t.scrollTop;o=-1==o?t.value.length:o,t.value=t.value.substring(0,o)+e+t.value.substring(i,t.value.length),t.focus(),t.selectionStart=o+e.length,t.selectionEnd=o+e.length,t.scrollTop=c}else{var c=t.scrollTop;t.value+=e,t.focus(),t.scrollTop=c}}function makeUnijoyEditor(e){activeTextAreaInstance=document.getElementById(e),activeTextAreaInstance.onkeypress=parseunijoy,activeTextAreaInstance.onkeydown=checkKeyDown,activeTextAreaInstance.onkeyup=checkKeyUp,activeTextAreaInstance.onfocus=function(){activeta=e}}var activeta,phonetic=new Array;phonetic.k="à¦•",phonetic[0]="à§¦",phonetic[1]="à§§",phonetic[2]="à§¨",phonetic[3]="à§©",phonetic[4]="à§ª",phonetic[5]="à§«",phonetic[6]="à§¬",phonetic[7]="à§­",phonetic[8]="à§®",phonetic[9]="à§¯",phonetic.i="à¦¿",phonetic.I="à¦‡",phonetic.ii="à§€",phonetic.II="à¦ˆ",phonetic.e="à§‡",phonetic.E="à¦",phonetic.U="à¦‰",phonetic.u="à§",phonetic.uu="à§‚",phonetic.UU="à¦Š",phonetic.r="à¦°",phonetic.WR="à¦‹",phonetic.a="à¦¾",phonetic.A="à¦†",phonetic.ao="à¦…",phonetic.s="à¦¸",phonetic.t="à¦Ÿ",phonetic.K="à¦–",phonetic.kh="à¦–",phonetic.n="à¦¨",phonetic.N="à¦£",phonetic.T="à¦¤",phonetic.Th="à¦¥",phonetic.d="à¦¡",phonetic.dh="à¦¢",phonetic.b="à¦¬",phonetic.bh="à¦­",phonetic.v="à¦­",phonetic.R="à¦¡à¦¼",phonetic.Rh="à¦¢à¦¼",phonetic.g="à¦—",phonetic.G="à¦˜",phonetic.gh="à¦˜",phonetic.h="à¦¹",phonetic.NG="à¦ž",phonetic.j="à¦œ",phonetic.J="à¦",phonetic.jh="à¦",phonetic.c="à¦š",phonetic.ch="à¦š",phonetic.C="à¦›",phonetic.th="à¦ ",phonetic.p="à¦ª",phonetic.f="à¦«",phonetic.ph="à¦«",phonetic.D="à¦¦",phonetic.Dh="à¦§",phonetic.z="à¦¯",phonetic.y="à¦¯à¦¼",phonetic.Ng="à¦™",phonetic.ng="à¦‚",phonetic.l="à¦²",phonetic.m="à¦®",phonetic.sh="à¦¶",phonetic.S="à¦·",phonetic.O="à¦“",phonetic.ou="à¦œ",phonetic.OU="à¦”",phonetic.Ou="à¦”",phonetic.Oi="à¦",phonetic.OI="à¦",phonetic.tt="à§Ž",phonetic.H="à¦ƒ",phonetic["."]="à¥¤",phonetic[".."]=".",phonetic.HH="à§â€Œ",phonetic.NN="à¦",phonetic.Y="à§à¦¯",phonetic.w="à§à¦¬",phonetic.W="à§ƒ",phonetic.wr="à§ƒ",phonetic.x="à¦•à§à¦¸",phonetic.rY=phonetic.r+"â€à§à¦¯",phonetic.L=phonetic.l,phonetic.Z=phonetic.z,phonetic.P=phonetic.p,phonetic.V=phonetic.v,phonetic.B=phonetic.b,phonetic.M=phonetic.m,phonetic.V=phonetic.v,phonetic.X=phonetic.x,phonetic.V=phonetic.v,phonetic.F=phonetic.f;var carry="",old_len=0,ctrlPressed=!1,len_to_process_oi_kar=0,first_letter=!1,carry2="";isIE=document.all?1:0;var switched=!1,activeta,unijoy=new Array;unijoy[0]="à§¦",unijoy[1]="à§§",unijoy[2]="à§¨",unijoy[3]="à§©",unijoy[4]="à§ª",unijoy[5]="à§«",unijoy[6]="à§¬",unijoy[7]="à§­",unijoy[8]="à§®",unijoy[9]="à§¯",unijoy.j="à¦•",unijoy.d="à¦¿",unijoy.gd="à¦‡",unijoy.D="à§€",unijoy.gD="à¦ˆ",unijoy.c="à§‡",unijoy.gc="à¦",unijoy.gs="à¦‰",unijoy.s="à§",unijoy.S="à§‚",unijoy.gS="à¦Š",unijoy.v="à¦°",unijoy.a="à¦‹",unijoy.f="à¦¾",unijoy.gf="à¦†",unijoy.F="à¦…",unijoy.n="à¦¸",unijoy.t="à¦Ÿ",unijoy.J="à¦–",unijoy.b="à¦¨",unijoy.B="à¦£",unijoy.k="à¦¤",unijoy.K="à¦¥",unijoy.e="à¦¡",unijoy.E="à¦¢",unijoy.h="à¦¬",unijoy.H="à¦­",unijoy.p="à¦¡à¦¼",unijoy.P="à¦¢à¦¼",unijoy.o="à¦—",unijoy.O="à¦˜",unijoy.i="à¦¹",unijoy.I="à¦ž",unijoy.u="à¦œ",unijoy.U="à¦",unijoy.y="à¦š",unijoy.Y="à¦›",unijoy.T="à¦ ",unijoy.r="à¦ª",unijoy.R="à¦«",unijoy.l="à¦¦",unijoy.L="à¦§",unijoy.w="à¦¯",unijoy.W="à¦¯à¦¼",unijoy.q="à¦™",unijoy.Q="à¦‚",unijoy.V="à¦²",unijoy.m="à¦®",unijoy.M="à¦¶",unijoy.N="à¦·",unijoy.gx="à¦“",unijoy.X="à§Œ",unijoy.gX="à¦”",unijoy.gC="à¦",unijoy["\\"]="à¦ƒ",unijoy["|"]="à§Ž",unijoy.G="à¥¤",unijoy.g=" ",unijoy["&"]="à¦",unijoy.Z="à§à¦¯",unijoy.gh="à§à¦¬",unijoy.ga="à¦‹",unijoy.a="à§ƒ",unijoy.vZ=unijoy.v+"â€Œà§à¦¯",unijoy.z="à§"+unijoy.v,unijoy.x="à§‹",unijoy.C="à§ˆ";var carry="",old_len=0,ctrlPressed=!1,first_letter=!1,lastInserted;isIE=document.all?1:0;var switched=!1;