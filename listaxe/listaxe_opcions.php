<?php	
// antes comprobamos que o evento existe. Por se alguún hacker fixo das suas.
  if (!isset($_POST['id_evento']))	exit;
$evento = $_POST['id_evento'];
     if ( !is_numeric ($evento )) exit;

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
// cela central de operacions.
?>
<h2> CREAR LISTAXE EN PDF  </h2>
<form name="f1" method="post" action="xerar_pdf.php">
<input type="hidden" name="id" value="<?= $evento?>">
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
<h4> OPCI&Oacute;NS DA LISTAXE </h4>
<div align="left">
<br>Introduza o nome da listaxe &aacute; crear:</b> 
<br>
<input type="text" name="nome" size="30" title="introduza o nome da listaxe" required>
<br> <br>
<b>Ordeado por:</b> <br> <br>
<input type="radio" name="orde" value="apelidos" title="ordeado por apelidos e nome" checked> Apelidos e nome.
<br>
<input type="radio" name="orde" value="nome" title="ordeado por nome e apelidos"> Nome e apelidos.
<br>
<input type="radio" name="orde" value="dorsal" title="ordeado por dorsal"> Dorsal.

<br> <br> <br> 
<input type="submit" value="Crear PDF" name="xerar">
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input type="reset" value="Borrar datos">
</tr>
</table>
</form>

<?
// pecho a taboa cos datos do evento que abro arriba de todo.
echo "
</td></tr>
	</table>
";
?>