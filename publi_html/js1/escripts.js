

function valida_form_ins(){
	var dato="";
	var fallo=""
	if( !isNaN(f1.nome.value) || f1.nome.value.length<3 )
	fallo += "Escriba o seu nome correctamente.\n";
	if( !isNaN(f1.apelidos.value) || f1.apelidos.value.length<3 )
	fallo += "Escriba os seus apelidos correctamente.\n";

var dni = valida_nif_cif_nie( f1.dni.value );
if (dni!=3 && dni!=1) 
	fallo += "Escriba o seu DNINIE correctamente.\n";

var indice = f1.sexo.selectedIndex;
var sexo = f1.sexo.options[indice].value;
	if( sexo=="---" )
	fallo += "Seleccione o seu sexo.\n";

 indice = f1.dia.selectedIndex;
var dia = f1.dia.options[indice].value;
 indice = f1.mes.selectedIndex;
var mes = f1.mes.options[indice].value;
 indice = f1.ano.selectedIndex;
var ano = f1.ano.options[indice].value;
var data = dia+"/"+mes+"/" + ano;
if (!validadataDDMMAAAA(data))
	fallo += "Seleccione a sua data correctamente.\n";

var valor = f1.correo.value;
	var test = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
	var emailReg = new RegExp(test);
 if (!emailReg.test(valor)) 
	fallo += "Escriba o seu E-mail correctamente.\n";
if (f1.correo.value != f1.correo2.value)
	fallo += "Repita o seu E-mail.\n";

if ( f1.mobil.value.charAt(0)!='6' || f1.mobil.value.length != 9 || isNaN(f1.mobil.value))
	fallo += "Escriba o seu numero de mobil correctamente.\n";

	if( !isNaN(f1.enderezo.value) || f1.enderezo.value.length<3 )
	fallo += "Escriba o seu enderezo correctamente.\n";

if (!isNaN(f1.postal.value)){
	if(f1.postal.value<1001 || f1.postal.value >52999 || f1.postal.value.length!= 5 )
		fallo += "Escriba o seu codigo postal correctamente.\n";
} else 
		fallo += "Escriba o seu codigo postal correctamente.\n";

 indice = f1.provincia.selectedIndex;
var prov = f1.provincia.options[indice].value;
	if( prov=="0" )
	fallo += "Seleccione a sua provincia.\n";



	if( !isNaN(f1.localidade.value) || f1.localidade.value.length<3 )
	fallo += "Escriba a sua localidade correctamente.\n";

if (!f1.acepto.checked)
	fallo += "Compre que acepte o regulamento para seguir ca inscricion."; 
	if(fallo!=""){ 
		alert(fallo);
		return false;
	}else return true;


}// fin da funcion valida_form_ins.


// **********

function valida_nif_cif_nie( a )
{
	var temp = a.toUpperCase();
	var cadenadni = "TRWAGMYFPDXBNJZSQVHLCKE";
 
	if( temp!= '' )
	{
		//si no tiene un formato valido devuelve error
		if( ( !/^[A-Z]{1}[0-9]{7}[A-Z0-9]{1}$/.test( temp ) && !/^[T]{1}[A-Z0-9]{8}$/.test( temp ) ) && !/^[0-9]{8}[A-Z]{1}$/.test( temp ) )
		{
			return 0;
		}
 
		//comprobacion de NIFs estandar
		if( /^[0-9]{8}[A-Z]{1}$/.test( temp ) )
		{
			posicion = a.substring( 8,0 ) % 23;
			letra = cadenadni.charAt( posicion );
			var letradni = temp.charAt( 8 );
			if( letra == letradni )
			{
				return 1;
			}
			else
			{
				return -1;
			}
		}
 
 
		//algoritmo para comprobacion de codigos tipo CIF
		suma = parseInt(a.charAt(2))+parseInt(a.charAt(4))+parseInt(a.charAt(6));
 
		for( i = 1; i < 8; i += 2 )
		{
			temp1 = 2 * parseInt( a.charAt( i ) );
			temp1 += '';
			temp1 = temp1.substring(0,1);
			temp2 = 2 * parseInt( a.charAt( i ) );
			temp2 += '';
			temp2 = temp2.substring( 1,2 );
			if( temp2 == '' )
			{
				temp2 = '0';
			}
 
			suma += ( parseInt( temp1 ) + parseInt( temp2 ) );
		}
		suma += '';
		n = 10 - parseInt( suma.substring( suma.length-1, suma.length ) );
 
		//comprobacion de NIFs especiales (se calculan como CIFs)
		if( /^[KLM]{1}/.test( temp ) )
		{
			if( a.charAt( 8 ) == String.fromCharCode( 64 + n ) )
			{
				return 1;
			}
			else
			{
				return -1;
			}
		}
 
		//comprobacion de CIFs
		if( /^[ABCDEFGHJNPQRSUVW]{1}/.test( temp ) )
		{
			temp = n + '';
			if( a.charAt( 8 ) == String.fromCharCode( 64 + n ) || a.charAt( 8 ) == parseInt( temp.substring( temp.length-1, temp.length ) ) )
			{
				return 2;
			}
			else
			{
				return -2;
			}
		}
 
		//comprobacion de NIEs
		//T
		if( /^[T]{1}[A-Z0-9]{8}$/.test( temp ) )
		{
			if( a.charAt( 8 ) == /^[T]{1}[A-Z0-9]{8}$/.test( temp ) )
			{
				return 3;
			}
			else
			{
				return -3;
			}
		}
		//XYZ
		if( /^[XYZ]{1}/.test( temp ) )
		{
			temp = temp.replace( 'X','0' )
			temp = temp.replace( 'Y','1' )
			temp = temp.replace( 'Z','2' )
			pos = temp.substring(0, 8) % 23;
 
			if( a.toUpperCase().charAt( 8 ) == cadenadni.substring( pos, pos + 1 ) )
			{
				return 3;
			}
			else
			{
				return -3;
			}
		}
	}
 
	return 0;
} // fin da funcion valida DNI/NIE.

// Para los cálculos se usa esta función auxiliar que emula el str_replace de PHP

function str_replace( search, position, replace, subject )
{
	var f = search, r = replace, s = subject, p = position;
	var ra = r instanceof Array, sa = s instanceof Array, f = [].concat(f), r = [].concat(r), i = (s = [].concat(s)).length;
 
	while( j = 0, i-- )
	{
		if( s[i] )
		{
			while( s[p] = s[p].split( f[j] ).join( ra ? r[j] || "" : r[0] ), ++j in f){};
		}
	};
 
	return sa ? s : s[0];
} // fin de function str_replace( search, position, replace, subject )


function validadataDDMMAAAA(fecha){
	var dtCh= "/";
	var minYear=1900;
	var maxYear=2100;
	function isInteger(s){
		var i;
		for (i = 0; i < s.length; i++){
			var c = s.charAt(i);
			if (((c < "0") || (c > "9"))) return false;
		}
		return true;
	}
	function stripCharsInBag(s, bag){
		var i;
		var returnString = "";
		for (i = 0; i < s.length; i++){
			var c = s.charAt(i);
			if (bag.indexOf(c) == -1) returnString += c;
		}
		return returnString;
	}
	function daysInFebruary (year){
		return (((year % 4 == 0) && ( (!(year % 100 == 0)) || (year % 400 == 0))) ? 29 : 28 );
	}
	function DaysArray(n) {
		for (var i = 1; i <= n; i++) {
			this[i] = 31
			if (i==4 || i==6 || i==9 || i==11) {this[i] = 30}
			if (i==2) {this[i] = 29}
		}
		return this
	}
	function isDate(dtStr){
		var daysInMonth = DaysArray(12)
		var pos1=dtStr.indexOf(dtCh)
		var pos2=dtStr.indexOf(dtCh,pos1+1)
		var strDay=dtStr.substring(0,pos1)
		var strMonth=dtStr.substring(pos1+1,pos2)
		var strYear=dtStr.substring(pos2+1)
		strYr=strYear
		if (strDay.charAt(0)=="0" && strDay.length>1) strDay=strDay.substring(1)
		if (strMonth.charAt(0)=="0" && strMonth.length>1) strMonth=strMonth.substring(1)
		for (var i = 1; i <= 3; i++) {
			if (strYr.charAt(0)=="0" && strYr.length>1) strYr=strYr.substring(1)
		}
		month=parseInt(strMonth)
		day=parseInt(strDay)
		year=parseInt(strYr)
		if (pos1==-1 || pos2==-1){
			return false
		}
		if (strMonth.length<1 || month<1 || month>12){
			return false
		}
		if (strDay.length<1 || day<1 || day>31 || (month==2 && day>daysInFebruary(year)) || day > daysInMonth[month]){
			return false
		}
		if (strYear.length != 4 || year==0 || year<minYear || year>maxYear){
			return false
		}
		if (dtStr.indexOf(dtCh,pos2+1)!=-1 || isInteger(stripCharsInBag(dtStr, dtCh))==false){
			return false
		}
		return true
	}
	if(isDate(fecha)){
		return true;
	}else{
		return false;
	}
} // fin da funcion valida data.


// calcular idade 
function calcular_edad() {
var diaActual = <?=$trozos[0] ?>;
var mmActual = <?= $trozos[1] ?>;
var yyyyActual = <?= $trozos[2] ?>;
var indice = f1.dia.selectedIndex;
var diaCumple = f1.dia .options[indice].value;
indice = f1.mes.selectedIndex;
var mmCumple = f1.mes .options[indice].value;
indice = f1.ano.selectedIndex;
var yyyyCumple = f1.ano .options[indice].value;
//retiramos el primer cero de la izquierda
if (mmCumple.substr(0,1) == 0) {
mmCumple= mmCumple.substring(1, 2);
}
//retiramos el primer cero de la izquierda
if (diaCumple.substr(0, 1) == 0) {
diaCumple = diaCumple.substring(1, 2);
}
var edad = yyyyActual - yyyyCumple;

//validamos si el mes de cumpleaños es menor al actual
//o si el mes de cumpleaños es igual al actual
//y el dia actual es menor al del nacimiento
//De ser asi, se resta un año
if ((mmActual < mmCumple) || (mmActual == mmCumple && diaActual < diaCumple)) {
edad--;
}
return edad;
} // fin de calcular idade 



//   codigo da conta atras.
//variables que determinan la fecha y hora final de la cuenta atras
toYear=2012;
toMonth=10;
toDay=15;
toHour=8;
toMinute=59;
toSecond=59;

function countDown()
{
	new_year= 2016;
	new_month=8;
	new_day= 6;
	new_hour= 23;
	new_minute= 59 ;
	new_second= 59 ;
	actual_date=new Date();
	tempo=0;

	evento_date = new Date(toYear,toMonth - 1,toDay,toHour,toMinute,toSecond);
	evento_date = (evento_date.getTime() - actual_date.getTime())/1000;
	if (evento_date < 0) 

	{
		//si ya nos hemos pasado del año, mostramos los valores a 0

		form.tempo.value='00:00:00';
		form.day.value=0;
		form.month.value=0;

	}else{
		new_second=new_second+toSecond-actual_date.getSeconds();
		if(new_second<10) new_second='0' + new_second;
		if(new_second<0)
		{
			new_second=60+new_second;
			new_minute=-1;
		}


		new_minute=new_minute+toMinute-actual_date.getMinutes();
		if(new_minute<10) new_minute='0' + new_minute;
		if(new_minute<0)
		{
			new_minute=60+new_minute;
			new_hour=-1;
		}


		new_hour=new_hour+toHour-actual_date.getHours();
		if(new_hour<0)
		{
			new_hour=24+new_hour;
			new_day=-1;
		}

		tempo=new_hour + ':' + new_minute + ':' + new_second;
		form.tempo.value=tempo;

		new_day=new_day+toDay-actual_date.getDate();
		if(new_day<0)
		{
			new_month=-1;
			x=actual_date.getMonth();
			if(x==0||x==2||x==4||x==6||x==7||x==9||x==11){new_day=31+new_day;}
			if(x==3||x==5||x==8||x==10){new_day=30+new_day;}
			if(x==1)
			{
				//comprobamos si es un año bisiesto...
				if(actual_date.getYear()/4-Math.floor(actual_date.getYear()/4)==0)
				{
					actual_date=29+actual_date;
				}else{
					actual_date=28+actual_date;
				}
			}
		}
		form.day.value=new_day;


		new_month=new_month + toMonth-(actual_date.getMonth()+1);
		if(new_month<0)
		{
			new_month=12+new_month;
			new_year=-1;
		}
		form.month.value=new_month;

		new_year=new_year+toYear-actual_date.getFullYear();
		if(new_year<0)
		{
//			form.year.value=0;
		}else{
//			form.year.value=new_year;
			//vuelve a ejecutar la funcion dentro de 1000 milisegundos = 1 segundo
			setTimeout("countDown()",1000);
		}
	}
}// fin da funcion count down




