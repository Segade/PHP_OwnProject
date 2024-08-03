<?
	$evento=$_POST['id_evento'];
if ( !is_numeric ($evento)) $evento = 0;
$sql="SELECT * FROM res_eventos WHERE id_res=$evento";
$res=mysql_query($sql,$enlace);
$registro=mysql_fetch_array($res);
$nome_evento = $registro["res_nome"];
$data_evento =MySQLDateToDate($registro["res_data"]);

echo "
<table cellpadding=3 width=100%>
	<tr><td bgcolor=#ff6666> <font size=+3 weight=bold>$data_evento</font> </td>
	<td bgcolor=#ff6666> <font size=+3 weight=bold> $nome_evento </font> </td></tr>
	<tr><td>&nbsp;</td><td> <br>
";

if (isset ($_POST['codigo']) ) {
	$codigo=$_POST['codigo'];
	$competicion=$_POST['competicion'];
	$ligazon=$_POST['ligazon'];

$cantos = count($codigo);
	for ($i=0;$i<$cantos;$i++){
// sentencia SQL de modificacion dos datos.
		if (mysql_query("UPDATE result SET competicion='$competicion[$i]', ligazon='$ligazon[$i]' WHERE id_result='$codigo[$i]'",$enlace)){
 echo" <div align=left>
<b>Competici&oacute;n:</b> $competicion[$i]   
<b>Ligaz&oacute;n:</b> $ligazon[$i] <br>
";
}else{ // else do if do update 
echo"
<h3>Erro: Non se modificaron os datos.</h3>
<p>Os datos non foron modificados por problemas alleos o administrador desta paxina. Int&eacute;nteo de novo m&aacute;is tarde.</p>
";
} // fin do if que comproba que o update funcionou.
} // fin do for do numero de ligazons 
echo "<div align=right> $cantos ligaz&oacute;ns modificadas.</div>";

} // fin do if do isset de codigo 
// pecho a taboa que abre cos datos do evento de arriba de todo.
echo "
</td></tr>
	</table>
";

?>