<?
// declaracion de variables.
$vale = "";
$mobil = "";
$provincia = "";
$postal = "";
$enderezo = "";
$categoria="";
$licencia="";
$club="";
$local="";
$chip="";
$pago="";
$bus="";
$talle="";
$alcume="";

if (isset($_POST)){
        foreach($_POST as $campo=>$valor){
	$valor = trim($valor);
	$valor = strip_tags($valor);
 	$valor = htmlentities($valor, ENT_QUOTES, "utf-8");
	switch ($campo) {
		case "nome":
if ( is_numeric ($valor) || strlen($valor)<3 || strlen($valor)>70) $vale= "<li> Escriba o seu nome correctamente.</li>";
else $nome = $valor;
		break;
		case "apelidos":
if ( is_numeric ($valor) || strlen($valor)<3 || strlen($valor)>90) $vale.= "<li> Escriba os seus apelidos correctamente.</li>";
else $apelidos = $valor;
		break;
		case "sexo": 
	if ($valor != "1" || $valor != "2"){
	     if ($valor == "1") $sexo = "M";
	     if ($valor == "2") $sexo = "F";
	}else $vale .= "<li>Seleccione o seu sexo.</li>";
		break;
		case "dia": if (!is_numeric($valor)) $vale .= "<li>Seleccione o dia da sua data de nacemento.</li>";
		else $dia = $valor;
		break;
		case "mes": if (!is_numeric($valor)) $vale .= "<li>Seleccione o mes da sua data de nacemento.</li>";
		else $mes = $valor;
		break;
		case "ano": if (!is_numeric($valor)) $vale .= "<li>Seleccione o ano da sua data de nacemento.</li>";
		else $ano = $valor;
		break;
		case "correo": if(comprobar_email($valor)==0) $vale .="<li>Escriba o seu E-mail correctamente.</li>"; 
		else $correo=$valor; 
		break;
		case "correo2": 
	if(comprobar_email($valor)==0)
		 $vale .="<li>Escriba o seu E-mail correctamente.</li>";
	else		if ($correo!=$valor) $vale.="<li> Repita o seu E-mail correctamente.</li>";
		break;
		case "mobil": if (strlen($valor) != 9 || !is_numeric ($valor)) $vale .= "Escriba o seu numero de mobil correctamente.</li>";
		else $mobil=$valor;
		break;
		case "enderezo": if (is_numeric ($valor) || strlen($valor)<3 || strlen($valor)>175) $vale .= "<li> Escriba o seu enderezo correctamente.</li>";
	else $enderezo=$valor;
		break;
		case "postal": 
		if (is_numeric ($valor)){
			if ($valor <1001 || $valor >52999)
			$vale .= "<li>Escriba o seu codigo postal correctamente.</li>";
		else $postal=$valor;
		}else 
			$vale .= "<li>Escriba o seu codigo postal correctamente.</li>";
		break;
		case "provincia": if ( is_numeric ($valor) || strlen($valor)<3 || strlen($valor)>70) $vale = "<li> Escriba a sua provincia correctamente.</li>";
		else $provincia=$valor;
		break;
		case "localidade": if ( is_numeric ($valor) || strlen($valor)<3 || strlen($valor)>90) $vale = "<li> Escriba a sua localidade correctamente.</li>";
		else $localidade=$valor;
		break;

		case "club": if (strlen($valor) >150) $vale .= "<li> O nome do club é demasiado longo.</li>";
		else $club=$valor;
		break;
		case "licencia": if (strlen($valor) >50) $vale .= "<li> O numero de licencia é demasiado longo..</li>";
		else $licencia=$valor;
		break;
		case "local": if ($valor=="si") $local="SI";
		break;

	} //fin do switch
} // fin do foreach 

// comprobo que aceptou o regulamento.
if (isset ($_POST['acepto']) )	{
	if ($_POST['acepto']!="si") $vale = "<li> Compre que acepte o regulamento para continuar ca inscricion.</li>";
}else $vale = "<li> Compre que acepte o regulamento para continuar ca inscricion.</li>";

}else{ // else do if de isset de $_post.
	$vale="Formulario non enviado";
} // fin do if de isset de $_post.



if ($vale==""){
// comprobo que e maior de idade pra ver se precisa DNI
If (!checkdate ($mes,$dia,$ano)){
// miro se a data introducida e correcta
	$vale .= "<li>Seleccione a sua data correctamente.</li>";
}else{ // else do if de checkdate
// a data e correcta, procedo a comproba-lo DNI/NIE.
// antes calculo a idade
$anonaz =$_POST['ano'];
$mesnaz =$_POST['mes']; // 100
$dianaz =$_POST['dia'];
// data do evento.
$trozos=explode("/",$data_evento,3); 
$dia = $trozos[0];
$mes = $trozos[1];
$ano = $trozos[2];
 
//si el mes es el mismo pero el día inferior aun no ha cumplido años, le quitaremos un año al actual
 
if (($mesnaz == $mes) && ($dianaz > $dia)) {
$ano=($ano-1); }
 
//si el mes es superior al actual tampoco habrá cumplido años, por eso le quitamos un año al actual
 
if ($mesnaz > $mes) {
$ano=($ano-1);}

//ya no habría mas condiciones, ahora simplemente restamos los años y mostramos el resultado como // su edad
 
$idade=($ano-$anonaz);
 
$dni = $_POST['dni'];
if ($dni!=""){
	if (!es_DNI_NIE_valido ($dni)) 
		$vale .= "<li>Escriba o seu DNI/NIE correctamente.</li>";
}else{ // else do if de dni!= " "
	if ($idade >= 18) 
		$vale.="<li> Debe introducir un DNI/NIE, por ser maior de idade no dia da proba.</li>";
} // fin do if de dni!= " "
} // fin do if de checkdate
} // fin do if de vale==""

// Seccion das categorias.


// calculo de categorias.
	if ($idade>=18 && $idade < 35) $categoria = "Senior";
	if ($idade>= 35 && $idade < 45) $categoria = "Veteran A";
	if ($idade>= 45 && $idade < 55) $categoria = "Veteran B";
	if ($idade>=55 && $idade < 65) $categoria = "Veteran C";
	if ($idade>= 65) $categoria = "Veteran D";

 
if ($categoria == "") $vale = "<li> A sua idade non corresponde con ningunha categoria. Revise o regulamento, e se hai algun erro, poñase en contacto connos.</li>";


// funcion complementarias para validar.
function es_DNI_NIE_valido ($cadena)
{
    //Comprobamos longitud
    if (strlen($cadena) != 9) return false;      
 
    //Posibles valores para la letra final
    $valoresLetra = array(
        0 => 'T', 1 => 'R', 2 => 'W', 3 => 'A', 4 => 'G', 5 => 'M',
        6 => 'Y', 7 => 'F', 8 => 'P', 9 => 'D', 10 => 'X', 11 => 'B',
        12 => 'N', 13 => 'J', 14 => 'Z', 15 => 'S', 16 => 'Q', 17 => 'V',
        18 => 'H', 19 => 'L', 20 => 'C', 21 => 'K',22 => 'E'
    );

    //Comprobar si es un DNI
    if (preg_match('/^[0-9]{8}[A-Z]$/i', $cadena))
    {
        //Comprobar letra
        if (strtoupper($cadena[strlen($cadena) - 1]) !=
            $valoresLetra[((int) substr($cadena, 0, strlen($cadena) - 1)) % 23])
            return false;
 
        //Todo fue bien
        return true;
    }
    //Comprobar si es un NIE
    else if (preg_match('/^[XYZ][0-9]{7}[A-Z]$/i', $cadena))
    {
        //Comprobar letra
        if (strtoupper($cadena[strlen($cadena) - 1]) !=
            $valoresLetra[((int) substr($cadena, 1, strlen($cadena) - 2)) % 23])
            return false;

        //Todo fue bien
        return true;
    }
   
    //Cadena no válida  
    return false;
} // fin da funcion do dni


function comprobar_email($email){
    $mail_correcto = 0;
    //compruebo unas cosas primeras
    if ((strlen($email) >= 6) && (substr_count($email,"@") == 1) && (substr($email,0,1) != "@") && (substr($email,strlen($email)-1,1) != "@")){
       if ((!strstr($email,"'")) && (!strstr($email,"\"")) && (!strstr($email,"\\")) && (!strstr($email,"\$")) && (!strstr($email," "))) {
          //miro si tiene caracter .
          if (substr_count($email,".")>= 1){
             //obtengo la terminacion del dominio
             $term_dom = substr(strrchr ($email, '.'),1);
             //compruebo que la terminación del dominio sea correcta
             if (strlen($term_dom)>1 && strlen($term_dom)<5 && (!strstr($term_dom,"@")) ){
                //compruebo que lo de antes del dominio sea correcto
                $antes_dom = substr($email,0,strlen($email) - strlen($term_dom) - 1);
                $caracter_ult = substr($antes_dom,strlen($antes_dom)-1,1);
                if ($caracter_ult != "@" && $caracter_ult != "."){
                   $mail_correcto = 1;
                }
             }
          }
       }
    }
    if ($mail_correcto)
       return 1;
    else
       return 0;
} // fin da funcion comprobar_email.



?>