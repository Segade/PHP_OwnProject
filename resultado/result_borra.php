<?
if (isset($_POST['non'])){
    header('Location: ./inperator.php');
}else{
if (!isset($_POST['id_evento'])){
echo "
	<h3>Erro: co ID do evento.</h3>
	<p>Houbo un erro ca variable do ID do evento. Por algun motivo, esta variable non foron enviadas. Isto puidose provocar por un mal uso desta paxina web ou por un problema no codigo fonte</p>
";
}else{ // else do if isset de id_evento.
// as variables id_evento foron enviadas, procedo a traballar.
	$evento=$_POST['id_evento'];
if ( !is_numeric ($evento)) $evento = 0;

$sql="SELECT * FROM res_eventos WHERE id_res=$evento";
$res=mysql_query($sql,$enlace);
//  comprobo que o evento existe.
if ($registro=mysql_fetch_array($res)){
$nome_evento = $registro["res_nome"];
$data_evento =MySQLDateToDate($registro["res_data"]);
echo "
<table cellpadding=3 width=100%>
	<tr><td bgcolor=#ff6666> <font size=+3 weight=bold>$data_evento</font> </td>
	<td bgcolor=#ff6666> <font size=+3 weight=bold> $nome_evento </font> </td></tr>
	<tr><td>&nbsp;</td><td> <br>
";

// antes miramos se se enviou o form para amosalo ou face-lo borrado.
if (!isset ($_POST['si'])){
?>
<h3> Comfirmacion do borrado </h3>
<div align="center">
<form name="f1" method="post" action="<?= $_SERVER['PHP_SELF'] ?>?corpo=editresult" >
<input type="hidden" name="id_evento" value="<?= $evento ?>">
<?
if (isset($_POST['borrar_selec'])){
echo "<input type=\"hidden\" name=\"borrar_selec\">
<p> �Esta seguro que desexa realiza-lo borrado dos resultados seleccionados deste evento? </p>
";
$codigo = $_POST["codigo"];
$cantos = count($codigo);
	for ($i=0;$i<$cantos;$i++){
echo "<input type=\"hidden\" name=\"codigo[]\" value=\"$codigo[$i]\">";
} // fin do for de cantos.
}else{ // else do if de isset de borrar_selec 
// se non se premeu borrar_selec e que se premeu borrar_todo 
echo "
<input type=\"hidden\" name=\"borrar_todo\">
<input type=\"hidden\" name=\"codigo[]\" value=\"$codigo[0]\">
<p> �Esta seguro que desexa realiza-lo borrado de toda a xente deste evento? </p>
";
} // fin do if de isset de borrar_selec.
?>
<input type="submit" name="si" value="SI">
&nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 
<input type="submit" name="non" value="NON"> 
</form>
</div>
<?
}else{ // else do if de isset de Si.
// borrado na modalidade de seleccion.
if (isset($_POST['borrar_selec'])){
if (isset($_POST['codigo'])){
// a variable codigo foi enviada.
	$codigo=$_POST['codigo'];
$cantos = count($codigo);

	for ($i=0;$i<$cantos;$i++){
	mysql_query("DELETE FROM result WHERE id_result='$codigo[$i]'",$enlace);
} // fin do for de cantos
echo "<h3>Borrado finalizado:</h3>
	<p>O borrado dos resultados seleccionados finalizou. Comprobe que todolos resultados seleccionados foron borradas na listaxe de inscritos</p>
";
}else{ // else do if de isset de codigo 
	echo "<h3>A variable codigo non foi enviada.</h3>";
} // fin do if de isset de codigo 
} // fin do if de isset de borrar_selec 

// Borrado na modalidade de borrado total.
if (isset($_POST['borrar_todo'])){
		mysql_query("DELETE FROM result WHERE evento_res=$evento",$enlace);
	echo "<h3>O borrado de todolos resultados deste evento finalizou</h3>
	<p>Todolos resultados deste evento foron borrados. Comprobe que a operacion realizouse correctamente na listaxe de resultados. </p>
";
} // fin do if de isset de borrar_todo 
} // fin do if de isset de Si.
echo "
</td></tr>
	</table>
";
}else{ // else do fetch_array
// non existe ningun evento
	echo"
	<h3>Non existe o evento.</h3>
<p>Non existe ningun evento co ID enviado. Comprobe que realizou correctamente esta operaci�n. </p>
";
} // fin do if do fetch_array 
} // fin do if de isset de id_evento.

} // fin do if de isset de non 
?>