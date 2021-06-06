/**
 * Unicode Phonetic Parser for writing in webpages
 * This script transliterate the user input and display unicode bangla characters
 * 
 * @name Ekushey Unicode Parser
 * @version 1.0 [Date 30th July, 2006]
 * @author Hasin Hayder. Visit My Homepage at http://hasin.wordpress.com
 * @license LGPL
 */
 
/**
 * This script is released under Lesser GNU Public License [LGPL] 
 * which implies that you are free to use this script in your 
 * web applications without any problem. No warranty ensured. If you like 
 * this script, Please acknowledge by keeping a link to my website 
 * http://hasin.wordpress.com in the page where you use this script. 
 */ 
/*
Last Modification:01/11/2008 by Sabuj Kundu(http://manchu.wordpress.com)
Last Modification: 26 Jan 2008 by Omi Azad (http://omi.net.bd)
*/
// Set of Characters
var activeta; //active text area
var phonetic=new Array();

// phonetic bangla equivalents
//Bengali: {U+0980..U+09FF} 
phonetic['k'] = '\u0995'; // ko
//digits
phonetic['0']='\u09e6';//'à§¦'; 
phonetic['1']='\u09e7';//'à§§';
phonetic['2']='\u09e8';//'à§¨';
phonetic['3']='\u09e9';//'à§©';
phonetic['4']='\u09ea';//'à§ª';
phonetic['5']='\u09eb';//'à§«';
phonetic['6']='\u09ec';//'à§¬';
phonetic['7']='\u09ed';//'à§­';
phonetic['8']='\u09ee';//'à§®';
phonetic['9']='\u09ef';//'à§¯';

phonetic['i']='\u09BF'; // hrossho i kar
phonetic['I']='\u0987'; // hrossho i
phonetic['ii']='\u09C0'; // dirgho i kar
phonetic['II']='\u0988'; // dirgho i
phonetic['e']='\u09C7'; // e kar
phonetic['E'] = '\u098F'; // E
phonetic['U'] = '\u0989'; // hrossho u
phonetic['u'] = '\u09C1'; // hrossho u kar
phonetic['uu'] = '\u09C2'; // dirgho u kar
phonetic['UU'] = '\u098A'; // dirgho u
phonetic['r']='\u09B0'; // ro
phonetic['WR']='\u098B'; // wri
phonetic['a']='\u09BE'; // a kar
phonetic['A']='\u0986'; // shore a
phonetic['ao']='\u0985'; // shore o
phonetic['s']='\u09B8'; // dontyo so
phonetic['t']='\u099f'; // to
phonetic['K'] = '\u0996'; // Kho

phonetic['kh'] = '\u0996'; // kho

phonetic['n']='\u09A8'; // dontyo no
phonetic['N']='\u09A3'; // murdhonyo no
phonetic['T']='\u09A4'; // tto
phonetic['Th']='\u09A5'; // ttho

phonetic['d']='\u09A1'; // ddo
phonetic['dh']='\u09A2'; // ddho

phonetic['b']='\u09AC'; // bo
phonetic['bh']='\u09AD'; // bho
phonetic['v']='\u09AD'; // bho
//phonetic['rh']='o';	 // doye bindu ro
phonetic['R']='\u09DC';	 // doye bindu ro
phonetic['Rh']='\u09DD';	 // dhoye bindu ro
phonetic['g']='\u0997';	// go
phonetic['G']='\u0998';	// gho

phonetic['gh']='\u0998'; // gho

phonetic['h']='\u09B9';	// ho
phonetic['NG']='\u099E';	// yo
phonetic['j']='\u099C';	// borgio jo
phonetic['J']='\u099D'; // jho
phonetic['jh']='\u099D'; // jho
phonetic['c']='\u099A'; //  cho
phonetic['ch']='\u099A'; // cho
phonetic['C']='\u099B'; // ccho
phonetic['th']='\u09A0'; // tho
phonetic['p']='\u09AA'; // po
phonetic['f']='\u09AB'; // fo
phonetic['ph']='\u09AB'; // fo
phonetic['D']='\u09A6'; // do
phonetic['Dh']='\u09A7'; // dho

phonetic['z']='\u09AF';// ontoshyo zo
phonetic['y']='\u09DF';	// ontostho yo
phonetic['Ng']='\u0999';	// Uma
phonetic['ng']='\u0982';	// uniswor
phonetic['l']='\u09B2';	// lo
phonetic['m']='\u09AE';	// mo
phonetic['sh']='\u09B6';	// talobyo sho
phonetic['S']='\u09B7'; // mordhonyo sho
phonetic['O']= '\u0993';//'\u09CB'; // o
phonetic['ou']='\u099C'; // ou kar
phonetic['OU']='\u0994'; // OU
phonetic['Ou']='\u0994'; // OU
phonetic['Oi']='\u0990'; // OU
phonetic['OI']='\u0990'; // OU
phonetic['tt']='\u09CE'; // tto
phonetic['H']='\u0983'; // bisworgo
phonetic["."] ="\u0964"; // dari
phonetic[".."] = "."; // fullstop
phonetic['HH'] = '\u09CD' + '\u200c'; // hosonto
phonetic['NN'] = '\u0981'; // chondrobindu
phonetic['Y'] ='\u09CD'+'\u09AF'; // jo fola
phonetic['w'] ='\u09CD'+ '\u09AC'; // wri kar
phonetic['W'] ='\u09C3';// wri kar
phonetic['wr'] ='\u09C3'; // wri kar
phonetic['x'] ="\u0995"  + '\u09CD'+ '\u09B8';
phonetic['rY'] = phonetic['r']+ '\u200D'+ '\u09CD'+'\u09AF';
phonetic['L'] = phonetic['l'];
phonetic['Z'] = phonetic['z'];
phonetic['P'] = phonetic['p'];
phonetic['V'] = phonetic['v'];
phonetic['B'] = phonetic['b'];
phonetic['M'] = phonetic['m'];
phonetic['V'] = phonetic['v'];
phonetic['X'] = phonetic['x'];
phonetic['V'] = phonetic['v'];
phonetic['F'] = phonetic['f'];
//End Set


var carry = '';  //This variable stores each keystrokes
var old_len =0; //This stores length parsed bangla charcter
var ctrlPressed=false;
var len_to_process_oi_kar=0;
var first_letter = false;
var carry2="";
isIE=document.all? 1:0;
var switched=false;

function checkKeyDown(ev)
{
	//just track the control key
	var e = (window.event) ? event.keyCode : ev.which;
	if (e=='17')
	{
		ctrlPressed = true;
	}
}

function checkKeyUp(ev)
{
	//just track the control key
	var e = (window.event) ? event.keyCode : ev.which;
	if (e=='17')
	{
		ctrlPressed = false;
		//alert(ctrlPressed);
	}

}


function parsePhonetic(evnt)
{
	// main phonetic parser
	var t = document.getElementById(activeta); // the active text area
	var e = (window.event) ? event.keyCode : evnt.which; // get the keycode

	if (e=='113')
	{
		//switch the keyboard mode
		if(ctrlPressed){
			switched = !switched;
			//alert("H"+switched);
			return true;
		}
	}

	if (switched) return true;
	
	if(ctrlPressed)
	{
		// user is pressing control, so leave the parsing
		e=0; 
	}

	var char_e = String.fromCharCode(e); // get the character equivalent to this keycode
	
	if(e==8 || e==32)
	{
		// if space is pressed we have to clear the carry. otherwise there will be some malformed conjunctions
		carry = " ";	
		old_len = 1;
		return;
	}

	lastcarry = carry;
	carry += "" + char_e;	 //append the current character pressed to the carry
	
	bangla = parsePhoneticCarry(carry); // get the combined equivalent
	tempBangla = parsePhoneticCarry(char_e); // get the single equivalent

	if (tempBangla == ".." || bangla == "..") //that means it has next sibling
	{
		return false;
	}
	if (char_e=="+")
	{
		if(carry=="++")
		{
			// check if it is a plus sign
			insertJointAtCursor("+",old_len);
			old_len=1;
			return false;
		}	
		//otherwise this is a simple joiner
		insertAtCursor("\u09CD");old_len = 1;
		carry2=carry;
		carry="+";
		return false;
	}
	else if(old_len==0) //first character
	{
		// this is first time someone press a character
		insertJointAtCursor(bangla,1);
		old_len=1;
		return false;
		
	}
/*	else if((char_e=='z' || char_e=='Z')&& carry2=="r+")//force Za-phola after Ra
	{
		//alert('yes');
		insertJointAtCursor('\u200D'+'\u09CD'+phonetic['z'],1);
		old_len=1;	
		return false;
	} */
	else if(carry=="ao")
	{
		// its a shore o
		insertJointAtCursor(parsePhoneticCarry("ao"),old_len);
		old_len=1;
		return false;
	}
	else if (carry == "ii")
	{
		// process dirgho i kar

		insertJointAtCursor(phonetic['ii'],1);
		old_len = 1;
		return false;
	}
	else if (carry == "oi" )
	{
		insertJointAtCursor('\u09C8',1);
		return false;
	}		

	else if (char_e == "o")
	{
		old_len = 1;
		insertAtCursor('\u09CB');
		carry = "o";
		return false;
	}
	else if (carry == "ou")
	{
		// ou kar
		insertJointAtCursor("\u09CC",old_len);
		old_len = 1;
		return false;
	}	
	
	else if((bangla == "" && tempBangla !="")) //that means it has no joint equivalent
	{
		
		// there is no joint equivalent - so show the single equivalent. 
		bangla = tempBangla;
		if (bangla=="")
		{
			// there is no available equivalent - leave as is
			carry ="";
			return;
		}
		
		else
		{
			// found one equivalent
			carry = char_e;
			insertAtCursor(bangla);
			old_len = bangla.length;
			return false;
		}
	}
	else if(bangla!="")//joint equivalent found 
	{
		// we have found some joint equivalent process it
		
		insertJointAtCursor(bangla, old_len);
		old_len = bangla.length;
		return false;
	}
}

    function parsePhoneticCarry(code)
    {
	//this function just returns a bangla equivalent for a given keystroke
	//or a conjunction
	//just read the array - if found then return the bangla eq.
	//otherwise return a null value
        if (!phonetic[code])  //Oh my god :-( no bangla equivalent for this keystroke

        {
			return ''; //return a null value
        }
        else
        {
            return ( phonetic[code]);  //voila - we've found bangla equivalent
        }

    }


function insertAtCursor(myValue) {
	/**
	 * this function inserts a character at the current cursor position in a text area
	 * many thanks to alex king and phpMyAdmin for this cool function
	 * 
	 * This function is originally found in phpMyAdmin package and modified by Hasin Hayder to meet the requirement
	 */
	var myField = document.getElementById(activeta);
	if (document.selection) {		
		myField.focus();
		sel = document.selection.createRange();
		sel.text = myValue;
		sel.collapse(true);
		sel.select();
	}
	//MOZILLA/NETSCAPE support
	else if (myField.selectionStart || myField.selectionStart == 0) {
		
		var startPos = myField.selectionStart;
		var endPos = myField.selectionEnd;
		var scrollTop = myField.scrollTop;
		startPos = (startPos == -1 ? myField.value.length : startPos );
		myField.value = myField.value.substring(0, startPos)
		+ myValue
		+ myField.value.substring(endPos, myField.value.length);
		myField.focus();
		myField.selectionStart = startPos + myValue.length;
		myField.selectionEnd = startPos + myValue.length;
		myField.scrollTop = scrollTop;
	} else {
		var scrollTop = myField.scrollTop;
		myField.value += myValue;
		myField.focus();
		myField.scrollTop = scrollTop;
	}
}

function insertJointAtCursor(myValue, len) {
	/**
	 * this function inserts a conjunction and removes previous single character at the current cursor position in a text area
	 * 
	 * This function is derived from the original one found in phpMyAdmin package and modified by Hasin to meet our need
	 */
	//alert(len);
	var myField = document.getElementById(activeta);
	if (document.selection) {
		myField.focus();
		sel = document.selection.createRange();
		if (myField.value.length >= len){  // here is that first conjunction bug in IE, if you use the > operator
			sel.moveStart('character', -1*(len));   
			//sel.moveEnd('character',-1*(len-1));
		}
		sel.text = myValue;
		sel.collapse(true);
		sel.select();
	}
	//MOZILLA/NETSCAPE support
	else if (myField.selectionStart || myField.selectionStart == 0) {
		myField.focus();
		var startPos = myField.selectionStart-len;
		var endPos = myField.selectionEnd;
		var scrollTop = myField.scrollTop;
		startPos = (startPos == -1 ? myField.value.length : startPos );
		myField.value = myField.value.substring(0, startPos)
		+ myValue
		+ myField.value.substring(endPos, myField.value.length);
		myField.focus();
		myField.selectionStart = startPos + myValue.length;
		myField.selectionEnd = startPos + myValue.length;
		myField.scrollTop = scrollTop;
	} else {
		var scrollTop = myField.scrollTop;
		myField.value += myValue;
		myField.focus();
		myField.scrollTop = scrollTop;
	}
	//document.getElementById("len").innerHTML = len;
}

function makePhoneticEditor(textAreaId)
{
	activeTextAreaInstance = document.getElementById(textAreaId);
	activeTextAreaInstance.onkeypress = parsePhonetic; 
	activeTextAreaInstance.onkeydown = checkKeyDown; 
	activeTextAreaInstance.onkeyup = checkKeyUp;
	activeTextAreaInstance.onfocus = function(){activeta=textAreaId;};
}
function makeVirtualEditor(textAreaId)
{
	activeTextAreaInstance = document.getElementById(textAreaId);
	activeTextAreaInstance.onfocus = function(){activeta=textAreaId;};
}
/**
 * Unicode unijoy Parser for writing in webpages
 * This script helps to write unicode bangla using unijoy keyboard mapping
 * 
 * @name Unijoy Unicode Parser
 * @version 1.0 [Date 26th August, 2006]
 * @author Hasin Hayder. Visit My Homepage at http://www.hasinhyder.net
 * @license LGPL
 */
 
/**
 * This script is released under Lesser GNU Public License [LGPL] 
 * which implies that you are free to use this script in your 
 * web applications without any problem. No warranty ensured. If you like 
 * this script, Please acknowledge by keeping a link to my website 
 * http://hasin.wordpress.com in the page where you use this script. 
 */ 
/*
Last Modification:01/11/2008 by Sabuj Kundu(http://manchu.wordpress.com)
*/
// Set of Characters
var activeta; //active text area
var unijoy=new Array();

unijoy['0']='\u09e6';//'à§¦'; 
unijoy['1']='\u09e7';//'à§§';
unijoy['2']='\u09e8';//'à§¨';
unijoy['3']='\u09e9';//'à§©';
unijoy['4']='\u09ea';//'à§ª';
unijoy['5']='\u09eb';//'à§«';
unijoy['6']='\u09ec';//'à§¬';
unijoy['7']='\u09ed';//'à§­';
unijoy['8']='\u09ee';//'à§®';
unijoy['9']='\u09ef';//'à§¯';

// unijoy bangla equivalents
unijoy['j'] = '\u0995'; // ko

unijoy['d']='\u09BF'; // hrossho i kar
unijoy['gd']='\u0987'; // hrossho i
unijoy['D']='\u09C0'; // dirgho i kar
unijoy['gD']='\u0988'; // dirgho i
unijoy['c']='\u09C7'; // e kar
unijoy['gc'] = '\u098F'; // E
unijoy['gs'] = '\u0989'; // hrossho u
unijoy['s'] = '\u09C1'; // hrossho u kar
unijoy['S'] = '\u09C2'; // dirgho u kar
unijoy['gS'] = '\u098A'; // dirgho u
unijoy['v']='\u09B0'; // ro
unijoy['a']='\u098B'; // wri
unijoy['f']='\u09BE'; // a kar
unijoy['gf'] = '\u0986'; //shore a
unijoy['F']='\u0985'; // shore ao
//unijoy['ao']='\u0985'; // shore o
unijoy['n']='\u09B8'; // dontyo so
unijoy['t']='\u099f'; // to
unijoy['J'] = '\u0996'; // Kho

//unijoy['kh'] = '\u0996'; // kho

unijoy['b']='\u09A8'; // dontyo no
unijoy['B']='\u09A3'; // murdhonyo no
unijoy['k']='\u09A4'; // tto
unijoy['K']='\u09A5'; // ttho

unijoy['e']='\u09A1'; // ddo
unijoy['E']='\u09A2'; // ddho

unijoy['h']='\u09AC'; // bo
unijoy['H']='\u09AD'; // bho
//unijoy['v']='\u09AD'; // bho
//unijoy['rh']='o';	 // doye bindu ro
unijoy['p']='\u09DC';	 // doye bindu ro
unijoy['P']='\u09DD';	 // dhoye bindu ro
unijoy['o']='\u0997';	// go
unijoy['O']='\u0998';	// gho

//unijoy['gh']='\u0998'; // gho

unijoy['i']='\u09B9';	// ho
unijoy['I']='\u099E';	// yo
unijoy['u']='\u099C';	// borgio jo
unijoy['U']='\u099D'; // jho
//unijoy['jh']='\u099D'; // jho
unijoy['y']='\u099A'; //  cho
unijoy['Y']='\u099B'; // cho
//unijoy['C']='\u099B'; // ccho
unijoy['T']='\u09A0'; // tho
unijoy['r']='\u09AA'; // po
unijoy['R']='\u09AB'; // fo
//unijoy['ph']='\u09AB'; // fo
unijoy['l']='\u09A6'; // do
unijoy['L']='\u09A7'; // dho

unijoy['w']='\u09AF';// ontoshyo zo
unijoy['W']='\u09DF';	// ontostho yo
unijoy['q']='\u0999';	// Uma
unijoy['Q']='\u0982';	// uniswor
unijoy['V']='\u09B2';	// lo
unijoy['m']='\u09AE';	// mo
unijoy['M']='\u09B6';	// talobyo sho
unijoy['N']='\u09B7'; // mordhonyo sho
unijoy['gx']= '\u0993';//'\u09CB'; // o
unijoy['X']='\u09CC'; // ou kar
unijoy['gX']='\u0994'; // OU
//unijoy['Ou']='\u0994'; // OU
unijoy['gC']='\u0990'; // Oi
unijoy['\\']='\u0983'; // khandaTa
unijoy['|']='\u09CE'; // bisworgo
unijoy["G"] ="\u0964"; // dari
//unijoy[".."] = "."; // fullstop
unijoy['g'] = ' ';//'\u09CD' + '\u200c'; // hosonto
unijoy['&'] = '\u0981'; // chondrobindu
unijoy['Z'] ='\u09CD'+'\u09AF'; // jo fola
unijoy['gh'] ='\u09CD'+ '\u09AC'; // bo fola
unijoy['ga'] ='\u098B';// wri kar
unijoy['a'] ='\u09C3'; // wri 
//unijoy['k'] ="\u0995"  + '\u09CD'+ '\u09B8';
unijoy['vZ'] = unijoy['v']+ '\u200C'+ '\u09CD'+'\u09AF';
unijoy['z'] =  '\u09CD'+ unijoy['v'];
unijoy['x'] = '\u09CB';
unijoy['C'] = '\u09C8'; //Oi Kar



var carry = '';  //This variable stores each keystrokes
var old_len =0; //This stores length parsed bangla charcter
var ctrlPressed=false;
var first_letter = false;
var lastInserted;

isIE=document.all? 1:0;
var switched=false;

function checkKeyDown(ev)
{
	//just track the control key
	var e = (window.event) ? event.keyCode : ev.which;
	if (e=='17')
	{
		ctrlPressed = true;
	}
}

function checkKeyUp(ev)
{
	//just track the control key
	var e = (window.event) ? event.keyCode : ev.which;
	if (e=='17')
	{
		ctrlPressed = false;
		//alert(ctrlPressed);
	}

}


function parseunijoy(evnt)
{
	// main unijoy parser
	var t = document.getElementById(activeta); // the active text area
	var e = (window.event) ? event.keyCode : evnt.which; // get the keycode

	if (e=='113')
	{
		//switch the keyboard mode
		if(ctrlPressed){
			switched = !switched;
			//alert("H"+switched);
			return true;
		}
	}

	if (switched) return true;
	
	if(ctrlPressed)
	{
		// user is pressing control, so leave the parsing
		e=0; 
	}

	var char_e = String.fromCharCode(e); // get the character equivalent to this keycode
	
	if(e==8 || e==32)
	{
		// if space is pressed we have to clear the carry. otherwise there will be some malformed conjunctions
		carry = " ";	
		old_len = 1;
		return;
	}

	lastcarry = carry;
	carry += "" + char_e;	 //append the current character pressed to the carry
	
	bangla = parseunijoyCarry(carry); // get the combined equivalent
	tempBangla = parseunijoyCarry(char_e); // get the single equivalent

	if (tempBangla == ".." || bangla == "..") //that means it has sibling
	{
		return false;
	}
	if (char_e=="g")
	{
		if(carry=="gg")
		{
			// check if it is a plus sign
			insertConjunction('\u09CD' + '\u200c',old_len);
			old_len=1;
			return false;
		}	
		//otherwise this is a simple joiner
		insertAtCursor("\u09CD");old_len = 1;
		carry="g";
		return false;
	}

	else if(old_len==0) //first character
	{
		// this is first time someone press a character
		insertConjunction(bangla,1);
		old_len=1;
		return false;
		
	}

	else if(char_e=="A")
	{
		//process old style ref
		newChar = unijoy['v']+ '\u09CD';
		insertAtCursor(newChar);
		old_len = 1;
		return false;
	}

	
	else if((bangla == "" && tempBangla !="")) //that means it has no joint equivalent
	{
		
		// there is no joint equivalent - so show the single equivalent. 
		bangla = tempBangla;
		if (bangla=="")
		{
			// there is no available equivalent - leave as is
			carry ="";
			return;
		}
		
		else
		{
			// found one equivalent
			carry = char_e;
			insertAtCursor(bangla);
			old_len = bangla.length;
			return false;
		}
	}
	else if(bangla!="")//joint equivalent found 
	{
		// we have found some joint equivalent process it
		
		insertConjunction(bangla, old_len);
		old_len = bangla.length;
		return false;
	}
}

    function parseunijoyCarry(code)
    {
	//this function just returns a bangla equivalent for a given keystroke
	//or a conjunction
	//just read the array - if found then return the bangla eq.
	//otherwise return a null value
        if (!unijoy[code])  //Oh my god :-( no bangla equivalent for this keystroke

        {
			return ''; //return a null value
        }
        else
        {
            return ( unijoy[code]);  //voila - we've found bangla equivalent
        }

    }


function insertAtCursor(myValue) {
	/**
	 * this function inserts a character at the current cursor position in a text area
	 * many thanks to alex king and phpMyAdmin for this cool function
	 * 
	 * This function is originally found in phpMyAdmin package and modified by Hasin Hayder to meet the requirement
	 */
	lastInserted = myValue;
	var myField = document.getElementById(activeta);
	if (document.selection) {
		//alert("hello2");
		myField.focus();
		sel = document.selection.createRange();
		sel.text = myValue;
		sel.collapse(true);
		sel.select();
	}
	//MOZILLA/NETSCAPE support
	else if (myField.selectionStart || myField.selectionStart == 0) {
		
		var startPos = myField.selectionStart;
		var endPos = myField.selectionEnd;
		var scrollTop = myField.scrollTop;
		startPos = (startPos == -1 ? myField.value.length : startPos );
		myField.value = myField.value.substring(0, startPos)
		+ myValue
		+ myField.value.substring(endPos, myField.value.length);
		myField.focus();
		myField.selectionStart = startPos + myValue.length;
		myField.selectionEnd = startPos + myValue.length;
		myField.scrollTop = scrollTop;
	} else {
		var scrollTop = myField.scrollTop;
		myField.value += myValue;
		myField.focus();
		myField.scrollTop = scrollTop;
	}
}

function insertConjunction(myValue, len) {
	/**
	 * this function inserts a conjunction and removes previous single character at the current cursor position in a text area
	 * 
	 * This function is derived from the original one found in phpMyAdmin package and modified by Hasin to meet our need
	 */
	//alert(len);
	lastInserted = myValue;
	var myField = document.getElementById(activeta);
	if (document.selection) {
		myField.focus();
		sel = document.selection.createRange();
		if (myField.value.length >= len){  // here is that first conjunction bug in IE, if you use the > operator
			sel.moveStart('character', -1*(len));   
			//sel.moveEnd('character',-1*(len-1));
		}
		sel.text = myValue;
		sel.collapse(true);
		sel.select();
	}
	//MOZILLA/NETSCAPE support
	else if (myField.selectionStart || myField.selectionStart == 0) {
		myField.focus();
		var startPos = myField.selectionStart-len;
		var endPos = myField.selectionEnd;
		var scrollTop = myField.scrollTop;
		startPos = (startPos == -1 ? myField.value.length : startPos );
		myField.value = myField.value.substring(0, startPos)
		+ myValue
		+ myField.value.substring(endPos, myField.value.length);
		myField.focus();
		myField.selectionStart = startPos + myValue.length;
		myField.selectionEnd = startPos + myValue.length;
		myField.scrollTop = scrollTop;
	} else {
		var scrollTop = myField.scrollTop;
		myField.value += myValue;
		myField.focus();
		myField.scrollTop = scrollTop;
	}
	//document.getElementById("len").innerHTML = len;
}

function makeUnijoyEditor(textAreaId)
{
	activeTextAreaInstance = document.getElementById(textAreaId);
	activeTextAreaInstance.onkeypress = parseunijoy;
	activeTextAreaInstance.onkeydown = checkKeyDown; 
	activeTextAreaInstance.onkeyup = checkKeyUp;
	activeTextAreaInstance.onfocus = function(){activeta=textAreaId;};
}
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
    function mega_menu_summary(cat_id, pid, par_id){
    	var BASE_URL = $("#base_url").val();
        var URL = BASE_URL+'ajax/mega_menu_summary?rand='+Math.random();

        // Load mega data summary
        $.ajax({
            url: URL,
            type:"POST",
            data:{ cat_id : cat_id, par_id : par_id, rand : Math.random() },
            beforeSend:function(){
                $('div.mega_list_block > #sub_mega_sum-'+pid).html('<div style="padding:10px; text-align:left">লোডিং...</div>');
            },
            success:function(msg){
                $('div.mega_list_block > #sub_mega_sum-'+pid).html(msg);
            },
            error:function(jqXHR, textStatus, errorMessage) {
            	
            }
        });
    }

    /**
     * MEGA DIST SUMMARY BLOCK FUNCTION
     */
    function mega_dist_summary(dist_title,pid){
        var URL = '';

        // Load mega data summary
        $.ajax({
            url:URL,
            type:"POST",
            data:{dist_title:dist_title},
            beforeSend:function(){
                $('div.mega_list_block > #dis_mega_sum-'+pid).html('<div style="padding:10px; text-align:left">লোডিং...</div>');
            },
            success:function(msg){
                $('div.mega_list_block > #dis_mega_sum-'+pid).html(msg);
            },
            error:function(jqXHR, textStatus, errorMessage){
            }
        });
    }

    /**
     * NTV MOST VIEW FUNCTIONS
     */
    function most_viewed_list(){
        if($('.most_view_tab_block .second-layer .btn.active').hasClass('news')) var URL = '?cat_id=';
        else if($('.most_view_tab_block .second-layer .btn.active').hasClass('videos')) var URL = '';
        else if($('.most_view_tab_block .second-layer .btn.active').hasClass('photos')) var URL = '';

        if($('.most_view_tab_block .third-layer .btn.active').hasClass('todays')) var data = 'todays';
        else if($('.most_view_tab_block .third-layer .btn.active').hasClass('one_month')) var data = 'one_month';
        else if($('.most_view_tab_block .third-layer .btn.active').hasClass('three_month')) var data = 'three_month';
        // Load cart data update
        $.ajax({
            url:URL,
            type:"POST",
            data:{data:data},
            beforeSend:function(){
                $('.most_view_tab_block .most_viewed_display_block').html('<div style="padding:5px 0">লোডিং...</div>');
            },
            success:function(msg){
                $('.most_view_tab_block .most_viewed_display_block').html(msg);
            },
            error:function(jqXHR, textStatus, errorMessage){
            }
        });
    }

    /**
     * NTV MOST VIEW FUNCTIONS
     */
    function most_commented_list(){
        if($('.most_view_tab_block .second-layer .btn.active').hasClass('news')) var URL = '?host=&cat_id=';
        else if($('.most_view_tab_block .second-layer .btn.active').hasClass('videos')) var URL = '?host=video.ntvbd.com';
        else if($('.most_view_tab_block .second-layer .btn.active').hasClass('photos')) var URL = '?host=photo.ntvbd.com';

        if($('.most_view_tab_block .third-layer .btn.active').hasClass('todays')) var data = 'todays';
        else if($('.most_view_tab_block .third-layer .btn.active').hasClass('one_month')) var data = 'one_month';
        else if($('.most_view_tab_block .third-layer .btn.active').hasClass('three_month')) var data = 'three_month';
        // Load cart data update
        $.ajax({
            url:URL,
            type:"POST",
            data:{data:data},
            beforeSend:function(){
                $('.most_view_tab_block .most_viewed_display_block').html('<div style="padding:5px 0">লোডিং...</div>');
            },
            success:function(msg){
                $('.most_view_tab_block .most_viewed_display_block').html(msg);
            },
            error:function(jqXHR, textStatus, errorMessage){
            }
        });
    }

    /**
     * NTV SEARCH FUNCTION
     */
    function ntv_search(srchInputElm){
        var keyword = srchInputElm.val().trim().toLowerCase().replace(/\s/g,'+');
        if(keyword==''){
            srchInputElm.css({'background':'#FF9','color':'#444'}).focus()
        }else{
            var srch_type = $('input[name="srch_type"]:checked').val();
            if(srch_type=='google'){
                var URL = '?q='+keyword+'&cx='+encodeURIComponent('partner-pub-2048928514082800:7777012178')+'&cof='+encodeURIComponent('FORID:10')+'&ie=UTF-8&sa=Search';
                window.location.href = URL;
            }else if(srch_type=='youtube'){
                var URL = '/?q='+keyword+'';
                window.location.href = URL;
            }
            else{
                /*var URL = ''+keyword;*/
                var URL = '?q='+keyword+'&cx='+encodeURIComponent('partner-pub-2048928514082800:7777012178')+'&cof='+encodeURIComponent('FORID:10')+'&ie=UTF-8&sa=Search';
                window.location.href = URL;
            }
        }
    }

    $(function(){
        /**
         * Mega Menu Dipslay
         */
        $('#menu_category div.mega_list_block > div.sub_mega_list > ul > li').hover(function(){
            if(!$(this).hasClass('active')){
                var cat_id 	= $(this).attr('data-val');
                var par_id 	= $(this).attr('data-par');
                var pid		= $(this).attr('parent-data');
                $('#menu_category div.mega_list_block > div.sub_mega_list > ul > li').removeClass('active');
                $(this).addClass('active');
                if(cat_id>0) mega_menu_summary(cat_id, pid, par_id);
            }
        });

        $('#menu_category > ul > li.mega_parent').hover(function(){
            /**
             * SETUP CURRECT POSITION
             */
            // get the current position
            var pos = $('div.mega_list_block',this).position();
            // setup compare position
            var com_pos = pos.left+450, limit_pos = 1190;
            if(com_pos>limit_pos){
                var diff_pos = com_pos - limit_pos;
                $('div.mega_list_block',this).css('margin-left','-'+diff_pos+'px');
            }

            $('div.mega_list_block > div.sub_mega_list > ul > li').removeClass('active');
            var cat_id 	= $('div.mega_list_block > div.sub_mega_list > ul > li:first-child',this).addClass('active').attr('data-val');
            var par_id 	= $('div.mega_list_block > div.sub_mega_list > ul > li:first-child',this).addClass('active').attr('data-par');
            var pid 	= $('div.mega_list_block > div.sub_mega_list > ul > li:first-child',this).addClass('active').attr('parent-data');
            if(cat_id>0) mega_menu_summary(cat_id, pid, par_id);
        });

        /**
         * Mega District Dipslay
         */
        $('#division_list div.mega_list_block > div.sub_mega_list > ul > li').hover(function(){
            if(!$(this).hasClass('active')){
                var dist_title 	= $(this).attr('data-val');
                var pid			= $(this).attr('parent-data');
                $('#division_list div.mega_list_block > div.sub_mega_list > ul > li').removeClass('active');
                $(this).addClass('active');
                if(dist_title!='') mega_dist_summary(dist_title,pid);
            }
        });

        $('#division_list > ul > li').hover(function(){
            /**
             * SETUP CURRECT POSITION
             */
            // get the current position
            var pos = $('div.mega_list_block',this).position();
            // setup compare position
            var com_pos = pos.left+450, limit_pos = 990;

            if(com_pos>limit_pos){
                var diff_pos = com_pos - limit_pos;
                $('div.mega_list_block',this).css('margin-left','-'+diff_pos+'px');
            }

            $('#division_list div.mega_list_block > div.sub_mega_list > ul > li').removeClass('active');
            var dist_title 	= $('div.mega_list_block > div.sub_mega_list > ul > li:first-child',this).addClass('active').attr('data-val');
            var pid 	= $('div.mega_list_block > div.sub_mega_list > ul > li:first-child',this).addClass('active').attr('parent-data');
            if(dist_title!='') mega_dist_summary(dist_title,pid);
        });

        /**
         * Corner news display
         */
        var corner_index = 0;
        var last_index = $('#top_content .top_corner_news > ul > li:last-child').index();

        var corner_news_interval = setInterval(function(){
            var cur_index = $('#top_content .top_corner_news > ul > li:visible').index();
            var nxt_index = cur_index + 1;
            if(nxt_index>last_index) nxt_index = 0;
            $('#top_content .top_corner_news > ul > li:eq('+(cur_index)+')').fadeOut();
            $('#top_content .top_corner_news > ul > li:eq('+(nxt_index)+')').fadeIn();
        },1000*5);

        /**
         * Breaking list section
         */
        var brk_list_width = 0;
        $('.headlines li').each(function(index, element) {
            brk_list_width = brk_list_width + $(this).innerWidth() + 25;
        });
        //alert(total_hl_list_width);
        $('.headlines ul').css('width',brk_list_width);

        /**
         * Healine list section
         */
        var total_hl_list_width = 0;
        $('.hl_list li').each(function(index, element) {
            total_hl_list_width = total_hl_list_width + $(this).innerWidth() + 25;
        });
        //alert(total_hl_list_width);
        $('.hl_list ul').css('width',total_hl_list_width);

        /**
         * Details page more reporter display
         */
        $('#details_content .rpt_info_section > div.rpt_more').click(function(){
            if($('i',this).hasClass('fa-arrow-circle-o-down')){
                $('i',this).removeClass('fa-arrow-circle-o-down').addClass('fa-arrow-circle-o-up');
                $('#details_content .rpt_info_section > div.rpt_more_list_block').slideDown();
            }else{
                $('i',this).removeClass('fa-arrow-circle-o-up').addClass('fa-arrow-circle-o-down');
                $('#details_content .rpt_info_section > div.rpt_more_list_block').slideUp();
            }
        });

        /**
         * Details photo slider
         */
        var cur_dtl_font_size = 15, dtl_font_low_limit = 15, dtl_font_high_limit = 30;
        $('#details_content .smallFontIcon').click(function(){
            if((cur_dtl_font_size - 1) >= dtl_font_low_limit){
                cur_dtl_font_size 		= cur_dtl_font_size - 1;
                var line_hght_size 		= cur_dtl_font_size + 4;
                $('#details_content .dtl_section').css({
                    'font-size' 	: cur_dtl_font_size + 'px',
                    'line-height'	: line_hght_size + 'px'
                });
            }
        });

        $('#details_content .bigFontIcon').click(function(){
            if((cur_dtl_font_size + 1) <= dtl_font_high_limit){
                cur_dtl_font_size 		= cur_dtl_font_size + 1;
                var line_hght_size 		= cur_dtl_font_size + 4;
                $('#details_content .dtl_section').css({
                    'font-size' 	: cur_dtl_font_size + 'px',
                    'line-height'	: line_hght_size + 'px'
                });
            }
        });

        $('#details_content .dtl_section > .dtl_img_section > ul > li.pre-photo,#details_content .dtl_section > .dtl_full_img_section > ul > li.pre-photo').click(function(){
            var cur_photo_obj = $('#details_content .dtl_section > .dtl_img_section > ul > li.pre-photo,#details_content .dtl_section > .dtl_full_img_section > ul > li.active');
            var cur_photo_index = cur_photo_obj.index();
            var pre_photo_obj = $('#details_content .dtl_section > .dtl_img_section > ul > li.pre-photo,#details_content .dtl_section > .dtl_full_img_section > ul > li.photo:nth-child('+(cur_photo_index)+')');
            if(pre_photo_obj.hasClass('photo')){
                $(cur_photo_obj).removeClass('active').fadeOut();
                $(pre_photo_obj).addClass('active').fadeIn();
            }else{
                var album_url = $(this).attr('data-album-url');
                window.location.href = album_url;
            }
        });

        $('#details_content .dtl_section > .dtl_img_section > ul > li.nxt-photo,#details_content .dtl_section > .dtl_full_img_section > ul > li.nxt-photo').click(function(){
            var cur_photo_obj = $('#details_content .dtl_section > .dtl_img_section > ul > li.nxt-photo,#details_content .dtl_section > .dtl_full_img_section > ul > li.active');
            var cur_photo_index = cur_photo_obj.index();
            var nxt_photo_obj = $('#details_content .dtl_section > .dtl_img_section > ul > li.nxt-photo,#details_content .dtl_section > .dtl_full_img_section > ul > li.photo:nth-child('+(cur_photo_index+2)+')');
            if(nxt_photo_obj.hasClass('photo')){
                $(cur_photo_obj).removeClass('active').fadeOut();
                $(nxt_photo_obj).addClass('active').fadeIn();
            }else{
                var album_url = $(this).attr('data-album-url');
                window.location.href = album_url;
            }
        });

        /**
         * MOST VIEWED OR HITS DISPLAY SECTION
         */
        $('.most_view_tab_block .first-layer .btn').click(function(){
            $('.most_view_tab_block .first-layer .btn').removeClass('active');
            $(this).addClass('active');

            if($('.most_view_tab_block .most_clicks').hasClass('active')) most_viewed_list();
            else if($('.most_view_tab_block .most_comments').hasClass('active')) most_commented_list();
        });
        $('.most_view_tab_block .second-layer .btn').click(function(){
            var rpt_type = '';
            if($('.most_view_tab_block .most_clicks').hasClass('active')){
                if(!$(this).hasClass('active')){
                    $('.most_view_tab_block .second-layer .btn').removeClass('active');
                    $(this).addClass('active');

                    most_viewed_list();
                }
            }else if($('.most_view_tab_block .most_comments').hasClass('active')){
                if(!$(this).hasClass('active')){
                    $('.most_view_tab_block .second-layer .btn').removeClass('active');
                    $(this).addClass('active');

                    most_commented_list();
                }
            }
        });

        $('.most_view_tab_block .third-layer .btn').click(function(){
            var rpt_type = '';
            if($('.most_view_tab_block .most_clicks').hasClass('active')){
                if(!$(this).hasClass('active')){
                    $('.most_view_tab_block .third-layer .btn').removeClass('active');
                    $(this).addClass('active');

                    most_viewed_list();
                }
            }else if($('.most_view_tab_block .most_comments').hasClass('active')){
                if(!$(this).hasClass('active')){
                    $('.most_view_tab_block .third-layer .btn').removeClass('active');
                    $(this).addClass('active');

                    most_commented_list();
                }
            }
        });

        // default load
        var URL = '?cat_id=';
        var data = 'todays';

        // Load cart data update
        $.ajax({
            url:URL,
            type:"POST",
            data:{data:data},
            beforeSend:function(){
                $('.most_view_tab_block .most_viewed_display_block').html('<div style="padding:5px 0">লোডিং...</div>');
            },
            success:function(msg){
                $('.most_view_tab_block .most_viewed_display_block').html(msg);
            },
            error:function(jqXHR, textStatus, errorMessage){
            }
        });


        /**
         * MOBILE MENU BAR LINK
         */
        if($("#mobile_header .cat_collapse_bar").is(':visible')){

            $("#mobile_header .cat_collapse_bar").click(function(){
                $('#mobile_menu_category > div').slideToggle();
            });

        }

        /**
         * FOOTER MORE LINK FOR MOBILE
         */
        if($("#mobile_footer .footer-morelink-bar").is(':visible')){

            $("#mobile_footer .footer-morelink-bar").click(function(){
                $('#mobile_footer .moreLinks').slideToggle();
            });

        }

        /**
         * SEARCH BUTTON ACTION
         */
        if($('#ntv_srch_keyword').is(':visible')){
            var topSrchBtnInterval = '',top_btn_click_val = 0;
            $('.top_srch_entry_type > .bn_entry_type').click(function(){
                $('#ntv_srch_keyword').focus(); top_btn_click_val = 1;
            });
            $('#ntv_srch_keyword').on('focus',function(){
                $('.top_srch_entry_type').show();
            });
            $('#ntv_srch_keyword').on('blur',function(){
                var topSrchBtnInterval = setInterval(function(){
                    if(top_btn_click_val==0){
                        $('.top_srch_entry_type').hide();
                    }else top_btn_click_val = 0;
                    clearInterval(topSrchBtnInterval);
                },200);
            });
            makeUnijoyEditor('ntv_srch_keyword');
        }
        if($('#ntv_bottom_srch_keyword').is(':visible')){
            var bottomSrchBtnInterval = '',bottom_btn_click_val = 0;
            $('.bottom_srch_entry_type > .bn_entry_type').click(function(){
                $('#ntv_bottom_srch_keyword').focus(); bottom_btn_click_val = 1;
            });
            $('#ntv_bottom_srch_keyword').on('focus',function(){
                $('.bottom_srch_entry_type').show();
            });
            $('#ntv_bottom_srch_keyword').on('blur',function(){
                var bottomSrchBtnInterval = setInterval(function(){
                    if(bottom_btn_click_val==0){
                        $('.bottom_srch_entry_type').hide();
                    }else bottom_btn_click_val = 0;
                    clearInterval(bottomSrchBtnInterval);
                },200);
            });
            makeUnijoyEditor('ntv_bottom_srch_keyword');
        }

        if($('#srch_keyword').is(':visible')) makeUnijoyEditor('srch_keyword');
        $('.ntv-srch-btn').click(function(){
            var keyword = $('.srch_keyword').val().trim().toLowerCase().replace(/\s/g,'+');
            var category = $('.srch_category').val();
            if(keyword==''){
                $('.srch_keyword').css('background','#FF9').focus()
            }else{
                var URL = '?q='+keyword;
                if(category!='') URL = URL + '&category=' + category;
                window.location.href = URL;
            }
        });

        $('.google-srch-btn').on('click', function(e){
            var category = $('.srch_category').val();
            var keyword = $('.srch_keyword').val().trim().toLowerCase().replace(/\s/g,'+');
            if(category!='') keyword = keyword + ' site:'+category;
            if(keyword==''){
                $('.srch_keyword').css('background','#FF9').focus()
            }else{
                var URL = '?q='+encodeURIComponent(keyword)+'&cx='+encodeURIComponent('partner-pub-2048928514082800:7777012178')+'&cof='+encodeURIComponent('FORID:10')+'&ie=UTF-8&sa=Search';
                window.location.href = URL;
            }
        });

        $('.searchIcon').click(function(){
            ntv_search($('.srch_keyword'));
        });

        $('#ntv_srch_keyword,#ntv_bottom_srch_keyword,#srch_keyword').keypress(function(e) {
            var p = e.which;
            if(p==13){
                ntv_search($(this));
            }
        });

        $('.srch_keyword').keyup(function(){
            var str = $(this).val().toLowerCase();
            $('.srch_keyword').val(str);
        });

        $('.bn_entry_type').click(function(){
            $('.bn_entry_type').removeClass('active');
            if($(this).hasClass('unijoy')){
                $('.bn_entry_type.unijoy').addClass('active');
                makeUnijoyEditor('ntv_srch_keyword');
                makeUnijoyEditor('ntv_bottom_srch_keyword');
            }else if($(this).hasClass('phonetic')){
                $('.bn_entry_type.phonetic').addClass('active');
                makePhoneticEditor('ntv_srch_keyword');
                makePhoneticEditor('ntv_bottom_srch_keyword');
                if($('#srch_keyword').is('visible')) makePhoneticEditor('srch_keyword');
            }else if($(this).hasClass('english')){
                $('.bn_entry_type.english').addClass('active');
            }
        });

        /**
         * TOOLTIPS SETUP
         */
        $(".tooltips").tooltip({placement : 'top'});
        $(".tooltips-bottom").tooltip({placement : 'bottom'});

        
        /**
         * ARCHIVE SUBMIT SECTION
         */
        if($('select[name="calendar_month"]').is(':visible')){
            $('select[name="calendar_month"]').on('change', function(){
                var URL = '';
                var data = $('select[name="calendar_year"]').val() + '-' + $(this).val() + '-01';

                // Load cart data update
                $.ajax({
                    url:URL,
                    type:"POST",
                    data:{data:data},
                    beforeSend:function(){
                        //$('.schedules_block').html('Loading...');
                    },
                    success:function(msg){
                        $('#arch_calendar').html(msg);
                    },
                    error:function(jqXHR, textStatus, errorMessage){
                    }
                });
            });
        }
        if($('select[name="calendar_year"]').is(':visible')){
            $('select[name="calendar_year"]').on('change', function(){
                var URL = '';
                var data = $(this).val() + '-' + $('select[name="calendar_month"]').val() + '-01';

                // Load cart data update
                $.ajax({
                    url:URL,
                    type:"POST",
                    data:{data:data},
                    beforeSend:function(){
                        //$('.schedules_block').html('Loading...');
                    },
                    success:function(msg){
                        $('#arch_calendar').html(msg);
                    },
                    error:function(jqXHR, textStatus, errorMessage){
                    }
                });
            });
        }
        if($('.archive_submit').is(':visible')){
            $('.archive_submit').click(function(){
                var sel_day = $('select[name="arch_day"]').val();
                var sel_month = $('select[name="arch_month"]').val();
                var sel_year = $('select[name="arch_year"]').val();

                if(sel_day==''){
                    $('select[name="arch_day"]').css('background','#FF9').focus();
                }else if(sel_month==''){
                    $('select[name="arch_month"]').css('background','#FF9').focus();
                }else if(sel_year==''){
                    $('select[name="arch_year"]').css('background','#FF9').focus();
                }else{
                    var sel_date = sel_year + '/' + sel_month + '/' + sel_day;
                    var URL = '' + sel_date;
                    window.location.href = URL;
                }
            });
        }

        /*Home Page Photo Slider*/
        var currentLeadNews = 1;
        var totalLeadNews = $('.photo_slider_block .img a').length;
        $('.pre_btn').click(function(){

            $('.photo_slider_block .img a:nth-child('+(currentLeadNews+1)+')').hide();
            if(currentLeadNews==totalLeadNews)
            {
                var url = $('.photo_slider_block .album_title a').attr('href');
                window.location = url;
            }
            if(currentLeadNews>1)
            {
                currentLeadNews = currentLeadNews - 1;
                $('.photo_slider_block .img a:nth-child('+(currentLeadNews+1)+')').fadeIn(100);
            }
            else
            {
                currentLeadNews = 2;
                $('.photo_slider_block .img a:nth-child('+(currentLeadNews+1)+')').fadeIn(100);
            }
        });

        $('.nxt_btn').click(function(){

            $('.photo_slider_block .img a:nth-child('+(currentLeadNews+1)+')').hide();
            if(currentLeadNews==totalLeadNews)
            {
                var url = $('.photo_slider_block .album_title a').attr('href');
                window.location = url;
            }
            if(currentLeadNews<totalLeadNews)
            {
                currentLeadNews = currentLeadNews + 1;
                $('.photo_slider_block .img a:nth-child('+(currentLeadNews+1)+')').fadeIn(100);
            }
            else
            {
                currentLeadNews = 1;
                $('.photo_slider_block .img a:nth-child('+(currentLeadNews+1)+')').fadeIn(100);
            }
        });

        /*Home Page Photo Slider*/

        /**
         * Poll section
         * Poll result display with pie-chart
         * parameters (dataClass,displayId,headerText,chartType[pie,doughnut],backgroundColor)
         */
        $('input[name="poll_ans"]').click(function(){
            $('.simple_poll .err_msg').fadeOut().html('');
        });
        $('.simple_poll .poll_submit').click(function(){
            var vote_index = $('input[name="poll_ans"]:checked').val();
            if(vote_index>=0){
                $('#poll_form').submit();
            }else{
                $('.simple_poll .err_msg').fadeIn().html('<i class="fa fa-info"></i>অনুগ্রহ করে আপনার পছন্দ নির্বাচন করুন।');
            }
        });

            });
/*!
  * Bootstrap v4.3.1 (https://getbootstrap.com/)
  * Copyright 2011-2019 The Bootstrap Authors (https://github.com/twbs/bootstrap/graphs/contributors)
  * Licensed under MIT (https://github.com/twbs/bootstrap/blob/master/LICENSE)
  */
!function(t,e){"object"==typeof exports&&"undefined"!=typeof module?e(exports,require("jquery"),require("popper.js")):"function"==typeof define&&define.amd?define(["exports","jquery","popper.js"],e):e((t=t||self).bootstrap={},t.jQuery,t.Popper)}(this,function(t,g,u){"use strict";function i(t,e){for(var n=0;n<e.length;n++){var i=e[n];i.enumerable=i.enumerable||!1,i.configurable=!0,"value"in i&&(i.writable=!0),Object.defineProperty(t,i.key,i)}}function s(t,e,n){return e&&i(t.prototype,e),n&&i(t,n),t}function l(o){for(var t=1;t<arguments.length;t++){var r=null!=arguments[t]?arguments[t]:{},e=Object.keys(r);"function"==typeof Object.getOwnPropertySymbols&&(e=e.concat(Object.getOwnPropertySymbols(r).filter(function(t){return Object.getOwnPropertyDescriptor(r,t).enumerable}))),e.forEach(function(t){var e,n,i;e=o,i=r[n=t],n in e?Object.defineProperty(e,n,{value:i,enumerable:!0,configurable:!0,writable:!0}):e[n]=i})}return o}g=g&&g.hasOwnProperty("default")?g.default:g,u=u&&u.hasOwnProperty("default")?u.default:u;var e="transitionend";function n(t){var e=this,n=!1;return g(this).one(_.TRANSITION_END,function(){n=!0}),setTimeout(function(){n||_.triggerTransitionEnd(e)},t),this}var _={TRANSITION_END:"bsTransitionEnd",getUID:function(t){for(;t+=~~(1e6*Math.random()),document.getElementById(t););return t},getSelectorFromElement:function(t){var e=t.getAttribute("data-target");if(!e||"#"===e){var n=t.getAttribute("href");e=n&&"#"!==n?n.trim():""}try{return document.querySelector(e)?e:null}catch(t){return null}},getTransitionDurationFromElement:function(t){if(!t)return 0;var e=g(t).css("transition-duration"),n=g(t).css("transition-delay"),i=parseFloat(e),o=parseFloat(n);return i||o?(e=e.split(",")[0],n=n.split(",")[0],1e3*(parseFloat(e)+parseFloat(n))):0},reflow:function(t){return t.offsetHeight},triggerTransitionEnd:function(t){g(t).trigger(e)},supportsTransitionEnd:function(){return Boolean(e)},isElement:function(t){return(t[0]||t).nodeType},typeCheckConfig:function(t,e,n){for(var i in n)if(Object.prototype.hasOwnProperty.call(n,i)){var o=n[i],r=e[i],s=r&&_.isElement(r)?"element":(a=r,{}.toString.call(a).match(/\s([a-z]+)/i)[1].toLowerCase());if(!new RegExp(o).test(s))throw new Error(t.toUpperCase()+': Option "'+i+'" provided type "'+s+'" but expected type "'+o+'".')}var a},findShadowRoot:function(t){if(!document.documentElement.attachShadow)return null;if("function"!=typeof t.getRootNode)return t instanceof ShadowRoot?t:t.parentNode?_.findShadowRoot(t.parentNode):null;var e=t.getRootNode();return e instanceof ShadowRoot?e:null}};g.fn.emulateTransitionEnd=n,g.event.special[_.TRANSITION_END]={bindType:e,delegateType:e,handle:function(t){if(g(t.target).is(this))return t.handleObj.handler.apply(this,arguments)}};var o="alert",r="bs.alert",a="."+r,c=g.fn[o],h={CLOSE:"close"+a,CLOSED:"closed"+a,CLICK_DATA_API:"click"+a+".data-api"},f="alert",d="fade",m="show",p=function(){function i(t){this._element=t}var t=i.prototype;return t.close=function(t){var e=this._element;t&&(e=this._getRootElement(t)),this._triggerCloseEvent(e).isDefaultPrevented()||this._removeElement(e)},t.dispose=function(){g.removeData(this._element,r),this._element=null},t._getRootElement=function(t){var e=_.getSelectorFromElement(t),n=!1;return e&&(n=document.querySelector(e)),n||(n=g(t).closest("."+f)[0]),n},t._triggerCloseEvent=function(t){var e=g.Event(h.CLOSE);return g(t).trigger(e),e},t._removeElement=function(e){var n=this;if(g(e).removeClass(m),g(e).hasClass(d)){var t=_.getTransitionDurationFromElement(e);g(e).one(_.TRANSITION_END,function(t){return n._destroyElement(e,t)}).emulateTransitionEnd(t)}else this._destroyElement(e)},t._destroyElement=function(t){g(t).detach().trigger(h.CLOSED).remove()},i._jQueryInterface=function(n){return this.each(function(){var t=g(this),e=t.data(r);e||(e=new i(this),t.data(r,e)),"close"===n&&e[n](this)})},i._handleDismiss=function(e){return function(t){t&&t.preventDefault(),e.close(this)}},s(i,null,[{key:"VERSION",get:function(){return"4.3.1"}}]),i}();g(document).on(h.CLICK_DATA_API,'[data-dismiss="alert"]',p._handleDismiss(new p)),g.fn[o]=p._jQueryInterface,g.fn[o].Constructor=p,g.fn[o].noConflict=function(){return g.fn[o]=c,p._jQueryInterface};var v="button",y="bs.button",E="."+y,C=".data-api",T=g.fn[v],S="active",b="btn",I="focus",D='[data-toggle^="button"]',w='[data-toggle="buttons"]',A='input:not([type="hidden"])',N=".active",O=".btn",k={CLICK_DATA_API:"click"+E+C,FOCUS_BLUR_DATA_API:"focus"+E+C+" blur"+E+C},P=function(){function n(t){this._element=t}var t=n.prototype;return t.toggle=function(){var t=!0,e=!0,n=g(this._element).closest(w)[0];if(n){var i=this._element.querySelector(A);if(i){if("radio"===i.type)if(i.checked&&this._element.classList.contains(S))t=!1;else{var o=n.querySelector(N);o&&g(o).removeClass(S)}if(t){if(i.hasAttribute("disabled")||n.hasAttribute("disabled")||i.classList.contains("disabled")||n.classList.contains("disabled"))return;i.checked=!this._element.classList.contains(S),g(i).trigger("change")}i.focus(),e=!1}}e&&this._element.setAttribute("aria-pressed",!this._element.classList.contains(S)),t&&g(this._element).toggleClass(S)},t.dispose=function(){g.removeData(this._element,y),this._element=null},n._jQueryInterface=function(e){return this.each(function(){var t=g(this).data(y);t||(t=new n(this),g(this).data(y,t)),"toggle"===e&&t[e]()})},s(n,null,[{key:"VERSION",get:function(){return"4.3.1"}}]),n}();g(document).on(k.CLICK_DATA_API,D,function(t){t.preventDefault();var e=t.target;g(e).hasClass(b)||(e=g(e).closest(O)),P._jQueryInterface.call(g(e),"toggle")}).on(k.FOCUS_BLUR_DATA_API,D,function(t){var e=g(t.target).closest(O)[0];g(e).toggleClass(I,/^focus(in)?$/.test(t.type))}),g.fn[v]=P._jQueryInterface,g.fn[v].Constructor=P,g.fn[v].noConflict=function(){return g.fn[v]=T,P._jQueryInterface};var L="carousel",j="bs.carousel",H="."+j,R=".data-api",x=g.fn[L],F={interval:5e3,keyboard:!0,slide:!1,pause:"hover",wrap:!0,touch:!0},U={interval:"(number|boolean)",keyboard:"boolean",slide:"(boolean|string)",pause:"(string|boolean)",wrap:"boolean",touch:"boolean"},W="next",q="prev",M="left",K="right",Q={SLIDE:"slide"+H,SLID:"slid"+H,KEYDOWN:"keydown"+H,MOUSEENTER:"mouseenter"+H,MOUSELEAVE:"mouseleave"+H,TOUCHSTART:"touchstart"+H,TOUCHMOVE:"touchmove"+H,TOUCHEND:"touchend"+H,POINTERDOWN:"pointerdown"+H,POINTERUP:"pointerup"+H,DRAG_START:"dragstart"+H,LOAD_DATA_API:"load"+H+R,CLICK_DATA_API:"click"+H+R},B="carousel",V="active",Y="slide",z="carousel-item-right",X="carousel-item-left",$="carousel-item-next",G="carousel-item-prev",J="pointer-event",Z=".active",tt=".active.carousel-item",et=".carousel-item",nt=".carousel-item img",it=".carousel-item-next, .carousel-item-prev",ot=".carousel-indicators",rt="[data-slide], [data-slide-to]",st='[data-ride="carousel"]',at={TOUCH:"touch",PEN:"pen"},lt=function(){function r(t,e){this._items=null,this._interval=null,this._activeElement=null,this._isPaused=!1,this._isSliding=!1,this.touchTimeout=null,this.touchStartX=0,this.touchDeltaX=0,this._config=this._getConfig(e),this._element=t,this._indicatorsElement=this._element.querySelector(ot),this._touchSupported="ontouchstart"in document.documentElement||0<navigator.maxTouchPoints,this._pointerEvent=Boolean(window.PointerEvent||window.MSPointerEvent),this._addEventListeners()}var t=r.prototype;return t.next=function(){this._isSliding||this._slide(W)},t.nextWhenVisible=function(){!document.hidden&&g(this._element).is(":visible")&&"hidden"!==g(this._element).css("visibility")&&this.next()},t.prev=function(){this._isSliding||this._slide(q)},t.pause=function(t){t||(this._isPaused=!0),this._element.querySelector(it)&&(_.triggerTransitionEnd(this._element),this.cycle(!0)),clearInterval(this._interval),this._interval=null},t.cycle=function(t){t||(this._isPaused=!1),this._interval&&(clearInterval(this._interval),this._interval=null),this._config.interval&&!this._isPaused&&(this._interval=setInterval((document.visibilityState?this.nextWhenVisible:this.next).bind(this),this._config.interval))},t.to=function(t){var e=this;this._activeElement=this._element.querySelector(tt);var n=this._getItemIndex(this._activeElement);if(!(t>this._items.length-1||t<0))if(this._isSliding)g(this._element).one(Q.SLID,function(){return e.to(t)});else{if(n===t)return this.pause(),void this.cycle();var i=n<t?W:q;this._slide(i,this._items[t])}},t.dispose=function(){g(this._element).off(H),g.removeData(this._element,j),this._items=null,this._config=null,this._element=null,this._interval=null,this._isPaused=null,this._isSliding=null,this._activeElement=null,this._indicatorsElement=null},t._getConfig=function(t){return t=l({},F,t),_.typeCheckConfig(L,t,U),t},t._handleSwipe=function(){var t=Math.abs(this.touchDeltaX);if(!(t<=40)){var e=t/this.touchDeltaX;0<e&&this.prev(),e<0&&this.next()}},t._addEventListeners=function(){var e=this;this._config.keyboard&&g(this._element).on(Q.KEYDOWN,function(t){return e._keydown(t)}),"hover"===this._config.pause&&g(this._element).on(Q.MOUSEENTER,function(t){return e.pause(t)}).on(Q.MOUSELEAVE,function(t){return e.cycle(t)}),this._config.touch&&this._addTouchEventListeners()},t._addTouchEventListeners=function(){var n=this;if(this._touchSupported){var e=function(t){n._pointerEvent&&at[t.originalEvent.pointerType.toUpperCase()]?n.touchStartX=t.originalEvent.clientX:n._pointerEvent||(n.touchStartX=t.originalEvent.touches[0].clientX)},i=function(t){n._pointerEvent&&at[t.originalEvent.pointerType.toUpperCase()]&&(n.touchDeltaX=t.originalEvent.clientX-n.touchStartX),n._handleSwipe(),"hover"===n._config.pause&&(n.pause(),n.touchTimeout&&clearTimeout(n.touchTimeout),n.touchTimeout=setTimeout(function(t){return n.cycle(t)},500+n._config.interval))};g(this._element.querySelectorAll(nt)).on(Q.DRAG_START,function(t){return t.preventDefault()}),this._pointerEvent?(g(this._element).on(Q.POINTERDOWN,function(t){return e(t)}),g(this._element).on(Q.POINTERUP,function(t){return i(t)}),this._element.classList.add(J)):(g(this._element).on(Q.TOUCHSTART,function(t){return e(t)}),g(this._element).on(Q.TOUCHMOVE,function(t){var e;(e=t).originalEvent.touches&&1<e.originalEvent.touches.length?n.touchDeltaX=0:n.touchDeltaX=e.originalEvent.touches[0].clientX-n.touchStartX}),g(this._element).on(Q.TOUCHEND,function(t){return i(t)}))}},t._keydown=function(t){if(!/input|textarea/i.test(t.target.tagName))switch(t.which){case 37:t.preventDefault(),this.prev();break;case 39:t.preventDefault(),this.next()}},t._getItemIndex=function(t){return this._items=t&&t.parentNode?[].slice.call(t.parentNode.querySelectorAll(et)):[],this._items.indexOf(t)},t._getItemByDirection=function(t,e){var n=t===W,i=t===q,o=this._getItemIndex(e),r=this._items.length-1;if((i&&0===o||n&&o===r)&&!this._config.wrap)return e;var s=(o+(t===q?-1:1))%this._items.length;return-1===s?this._items[this._items.length-1]:this._items[s]},t._triggerSlideEvent=function(t,e){var n=this._getItemIndex(t),i=this._getItemIndex(this._element.querySelector(tt)),o=g.Event(Q.SLIDE,{relatedTarget:t,direction:e,from:i,to:n});return g(this._element).trigger(o),o},t._setActiveIndicatorElement=function(t){if(this._indicatorsElement){var e=[].slice.call(this._indicatorsElement.querySelectorAll(Z));g(e).removeClass(V);var n=this._indicatorsElement.children[this._getItemIndex(t)];n&&g(n).addClass(V)}},t._slide=function(t,e){var n,i,o,r=this,s=this._element.querySelector(tt),a=this._getItemIndex(s),l=e||s&&this._getItemByDirection(t,s),c=this._getItemIndex(l),h=Boolean(this._interval);if(o=t===W?(n=X,i=$,M):(n=z,i=G,K),l&&g(l).hasClass(V))this._isSliding=!1;else if(!this._triggerSlideEvent(l,o).isDefaultPrevented()&&s&&l){this._isSliding=!0,h&&this.pause(),this._setActiveIndicatorElement(l);var u=g.Event(Q.SLID,{relatedTarget:l,direction:o,from:a,to:c});if(g(this._element).hasClass(Y)){g(l).addClass(i),_.reflow(l),g(s).addClass(n),g(l).addClass(n);var f=parseInt(l.getAttribute("data-interval"),10);this._config.interval=f?(this._config.defaultInterval=this._config.defaultInterval||this._config.interval,f):this._config.defaultInterval||this._config.interval;var d=_.getTransitionDurationFromElement(s);g(s).one(_.TRANSITION_END,function(){g(l).removeClass(n+" "+i).addClass(V),g(s).removeClass(V+" "+i+" "+n),r._isSliding=!1,setTimeout(function(){return g(r._element).trigger(u)},0)}).emulateTransitionEnd(d)}else g(s).removeClass(V),g(l).addClass(V),this._isSliding=!1,g(this._element).trigger(u);h&&this.cycle()}},r._jQueryInterface=function(i){return this.each(function(){var t=g(this).data(j),e=l({},F,g(this).data());"object"==typeof i&&(e=l({},e,i));var n="string"==typeof i?i:e.slide;if(t||(t=new r(this,e),g(this).data(j,t)),"number"==typeof i)t.to(i);else if("string"==typeof n){if("undefined"==typeof t[n])throw new TypeError('No method named "'+n+'"');t[n]()}else e.interval&&e.ride&&(t.pause(),t.cycle())})},r._dataApiClickHandler=function(t){var e=_.getSelectorFromElement(this);if(e){var n=g(e)[0];if(n&&g(n).hasClass(B)){var i=l({},g(n).data(),g(this).data()),o=this.getAttribute("data-slide-to");o&&(i.interval=!1),r._jQueryInterface.call(g(n),i),o&&g(n).data(j).to(o),t.preventDefault()}}},s(r,null,[{key:"VERSION",get:function(){return"4.3.1"}},{key:"Default",get:function(){return F}}]),r}();g(document).on(Q.CLICK_DATA_API,rt,lt._dataApiClickHandler),g(window).on(Q.LOAD_DATA_API,function(){for(var t=[].slice.call(document.querySelectorAll(st)),e=0,n=t.length;e<n;e++){var i=g(t[e]);lt._jQueryInterface.call(i,i.data())}}),g.fn[L]=lt._jQueryInterface,g.fn[L].Constructor=lt,g.fn[L].noConflict=function(){return g.fn[L]=x,lt._jQueryInterface};var ct="collapse",ht="bs.collapse",ut="."+ht,ft=g.fn[ct],dt={toggle:!0,parent:""},gt={toggle:"boolean",parent:"(string|element)"},_t={SHOW:"show"+ut,SHOWN:"shown"+ut,HIDE:"hide"+ut,HIDDEN:"hidden"+ut,CLICK_DATA_API:"click"+ut+".data-api"},mt="show",pt="collapse",vt="collapsing",yt="collapsed",Et="width",Ct="height",Tt=".show, .collapsing",St='[data-toggle="collapse"]',bt=function(){function a(e,t){this._isTransitioning=!1,this._element=e,this._config=this._getConfig(t),this._triggerArray=[].slice.call(document.querySelectorAll('[data-toggle="collapse"][href="#'+e.id+'"],[data-toggle="collapse"][data-target="#'+e.id+'"]'));for(var n=[].slice.call(document.querySelectorAll(St)),i=0,o=n.length;i<o;i++){var r=n[i],s=_.getSelectorFromElement(r),a=[].slice.call(document.querySelectorAll(s)).filter(function(t){return t===e});null!==s&&0<a.length&&(this._selector=s,this._triggerArray.push(r))}this._parent=this._config.parent?this._getParent():null,this._config.parent||this._addAriaAndCollapsedClass(this._element,this._triggerArray),this._config.toggle&&this.toggle()}var t=a.prototype;return t.toggle=function(){g(this._element).hasClass(mt)?this.hide():this.show()},t.show=function(){var t,e,n=this;if(!this._isTransitioning&&!g(this._element).hasClass(mt)&&(this._parent&&0===(t=[].slice.call(this._parent.querySelectorAll(Tt)).filter(function(t){return"string"==typeof n._config.parent?t.getAttribute("data-parent")===n._config.parent:t.classList.contains(pt)})).length&&(t=null),!(t&&(e=g(t).not(this._selector).data(ht))&&e._isTransitioning))){var i=g.Event(_t.SHOW);if(g(this._element).trigger(i),!i.isDefaultPrevented()){t&&(a._jQueryInterface.call(g(t).not(this._selector),"hide"),e||g(t).data(ht,null));var o=this._getDimension();g(this._element).removeClass(pt).addClass(vt),this._element.style[o]=0,this._triggerArray.length&&g(this._triggerArray).removeClass(yt).attr("aria-expanded",!0),this.setTransitioning(!0);var r="scroll"+(o[0].toUpperCase()+o.slice(1)),s=_.getTransitionDurationFromElement(this._element);g(this._element).one(_.TRANSITION_END,function(){g(n._element).removeClass(vt).addClass(pt).addClass(mt),n._element.style[o]="",n.setTransitioning(!1),g(n._element).trigger(_t.SHOWN)}).emulateTransitionEnd(s),this._element.style[o]=this._element[r]+"px"}}},t.hide=function(){var t=this;if(!this._isTransitioning&&g(this._element).hasClass(mt)){var e=g.Event(_t.HIDE);if(g(this._element).trigger(e),!e.isDefaultPrevented()){var n=this._getDimension();this._element.style[n]=this._element.getBoundingClientRect()[n]+"px",_.reflow(this._element),g(this._element).addClass(vt).removeClass(pt).removeClass(mt);var i=this._triggerArray.length;if(0<i)for(var o=0;o<i;o++){var r=this._triggerArray[o],s=_.getSelectorFromElement(r);if(null!==s)g([].slice.call(document.querySelectorAll(s))).hasClass(mt)||g(r).addClass(yt).attr("aria-expanded",!1)}this.setTransitioning(!0);this._element.style[n]="";var a=_.getTransitionDurationFromElement(this._element);g(this._element).one(_.TRANSITION_END,function(){t.setTransitioning(!1),g(t._element).removeClass(vt).addClass(pt).trigger(_t.HIDDEN)}).emulateTransitionEnd(a)}}},t.setTransitioning=function(t){this._isTransitioning=t},t.dispose=function(){g.removeData(this._element,ht),this._config=null,this._parent=null,this._element=null,this._triggerArray=null,this._isTransitioning=null},t._getConfig=function(t){return(t=l({},dt,t)).toggle=Boolean(t.toggle),_.typeCheckConfig(ct,t,gt),t},t._getDimension=function(){return g(this._element).hasClass(Et)?Et:Ct},t._getParent=function(){var t,n=this;_.isElement(this._config.parent)?(t=this._config.parent,"undefined"!=typeof this._config.parent.jquery&&(t=this._config.parent[0])):t=document.querySelector(this._config.parent);var e='[data-toggle="collapse"][data-parent="'+this._config.parent+'"]',i=[].slice.call(t.querySelectorAll(e));return g(i).each(function(t,e){n._addAriaAndCollapsedClass(a._getTargetFromElement(e),[e])}),t},t._addAriaAndCollapsedClass=function(t,e){var n=g(t).hasClass(mt);e.length&&g(e).toggleClass(yt,!n).attr("aria-expanded",n)},a._getTargetFromElement=function(t){var e=_.getSelectorFromElement(t);return e?document.querySelector(e):null},a._jQueryInterface=function(i){return this.each(function(){var t=g(this),e=t.data(ht),n=l({},dt,t.data(),"object"==typeof i&&i?i:{});if(!e&&n.toggle&&/show|hide/.test(i)&&(n.toggle=!1),e||(e=new a(this,n),t.data(ht,e)),"string"==typeof i){if("undefined"==typeof e[i])throw new TypeError('No method named "'+i+'"');e[i]()}})},s(a,null,[{key:"VERSION",get:function(){return"4.3.1"}},{key:"Default",get:function(){return dt}}]),a}();g(document).on(_t.CLICK_DATA_API,St,function(t){"A"===t.currentTarget.tagName&&t.preventDefault();var n=g(this),e=_.getSelectorFromElement(this),i=[].slice.call(document.querySelectorAll(e));g(i).each(function(){var t=g(this),e=t.data(ht)?"toggle":n.data();bt._jQueryInterface.call(t,e)})}),g.fn[ct]=bt._jQueryInterface,g.fn[ct].Constructor=bt,g.fn[ct].noConflict=function(){return g.fn[ct]=ft,bt._jQueryInterface};var It="dropdown",Dt="bs.dropdown",wt="."+Dt,At=".data-api",Nt=g.fn[It],Ot=new RegExp("38|40|27"),kt={HIDE:"hide"+wt,HIDDEN:"hidden"+wt,SHOW:"show"+wt,SHOWN:"shown"+wt,CLICK:"click"+wt,CLICK_DATA_API:"click"+wt+At,KEYDOWN_DATA_API:"keydown"+wt+At,KEYUP_DATA_API:"keyup"+wt+At},Pt="disabled",Lt="show",jt="dropup",Ht="dropright",Rt="dropleft",xt="dropdown-menu-right",Ft="position-static",Ut='[data-toggle="dropdown"]',Wt=".dropdown form",qt=".dropdown-menu",Mt=".navbar-nav",Kt=".dropdown-menu .dropdown-item:not(.disabled):not(:disabled)",Qt="top-start",Bt="top-end",Vt="bottom-start",Yt="bottom-end",zt="right-start",Xt="left-start",$t={offset:0,flip:!0,boundary:"scrollParent",reference:"toggle",display:"dynamic"},Gt={offset:"(number|string|function)",flip:"boolean",boundary:"(string|element)",reference:"(string|element)",display:"string"},Jt=function(){function c(t,e){this._element=t,this._popper=null,this._config=this._getConfig(e),this._menu=this._getMenuElement(),this._inNavbar=this._detectNavbar(),this._addEventListeners()}var t=c.prototype;return t.toggle=function(){if(!this._element.disabled&&!g(this._element).hasClass(Pt)){var t=c._getParentFromElement(this._element),e=g(this._menu).hasClass(Lt);if(c._clearMenus(),!e){var n={relatedTarget:this._element},i=g.Event(kt.SHOW,n);if(g(t).trigger(i),!i.isDefaultPrevented()){if(!this._inNavbar){if("undefined"==typeof u)throw new TypeError("Bootstrap's dropdowns require Popper.js (https://popper.js.org/)");var o=this._element;"parent"===this._config.reference?o=t:_.isElement(this._config.reference)&&(o=this._config.reference,"undefined"!=typeof this._config.reference.jquery&&(o=this._config.reference[0])),"scrollParent"!==this._config.boundary&&g(t).addClass(Ft),this._popper=new u(o,this._menu,this._getPopperConfig())}"ontouchstart"in document.documentElement&&0===g(t).closest(Mt).length&&g(document.body).children().on("mouseover",null,g.noop),this._element.focus(),this._element.setAttribute("aria-expanded",!0),g(this._menu).toggleClass(Lt),g(t).toggleClass(Lt).trigger(g.Event(kt.SHOWN,n))}}}},t.show=function(){if(!(this._element.disabled||g(this._element).hasClass(Pt)||g(this._menu).hasClass(Lt))){var t={relatedTarget:this._element},e=g.Event(kt.SHOW,t),n=c._getParentFromElement(this._element);g(n).trigger(e),e.isDefaultPrevented()||(g(this._menu).toggleClass(Lt),g(n).toggleClass(Lt).trigger(g.Event(kt.SHOWN,t)))}},t.hide=function(){if(!this._element.disabled&&!g(this._element).hasClass(Pt)&&g(this._menu).hasClass(Lt)){var t={relatedTarget:this._element},e=g.Event(kt.HIDE,t),n=c._getParentFromElement(this._element);g(n).trigger(e),e.isDefaultPrevented()||(g(this._menu).toggleClass(Lt),g(n).toggleClass(Lt).trigger(g.Event(kt.HIDDEN,t)))}},t.dispose=function(){g.removeData(this._element,Dt),g(this._element).off(wt),this._element=null,(this._menu=null)!==this._popper&&(this._popper.destroy(),this._popper=null)},t.update=function(){this._inNavbar=this._detectNavbar(),null!==this._popper&&this._popper.scheduleUpdate()},t._addEventListeners=function(){var e=this;g(this._element).on(kt.CLICK,function(t){t.preventDefault(),t.stopPropagation(),e.toggle()})},t._getConfig=function(t){return t=l({},this.constructor.Default,g(this._element).data(),t),_.typeCheckConfig(It,t,this.constructor.DefaultType),t},t._getMenuElement=function(){if(!this._menu){var t=c._getParentFromElement(this._element);t&&(this._menu=t.querySelector(qt))}return this._menu},t._getPlacement=function(){var t=g(this._element.parentNode),e=Vt;return t.hasClass(jt)?(e=Qt,g(this._menu).hasClass(xt)&&(e=Bt)):t.hasClass(Ht)?e=zt:t.hasClass(Rt)?e=Xt:g(this._menu).hasClass(xt)&&(e=Yt),e},t._detectNavbar=function(){return 0<g(this._element).closest(".navbar").length},t._getOffset=function(){var e=this,t={};return"function"==typeof this._config.offset?t.fn=function(t){return t.offsets=l({},t.offsets,e._config.offset(t.offsets,e._element)||{}),t}:t.offset=this._config.offset,t},t._getPopperConfig=function(){var t={placement:this._getPlacement(),modifiers:{offset:this._getOffset(),flip:{enabled:this._config.flip},preventOverflow:{boundariesElement:this._config.boundary}}};return"static"===this._config.display&&(t.modifiers.applyStyle={enabled:!1}),t},c._jQueryInterface=function(e){return this.each(function(){var t=g(this).data(Dt);if(t||(t=new c(this,"object"==typeof e?e:null),g(this).data(Dt,t)),"string"==typeof e){if("undefined"==typeof t[e])throw new TypeError('No method named "'+e+'"');t[e]()}})},c._clearMenus=function(t){if(!t||3!==t.which&&("keyup"!==t.type||9===t.which))for(var e=[].slice.call(document.querySelectorAll(Ut)),n=0,i=e.length;n<i;n++){var o=c._getParentFromElement(e[n]),r=g(e[n]).data(Dt),s={relatedTarget:e[n]};if(t&&"click"===t.type&&(s.clickEvent=t),r){var a=r._menu;if(g(o).hasClass(Lt)&&!(t&&("click"===t.type&&/input|textarea/i.test(t.target.tagName)||"keyup"===t.type&&9===t.which)&&g.contains(o,t.target))){var l=g.Event(kt.HIDE,s);g(o).trigger(l),l.isDefaultPrevented()||("ontouchstart"in document.documentElement&&g(document.body).children().off("mouseover",null,g.noop),e[n].setAttribute("aria-expanded","false"),g(a).removeClass(Lt),g(o).removeClass(Lt).trigger(g.Event(kt.HIDDEN,s)))}}}},c._getParentFromElement=function(t){var e,n=_.getSelectorFromElement(t);return n&&(e=document.querySelector(n)),e||t.parentNode},c._dataApiKeydownHandler=function(t){if((/input|textarea/i.test(t.target.tagName)?!(32===t.which||27!==t.which&&(40!==t.which&&38!==t.which||g(t.target).closest(qt).length)):Ot.test(t.which))&&(t.preventDefault(),t.stopPropagation(),!this.disabled&&!g(this).hasClass(Pt))){var e=c._getParentFromElement(this),n=g(e).hasClass(Lt);if(n&&(!n||27!==t.which&&32!==t.which)){var i=[].slice.call(e.querySelectorAll(Kt));if(0!==i.length){var o=i.indexOf(t.target);38===t.which&&0<o&&o--,40===t.which&&o<i.length-1&&o++,o<0&&(o=0),i[o].focus()}}else{if(27===t.which){var r=e.querySelector(Ut);g(r).trigger("focus")}g(this).trigger("click")}}},s(c,null,[{key:"VERSION",get:function(){return"4.3.1"}},{key:"Default",get:function(){return $t}},{key:"DefaultType",get:function(){return Gt}}]),c}();g(document).on(kt.KEYDOWN_DATA_API,Ut,Jt._dataApiKeydownHandler).on(kt.KEYDOWN_DATA_API,qt,Jt._dataApiKeydownHandler).on(kt.CLICK_DATA_API+" "+kt.KEYUP_DATA_API,Jt._clearMenus).on(kt.CLICK_DATA_API,Ut,function(t){t.preventDefault(),t.stopPropagation(),Jt._jQueryInterface.call(g(this),"toggle")}).on(kt.CLICK_DATA_API,Wt,function(t){t.stopPropagation()}),g.fn[It]=Jt._jQueryInterface,g.fn[It].Constructor=Jt,g.fn[It].noConflict=function(){return g.fn[It]=Nt,Jt._jQueryInterface};var Zt="modal",te="bs.modal",ee="."+te,ne=g.fn[Zt],ie={backdrop:!0,keyboard:!0,focus:!0,show:!0},oe={backdrop:"(boolean|string)",keyboard:"boolean",focus:"boolean",show:"boolean"},re={HIDE:"hide"+ee,HIDDEN:"hidden"+ee,SHOW:"show"+ee,SHOWN:"shown"+ee,FOCUSIN:"focusin"+ee,RESIZE:"resize"+ee,CLICK_DISMISS:"click.dismiss"+ee,KEYDOWN_DISMISS:"keydown.dismiss"+ee,MOUSEUP_DISMISS:"mouseup.dismiss"+ee,MOUSEDOWN_DISMISS:"mousedown.dismiss"+ee,CLICK_DATA_API:"click"+ee+".data-api"},se="modal-dialog-scrollable",ae="modal-scrollbar-measure",le="modal-backdrop",ce="modal-open",he="fade",ue="show",fe=".modal-dialog",de=".modal-body",ge='[data-toggle="modal"]',_e='[data-dismiss="modal"]',me=".fixed-top, .fixed-bottom, .is-fixed, .sticky-top",pe=".sticky-top",ve=function(){function o(t,e){this._config=this._getConfig(e),this._element=t,this._dialog=t.querySelector(fe),this._backdrop=null,this._isShown=!1,this._isBodyOverflowing=!1,this._ignoreBackdropClick=!1,this._isTransitioning=!1,this._scrollbarWidth=0}var t=o.prototype;return t.toggle=function(t){return this._isShown?this.hide():this.show(t)},t.show=function(t){var e=this;if(!this._isShown&&!this._isTransitioning){g(this._element).hasClass(he)&&(this._isTransitioning=!0);var n=g.Event(re.SHOW,{relatedTarget:t});g(this._element).trigger(n),this._isShown||n.isDefaultPrevented()||(this._isShown=!0,this._checkScrollbar(),this._setScrollbar(),this._adjustDialog(),this._setEscapeEvent(),this._setResizeEvent(),g(this._element).on(re.CLICK_DISMISS,_e,function(t){return e.hide(t)}),g(this._dialog).on(re.MOUSEDOWN_DISMISS,function(){g(e._element).one(re.MOUSEUP_DISMISS,function(t){g(t.target).is(e._element)&&(e._ignoreBackdropClick=!0)})}),this._showBackdrop(function(){return e._showElement(t)}))}},t.hide=function(t){var e=this;if(t&&t.preventDefault(),this._isShown&&!this._isTransitioning){var n=g.Event(re.HIDE);if(g(this._element).trigger(n),this._isShown&&!n.isDefaultPrevented()){this._isShown=!1;var i=g(this._element).hasClass(he);if(i&&(this._isTransitioning=!0),this._setEscapeEvent(),this._setResizeEvent(),g(document).off(re.FOCUSIN),g(this._element).removeClass(ue),g(this._element).off(re.CLICK_DISMISS),g(this._dialog).off(re.MOUSEDOWN_DISMISS),i){var o=_.getTransitionDurationFromElement(this._element);g(this._element).one(_.TRANSITION_END,function(t){return e._hideModal(t)}).emulateTransitionEnd(o)}else this._hideModal()}}},t.dispose=function(){[window,this._element,this._dialog].forEach(function(t){return g(t).off(ee)}),g(document).off(re.FOCUSIN),g.removeData(this._element,te),this._config=null,this._element=null,this._dialog=null,this._backdrop=null,this._isShown=null,this._isBodyOverflowing=null,this._ignoreBackdropClick=null,this._isTransitioning=null,this._scrollbarWidth=null},t.handleUpdate=function(){this._adjustDialog()},t._getConfig=function(t){return t=l({},ie,t),_.typeCheckConfig(Zt,t,oe),t},t._showElement=function(t){var e=this,n=g(this._element).hasClass(he);this._element.parentNode&&this._element.parentNode.nodeType===Node.ELEMENT_NODE||document.body.appendChild(this._element),this._element.style.display="block",this._element.removeAttribute("aria-hidden"),this._element.setAttribute("aria-modal",!0),g(this._dialog).hasClass(se)?this._dialog.querySelector(de).scrollTop=0:this._element.scrollTop=0,n&&_.reflow(this._element),g(this._element).addClass(ue),this._config.focus&&this._enforceFocus();var i=g.Event(re.SHOWN,{relatedTarget:t}),o=function(){e._config.focus&&e._element.focus(),e._isTransitioning=!1,g(e._element).trigger(i)};if(n){var r=_.getTransitionDurationFromElement(this._dialog);g(this._dialog).one(_.TRANSITION_END,o).emulateTransitionEnd(r)}else o()},t._enforceFocus=function(){var e=this;g(document).off(re.FOCUSIN).on(re.FOCUSIN,function(t){document!==t.target&&e._element!==t.target&&0===g(e._element).has(t.target).length&&e._element.focus()})},t._setEscapeEvent=function(){var e=this;this._isShown&&this._config.keyboard?g(this._element).on(re.KEYDOWN_DISMISS,function(t){27===t.which&&(t.preventDefault(),e.hide())}):this._isShown||g(this._element).off(re.KEYDOWN_DISMISS)},t._setResizeEvent=function(){var e=this;this._isShown?g(window).on(re.RESIZE,function(t){return e.handleUpdate(t)}):g(window).off(re.RESIZE)},t._hideModal=function(){var t=this;this._element.style.display="none",this._element.setAttribute("aria-hidden",!0),this._element.removeAttribute("aria-modal"),this._isTransitioning=!1,this._showBackdrop(function(){g(document.body).removeClass(ce),t._resetAdjustments(),t._resetScrollbar(),g(t._element).trigger(re.HIDDEN)})},t._removeBackdrop=function(){this._backdrop&&(g(this._backdrop).remove(),this._backdrop=null)},t._showBackdrop=function(t){var e=this,n=g(this._element).hasClass(he)?he:"";if(this._isShown&&this._config.backdrop){if(this._backdrop=document.createElement("div"),this._backdrop.className=le,n&&this._backdrop.classList.add(n),g(this._backdrop).appendTo(document.body),g(this._element).on(re.CLICK_DISMISS,function(t){e._ignoreBackdropClick?e._ignoreBackdropClick=!1:t.target===t.currentTarget&&("static"===e._config.backdrop?e._element.focus():e.hide())}),n&&_.reflow(this._backdrop),g(this._backdrop).addClass(ue),!t)return;if(!n)return void t();var i=_.getTransitionDurationFromElement(this._backdrop);g(this._backdrop).one(_.TRANSITION_END,t).emulateTransitionEnd(i)}else if(!this._isShown&&this._backdrop){g(this._backdrop).removeClass(ue);var o=function(){e._removeBackdrop(),t&&t()};if(g(this._element).hasClass(he)){var r=_.getTransitionDurationFromElement(this._backdrop);g(this._backdrop).one(_.TRANSITION_END,o).emulateTransitionEnd(r)}else o()}else t&&t()},t._adjustDialog=function(){var t=this._element.scrollHeight>document.documentElement.clientHeight;!this._isBodyOverflowing&&t&&(this._element.style.paddingLeft=this._scrollbarWidth+"px"),this._isBodyOverflowing&&!t&&(this._element.style.paddingRight=this._scrollbarWidth+"px")},t._resetAdjustments=function(){this._element.style.paddingLeft="",this._element.style.paddingRight=""},t._checkScrollbar=function(){var t=document.body.getBoundingClientRect();this._isBodyOverflowing=t.left+t.right<window.innerWidth,this._scrollbarWidth=this._getScrollbarWidth()},t._setScrollbar=function(){var o=this;if(this._isBodyOverflowing){var t=[].slice.call(document.querySelectorAll(me)),e=[].slice.call(document.querySelectorAll(pe));g(t).each(function(t,e){var n=e.style.paddingRight,i=g(e).css("padding-right");g(e).data("padding-right",n).css("padding-right",parseFloat(i)+o._scrollbarWidth+"px")}),g(e).each(function(t,e){var n=e.style.marginRight,i=g(e).css("margin-right");g(e).data("margin-right",n).css("margin-right",parseFloat(i)-o._scrollbarWidth+"px")});var n=document.body.style.paddingRight,i=g(document.body).css("padding-right");g(document.body).data("padding-right",n).css("padding-right",parseFloat(i)+this._scrollbarWidth+"px")}g(document.body).addClass(ce)},t._resetScrollbar=function(){var t=[].slice.call(document.querySelectorAll(me));g(t).each(function(t,e){var n=g(e).data("padding-right");g(e).removeData("padding-right"),e.style.paddingRight=n||""});var e=[].slice.call(document.querySelectorAll(""+pe));g(e).each(function(t,e){var n=g(e).data("margin-right");"undefined"!=typeof n&&g(e).css("margin-right",n).removeData("margin-right")});var n=g(document.body).data("padding-right");g(document.body).removeData("padding-right"),document.body.style.paddingRight=n||""},t._getScrollbarWidth=function(){var t=document.createElement("div");t.className=ae,document.body.appendChild(t);var e=t.getBoundingClientRect().width-t.clientWidth;return document.body.removeChild(t),e},o._jQueryInterface=function(n,i){return this.each(function(){var t=g(this).data(te),e=l({},ie,g(this).data(),"object"==typeof n&&n?n:{});if(t||(t=new o(this,e),g(this).data(te,t)),"string"==typeof n){if("undefined"==typeof t[n])throw new TypeError('No method named "'+n+'"');t[n](i)}else e.show&&t.show(i)})},s(o,null,[{key:"VERSION",get:function(){return"4.3.1"}},{key:"Default",get:function(){return ie}}]),o}();g(document).on(re.CLICK_DATA_API,ge,function(t){var e,n=this,i=_.getSelectorFromElement(this);i&&(e=document.querySelector(i));var o=g(e).data(te)?"toggle":l({},g(e).data(),g(this).data());"A"!==this.tagName&&"AREA"!==this.tagName||t.preventDefault();var r=g(e).one(re.SHOW,function(t){t.isDefaultPrevented()||r.one(re.HIDDEN,function(){g(n).is(":visible")&&n.focus()})});ve._jQueryInterface.call(g(e),o,this)}),g.fn[Zt]=ve._jQueryInterface,g.fn[Zt].Constructor=ve,g.fn[Zt].noConflict=function(){return g.fn[Zt]=ne,ve._jQueryInterface};var ye=["background","cite","href","itemtype","longdesc","poster","src","xlink:href"],Ee={"*":["class","dir","id","lang","role",/^aria-[\w-]*$/i],a:["target","href","title","rel"],area:[],b:[],br:[],col:[],code:[],div:[],em:[],hr:[],h1:[],h2:[],h3:[],h4:[],h5:[],h6:[],i:[],img:["src","alt","title","width","height"],li:[],ol:[],p:[],pre:[],s:[],small:[],span:[],sub:[],sup:[],strong:[],u:[],ul:[]},Ce=/^(?:(?:https?|mailto|ftp|tel|file):|[^&:/?#]*(?:[/?#]|$))/gi,Te=/^data:(?:image\/(?:bmp|gif|jpeg|jpg|png|tiff|webp)|video\/(?:mpeg|mp4|ogg|webm)|audio\/(?:mp3|oga|ogg|opus));base64,[a-z0-9+/]+=*$/i;function Se(t,s,e){if(0===t.length)return t;if(e&&"function"==typeof e)return e(t);for(var n=(new window.DOMParser).parseFromString(t,"text/html"),a=Object.keys(s),l=[].slice.call(n.body.querySelectorAll("*")),i=function(t,e){var n=l[t],i=n.nodeName.toLowerCase();if(-1===a.indexOf(n.nodeName.toLowerCase()))return n.parentNode.removeChild(n),"continue";var o=[].slice.call(n.attributes),r=[].concat(s["*"]||[],s[i]||[]);o.forEach(function(t){(function(t,e){var n=t.nodeName.toLowerCase();if(-1!==e.indexOf(n))return-1===ye.indexOf(n)||Boolean(t.nodeValue.match(Ce)||t.nodeValue.match(Te));for(var i=e.filter(function(t){return t instanceof RegExp}),o=0,r=i.length;o<r;o++)if(n.match(i[o]))return!0;return!1})(t,r)||n.removeAttribute(t.nodeName)})},o=0,r=l.length;o<r;o++)i(o);return n.body.innerHTML}var be="tooltip",Ie="bs.tooltip",De="."+Ie,we=g.fn[be],Ae="bs-tooltip",Ne=new RegExp("(^|\\s)"+Ae+"\\S+","g"),Oe=["sanitize","whiteList","sanitizeFn"],ke={animation:"boolean",template:"string",title:"(string|element|function)",trigger:"string",delay:"(number|object)",html:"boolean",selector:"(string|boolean)",placement:"(string|function)",offset:"(number|string|function)",container:"(string|element|boolean)",fallbackPlacement:"(string|array)",boundary:"(string|element)",sanitize:"boolean",sanitizeFn:"(null|function)",whiteList:"object"},Pe={AUTO:"auto",TOP:"top",RIGHT:"right",BOTTOM:"bottom",LEFT:"left"},Le={animation:!0,template:'<div class="tooltip" role="tooltip"><div class="arrow"></div><div class="tooltip-inner"></div></div>',trigger:"hover focus",title:"",delay:0,html:!1,selector:!1,placement:"top",offset:0,container:!1,fallbackPlacement:"flip",boundary:"scrollParent",sanitize:!0,sanitizeFn:null,whiteList:Ee},je="show",He="out",Re={HIDE:"hide"+De,HIDDEN:"hidden"+De,SHOW:"show"+De,SHOWN:"shown"+De,INSERTED:"inserted"+De,CLICK:"click"+De,FOCUSIN:"focusin"+De,FOCUSOUT:"focusout"+De,MOUSEENTER:"mouseenter"+De,MOUSELEAVE:"mouseleave"+De},xe="fade",Fe="show",Ue=".tooltip-inner",We=".arrow",qe="hover",Me="focus",Ke="click",Qe="manual",Be=function(){function i(t,e){if("undefined"==typeof u)throw new TypeError("Bootstrap's tooltips require Popper.js (https://popper.js.org/)");this._isEnabled=!0,this._timeout=0,this._hoverState="",this._activeTrigger={},this._popper=null,this.element=t,this.config=this._getConfig(e),this.tip=null,this._setListeners()}var t=i.prototype;return t.enable=function(){this._isEnabled=!0},t.disable=function(){this._isEnabled=!1},t.toggleEnabled=function(){this._isEnabled=!this._isEnabled},t.toggle=function(t){if(this._isEnabled)if(t){var e=this.constructor.DATA_KEY,n=g(t.currentTarget).data(e);n||(n=new this.constructor(t.currentTarget,this._getDelegateConfig()),g(t.currentTarget).data(e,n)),n._activeTrigger.click=!n._activeTrigger.click,n._isWithActiveTrigger()?n._enter(null,n):n._leave(null,n)}else{if(g(this.getTipElement()).hasClass(Fe))return void this._leave(null,this);this._enter(null,this)}},t.dispose=function(){clearTimeout(this._timeout),g.removeData(this.element,this.constructor.DATA_KEY),g(this.element).off(this.constructor.EVENT_KEY),g(this.element).closest(".modal").off("hide.bs.modal"),this.tip&&g(this.tip).remove(),this._isEnabled=null,this._timeout=null,this._hoverState=null,(this._activeTrigger=null)!==this._popper&&this._popper.destroy(),this._popper=null,this.element=null,this.config=null,this.tip=null},t.show=function(){var e=this;if("none"===g(this.element).css("display"))throw new Error("Please use show on visible elements");var t=g.Event(this.constructor.Event.SHOW);if(this.isWithContent()&&this._isEnabled){g(this.element).trigger(t);var n=_.findShadowRoot(this.element),i=g.contains(null!==n?n:this.element.ownerDocument.documentElement,this.element);if(t.isDefaultPrevented()||!i)return;var o=this.getTipElement(),r=_.getUID(this.constructor.NAME);o.setAttribute("id",r),this.element.setAttribute("aria-describedby",r),this.setContent(),this.config.animation&&g(o).addClass(xe);var s="function"==typeof this.config.placement?this.config.placement.call(this,o,this.element):this.config.placement,a=this._getAttachment(s);this.addAttachmentClass(a);var l=this._getContainer();g(o).data(this.constructor.DATA_KEY,this),g.contains(this.element.ownerDocument.documentElement,this.tip)||g(o).appendTo(l),g(this.element).trigger(this.constructor.Event.INSERTED),this._popper=new u(this.element,o,{placement:a,modifiers:{offset:this._getOffset(),flip:{behavior:this.config.fallbackPlacement},arrow:{element:We},preventOverflow:{boundariesElement:this.config.boundary}},onCreate:function(t){t.originalPlacement!==t.placement&&e._handlePopperPlacementChange(t)},onUpdate:function(t){return e._handlePopperPlacementChange(t)}}),g(o).addClass(Fe),"ontouchstart"in document.documentElement&&g(document.body).children().on("mouseover",null,g.noop);var c=function(){e.config.animation&&e._fixTransition();var t=e._hoverState;e._hoverState=null,g(e.element).trigger(e.constructor.Event.SHOWN),t===He&&e._leave(null,e)};if(g(this.tip).hasClass(xe)){var h=_.getTransitionDurationFromElement(this.tip);g(this.tip).one(_.TRANSITION_END,c).emulateTransitionEnd(h)}else c()}},t.hide=function(t){var e=this,n=this.getTipElement(),i=g.Event(this.constructor.Event.HIDE),o=function(){e._hoverState!==je&&n.parentNode&&n.parentNode.removeChild(n),e._cleanTipClass(),e.element.removeAttribute("aria-describedby"),g(e.element).trigger(e.constructor.Event.HIDDEN),null!==e._popper&&e._popper.destroy(),t&&t()};if(g(this.element).trigger(i),!i.isDefaultPrevented()){if(g(n).removeClass(Fe),"ontouchstart"in document.documentElement&&g(document.body).children().off("mouseover",null,g.noop),this._activeTrigger[Ke]=!1,this._activeTrigger[Me]=!1,this._activeTrigger[qe]=!1,g(this.tip).hasClass(xe)){var r=_.getTransitionDurationFromElement(n);g(n).one(_.TRANSITION_END,o).emulateTransitionEnd(r)}else o();this._hoverState=""}},t.update=function(){null!==this._popper&&this._popper.scheduleUpdate()},t.isWithContent=function(){return Boolean(this.getTitle())},t.addAttachmentClass=function(t){g(this.getTipElement()).addClass(Ae+"-"+t)},t.getTipElement=function(){return this.tip=this.tip||g(this.config.template)[0],this.tip},t.setContent=function(){var t=this.getTipElement();this.setElementContent(g(t.querySelectorAll(Ue)),this.getTitle()),g(t).removeClass(xe+" "+Fe)},t.setElementContent=function(t,e){"object"!=typeof e||!e.nodeType&&!e.jquery?this.config.html?(this.config.sanitize&&(e=Se(e,this.config.whiteList,this.config.sanitizeFn)),t.html(e)):t.text(e):this.config.html?g(e).parent().is(t)||t.empty().append(e):t.text(g(e).text())},t.getTitle=function(){var t=this.element.getAttribute("data-original-title");return t||(t="function"==typeof this.config.title?this.config.title.call(this.element):this.config.title),t},t._getOffset=function(){var e=this,t={};return"function"==typeof this.config.offset?t.fn=function(t){return t.offsets=l({},t.offsets,e.config.offset(t.offsets,e.element)||{}),t}:t.offset=this.config.offset,t},t._getContainer=function(){return!1===this.config.container?document.body:_.isElement(this.config.container)?g(this.config.container):g(document).find(this.config.container)},t._getAttachment=function(t){return Pe[t.toUpperCase()]},t._setListeners=function(){var i=this;this.config.trigger.split(" ").forEach(function(t){if("click"===t)g(i.element).on(i.constructor.Event.CLICK,i.config.selector,function(t){return i.toggle(t)});else if(t!==Qe){var e=t===qe?i.constructor.Event.MOUSEENTER:i.constructor.Event.FOCUSIN,n=t===qe?i.constructor.Event.MOUSELEAVE:i.constructor.Event.FOCUSOUT;g(i.element).on(e,i.config.selector,function(t){return i._enter(t)}).on(n,i.config.selector,function(t){return i._leave(t)})}}),g(this.element).closest(".modal").on("hide.bs.modal",function(){i.element&&i.hide()}),this.config.selector?this.config=l({},this.config,{trigger:"manual",selector:""}):this._fixTitle()},t._fixTitle=function(){var t=typeof this.element.getAttribute("data-original-title");(this.element.getAttribute("title")||"string"!==t)&&(this.element.setAttribute("data-original-title",this.element.getAttribute("title")||""),this.element.setAttribute("title",""))},t._enter=function(t,e){var n=this.constructor.DATA_KEY;(e=e||g(t.currentTarget).data(n))||(e=new this.constructor(t.currentTarget,this._getDelegateConfig()),g(t.currentTarget).data(n,e)),t&&(e._activeTrigger["focusin"===t.type?Me:qe]=!0),g(e.getTipElement()).hasClass(Fe)||e._hoverState===je?e._hoverState=je:(clearTimeout(e._timeout),e._hoverState=je,e.config.delay&&e.config.delay.show?e._timeout=setTimeout(function(){e._hoverState===je&&e.show()},e.config.delay.show):e.show())},t._leave=function(t,e){var n=this.constructor.DATA_KEY;(e=e||g(t.currentTarget).data(n))||(e=new this.constructor(t.currentTarget,this._getDelegateConfig()),g(t.currentTarget).data(n,e)),t&&(e._activeTrigger["focusout"===t.type?Me:qe]=!1),e._isWithActiveTrigger()||(clearTimeout(e._timeout),e._hoverState=He,e.config.delay&&e.config.delay.hide?e._timeout=setTimeout(function(){e._hoverState===He&&e.hide()},e.config.delay.hide):e.hide())},t._isWithActiveTrigger=function(){for(var t in this._activeTrigger)if(this._activeTrigger[t])return!0;return!1},t._getConfig=function(t){var e=g(this.element).data();return Object.keys(e).forEach(function(t){-1!==Oe.indexOf(t)&&delete e[t]}),"number"==typeof(t=l({},this.constructor.Default,e,"object"==typeof t&&t?t:{})).delay&&(t.delay={show:t.delay,hide:t.delay}),"number"==typeof t.title&&(t.title=t.title.toString()),"number"==typeof t.content&&(t.content=t.content.toString()),_.typeCheckConfig(be,t,this.constructor.DefaultType),t.sanitize&&(t.template=Se(t.template,t.whiteList,t.sanitizeFn)),t},t._getDelegateConfig=function(){var t={};if(this.config)for(var e in this.config)this.constructor.Default[e]!==this.config[e]&&(t[e]=this.config[e]);return t},t._cleanTipClass=function(){var t=g(this.getTipElement()),e=t.attr("class").match(Ne);null!==e&&e.length&&t.removeClass(e.join(""))},t._handlePopperPlacementChange=function(t){var e=t.instance;this.tip=e.popper,this._cleanTipClass(),this.addAttachmentClass(this._getAttachment(t.placement))},t._fixTransition=function(){var t=this.getTipElement(),e=this.config.animation;null===t.getAttribute("x-placement")&&(g(t).removeClass(xe),this.config.animation=!1,this.hide(),this.show(),this.config.animation=e)},i._jQueryInterface=function(n){return this.each(function(){var t=g(this).data(Ie),e="object"==typeof n&&n;if((t||!/dispose|hide/.test(n))&&(t||(t=new i(this,e),g(this).data(Ie,t)),"string"==typeof n)){if("undefined"==typeof t[n])throw new TypeError('No method named "'+n+'"');t[n]()}})},s(i,null,[{key:"VERSION",get:function(){return"4.3.1"}},{key:"Default",get:function(){return Le}},{key:"NAME",get:function(){return be}},{key:"DATA_KEY",get:function(){return Ie}},{key:"Event",get:function(){return Re}},{key:"EVENT_KEY",get:function(){return De}},{key:"DefaultType",get:function(){return ke}}]),i}();g.fn[be]=Be._jQueryInterface,g.fn[be].Constructor=Be,g.fn[be].noConflict=function(){return g.fn[be]=we,Be._jQueryInterface};var Ve="popover",Ye="bs.popover",ze="."+Ye,Xe=g.fn[Ve],$e="bs-popover",Ge=new RegExp("(^|\\s)"+$e+"\\S+","g"),Je=l({},Be.Default,{placement:"right",trigger:"click",content:"",template:'<div class="popover" role="tooltip"><div class="arrow"></div><h3 class="popover-header"></h3><div class="popover-body"></div></div>'}),Ze=l({},Be.DefaultType,{content:"(string|element|function)"}),tn="fade",en="show",nn=".popover-header",on=".popover-body",rn={HIDE:"hide"+ze,HIDDEN:"hidden"+ze,SHOW:"show"+ze,SHOWN:"shown"+ze,INSERTED:"inserted"+ze,CLICK:"click"+ze,FOCUSIN:"focusin"+ze,FOCUSOUT:"focusout"+ze,MOUSEENTER:"mouseenter"+ze,MOUSELEAVE:"mouseleave"+ze},sn=function(t){var e,n;function i(){return t.apply(this,arguments)||this}n=t,(e=i).prototype=Object.create(n.prototype),(e.prototype.constructor=e).__proto__=n;var o=i.prototype;return o.isWithContent=function(){return this.getTitle()||this._getContent()},o.addAttachmentClass=function(t){g(this.getTipElement()).addClass($e+"-"+t)},o.getTipElement=function(){return this.tip=this.tip||g(this.config.template)[0],this.tip},o.setContent=function(){var t=g(this.getTipElement());this.setElementContent(t.find(nn),this.getTitle());var e=this._getContent();"function"==typeof e&&(e=e.call(this.element)),this.setElementContent(t.find(on),e),t.removeClass(tn+" "+en)},o._getContent=function(){return this.element.getAttribute("data-content")||this.config.content},o._cleanTipClass=function(){var t=g(this.getTipElement()),e=t.attr("class").match(Ge);null!==e&&0<e.length&&t.removeClass(e.join(""))},i._jQueryInterface=function(n){return this.each(function(){var t=g(this).data(Ye),e="object"==typeof n?n:null;if((t||!/dispose|hide/.test(n))&&(t||(t=new i(this,e),g(this).data(Ye,t)),"string"==typeof n)){if("undefined"==typeof t[n])throw new TypeError('No method named "'+n+'"');t[n]()}})},s(i,null,[{key:"VERSION",get:function(){return"4.3.1"}},{key:"Default",get:function(){return Je}},{key:"NAME",get:function(){return Ve}},{key:"DATA_KEY",get:function(){return Ye}},{key:"Event",get:function(){return rn}},{key:"EVENT_KEY",get:function(){return ze}},{key:"DefaultType",get:function(){return Ze}}]),i}(Be);g.fn[Ve]=sn._jQueryInterface,g.fn[Ve].Constructor=sn,g.fn[Ve].noConflict=function(){return g.fn[Ve]=Xe,sn._jQueryInterface};var an="scrollspy",ln="bs.scrollspy",cn="."+ln,hn=g.fn[an],un={offset:10,method:"auto",target:""},fn={offset:"number",method:"string",target:"(string|element)"},dn={ACTIVATE:"activate"+cn,SCROLL:"scroll"+cn,LOAD_DATA_API:"load"+cn+".data-api"},gn="dropdown-item",_n="active",mn='[data-spy="scroll"]',pn=".nav, .list-group",vn=".nav-link",yn=".nav-item",En=".list-group-item",Cn=".dropdown",Tn=".dropdown-item",Sn=".dropdown-toggle",bn="offset",In="position",Dn=function(){function n(t,e){var n=this;this._element=t,this._scrollElement="BODY"===t.tagName?window:t,this._config=this._getConfig(e),this._selector=this._config.target+" "+vn+","+this._config.target+" "+En+","+this._config.target+" "+Tn,this._offsets=[],this._targets=[],this._activeTarget=null,this._scrollHeight=0,g(this._scrollElement).on(dn.SCROLL,function(t){return n._process(t)}),this.refresh(),this._process()}var t=n.prototype;return t.refresh=function(){var e=this,t=this._scrollElement===this._scrollElement.window?bn:In,o="auto"===this._config.method?t:this._config.method,r=o===In?this._getScrollTop():0;this._offsets=[],this._targets=[],this._scrollHeight=this._getScrollHeight(),[].slice.call(document.querySelectorAll(this._selector)).map(function(t){var e,n=_.getSelectorFromElement(t);if(n&&(e=document.querySelector(n)),e){var i=e.getBoundingClientRect();if(i.width||i.height)return[g(e)[o]().top+r,n]}return null}).filter(function(t){return t}).sort(function(t,e){return t[0]-e[0]}).forEach(function(t){e._offsets.push(t[0]),e._targets.push(t[1])})},t.dispose=function(){g.removeData(this._element,ln),g(this._scrollElement).off(cn),this._element=null,this._scrollElement=null,this._config=null,this._selector=null,this._offsets=null,this._targets=null,this._activeTarget=null,this._scrollHeight=null},t._getConfig=function(t){if("string"!=typeof(t=l({},un,"object"==typeof t&&t?t:{})).target){var e=g(t.target).attr("id");e||(e=_.getUID(an),g(t.target).attr("id",e)),t.target="#"+e}return _.typeCheckConfig(an,t,fn),t},t._getScrollTop=function(){return this._scrollElement===window?this._scrollElement.pageYOffset:this._scrollElement.scrollTop},t._getScrollHeight=function(){return this._scrollElement.scrollHeight||Math.max(document.body.scrollHeight,document.documentElement.scrollHeight)},t._getOffsetHeight=function(){return this._scrollElement===window?window.innerHeight:this._scrollElement.getBoundingClientRect().height},t._process=function(){var t=this._getScrollTop()+this._config.offset,e=this._getScrollHeight(),n=this._config.offset+e-this._getOffsetHeight();if(this._scrollHeight!==e&&this.refresh(),n<=t){var i=this._targets[this._targets.length-1];this._activeTarget!==i&&this._activate(i)}else{if(this._activeTarget&&t<this._offsets[0]&&0<this._offsets[0])return this._activeTarget=null,void this._clear();for(var o=this._offsets.length;o--;){this._activeTarget!==this._targets[o]&&t>=this._offsets[o]&&("undefined"==typeof this._offsets[o+1]||t<this._offsets[o+1])&&this._activate(this._targets[o])}}},t._activate=function(e){this._activeTarget=e,this._clear();var t=this._selector.split(",").map(function(t){return t+'[data-target="'+e+'"],'+t+'[href="'+e+'"]'}),n=g([].slice.call(document.querySelectorAll(t.join(","))));n.hasClass(gn)?(n.closest(Cn).find(Sn).addClass(_n),n.addClass(_n)):(n.addClass(_n),n.parents(pn).prev(vn+", "+En).addClass(_n),n.parents(pn).prev(yn).children(vn).addClass(_n)),g(this._scrollElement).trigger(dn.ACTIVATE,{relatedTarget:e})},t._clear=function(){[].slice.call(document.querySelectorAll(this._selector)).filter(function(t){return t.classList.contains(_n)}).forEach(function(t){return t.classList.remove(_n)})},n._jQueryInterface=function(e){return this.each(function(){var t=g(this).data(ln);if(t||(t=new n(this,"object"==typeof e&&e),g(this).data(ln,t)),"string"==typeof e){if("undefined"==typeof t[e])throw new TypeError('No method named "'+e+'"');t[e]()}})},s(n,null,[{key:"VERSION",get:function(){return"4.3.1"}},{key:"Default",get:function(){return un}}]),n}();g(window).on(dn.LOAD_DATA_API,function(){for(var t=[].slice.call(document.querySelectorAll(mn)),e=t.length;e--;){var n=g(t[e]);Dn._jQueryInterface.call(n,n.data())}}),g.fn[an]=Dn._jQueryInterface,g.fn[an].Constructor=Dn,g.fn[an].noConflict=function(){return g.fn[an]=hn,Dn._jQueryInterface};var wn="bs.tab",An="."+wn,Nn=g.fn.tab,On={HIDE:"hide"+An,HIDDEN:"hidden"+An,SHOW:"show"+An,SHOWN:"shown"+An,CLICK_DATA_API:"click"+An+".data-api"},kn="dropdown-menu",Pn="active",Ln="disabled",jn="fade",Hn="show",Rn=".dropdown",xn=".nav, .list-group",Fn=".active",Un="> li > .active",Wn='[data-toggle="tab"], [data-toggle="pill"], [data-toggle="list"]',qn=".dropdown-toggle",Mn="> .dropdown-menu .active",Kn=function(){function i(t){this._element=t}var t=i.prototype;return t.show=function(){var n=this;if(!(this._element.parentNode&&this._element.parentNode.nodeType===Node.ELEMENT_NODE&&g(this._element).hasClass(Pn)||g(this._element).hasClass(Ln))){var t,i,e=g(this._element).closest(xn)[0],o=_.getSelectorFromElement(this._element);if(e){var r="UL"===e.nodeName||"OL"===e.nodeName?Un:Fn;i=(i=g.makeArray(g(e).find(r)))[i.length-1]}var s=g.Event(On.HIDE,{relatedTarget:this._element}),a=g.Event(On.SHOW,{relatedTarget:i});if(i&&g(i).trigger(s),g(this._element).trigger(a),!a.isDefaultPrevented()&&!s.isDefaultPrevented()){o&&(t=document.querySelector(o)),this._activate(this._element,e);var l=function(){var t=g.Event(On.HIDDEN,{relatedTarget:n._element}),e=g.Event(On.SHOWN,{relatedTarget:i});g(i).trigger(t),g(n._element).trigger(e)};t?this._activate(t,t.parentNode,l):l()}}},t.dispose=function(){g.removeData(this._element,wn),this._element=null},t._activate=function(t,e,n){var i=this,o=(!e||"UL"!==e.nodeName&&"OL"!==e.nodeName?g(e).children(Fn):g(e).find(Un))[0],r=n&&o&&g(o).hasClass(jn),s=function(){return i._transitionComplete(t,o,n)};if(o&&r){var a=_.getTransitionDurationFromElement(o);g(o).removeClass(Hn).one(_.TRANSITION_END,s).emulateTransitionEnd(a)}else s()},t._transitionComplete=function(t,e,n){if(e){g(e).removeClass(Pn);var i=g(e.parentNode).find(Mn)[0];i&&g(i).removeClass(Pn),"tab"===e.getAttribute("role")&&e.setAttribute("aria-selected",!1)}if(g(t).addClass(Pn),"tab"===t.getAttribute("role")&&t.setAttribute("aria-selected",!0),_.reflow(t),t.classList.contains(jn)&&t.classList.add(Hn),t.parentNode&&g(t.parentNode).hasClass(kn)){var o=g(t).closest(Rn)[0];if(o){var r=[].slice.call(o.querySelectorAll(qn));g(r).addClass(Pn)}t.setAttribute("aria-expanded",!0)}n&&n()},i._jQueryInterface=function(n){return this.each(function(){var t=g(this),e=t.data(wn);if(e||(e=new i(this),t.data(wn,e)),"string"==typeof n){if("undefined"==typeof e[n])throw new TypeError('No method named "'+n+'"');e[n]()}})},s(i,null,[{key:"VERSION",get:function(){return"4.3.1"}}]),i}();g(document).on(On.CLICK_DATA_API,Wn,function(t){t.preventDefault(),Kn._jQueryInterface.call(g(this),"show")}),g.fn.tab=Kn._jQueryInterface,g.fn.tab.Constructor=Kn,g.fn.tab.noConflict=function(){return g.fn.tab=Nn,Kn._jQueryInterface};var Qn="toast",Bn="bs.toast",Vn="."+Bn,Yn=g.fn[Qn],zn={CLICK_DISMISS:"click.dismiss"+Vn,HIDE:"hide"+Vn,HIDDEN:"hidden"+Vn,SHOW:"show"+Vn,SHOWN:"shown"+Vn},Xn="fade",$n="hide",Gn="show",Jn="showing",Zn={animation:"boolean",autohide:"boolean",delay:"number"},ti={animation:!0,autohide:!0,delay:500},ei='[data-dismiss="toast"]',ni=function(){function i(t,e){this._element=t,this._config=this._getConfig(e),this._timeout=null,this._setListeners()}var t=i.prototype;return t.show=function(){var t=this;g(this._element).trigger(zn.SHOW),this._config.animation&&this._element.classList.add(Xn);var e=function(){t._element.classList.remove(Jn),t._element.classList.add(Gn),g(t._element).trigger(zn.SHOWN),t._config.autohide&&t.hide()};if(this._element.classList.remove($n),this._element.classList.add(Jn),this._config.animation){var n=_.getTransitionDurationFromElement(this._element);g(this._element).one(_.TRANSITION_END,e).emulateTransitionEnd(n)}else e()},t.hide=function(t){var e=this;this._element.classList.contains(Gn)&&(g(this._element).trigger(zn.HIDE),t?this._close():this._timeout=setTimeout(function(){e._close()},this._config.delay))},t.dispose=function(){clearTimeout(this._timeout),this._timeout=null,this._element.classList.contains(Gn)&&this._element.classList.remove(Gn),g(this._element).off(zn.CLICK_DISMISS),g.removeData(this._element,Bn),this._element=null,this._config=null},t._getConfig=function(t){return t=l({},ti,g(this._element).data(),"object"==typeof t&&t?t:{}),_.typeCheckConfig(Qn,t,this.constructor.DefaultType),t},t._setListeners=function(){var t=this;g(this._element).on(zn.CLICK_DISMISS,ei,function(){return t.hide(!0)})},t._close=function(){var t=this,e=function(){t._element.classList.add($n),g(t._element).trigger(zn.HIDDEN)};if(this._element.classList.remove(Gn),this._config.animation){var n=_.getTransitionDurationFromElement(this._element);g(this._element).one(_.TRANSITION_END,e).emulateTransitionEnd(n)}else e()},i._jQueryInterface=function(n){return this.each(function(){var t=g(this),e=t.data(Bn);if(e||(e=new i(this,"object"==typeof n&&n),t.data(Bn,e)),"string"==typeof n){if("undefined"==typeof e[n])throw new TypeError('No method named "'+n+'"');e[n](this)}})},s(i,null,[{key:"VERSION",get:function(){return"4.3.1"}},{key:"DefaultType",get:function(){return Zn}},{key:"Default",get:function(){return ti}}]),i}();g.fn[Qn]=ni._jQueryInterface,g.fn[Qn].Constructor=ni,g.fn[Qn].noConflict=function(){return g.fn[Qn]=Yn,ni._jQueryInterface},function(){if("undefined"==typeof g)throw new TypeError("Bootstrap's JavaScript requires jQuery. jQuery must be included before Bootstrap's JavaScript.");var t=g.fn.jquery.split(" ")[0].split(".");if(t[0]<2&&t[1]<9||1===t[0]&&9===t[1]&&t[2]<1||4<=t[0])throw new Error("Bootstrap's JavaScript requires at least jQuery v1.9.1 but less than v4.0.0")}(),t.Util=_,t.Alert=p,t.Button=P,t.Carousel=lt,t.Collapse=bt,t.Dropdown=Jt,t.Modal=ve,t.Popover=sn,t.Scrollspy=Dn,t.Tab=Kn,t.Toast=ni,t.Tooltip=Be,Object.defineProperty(t,"__esModule",{value:!0})});
//# sourceMappingURL=bootstrap.min.js.map
/*! jssocials - v1.4.0 - 2016-10-10
* http://js-socials.com
* Copyright (c) 2016 Artem Tabalin; Licensed MIT */
!function(a,b,c){function d(a,c){var d=b(a);d.data(f,this),this._$element=d,this.shares=[],this._init(c),this._render()}var e="JSSocials",f=e,g=function(a,c){return b.isFunction(a)?a.apply(c,b.makeArray(arguments).slice(2)):a},h=/(\.(jpeg|png|gif|bmp|svg)$|^data:image\/(jpeg|png|gif|bmp|svg\+xml);base64)/i,i=/(&?[a-zA-Z0-9]+=)?\{([a-zA-Z0-9]+)\}/g,j={G:1e9,M:1e6,K:1e3},k={};d.prototype={url:"",text:"",shareIn:"blank",showLabel:function(a){return this.showCount===!1?a>this.smallScreenWidth:a>=this.largeScreenWidth},showCount:function(a){return a<=this.smallScreenWidth?"inside":!0},smallScreenWidth:640,largeScreenWidth:1024,resizeTimeout:200,elementClass:"jssocials",sharesClass:"jssocials-shares",shareClass:"jssocials-share",shareButtonClass:"jssocials-share-button",shareLinkClass:"jssocials-share-link",shareLogoClass:"jssocials-share-logo",shareLabelClass:"jssocials-share-label",shareLinkCountClass:"jssocials-share-link-count",shareCountBoxClass:"jssocials-share-count-box",shareCountClass:"jssocials-share-count",shareZeroCountClass:"jssocials-share-no-count",_init:function(a){this._initDefaults(),b.extend(this,a),this._initShares(),this._attachWindowResizeCallback()},_initDefaults:function(){this.url=a.location.href,this.text=b.trim(b("meta[name=description]").attr("content")||b("title").text())},_initShares:function(){this.shares=b.map(this.shares,b.proxy(function(a){"string"==typeof a&&(a={share:a});var c=a.share&&k[a.share];if(!c&&!a.renderer)throw Error("Share '"+a.share+"' is not found");return b.extend({url:this.url,text:this.text},c,a)},this))},_attachWindowResizeCallback:function(){b(a).on("resize",b.proxy(this._windowResizeHandler,this))},_detachWindowResizeCallback:function(){b(a).off("resize",this._windowResizeHandler)},_windowResizeHandler:function(){(b.isFunction(this.showLabel)||b.isFunction(this.showCount))&&(a.clearTimeout(this._resizeTimer),this._resizeTimer=setTimeout(b.proxy(this.refresh,this),this.resizeTimeout))},_render:function(){this._clear(),this._defineOptionsByScreen(),this._$element.addClass(this.elementClass),this._$shares=b("<div>").addClass(this.sharesClass).appendTo(this._$element),this._renderShares()},_defineOptionsByScreen:function(){this._screenWidth=b(a).width(),this._showLabel=g(this.showLabel,this,this._screenWidth),this._showCount=g(this.showCount,this,this._screenWidth)},_renderShares:function(){b.each(this.shares,b.proxy(function(a,b){this._renderShare(b)},this))},_renderShare:function(a){var c;c=b.isFunction(a.renderer)?b(a.renderer()):this._createShare(a),c.addClass(this.shareClass).addClass(a.share?"jssocials-share-"+a.share:"").addClass(a.css).appendTo(this._$shares)},_createShare:function(a){var c=b("<div>"),d=this._createShareLink(a).appendTo(c);if(this._showCount){var e="inside"===this._showCount,f=e?d:b("<div>").addClass(this.shareCountBoxClass).appendTo(c);f.addClass(e?this.shareLinkCountClass:this.shareCountBoxClass),this._renderShareCount(a,f)}return c},_createShareLink:function(a){var c=this._getShareStrategy(a),d=c.call(a,{shareUrl:this._getShareUrl(a)});return d.addClass(this.shareLinkClass).append(this._createShareLogo(a)),this._showLabel&&d.append(this._createShareLabel(a)),b.each(this.on||{},function(c,e){b.isFunction(e)&&d.on(c,b.proxy(e,a))}),d},_getShareStrategy:function(a){var b=m[a.shareIn||this.shareIn];if(!b)throw Error("Share strategy '"+this.shareIn+"' not found");return b},_getShareUrl:function(a){var b=g(a.shareUrl,a);return this._formatShareUrl(b,a)},_createShareLogo:function(a){var c=a.logo,d=h.test(c)?b("<img>").attr("src",a.logo):b("<i>").addClass(c);return d.addClass(this.shareLogoClass),d},_createShareLabel:function(a){return b("<span>").addClass(this.shareLabelClass).text(a.label)},_renderShareCount:function(a,c){var d=b("<span>").addClass(this.shareCountClass);c.addClass(this.shareZeroCountClass).append(d),this._loadCount(a).done(b.proxy(function(a){a&&(c.removeClass(this.shareZeroCountClass),d.text(a))},this))},_loadCount:function(a){var c=b.Deferred(),d=this._getCountUrl(a);if(!d)return c.resolve(0).promise();var e=b.proxy(function(b){c.resolve(this._getCountValue(b,a))},this);return b.getJSON(d).done(e).fail(function(){b.get(d).done(e).fail(function(){c.resolve(0)})}),c.promise()},_getCountUrl:function(a){var b=g(a.countUrl,a);return this._formatShareUrl(b,a)},_getCountValue:function(a,c){var d=(b.isFunction(c.getCount)?c.getCount(a):a)||0;return"string"==typeof d?d:this._formatNumber(d)},_formatNumber:function(a){return b.each(j,function(b,c){return a>=c?(a=parseFloat((a/c).toFixed(2))+b,!1):void 0}),a},_formatShareUrl:function(b,c){return b.replace(i,function(b,d,e){var f=c[e]||"";return f?(d||"")+a.encodeURIComponent(f):""})},_clear:function(){a.clearTimeout(this._resizeTimer),this._$element.empty()},_passOptionToShares:function(a,c){var d=this.shares;b.each(["url","text"],function(e,f){f===a&&b.each(d,function(b,d){d[a]=c})})},_normalizeShare:function(a){return b.isNumeric(a)?this.shares[a]:"string"==typeof a?b.grep(this.shares,function(b){return b.share===a})[0]:a},refresh:function(){this._render()},destroy:function(){this._clear(),this._detachWindowResizeCallback(),this._$element.removeClass(this.elementClass).removeData(f)},option:function(a,b){return 1===arguments.length?this[a]:(this[a]=b,this._passOptionToShares(a,b),void this.refresh())},shareOption:function(a,b,c){return a=this._normalizeShare(a),2===arguments.length?a[b]:(a[b]=c,void this.refresh())}},b.fn.jsSocials=function(a){var e=b.makeArray(arguments),g=e.slice(1),h=this;return this.each(function(){var e,i=b(this),j=i.data(f);if(j)if("string"==typeof a){if(e=j[a].apply(j,g),e!==c&&e!==j)return h=e,!1}else j._detachWindowResizeCallback(),j._init(a),j._render();else new d(i,a)}),h};var l=function(a){var c;b.isPlainObject(a)?c=d.prototype:(c=k[a],a=arguments[1]||{}),b.extend(c,a)},m={popup:function(c){return b("<a>").attr("href","#").on("click",function(){return a.open(c.shareUrl,null,"width=600, height=400, location=0, menubar=0, resizeable=0, scrollbars=0, status=0, titlebar=0, toolbar=0"),!1})},blank:function(a){return b("<a>").attr({target:"_blank",href:a.shareUrl})},self:function(a){return b("<a>").attr({target:"_self",href:a.shareUrl})}};a.jsSocials={Socials:d,shares:k,shareStrategies:m,setDefaults:l}}(window,jQuery),function(a,b,c){b.extend(c.shares,{email:{label:"E-mail",logo:"fa fa-at",shareUrl:"mailto:{to}?subject={text}&body={url}",countUrl:"",shareIn:"self"},twitter:{label:"Tweet",logo:"fa fa-twitter",shareUrl:"https://twitter.com/share?url={url}&text={text}&via={via}&hashtags={hashtags}",countUrl:""},facebook:{label:"Like",logo:"fa fa-facebook",shareUrl:"https://facebook.com/sharer/sharer.php?u={url}",countUrl:"https://graph.facebook.com/?id={url}",getCount:function(a){return a.share&&a.share.share_count||0}},vkontakte:{label:"Like",logo:"fa fa-vk",shareUrl:"https://vk.com/share.php?url={url}&title={title}&description={text}",countUrl:"https://vk.com/share.php?act=count&index=1&url={url}",getCount:function(a){return parseInt(a.slice(15,-2).split(", ")[1])}},googleplus:{label:"+1",logo:"fa fa-google",shareUrl:"https://plus.google.com/share?url={url}",countUrl:""},linkedin:{label:"Share",logo:"fa fa-linkedin",shareUrl:"https://www.linkedin.com/shareArticle?mini=true&url={url}",countUrl:"https://www.linkedin.com/countserv/count/share?format=jsonp&url={url}&callback=?",getCount:function(a){return a.count}},pinterest:{label:"Pin it",logo:"fa fa-pinterest",shareUrl:"https://pinterest.com/pin/create/bookmarklet/?media={media}&url={url}&description={text}",countUrl:"https://api.pinterest.com/v1/urls/count.json?&url={url}&callback=?",getCount:function(a){return a.count}},stumbleupon:{label:"Share",logo:"fa fa-stumbleupon",shareUrl:"http://www.stumbleupon.com/submit?url={url}&title={title}",countUrl:"https://cors-anywhere.herokuapp.com/https://www.stumbleupon.com/services/1.01/badge.getinfo?url={url}",getCount:function(a){return a.result.views}},telegram:{label:"Telegram",logo:"fa fa-paper-plane",shareUrl:"tg://msg?text={url} {text}",countUrl:"",shareIn:"self"},whatsapp:{label:"WhatsApp",logo:"fa fa-whatsapp",shareUrl:"whatsapp://send?text={url} {text}",countUrl:"",shareIn:"self"},line:{label:"LINE",logo:"fa fa-comment",shareUrl:"http://line.me/R/msg/text/?{text} {url}",countUrl:""},viber:{label:"Viber",logo:"fa fa-volume-control-phone",shareUrl:"viber://forward?text={url} {text}",countUrl:"",shareIn:"self"},pocket:{label:"Pocket",logo:"fa fa-get-pocket",shareUrl:"https://getpocket.com/save?url={url}&title={title}",countUrl:""},messenger:{label:"Share",logo:"fa fa-commenting",shareUrl:"fb-messenger://share?link={url}",countUrl:"",shareIn:"self"}})}(window,jQuery,window.jsSocials);
// Sticky Plugin v1.0.4 for jQuery
// =============
// Author: Anthony Garand
// Improvements by German M. Bravo (Kronuz) and Ruud Kamphuis (ruudk)
// Improvements by Leonardo C. Daronco (daronco)
// Created: 02/14/2011
// Date: 07/20/2015
// Website: http://stickyjs.com/
// Description: Makes an element on the page stick on the screen as you scroll
//              It will only set the 'top' and 'position' of your element, you
//              might need to adjust the width in some cases.

(function (factory) {
    if (typeof define === 'function' && define.amd) {
        // AMD. Register as an anonymous module.
        define(['jquery'], factory);
    } else if (typeof module === 'object' && module.exports) {
        // Node/CommonJS
        module.exports = factory(require('jquery'));
    } else {
        // Browser globals
        factory(jQuery);
    }
}(function ($) {
    var slice = Array.prototype.slice; // save ref to original slice()
    var splice = Array.prototype.splice; // save ref to original slice()

  var defaults = {
      topSpacing: 0,
      bottomSpacing: 0,
      className: 'is-sticky',
      wrapperClassName: 'sticky-wrapper',
      center: false,
      getWidthFrom: '',
      widthFromWrapper: true, // works only when .getWidthFrom is empty
      responsiveWidth: false,
      zIndex: 'auto'
    },
    $window = $(window),
    $document = $(document),
    sticked = [],
    windowHeight = $window.height(),
    scroller = function() {
      var scrollTop = $window.scrollTop(),
        documentHeight = $document.height(),
        dwh = documentHeight - windowHeight,
        extra = (scrollTop > dwh) ? dwh - scrollTop : 0;

      for (var i = 0, l = sticked.length; i < l; i++) {
        var s = sticked[i],
          elementTop = s.stickyWrapper.offset().top,
          etse = elementTop - s.topSpacing - extra;

        //update height in case of dynamic content
        s.stickyWrapper.css('height', s.stickyElement.outerHeight());

        if (scrollTop <= etse) {
          if (s.currentTop !== null) {
            s.stickyElement
              .css({
                'width': '',
                'position': '',
                'top': '',
                'z-index': ''
              });
            s.stickyElement.parent().removeClass(s.className);
            s.stickyElement.trigger('sticky-end', [s]);
            s.currentTop = null;
          }
        }
        else {
          var newTop = documentHeight - s.stickyElement.outerHeight()
            - s.topSpacing - s.bottomSpacing - scrollTop - extra;
          if (newTop < 0) {
            newTop = newTop + s.topSpacing;
          } else {
            newTop = s.topSpacing;
          }
          if (s.currentTop !== newTop) {
            var newWidth;
            if (s.getWidthFrom) {
                newWidth = $(s.getWidthFrom).width() || null;
            } else if (s.widthFromWrapper) {
                newWidth = s.stickyWrapper.width();
            }
            if (newWidth == null) {
                newWidth = s.stickyElement.width();
            }
            s.stickyElement
              .css('width', newWidth)
              .css('position', 'fixed')
              .css('top', newTop)
              .css('z-index', s.zIndex);

            s.stickyElement.parent().addClass(s.className);

            if (s.currentTop === null) {
              s.stickyElement.trigger('sticky-start', [s]);
            } else {
              // sticky is started but it have to be repositioned
              s.stickyElement.trigger('sticky-update', [s]);
            }

            if (s.currentTop === s.topSpacing && s.currentTop > newTop || s.currentTop === null && newTop < s.topSpacing) {
              // just reached bottom || just started to stick but bottom is already reached
              s.stickyElement.trigger('sticky-bottom-reached', [s]);
            } else if(s.currentTop !== null && newTop === s.topSpacing && s.currentTop < newTop) {
              // sticky is started && sticked at topSpacing && overflowing from top just finished
              s.stickyElement.trigger('sticky-bottom-unreached', [s]);
            }

            s.currentTop = newTop;
          }

          // Check if sticky has reached end of container and stop sticking
          var stickyWrapperContainer = s.stickyWrapper.parent();
          var unstick = (s.stickyElement.offset().top + s.stickyElement.outerHeight() >= stickyWrapperContainer.offset().top + stickyWrapperContainer.outerHeight()) && (s.stickyElement.offset().top <= s.topSpacing);

          if( unstick ) {
            s.stickyElement
              .css('position', 'absolute')
              .css('top', '')
              .css('bottom', 0)
              .css('z-index', '');
          } else {
            s.stickyElement
              .css('position', 'fixed')
              .css('top', newTop)
              .css('bottom', '')
              .css('z-index', s.zIndex);
          }
        }
      }
    },
    resizer = function() {
      windowHeight = $window.height();

      for (var i = 0, l = sticked.length; i < l; i++) {
        var s = sticked[i];
        var newWidth = null;
        if (s.getWidthFrom) {
            if (s.responsiveWidth) {
                newWidth = $(s.getWidthFrom).width();
            }
        } else if(s.widthFromWrapper) {
            newWidth = s.stickyWrapper.width();
        }
        if (newWidth != null) {
            s.stickyElement.css('width', newWidth);
        }
      }
    },
    methods = {
      init: function(options) {
        var o = $.extend({}, defaults, options);
        return this.each(function() {
          var stickyElement = $(this);

          var stickyId = stickyElement.attr('id');
          var wrapperId = stickyId ? stickyId + '-' + defaults.wrapperClassName : defaults.wrapperClassName;
          var wrapper = $('<div></div>')
            .attr('id', wrapperId)
            .addClass(o.wrapperClassName);

          stickyElement.wrapAll(function() {
            if ($(this).parent("#" + wrapperId).length == 0) {
                    return wrapper;
            }
});

          var stickyWrapper = stickyElement.parent();

          if (o.center) {
            stickyWrapper.css({width:stickyElement.outerWidth(),marginLeft:"auto",marginRight:"auto"});
          }

          if (stickyElement.css("float") === "right") {
            stickyElement.css({"float":"none"}).parent().css({"float":"right"});
          }

          o.stickyElement = stickyElement;
          o.stickyWrapper = stickyWrapper;
          o.currentTop    = null;

          sticked.push(o);

          methods.setWrapperHeight(this);
          methods.setupChangeListeners(this);
        });
      },

      setWrapperHeight: function(stickyElement) {
        var element = $(stickyElement);
        var stickyWrapper = element.parent();
        if (stickyWrapper) {
          stickyWrapper.css('height', element.outerHeight());
        }
      },

      setupChangeListeners: function(stickyElement) {
        if (window.MutationObserver) {
          var mutationObserver = new window.MutationObserver(function(mutations) {
            if (mutations[0].addedNodes.length || mutations[0].removedNodes.length) {
              methods.setWrapperHeight(stickyElement);
            }
          });
          mutationObserver.observe(stickyElement, {subtree: true, childList: true});
        } else {
          stickyElement.addEventListener('DOMNodeInserted', function() {
            methods.setWrapperHeight(stickyElement);
          }, false);
          stickyElement.addEventListener('DOMNodeRemoved', function() {
            methods.setWrapperHeight(stickyElement);
          }, false);
        }
      },
      update: scroller,
      unstick: function(options) {
        return this.each(function() {
          var that = this;
          var unstickyElement = $(that);

          var removeIdx = -1;
          var i = sticked.length;
          while (i-- > 0) {
            if (sticked[i].stickyElement.get(0) === that) {
                splice.call(sticked,i,1);
                removeIdx = i;
            }
          }
          if(removeIdx !== -1) {
            unstickyElement.unwrap();
            unstickyElement
              .css({
                'width': '',
                'position': '',
                'top': '',
                'float': '',
                'z-index': ''
              })
            ;
          }
        });
      }
    };

  // should be more efficient than using $window.scroll(scroller) and $window.resize(resizer):
  if (window.addEventListener) {
    window.addEventListener('scroll', scroller, false);
    window.addEventListener('resize', resizer, false);
  } else if (window.attachEvent) {
    window.attachEvent('onscroll', scroller);
    window.attachEvent('onresize', resizer);
  }

  $.fn.sticky = function(method) {
    if (methods[method]) {
      return methods[method].apply(this, slice.call(arguments, 1));
    } else if (typeof method === 'object' || !method ) {
      return methods.init.apply( this, arguments );
    } else {
      $.error('Method ' + method + ' does not exist on jQuery.sticky');
    }
  };

  $.fn.unstick = function(method) {
    if (methods[method]) {
      return methods[method].apply(this, slice.call(arguments, 1));
    } else if (typeof method === 'object' || !method ) {
      return methods.unstick.apply( this, arguments );
    } else {
      $.error('Method ' + method + ' does not exist on jQuery.sticky');
    }
  };
  $(function() {
    setTimeout(scroller, 0);
  });
}));
