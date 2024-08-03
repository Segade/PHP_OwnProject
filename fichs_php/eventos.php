<?

 //Sentencia sql  
//  $sql = "SELECT * FROM eventos WHERE data > DATE_FORMAT(NOW(),'%Y-%m-%d 00:00:00') ORDER BY data";
$sql = "SELECT * FROM eventos WHERE publi=1 ORDER BY data";
 $res=mysql_query($sql,$enlace);


echo"
						<h3 class=\"h3__head1\">Inscrici&oacute;ns</h3>
<p>Elixa a modalidade de carreira na que se quere inscribir para acceder &oacute; formulario de inscrici&oacute;n
";
 //Leemos y escribimos los registros de la página actual
 while($registro = mysql_fetch_array($res)){
//mostramos la fecha y el título
$data=MySQLDateToDate($registro["data"]);
$nome=$registro["nome_evento"];
$observacions=$registro["observacions"];
$id=$registro["id_evento"] ;
   $hora= $registro["hora"]; 

// conto a xente que esta inscrita o evento.
$resultado = mysql_query(" select count(*) from inscritos where evento='$id'",$enlace);
$contados = mysql_result($resultado,0); 


$url = $_SERVER['PHP_SELF'];
$inicio = formato_datahora($registro["inscri_inicio"]) ;
$fin = formato_datahora($registro["inscri_fin"]) ;
// comprobo se as inscricions estan abertas pra poñe-la ligazon ó formulario.
	if (inscricion_aberta($registro["inscri_inicio"],$registro["inscri_fin"],$registro["limite"],$contados))
	$inscri = "<a href=\"$url?corpo=formevento&id=$id\" ><b>&lt; Inscribirme &gt;</b></a>";
else 
	$inscri = "<b>&lt; Inscrici&oacute;n pechada &gt;</b>";
// capa onde amoso os datos.
 echo "
<article>
<table border=0 cellpadding=3 width=100%><tr>
 <td align=center width=5 bgcolor=#ff6666> <font size=+3 weight=bold> $data </font> </td><td align=left bgcolor=#ff6666> <a href=\"$url?corpo=evento&id=$id\" ><font size=+3 weight=bold> $nome </font> </a>   </td>
<tr> <td><b>Hora:</b><br>$hora</td>
<td>
<table width=\"80%\"> <tr> <td align=\"left\">
<b>Prazo de Inscrici&oacute;n:</b> <
<ul> <li> Dende: $inicio. <br> </li>
 <li> Ata: $fin. </li></ul>
</td> <td align=right> 
<b> <a href=\"$url?corpo=listains&id=$id\" > &lt; Listaxe de inscritos: $contados &gt; </a> </b>
<br> <br>
$inscri 
</td> </tr>
<tr><td colspan=\"2\" align=\"center\">
<a href=\"regul.php?id=$id\" target=\"_blank\"> <b>&lt;Regulamento en PDF&gt;</b> </a> <br>
</td></tr>
<tr><td colspan=\"2\" align=\"left\">
<p >$observacions </p>
</td></tr> </table> <!-- fin da taboa do prazo de inscricions, listaxe, inscribirme -->

</td></tr></table> <!-- fin da taboa dos datos completos do evento -->
</article>
<br>
"; // fin do echo da taboa de datos.
 // cerramos la capa que contiene la información

 }
?>