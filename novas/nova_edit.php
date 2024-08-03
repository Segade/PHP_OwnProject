<?

if (!isset ($_POST['modifica']) ) {

if (isset ($_POST['rdid']) ) {
	$id=$_POST['rdid'];

 //Sentencia sql  
				$registro=mysql_query("SELECT * FROM noticias WHERE id=$id",$enlace);

if($fia=mysql_fetch_array($registro)){
$data=MySQLDateToDate($fia["data"]);
$contido=str_replace("<br />", "", $fia['contido']);
?>
<form name="f1" method="post" action="<?= $_SERVER['PHP_SELF'] ?>?corpo=operanova&opera=modif" onsubmit="return val_form_nova(this)">
<table cellspacing="2" cellpadding="2">
<tr>
	<td> ID </td> <td> <input type="text" name="id" value="<? echo $fia['id']; ?>" title="identificador da nova" readonly="readonly"> </td>
	<td> Data </td> <td> <input type="text" name="data" value="<? echo $data; ?>"title="data da nova"> </td>
</tr>
<tr>
	<td> T&iacute;tulo </td> <td colspan="3"> <input type="text" name="titulo" size="50" value="<? echo $fia['titulo']; ?>" title="titulo da nova" autofocus > </td>
</tr>

<tr>
	<td>Publicar:</td> <td> <input type="checkbox" name="publicar" title="publicar evento" value="si" <? if ($fia['publi']==1) echo "checked";?>
></td>
</tr>

<tr>
	<td valign="top"> Contido </td> <td colspan="3"> <textarea name=contido title=contido cols=40 rows=10><? echo $contido ; ?> </textarea></td>
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
	$titulo=$_POST['titulo'];
	$fecha=$_POST['data'];
	$data=DateToQuotedMySQLDate($fecha);
$contido = nl2br($_POST['contido']);
//$contenido=nl2br($_POST['contido']);
//$contido=utf8_decode($contenido);
if (isset ($_POST['publicar']) ){	 $publi = 1; $publica="Si";}
	else{ $publi = 0; $publica="Non";}

		mysql_query("UPDATE noticias SET titulo='$titulo',contido='$contido',data=$data,publi=$publi WHERE id=$id",$enlace);
?>
<!-- Muestro la noticia completa (titulo, imagen, contenido, etc -->
<p> <h3> A noticia foi modificada con exito </h3> </p>
<table cellpadding=3>
	<tr><td> <font size=+1> <? echo "$fecha"; ?> </font> </td>
	<td> <font size=+3> <? echo "$titulo </font> <br> <font size=+1><i> $subtitulo </i></font> </td></tr>"; ?>
	<tr><td valign="top"> Publicar <br> <?= $publica ?> </td><td> <br> <p> <? echo $contido; ?> </p>
	</td></tr>
	</table>
<div align="center">
<form name="f1" method="post" action="<?= $_SERVER['PHP_SELF'] ?>?corpo=operanova&opera=modif" >
<input type="hidden" name="rdid" value="<?= $id ?>">
<input type="submit" value="Modificar datos">
</form></div>

<?
} // fin do if do isset de modifica
?>