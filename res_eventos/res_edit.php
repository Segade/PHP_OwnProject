<?

if (!isset ($_POST['modifica']) ) {

if (isset ($_POST['rdid']) ) {
	$id=$_POST['rdid'];

 //Sentencia sql  
				$registro=mysql_query("SELECT * FROM res_eventos WHERE id_res=$id",$enlace);

if($fia=mysql_fetch_array($registro)){
$data=MySQLDateToDate($fia["res_data"]);
$publi = $fia['publi'];
?>
<form name="f1" method="post" action="<?= $_SERVER['PHP_SELF'] ?>?corpo=operaresev&opera=modif" onsubmit="return val_form_res_even()>
<table cellspacing="2" cellpadding="2">
<tr>
	<td> ID </td> <td> <input type="text" name="id" value="<?= $fia['id_res'] ?>" title="identificador do resultado" readonly="readonly" size="5"> </td>
	<td> Data: </td> <td> <input type="text" name="data" value="<?= $data ?>"title="data do resultado" required> </td>
</tr>
<tr>
<td>P&uacute;blico:</td> <td> <input type="checkbox" name="publi" value="si" title="publicar" <? if ($publi==1) echo "checked"; ?>> </td>
	<td> Evento: </td> <td> <input type="text" name="evento"  value="<?= $fia['res_nome'] ?>" title="nome do evento" required> </td>
</tr>
</table>
<div> <input type="submit" value="Modificar" name="modifica"> </div>
</form>
<?
} // fin do if fia=registro
}else{ // else do if de isset de rdid
	echo "<h2> Erro ca URL </h2>
<p align=center> [ <a href=\"javascript:history.go(-1)\">Volver Atr&aacutee;s</a> ]  </p>
";

}

}else{ //else do if do isset de post modifica

	$id=$_POST['id'];
	$evento=$_POST['evento'];
	$fecha=$_POST['data'];
	$data=DateToQuotedMySQLDate($fecha);
if (isset ($_POST['publi']) )  $publi = 1;
else $publi = 0;

		mysql_query("UPDATE res_eventos SET res_nome='$evento', res_data=$data, publi=$publi WHERE id_res=$id",$enlace);
if ($publi == 1) $publi ="Si";
else $publi ="Non";
?>
<p> <h3> O evento do resultado foi modificado con exito </h3> </p>
<table cellpadding=3>
	<tr><td> <font size=+1> <?= $fecha ?> </font> </td>
	<td> <font size=+3> <?= $evento?> </font> </td></tr>
	</table>
<?
echo "<p>P&uacute;blico: $publi </p>";
} // fin do if do isset de modifica
?>