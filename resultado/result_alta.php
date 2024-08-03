<?php	
// antes comprobamos que o evento existe. Por se alguún hacker fixo das suas.
$evento = $_POST['id_evento'];
if ( !is_numeric ($evento)) $evento = 0;
$sql="SELECT * FROM res_eventos WHERE id_res=$evento";
$res=mysql_query($sql,$enlace);
$registro=mysql_fetch_array($res);
$nome_evento = $registro["res_nome"];
$data_evento =MySQLDateToDate($registro["res_data"]);

echo "
<table cellpadding=3 width=100%>
	<tr><td bgcolor=#ff6666> <font size=+3 weight=bold>$data_evento</font> </td>	<td bgcolor=#ff6666> <font size=+3 weight=bold> $nome_evento </font> </td></tr>
	<tr><td>&nbsp;</td><td> <br>
";

if (!isset ($_POST['enviar']) ) 
include("../resultado/result_form.php");
else{ // se xa enviache-lo formulario, procedemos da-la alta.

	$competicion = $_POST['competicion'];
	$evento = $_POST['id_evento'];
	$ligazon=$_POST['ligazon'];
$url=$_SERVER['PHP_SELF'];
// conto o numero de ligazons que se enviaron
$cantos = count($competicion);
	for ($i=0;$i<$cantos;$i++){
// procedo o insert na taboa de resultado 

if (!mysql_query("insert into result (evento_res, competicion, ligazon) values ($evento, '$competicion[$i]', '$ligazon[$i]')",$enlace)) {
echo "
<h3> erro: </h3> 
<p align=left>
Houbo un erro interno no proceso de inscrici&oacute;n. Por favor, int&eacute;nteo de novo m&acute;is tarde. Gracias.
</p>
";
}else { // o insert realizouse con exito, saco a mensaxe de exito o usuario.
echo " <div align=left>
<b>Competici&oacute;n:</b> $competicion[$i]    <b>ligaz&oacute;n:</b>   $ligazon[$i] <br>
</div>
";

			} // fin do if do insert.
} // fin do for que conta o numero de competicions 
echo "<div align=right> $cantos ligaz&oacute;ns engadidas.</div>";
} // fin do if isset de enviar

// pecho a taboa cos datos do evento que abro arriba de todo.
echo "
</td></tr>
	</table>
";
?>