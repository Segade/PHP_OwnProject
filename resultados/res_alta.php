<?php	

if (!isset ($_POST['enviar']) ) 
include("../resultados/res_form.htm");
else{

	$carreira=$_POST['carreira'];
	$fecha=$_POST['data'];
$ligazon = $_POST['ligazon'];


	$data=DateToQuotedMySQLDate($fecha);


mysql_query("insert into resultados (carreira,data,ligazon) values ('$carreira',$data,'$ligazon')",$enlace);

?>
<h4>Gracias</h4>
<p> <h2> O resultado foi engadido con éxito </h2> </p>

<table cellpadding=3>
	<tr><td> <font size=+1> <? echo "$fecha"; ?> </font> </td>
	<td> <font size=+3> <? echo "$carreira </font> <br> <font size=+1><i> $subtitulo </i></font> </td></tr>"; ?>
	<tr><td>&nbsp;</td><td> <br> <p> <? echo"$ligazon"; ?> </p>
	</td></tr>
	</table>
<?
} // fin do if isset de enviar
?>