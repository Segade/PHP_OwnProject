<?php	

            $session_name = 'sec_session_id'; //Configura un nombre de sesión personalizado
                            $secure = false; //Configura en verdadero (true) si utilizas https
                            $httponly = true; //Esto detiene que javascript sea capaz de accesar la identificación de la sesión.
//                            ini_set('session.use_only_cookies', 1); //Forza a las sesiones a sólo utilizar cookies.
//                            $cookieParams = session_get_cookie_params(); //Obtén params de cookies actuales.
//                            session_set_cookie_params($cookieParams["lifetime"], $cookieParams["path"], $cookieParams["domain"], $secure, $httponly);
                            session_name($session_name); //Configura el nombre de sesión a el configurado arriba.
                            session_start(); //Inicia la sesión php
                            session_regenerate_id(true); //Regenera la sesión, borra la previa.
                    $user_browser = $_SERVER['HTTP_USER_AGENT']; //Obtén el agente de usuario del usuario
            $novo_string = hash('sha512', $user_browser);
    if (!isset($_SESSION['valida'], $_SESSION['form_string']) || $_SESSION['form_string'] != $novo_string || $_SESSION['valida']!= "Validado") {
	header('Location: ./index.php');
	exit ;
    } //  fin do if que comproba as sesions 
    include '../sesions/db_connect.php';
    include '../sesions/functions.php';

if (!isset ($_POST['enviar']) ) 
include("../fichs_php/novas.php");
else{ // se xa enviache-lo formulario, procedemos da-la alta.
// antes comprobamos que o evento existe. Por se alguún hacker fixo das suas.
$id = $_SESSION['id_evento'];
if ( !is_numeric ($id )) $id = 0;
$sql="SELECT * FROM eventos WHERE id_evento=$id";
$res=mysql_query($sql,$enlace);
$registro=mysql_fetch_array($res);
$nome_evento = $registro["nome_evento"];
$subnome=$registro["subnome"];
$data_evento =MySQLDateToDate($registro["data"]);
$dir=$registro["dir"];
$codigo=$registro["evento_cod"];


echo "
<article>
<table cellpadding=3 width=100%>
	<tr><td bgcolor=#ff6666> <font size=+3 weight=bold>$data_evento</font> </td>
	<td bgcolor=#ff6666> <font size=+3 weight=bold> $nome_evento </font> <br> <font size=+1><i> $subnome </i></font> </td></tr>
	<tr><td>&nbsp;</td><td> <br>
";


// comprobo que a inscricion esta aberta para aface/lo insert.
$resultado = mysql_query(" select count(*) from inscritos where evento='$id'",$enlace);
$contados = mysql_result($resultado,0); 

if (!inscricion_aberta($registro["inscri_inicio"],$registro["inscri_fin"],$registro["limite"],$contados)){
?>
<h3> INSCRICI&Oacute;N PECHADA </h3>
 
<p align="left"> A inscrici&oacute;n para este evento est&aacute; pechada.
</p>
<?
}else{ 
// a inscricion esta aberta.

// cargo o ficheiro de validacions personalizado pro evento.
if ($dir=="")
	$dir = "../fichs_php/validacions.php";
else
	$dir = "../evento_config/$dir/validacions.php";
include ($dir);
// $vale devolve unha cadea se hai fallos na validacion no servidor. Se non, ven valdeira.
if ($vale != "")
	$vale ="
<h3>Erro:</h3>
<p>Corrixa os datos que introduciu incorrectamente.</p>
<ul>$vale</ul>
<p align=center> [ <a href=\"javascript:history.go(-1)\">Volver o formulario</a> ]  </p>
";


if ($vale != ""){
	echo $vale;
}else { // else do if de vale==""
// $vale esta valdeiro polo que a validacion pasou sen erros.
// Antes procedo a xeracion do codigo da inscricion.
$dia = date("y") . date("m") . date("d") ;
$repetir = "si";

while ($repetir=="si"){
$xerar=gen_rand_string();
$codigo .= $dia . $xerar;

$sql="SELECT id_inscri FROM inscritos WHERE id_inscri='$codigo'";
$res=mysql_query($sql,$enlace);
if (!$registro=mysql_fetch_array($res)) $repetir = "non";
} // fin do while de repetir == si.
$rexistro = DATE("Y-m-d H:i:s");
$data = $_POST['ano'] . "-" . $_POST['mes'] . "-" . $_POST['dia'];
$nacemento = $_POST['dia'] . "/" . $_POST['mes'] . "/" . $_POST['ano'];
if ($sexo == "M") $sex = "Masculino"; else $sex = "Feminino";
$url=$_SERVER['PHP_SELF'];
$nome = stripslashes($nome);
$apelidos = stripslashes($apelidos);
$club = stripslashes($club);

// hai 2 insert, 1 pros que teñen DNI,
// e o 2 pros menores que non teñen DNI 
if ($dni!=""){
// comprobo que non hai ninguen inscrito o evento co mesmo DNI.
$res =mysql_query("SELECT * FROM inscritos WHERE (evento=$id) AND (dni='$dni')");
if ($registro=mysql_fetch_array($res)) {
	echo " <h3> Erro:</h3>
<p>
Xa hai unha persoa inscrita a este evento co DNI/NIE: $dni. Revise a listaxe de inscritos para comprobar se xa est&aacute; rexistrado. De haber alg&uacute;n problema, p&oacute;&ntilde;ase en contacto con nos.
</p>
	";
}else{ // non hai ninguen inscrito con ese dni.
// procedo o insert na taboa de inscritos.
$sentencia = "INSERT INTO inscritos (nome, apelidos, dni, sexo, correo, mobil, nacemento, provincia, localidade, categoria, licencia, club, evento, enderezo, postal, id_inscri, rexistro) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";

    if ($insert_stmt = $mysqli->prepare($sentencia)) {        
       $insert_stmt->bind_param('ssssssssssssissss', $nome, $apelidos, $dni, $sexo, $correo, $mobil, $data, $provincia, $localidade, $categoria, $licencia, $club, $id, $enderezo, $postal, $codigo, $rexistro);
       //Ejecuta la consulta preparada.
      if ( !$insert_stmt->execute()) echo "Failed level 3.";

echo "
						<h3 class=\"h3__head1\">Inscricion finalizada correctamente</h3>
<p align=left>
Inscrib&iacute;cheste corr&eacute;ctamente na <b>Carreira Popular do Concello de Mes&iacute;a</b> na modalidade de &quot;$nome_evento&quot;. Comproba que os teus datos aparecen corr&eacute;ctamente. Se hai alg&uacute;n erro, ponte en contacto connosc para resolve-lo problema.</p><br>
<table>
<tr><td align=\"left\"><b>Nome:</b></td> <td align=\"left\">$nome</td></tr>
<tr><td align=\"left\"><b>Apelidos:</b></td> <td align=\"left\">$apelidos</td></tr>
<tr><td align=\"left\"><b>DNI/NIE:</b></td> <td align=\"left\">$dni</td></tr>
<tr><td align=\"left\"><b>sexo:</b></td> <td align=\"left\">$sex</td></tr>
<tr><td align=\"left\"><b>Data de nacemento:</b></td> <td align=\"left\">$nacemento</td></tr>
<tr><td align=\"left\"><b>Categor&iacute;a:</b></td> <td align=\"left\">$categoria</td></tr>
<tr><td align=\"left\"><b>E-mail:</b></td> <td align=\"left\">$correo</td></tr>
<tr><td align=\"left\"><b>M&oacute;bil/Tlf:</b></td> <td align=\"left\">$mobil</td></tr>
<tr><td align=\"left\"><b>Provincia:</b></td> <td align=\"left\">$provincia</td></tr>
<tr><td align=\"left\"><b>Localidade:</b></td> <td align=\"left\">$localidade</td></tr>
<tr><td align=\"left\"><b>Club:</b></td> <td align=\"left\">$club</td></tr>
</table>
<p> <b>
<a href=$url?corpo=listains&id=$id>&lt; Listaxe de Inscritos &gt;</a>
</b> </p>
</article>
";
// include ("fichs_php/enviarcorreo.php");
}else{ // else do if de insert 
echo "
<h3> erro: </h3> 
<p align=left>
Houbo un erro interno no proceso de inscrici&oacute;n. Por favor, int&eacute;nteo de novo m&acute;is tarde. Gracias.
</p>
";
			} // fin do if do insert.

		} // fin do if se hai alguen xa inscrito.
}else{ // else do if DNI = " "
// procedo o insert na taboa de inscritos dos menores.
$sentencia = "INSERT INTO inscritos (nome, apelidos, dni, sexo, correo, mobil, nacemento, provincia, localidade, categoria, licencia, club, evento, enderezo, postal, id_inscri, rexistro) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";

    if ($insert_stmt = $mysqli->prepare($sentencia)) {        
       $insert_stmt->bind_param('ssssssssssssissss', $nome, $apelidos, $dni, $sexo, $correo, $mobil, $data, $provincia, $localidade, $categoria, $licencia, $club, $id, $enderezo, $postal, $codigo, $rexistro);

       //Ejecuta la consulta preparada.
       if (!$insert_stmt->execute()) echo "Failed level 3.";

echo "
<article>
						<h3 class=\"h3__head1\">Inscricion finalizada correctamente</h3>
<p align=left>
Inscrib&iacute;cheste corr&eacute;ctamente na <b>Carreira Popular do Concello de Mes&iacute;a</b> na modalidade de &quot;$nome_evento&quot;. Comproba que os teus datos aparecen corr&eacute;ctamente. Se hai alg&uacute;n erro, ponte en contacto connosc para resolve-lo problema.</p><br>
<table>
<tr><td align=\"left\"><b>Nome:</b></td> <td align=\"left\">$nome</td></tr>
<tr><td align=\"left\"><b>Apelidos:</b></td> <td align=\"left\">$apelidos</td></tr>
<tr><td align=\"left\"><b>DNI/NIE:</b></td> <td align=\"left\">$dni</td></tr>
<tr><td align=\"left\"><b>sexo:</b></td> <td align=\"left\">$sex</td></tr>
<tr><td align=\"left\"><b>Data de nacemento:</b></td> <td align=\"left\">$nacemento</td></tr>
<tr><td align=\"left\"><b>Categor&iacute;a:</b></td> <td align=\"left\">$categoria</td></tr>
<tr><td align=\"left\"><b>E-mail:</b></td> <td align=\"left\">$correo</td></tr>
<tr><td align=\"left\"><b>M&oacute;bil/Tlf:</b></td> <td align=\"left\">$mobil</td></tr>
<tr><td align=\"left\"><b>Provincia:</b></td> <td align=\"left\">$provincia</td></tr>
<tr><td align=\"left\"><b>Localidade:</b></td> <td align=\"left\">$localidade</td></tr>
<tr><td align=\"left\"><b>Club:</b></td> <td align=\"left\">$club</td></tr>
</table>
<p> <b>
<a href=$url?corpo=listains&id=$id>&lt; Listaxe de Inscritos &gt;</a>
</b> </p>
</article>
";
// include ("fichs_php/enviarcorreo.php");
}else{ // else do if de insert 
echo "
<h3> erro: </h3> 
<p align=left>
Houbo un erro interno no proceso de inscrici&oacute;n. Por favor, int&eacute;nteo de novo m&acute;is tarde. Gracias.
</p>
";
			} // fin do if do insert.

} // fin do if DNI == " "

// elimino toda a configuracion das variables sesions
    //Desconfigura todos los valores de sesión
    $_SESSION = array();
    //Obtén parámetros de sesión
    $params = session_get_cookie_params();
    //Borra la cookie actual
    setcookie(session_name(), '', time() - 42000, $params["path"], $params["domain"], $params["secure"], $params["httponly"]);
    //Destruye sesión
    session_destroy();
$mysqli->close();
	} // fin do if de validacion de $vale.
} // fin do if se a inscricion esta aberta.
echo "
</td></tr>
	</table>
";
} // fin do if isset de enviar

// funcion xeradora do codigo.

function gen_rand_string()
{
    $chars = array( 'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h',
            'i', 'j', 'k', 'l', 'm', 'n', 'o',
            'p', 'q', 'r', 's', 't', 'u', 'v', 'w',
            'x', 'y', 'z', '1', '2', '3', '4', '5',
            '6', '7', '8', '9', '0');

    $max_chars = count($chars) - 1;

    srand((double) microtime()*1000000);

    $rand_str = '';
    for($i=0; $i < 4; $i++)
    {
        $rand_str = $rand_str . $chars[rand(0, $max_chars)];
    }

    return $rand_str;
} // fin da funcionn gen_rand_string()


?>