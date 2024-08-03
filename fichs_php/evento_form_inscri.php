
<?


if (!isset($_GET['id'])){
	echo"<h3> Erro, non existe ID </h3>";
}else{
 //Busco en la tabla eventos la que corresponda al id de la selección
$id = $_GET['id'];
    if ( !is_numeric ($id )) $id = 0;

$sql="SELECT * FROM eventos WHERE id_evento=$id AND publi=1";

$res=mysql_query($sql,$enlace);
if (!$registro=mysql_fetch_array($res))
 { echo "<H4> NON EXISTE ESTE EVENTO </H4>";
}else{ // se existe o evento procedo a amosa-lo formulario.
$id=$registro["id_evento"];
$nome=$registro["nome_evento"];
$subnome=$registro["subnome"];
$data=MySQLDateToDate($registro["data"]);
$trozos=explode("/",$data,3); 
$hora=$registro["hora"];

$dir=$registro["dir"];

//  Capa onde amoso todolos datos do evento.
echo "
<article>
<table cellpadding=3>
	<tr><td bgcolor=#ff6666> <font size=+3 weight=bold>$data</font> </td>
	<td bgcolor=#ff6666> <font size=+3 weight=bold> $nome </font> <br> <font size=+1><i> $subnome </i></font> </td></tr>
	<tr><td>&nbsp;</td><td> <br>
";

// comprobo que a inscricion esta aberta para amosa-lo forumlario.
$resultado = mysql_query(" select count(*) from inscritos where evento='$id'",$enlace);
$contados = mysql_result($resultado,0); 

if (!inscricion_aberta($registro["inscri_inicio"],$registro["inscri_fin"],$registro["limite"],$contados)){
?>
<h3> INSCRICI&Oacute;N PECHADA </h3>
<p align="left"> A inscrici&oacute;n para este evento est&aacute; pechada.
</p>
<?
}else{ 
// configuro as variables sesions, para evitar spam
            $session_name = 'sec_session_id'; //Configura un nombre de sesión personalizado
                            $secure = false; //Configura en verdadero (true) si utilizas https
                            $httponly = true; //Esto detiene que javascript sea capaz de accesar la identificación de la sesión.
//                            ini_set('session.use_only_cookies', 1); //Forza a las sesiones a sólo utilizar cookies.
//                            $cookieParams = session_get_cookie_params(); //Obtén params de cookies actuales.
  //                          session_set_cookie_params($cookieParams["lifetime"], $cookieParams["path"], $cookieParams["domain"], $secure, $httponly);
                            session_name($session_name); //Configura el nombre de sesión a el configurado arriba.
                            session_start(); //Inicia la sesión php
                            session_regenerate_id(true); //Regenera la sesión, borra la previa.
                    $user_browser = $_SERVER['HTTP_USER_AGENT']; //Obtén el agente de usuario del usuario
                    $_SESSION['form_string'] = hash('sha512', $user_browser);
                    $_SESSION['valida'] = "Validado";
                    $_SESSION['id_evento'] = $id;

// a inscricion esta aberta polo que amoso o formulario.
if ($dir=="")
	$dir = "../fichs_php/evento_formulario.php";
else
	$dir = "../evento_config/$dir/evento_formulario.php";
include ($dir);
		} // fin do if inscricion_aberta.
?>

	</td></tr>	</table> 
</article>
<!-- fin da taboa da capa de datos. -->
<?
	}// fin do if se hai evento
} // fin do if, se existe ID
?>

<br><br>
<p align=center> [ <a href="javascript:history.go(-1)">Volver Atr&aacute;s</a> ]  </p>

<script language="javascript">
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


</script>