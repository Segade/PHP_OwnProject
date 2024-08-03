<?php	
// antes comprobamos que o evento existe. Por se alguún hacker fixo das suas.
$evento = $_POST['id_evento'];
if ( !is_numeric ($evento)) $evento = 0;
$sql="SELECT * FROM eventos WHERE id_evento=$evento";
$res=mysql_query($sql,$enlace);
$registro=mysql_fetch_array($res);
$nome_evento = $registro["nome_evento"];
$subnome=$registro["subnome"];
$data_evento =MySQLDateToDate($registro["data"]);
$codigo=$registro["evento_cod"];
echo "
<table cellpadding=3 width=100%>
	<tr><td bgcolor=#ff6666> <font size=+3 weight=bold>$data_evento</font> </td>
	<td bgcolor=#ff6666> <font size=+3 weight=bold> $nome_evento </font> <br> <font size=+1><i> $subnome </i></font> </td></tr>
	<tr><td>&nbsp;</td><td> <br>
";

if (!isset ($_POST['enviar']) ) 
include("../inscricions/inscri_form.php");
else{ // se xa enviache-lo formulario, procedemos da-la alta.

$nome = htmlentities($_POST['nome'], ENT_QUOTES, "utf-8");
	$apelidos = htmlentities($_POST['apelidos'], ENT_QUOTES, "utf-8");
	$dni=$_POST['dni'];
	$sexo=$_POST['sexo'];
	$correo=$_POST['correo'];
$correo2 = $_POST['correo2'];
	$mobil=$_POST['mobil'];
	$dia=$_POST['dia'];
	$mes=$_POST['mes'];
	$ano=$_POST['ano'];
	$enderezo=htmlentities($_POST['enderezo'], ENT_QUOTES, "utf-8");
	$postal=mysql_real_escape_string($_POST['postal']);
	$provincia=htmlentities($_POST['provincia'], ENT_QUOTES, "utf-8");
	$localidade=htmlentities($_POST['localidade'], ENT_QUOTES, "utf-8");
	$categoria="---";
	$licencia=mysql_real_escape_string($_POST['licencia']);
	$club=htmlentities($_POST['club'], ENT_QUOTES, "utf-8");
// procedo o insert na taboa de inscritos.

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

$data = "$ano-$mes-$dia";
$url=$_SERVER['PHP_SELF'];

// realizo o insert dos datos da persoa.
if (!mysql_query("insert into inscritos (nome, apelidos, dni, sexo, correo, mobil, nacemento, provincia, localidade, categoria, licencia, club, evento, enderezo, postal, id_inscri, rexistro) values ('$nome', '$apelidos', '$dni', '$sexo', '$correo', '$mobil', '$data', '$provincia', '$localidade', '$categoria', '$licencia', '$club', '$evento', '$enderezo', '$postal', '$codigo', '$rexistro')",$enlace)) {
echo "
<h3> erro: </h3> 
<p align=left>
Houbo un erro interno no proceso de inscrici&oacute;n. Por favor, int&eacute;nteo de novo m&acute;is tarde. Gracias.
</p>
";
}else { // o insert realizouse con exito, saco a mensaxe de exito o usuario.
echo "
<h3 align=center>Gracias</h3>
<h4 align=center> Inscrici&oacute;n finalizada correctamente. </h4> 
<p align=left>
$nome $apelidos, inscrib&iacute;cheste corr&eacute;ctamente no evento: $nome_evento. Comproba que a t&uacute;a inscrici&oacute;n est&aacute; ben na listaxe de inscritos. Se non apareces, ponte en contacto con nos para resolve-la situaci&oacute;n.
</p>
<div> <b>
<a href=$url?corpo=listains&id=$evento>&lt; Listaxe de Inscritos &gt;</a>
</b> </div>
";

			} // fin do if do insert.

} // fin do if isset de enviar

// pecho a taboa cos datos do evento que abro arriba de todo.
echo "
</td></tr>
	</table>
";


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