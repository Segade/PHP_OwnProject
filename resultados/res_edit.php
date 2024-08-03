<?

if (!isset ($_POST['modifica']) ) {

if (isset ($_POST['rdid']) ) {
	$id=$_POST['rdid'];

 //Sentencia sql  
				$registro=mysql_query("SELECT * FROM resultados WHERE id=$id",$enlace);

if($fia=mysql_fetch_array($registro)){
$data=MySQLDateToDate($fia["data"]);

?>
<form name="f1" method="post" action="<?= $_SERVER['PHP_SELF'] ?>?corpo=operares&opera=modif" onsubmit="return val_form(this)">
<table cellspacing="2" cellpadding="2">
<tr>
	<td> ID </td> <td> <input type="text" name="id" value="<? echo $fia['id']; ?>" title="identificador do resultado" readonly="readonly"> </td>
	<td> Data </td> <td> <input type="text" name="data" value="<? echo $data; ?>"title="data do resultado"> </td>
</tr>
<tr>
	<td> Carreira </td> <td colspan="3"> <input type="text" name="carreira" size="50" value="<? echo $fia['carreira']; ?>" title="nome da carreira" > </td>
</tr>
<tr>
	<td> Ligazon </td> <td colspan="3"> <input type="text" name="ligazon" size="100" title="ligazon" value="<? echo $fia['ligazon']; ?>"> </td>
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
	$carreira=$_POST['carreira'];
	$fecha=$_POST['data'];
	$data=DateToQuotedMySQLDate($fecha);
$ligazon = nl2br($_POST['ligazon']);



		mysql_query("UPDATE resultados SET carreira='$carreira',ligazon='$ligazon',data=$data WHERE id=$id",$enlace);
?>
<!-- Muestro la noticia completa (titulo, imagen, contenido, etc -->
<p> <h2> O resultado foi modificado con exito </h2> </p>
<table cellpadding=3>
	<tr><td> <font size=+1> <? echo "$fecha"; ?> </font> </td>
	<td> <font size=+3> <? echo "$carreira </font> <br> <font size=+1><i> $subtitulo </i></font> </td></tr>"; ?>
	<tr><td>&nbsp;</td><td> <br> <p> <? echo $ligazon; ?> </p>
	</td></tr>
	</table>


<?
} // fin do if do isset de modifica
?>