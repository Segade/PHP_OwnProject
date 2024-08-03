<?php	

if (!isset ($_POST['enviar']) ) 
include("fichs_php/novas.php");
else{ // se xa enviache-lo formulario, procedemos da-la alta.
// antes comprobamos que o evento existe. Por se alguún hacker fixo das suas.
$id = $_POST['idevento'];
if ( !is_numeric ($id )) $id = 0;
$sql="SELECT * FROM eventos WHERE id_evento=$id";
$res=mysql_query($sql,$enlace);
$registro=mysql_fetch_array($res);
$nome_evento = $registro["nome_evento"];
$subnome=$registro["subnome"];
$data_evento =MySQLDateToDate($registro["data"]);
$dir=$registro["aux1"];
$codigo=$registro["aux2"];


echo "
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

if ($dir=="")
	$dir = "fichs_php/validacions.php";
else
	$dir = "evento_config/$dir/validacions.php";
include ($dir);
// $vale devolve unha cadea se hai fallos na validacion no servidor. Se non, ven valdeira.
if ($vale != ""){
echo "
<h3>Erro:</h3>
<p>Corrixa os datos que introduciu incorrectamente.</p>
<ul>$vale</ul>
<p align=center> [ <a href=\"javascript:history.go(-1)\">Volver Atr&aacute;s</a> ]  </p>
";
}else { // else do if de vale))@@
// $vale esta valdeiro polo que a validacion pasou sen erros.
// Antes procedo a xeracion do codigo da inscricion.
// hai 2 insert, 1 pros que te;en 
if ($dni!=""){
// comprobo que non hai ninguen inscrito o evento co mesmo DNI.
$res =mysql_query("SELECT * FROM inscritos WHERE (evento=$id) AND (dni='$dni')");
if (($registro=mysql_fetch_array($res))) {
	echo " <h3> Erro:</h3>
<p>
Xa hai unha persoa inscrita a este evento co DNI/NIE: $dni. Revise a listaxe de inscritos para comprobar se xa est&aacute; rexistrado. De haber alg&uacute;n problema, p&oacute;&ntilde;ase en contacto con nos.
</p>
	";
}else{ // non hai ninguen inscrito con ese dni.
// procedo o insert na taboa de inscritos.

$data = "$ano-$mes-$dia";
$url=$_SERVER['PHP_SELF'];

// realizo o insert dos datos da persoa.
if (!mysql_query("insert into inscritos (nome, apelidos, dni, sexo, correo, mobil, nacemento, provincia, localidade, categoria, licencia, club, evento, enderezo, postal) values ('$nome', '$apelidos', '$dni', '$sexo', '$correo', '$mobil', '$data', '$provincia', '$localidade', '$categoria', '$licencia', '$club', '$id', '$enderezo', '$postal')",$enlace)) {
echo "
<h3> erro: </h3> 
<p align=left>
Houbo un erro interno no proceso de inscrici&oacute;n. Por favor, int&eacute;nteo de novo m&acute;is tarde. Gracias.
</p>
";
}else { // o insert realizouse con exito, saco a mensaxe de exito o usuario.
echo "
<h2 align=center>Gracias</h2>
<h4 align=center> Inscrici&oacute;n finalizada correctamente. </h4> 
<p align=left>
$nome $apelidos, inscrib&iacute;cheste corr&eacute;ctamente no evento: $nome_evento, na categor&iacute;a $categoria. Comproba que a t&uacute;a inscrici&oacute;n est&aacute; ben na listaxe de inscritos. Se non apareces, ponte en contacto con nos para resolve-la situaci&oacute;n.
</p>
<div> <b>
<a href=$url?corpo=listains&id=$id>&lt; Listaxe de Inscritos &gt;</a>
</b> </div>
";
include ("fichs_php/enviarcorreo.php");
			} // fin do if do insert.
		} // fin do if se hai alguen xa inscrito.
}else{ // else do if DNI = " "
// procedo o insert na taboa de inscritos.

$data = "$ano-$mes-$dia";
$url=$_SERVER['PHP_SELF'];

// realizo o insert dos datos da persoa.
if (!mysql_query("insert into inscritos (nome, apelidos, dni, sexo, correo, mobil, nacemento, provincia, localidade, categoria, licencia, club, evento, enderezo, postal) values ('$nome', '$apelidos', '$dni', '$sexo', '$correo', '$mobil', '$data', '$provincia', '$localidade', '$categoria', '$licencia', '$club', '$id', '$enderezo', '$postal')",$enlace)) {
echo "
<h3> erro: </h3> 
<p align=left>
Houbo un erro interno no proceso de inscrici&oacute;n. Por favor, int&eacute;nteo de novo m&acute;is tarde. Gracias.
</p>
";
}else { // o insert realizouse con exito, saco a mensaxe de exito o usuario.
echo "
<h2 align=center>Gracias</h2>
<h4 align=center> Inscrici&oacute;n finalizada correctamente. </h4> 
<p align=left>
$nome $apelidos, inscrib&iacute;cheste corr&eacute;ctamente no evento: $nome_evento, na categor&iacute;a $categoria. Comproba que a t&uacute;a inscrici&oacute;n est&aacute; ben na listaxe de inscritos. Se non apareces, ponte en contacto con nos para resolve-la situaci&oacute;n.
</p>
<div> <b>
<a href=$url?corpo=listains&id=$id>&lt; Listaxe de Inscritos &gt;</a>
</b> </div>
";
include ("fichs_php/enviarcorreo.php");
			} // fin do if do insert.
} // fin do if DNI == " "
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