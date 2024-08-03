<?

$vale = "";

// recollo os datos do formulario.
// mysql_real_escape_string()
	$nome=mysql_real_escape_string($_POST['nome']);
	$apelidos=mysql_real_escape_string($_POST['apelidos']);
	$dni=$_POST['dni'];
	$sexo=$_POST['sexo'];
	$correo=$_POST['correo'];
$correo2 = $_POST['correo2'];
	$mobil=$_POST['mobil'];
	$dia=$_POST['dia'];
	$mes=$_POST['mes'];
	$ano=$_POST['ano'];
	$enderezo=mysql_real_escape_string($_POST['enderezo']);
	$postal=mysql_real_escape_string($_POST['postal']);
	$provincia=mysql_real_escape_string($_POST['provincia']);
	$localidade=mysql_real_escape_string($_POST['localidade']);
	$categoria=$_POST['categoria'];
	$licencia=mysql_real_escape_string($_POST['licencia']);
if (isset ($_POST['acepto']) ) 	$acepto=mysql_real_escape_string($_POST['acepto']);
else $acepto = "Non";
	$club=mysql_real_escape_string($_POST['club']);





if ($nome=="" || is_numeric ($nome) || strlen($nome)<3)
	$vale = "<li> Escriba o seu nome correctamente.</li>";

if ($apelidos=="" || is_numeric ($apelidos) || strlen($apelidos)<3)
	$vale .= "<li> Escriba os seus apelidos correctamente.</li>";

if (!es_DNI_NIE_valido($dni)) 
	$vale .= "<li>Escriba o seu DNI/NIE correctamente.</li>";

if ($sexo == "0")
	$vale .= "<li>Seleccione o seu sexo.</li>";


if (!is_numeric($dia) || !is_numeric($mes) || !is_numeric($ano))
	$vale .= "<li>Seleccione a sua data correctamente.</li>";	
else {
If (!checkdate ($mes,$dia,$ano))
	$vale .= "<li>Seleccione a sua data correctamente.</li>";
}

// if (filter_var(trim($correo), FILTER_SANITIZE_EMAIL))
// if (filter_var($correo, FILTER_VALIDATE_EMAIL))
if(comprobar_email($correo)==0)
	$vale .="<li>Escriba o seu E-mail correctamente.</li>";

if ($correo!=$correo2)
	$vale .="<li>Repita o seu E-mail.</li>";

if (strlen($mobil) != 9 || !is_numeric ($mobil))
	$vale .= "Escriba o seu numero de mobil correctamente.</li>";

if ($enderezo=="" || is_numeric ($enderezo) || strlen($enderezo)<3)
	$vale .= "<li> Escriba o seu enderezo correctamente.</li>";

if (is_numeric ($postal)){
	if ($postal < 1001 || $postal > 52999 || strlen($postal) !=5)
		$vale .= "<li>Escriba o seu codigo postal correctamente.</li>";
}else 
	$vale .= "<li>Escriba o seu codigo postal correctamente.</li>";

if ($provincia=="0")
	$vale .= "Seleccione a sua provincia.</li>";

if ($localidade=="" || is_numeric ($localidade) || strlen($localidade)<3)
	$vale .= "<li> Escriba a sua localidade correctamente.</li>";

if ($acepto=="Non")
	$vale .= "Compre que acepte o regulamento para continuar ca inscricion.</li>";



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
}


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
}




?>