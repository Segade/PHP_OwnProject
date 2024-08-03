<?php	

if (!isset ($_POST['enviar']) ) 
include("../res_eventos/res_form.htm");
else{

	$evento=$_POST['evento'];
	$fecha=$_POST['data'];
if (isset ($_POST['publi']) )  $publi = 1;
else $publi = 0;
	$competicion = $_POST['competicion'];
	$ligazon=$_POST['ligazon'];
$cantos = count($competicion);

	$data=DateToQuotedMySQLDate($fecha);


mysql_query("insert into res_eventos (res_nome, res_data, publi) values ('$evento' ,$data, $publi)",$enlace);
$rs = mysql_query("SELECT MAX(id_res)  FROM res_eventos", $enlace);
if ($row = mysql_fetch_row($rs)) 
	$id = trim($row[0]);

if ($publi == 1) $publi = "Si";
Else $publi = "Non";
?>
<p> <h2> O evento do resultado foi engadido con &eacute;xito </h2> </p>

<table cellpadding=3>
	<tr><td> <font size=+1> <?= $fecha?> </font> </td>
	<td> <font size=+3> <?= $evento ?> </font> <br> <br>
<b>P&uacute;blico: </b> <?= $publi ?>
 </td></tr>
<tr> <td> &nbsp; </td> <td> <b>Ligaz&oacute;ns: </b> <br><br>
<?
	for ($i=0;$i<$cantos;$i++){
// procedo o insert na taboa de resultado 
if (mysql_query("insert into result (evento_res, competicion, ligazon) values ($id, '$competicion[$i]', '$ligazon[$i]')",$enlace)) {
echo " <div align=left>
<b>Competici&oacute;n:</b> $competicion[$i]    <b>ligaz&oacute;n:</b>   $ligazon[$i] <br>
</div>
";

			} // fin do if do insert.
} // fin do for que conta o numero de competicions 
echo "<div align=right> $cantos ligaz&oacute;ns engadidas.</div>";
?>
</td> </tr>
	</table>
<?
} // fin do if isset de enviar
?>