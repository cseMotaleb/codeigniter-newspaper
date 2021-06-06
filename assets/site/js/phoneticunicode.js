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