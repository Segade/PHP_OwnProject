
<?


if (!isset($_GET['id'])){
	echo"<h2> Erro, non existe ID </h2>";
}else{
 //Busco en la tabla eventos la que corresponda al id de la selección
$id = $_GET['id'];
    if ( !is_numeric ($id )) $id = 0;

$sql="SELECT * FROM eventos WHERE id_evento=$id";

$res=mysql_query($sql,$enlace);
if (!$registro=mysql_fetch_array($res))
 { echo "<H4> NON EXISTE ESTE EVENTO </H4>";
}else{ // se existe o evento procedo a amosa-lo formulario.
$id=$registro["id_evento"];
$nome=$registro["nome_evento"];
$subnome=$registro["subnome"];
$data=MySQLDateToDate($registro["data"]);

//  Capa onde amoso todolos datos do evento.
echo "
<table cellpadding=3>
	<tr><td bgcolor=#ff6666> <font size=+3 weight=bold>$data</font> </td>
	<td bgcolor=#ff6666> <font size=+3 weight=bold> $nome </font> <br> <font size=+1><i> $subnome </i></font> </td></tr>
	<tr><td>&nbsp;</td><td> <br>
";

// comprobo que a inscricion esta aberta para amosa-lo forumlario.
$resultado = mysql_query(" select count(*) from inscritos where evento='$id'",$enlace);
$contados = mysql_result($resultado,0); 

if (!inscricion_aberta($registro["inscri_inicio"],$registro["inscri_fin"],$registro["limite"],$contados)){
?>
<h3> INSCRICI&Oacute;N PECHADA </h3>
<p align="left"> A inscrici&oacute;n para este evento est&aacute; pechada.
</p>
<?
}else{ 
// a inscricion esta aberta polo que amoso o formulario.
include ("../fichs_php/evento_formulario.php");
		} // fin do if inscricion_aberta.
?>

	</td></tr>
	</table> 
<!-- fin da taboa da capa de datos. -->
<?
	}// fin do if se hai evento
} // fin do if, se existe ID
?>

<br><br>
<p align=center> [ <a href="javascript:history.go(-1)">Volver Atr&aacute;s</a> ]  </p>
