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

echo "
<table cellpadding=3 width=100%>
	<tr><td bgcolor=#ff6666> <font size=+3 weight=bold>$data_evento</font> </td>
	<td bgcolor=#ff6666> <font size=+3 weight=bold> $nome_evento </font> <br> <font size=+1><i> $subnome </i></font> </td></tr>
	<tr><td>&nbsp;</td><td> <br>
";


if (isset($_POST['adxudica']) || isset($_POST['borrar'])) {
?>
<table border=2"" cellpadding="5">
<tr> <th> DORSAL </th> <th> APELIDOS E NOME </th> <th> CLUB </th> <th> CATEGORIA </th></tr>
<?
// creamo-la sintaxe SQL das categorias.
if (isset($_POST['categoria'])){
$categoria = $_POST['categoria'];
$categorias = "AND (categoria='---'";
$y = count($categoria);
for ($x=0;$x<$y;$x++) {
	$categorias .=" OR categoria='$categoria[$x]'";
} // fin do for de revision das categorias.
$categorias .= ")";
} // fin do if se se enviaron as categorias.

// creamo-la sintaxe do ORDER BY do SQL.
$orderby = "ORDER BY ";
if (isset($_POST['grupo']))$orderby .= $_POST['grupo'] . ", ";
	if (isset($_POST['sexo'])) $orderby .= "sexo, ";
if (isset($_POST['orde'])){
	switch ($_POST['orde']){
		case "apelidos": $orderby .= "apelidos, nome";
		break;
		case "nome": $orderby .= "nome, apelidos";
		break;
		case "rexistro": $orderby .= "rexistro";
		break;
		default : $orderby .= "";
	} // fin do switch.
} // fin do if se seleccionou a opcion de ordeado por.

// comprobei as opcions seleccionadas, procedo a acxudicación.

$sql = "SELECT * FROM inscritos WHERE evento=$evento $categorias $orderby";
$res=mysql_query($sql,$enlace);
if (isset($_POST['inicio'])) $inicio=$_POST['inicio']; else $inicio=1;
 while($fia = mysql_fetch_array($res)){
$nome= $fia['nome'];;
$apelidos= $fia['apelidos'];;
$club= $fia['club'];;
$categoria= $fia['categoria'];;
$dni= $fia['dni'];;
// se seleccionou borrado de dorsal, poñoos todos a 0.
IF (isset($_POST['borrar'])) $inicio = "0";

	echo "<tr> <td> $inicio </td> <td> $apelidos, $nome </td> <td> $club </td> <td> $categoria </td> </tr>
";
	if (!mysql_query("UPDATE inscritos SET dorsal='$inicio' WHERE dni='$dni' AND evento=$evento", $enlace)) echo"<tr> <td colspan=\"4\"> <font color=\"red\"> Fallo na adxudicacion do dorsal para $nome $apelidos </font> </td> </tr>";
$inicio++;
}  // fin do while 

?>
</table>
<?
}else { // else do if do isset de adxudicar.
?>
<h3> Adxudicaci&oacute;n do n&uacute;mero de dorsal </h3>
<form name="f1" method="post" action="<?= $_SERVER['PHP_SELF'] ?>?corpo=dorsais">
<input type="hidden" name="adxudicar">
<input type="hidden" name="id_evento" value="<?= $evento ?>">

<table cellpadding="5" border="2">
<tr>
<td valign="top">
<h4> Categor&iacute;as </h4>
<div align="left">
<?
$sql = "SELECT DISTINCT categoria FROM inscritos WHERE evento=$evento ORDER BY categoria";
$res=mysql_query($sql,$enlace);
ECHO "<UL>";
 while($fia = mysql_fetch_array($res)){

$categ= $fia['categoria'];
ECHO "<LI> <input type=\"checkbox\" name=\"categoria[]\" value=\"$categ\" title=\"$categ\"> $categ </LI>";

}// fin do while.
ECHO "</UL>";
?> 
</div>
</td>
<td valign="top">
<h4> Opci&oacute;ns de adxudicaci&oacute;n </h4>
<div align="left">
<br>N&ordm; de inicio:</b> <input type="tel" name="inicio" size="7" title="numero de inicio" required>
<br> <br>
<b>Ordeado por:</b> <br> <br>
<input type="radio" name="orde" value="apelidos" title="ordeado por apelidos e nome" checked> Apelidos e nome.
<br>
<input type="radio" name="orde" value="nome" title="ordeado por nome e apelidos"> Nome e apelidos.
<br>
<input type="radio" name="orde" value="rexistro" title="ordeado por rexistro"> Rexistro.
<br> <br>
<b>Agrupado por:</b>
<br> <br>
<input type="radio" name="grupo" value="categoria" title="agrupado por categoria">  Categor&iacute;a.
<br>
<input type="radio" name="grupo" value="club" value="club" title="agrupado polo club"> Club.
<br> <br>
<input type="checkbox" name="sexo" value="sexo" title="agrupar por sexo"> sexo.
<br> <br> <br> 
<input type="submit" value="Adxudicar dorsais" name="adxudica">
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input type="submit" value="Borrar dorsais" name="borrar">
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input type="reset" value="Resetear datos" name="borrar">

</tr>
</table>
</form>
<?
} //fin do if de adxudicar.

// pecho a taboa cos datos do evento que abro arriba de todo.
echo "
</td></tr>
	</table>
";
?>