
<?


if (!isset($_GET['id'])){
	echo"<h2> Erro, non existe ID </h2>";
}else{
 //Busco en la tabla noticias la que corresponda al id de la selección
$id = $_GET['id'];
    if ( !is_numeric ($id )) $id = 0;
$sql="SELECT * FROM eventos WHERE id_evento=$id AND publi=1";

$res=mysql_query($sql,$enlace);
if (!$registro=mysql_fetch_array($res))
 { echo "<H4> NON EXISTE ESTE EVENTO </H4>";
}else{
// o evento existe polo que procedo a amosa-los datos.
$id=$registro["id_evento"];
$nome=$registro["nome_evento"];
$subnome=$registro["subnome"];
$lugar=$registro["lugar"];
$tipo=$registro["tipo"];
$limite=$registro["limite"];
$data=MySQLDateToDate($registro["data"]);
$distancia=$registro["distancia"];
$organiza=$registro["organiza"];
$observacions=$registro["observacions"];
$regulamento=$registro["regulamento"];
$inicio = formato_datahora($registro["inscri_inicio"]) ;
$fin = formato_datahora($registro["inscri_fin"]) ;
$url=$_SERVER['PHP_SELF'];
   $hora= $registro["hora"]; 
// conto a xente que esta inscrita o evento.
$resultado = mysql_query(" select count(*) from inscritos where evento='$id'",$enlace);
$contados = mysql_result($resultado,0); 

// Capa onde amoso todolos datos do evento.
echo "
<article>
						<h3 class=\"h3__head1\">Info do evento</h3>
<table cellpadding=3 width=100%>
	<tr><td bgcolor=#ff6666> <font size=+3 weight=bold>$data</font> </td>
	<td bgcolor=#ff6666> <font size=+3 weight=bold> $nome </font> <br> <font size=+1><i> $subnome </i></font> </td></tr>
	<tr><td>&nbsp;</td><td> <br>
<p align=+left>
<b>Lugar:</b> $lugar <br>
<b>Hora:</b> $hora <br>
<b>Tipo:</b> $tipo <br>
<b>Distancia:</b> $distancia <br>
<b>Organiza:</b> $organiza <br>
<b>Prazo de Inscrici&oacute;n:</b> <
<ul> <li> Dende: $inicio. <br> </li>
 <li> Ata: $fin. </li></ul>
";

if (!$limite=="0") {
	$x = $limite - $contados ;
	echo"<b>L&iacute;mite de inscritos:</b> $limite. Quedan $x prazas.<br>";
}

echo"
<b>Observaci&oacute;ns:</b> $observacions <br>
</p>
<table width=100%> <tr> <td align=left>
<b> <a href=$url?corpo=listains&id=$id> &lt; Listaxe de inscritos: $contados &gt; </a> </b>
</td> 
 <td align=right>
";

// comprobo se as inscricions estan abertas pra poñe-la ligazon ó formulario.
	if (inscricion_aberta($registro["inscri_inicio"],$registro["inscri_fin"],$limite,$contados)){
echo "
<a href=\"$url?corpo=formevento&id=$id\"><b>&lt; Inscribirme &gt;</b></a>";
}else{ // se as inscricions estan pechadas.
	echo"<b>&lt; Inscrici&oacute;n pechada &gt;</b>";
} // fin do if inscricion_aberta.

echo "</td> </tr> </table>
<h3 align=center>Regulamento</h3> 
<p align=left>$regulamento </p>
	</td></tr>
	</table>
</article>
";
// fin da capa onde amoso os datos.
}// fin do if se hai evento
} // fin do if, se existe ID na url.
?>

<br><br>
<p align=center> [ <a href="javascript:history.go(-1)">Volver Atr&aacute;s</a> ]  </p>
