<?php	

if (!isset ($_POST['enviar']) ) 
include("../novas/nova_form.htm");
else{

	$titulo=$_POST['titulo'];
	$fecha=$_POST['data'];
$contido = nl2br($_POST['contido']);
if (isset ($_POST['publicar']) ){	 $publi = 1; $publica="Si";}
	else{ $publi = 0; $publica="Non";}


	$data=DateToQuotedMySQLDate($fecha);


mysql_query("insert into noticias (titulo,data,contido,publi) values ('$titulo',$data,'$contido', $publi)",$enlace);

?>
<h3>Gracias</h3>
<p> <h3> A noticia foi publicada con exito </h3> </p>

<table cellpadding=3>
	<tr><td> <font size=+1> <? echo "$fecha"; ?> </font> </td>
	<td> <font size=+3> <? echo "$titulo </font> <br> <font size=+1><i> $subtitulo </i></font> </td></tr>"; ?>
	<tr><td valign="top"> Publicar <br> <?=$publica ?> </td><td> <br> <p> <? echo"$contido"; ?> </p>
	</td></tr>
	</table>
<div align="center">
<?
$rs = mysql_query("SELECT MAX(id) FROM noticias", $enlace);
$id = mysql_fetch_row($rs);
?>
<form name="f1" method="post" action="<?= $_SERVER['PHP_SELF'] ?>?corpo=operanova&opera=modif" >
<input type="hidden" name="rdid" value="<?= $id[0] ?>">
<input type="submit" value="Modificar datos">
</form></div>

<?
} // fin do if isset de enviar
?>