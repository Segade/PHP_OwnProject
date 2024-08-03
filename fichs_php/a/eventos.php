
<?

 //Sentencia sql  
 $_pagi_sql = "SELECT * FROM eventos WHERE data > DATE_FORMAT(NOW(),'%Y-%m-%d 00:00:00') ORDER BY data";

 //cantidad de resultados por página  
 $_pagi_cuantos = 5;

 //cantidad de enlaces que se mostrarán como máximo en la barra de navegación
 $_pagi_nav_num_enlaces = 7; 

 //Decidimos si queremos que se muesten los errores de mysql
 $_pagi_mostrar_errores = true; 

 //Definimos qué estilo CSS se utilizará para los enlaces de paginación.
 //El estilo debe estar definido previamente
 $_pagi_nav_estilo = "paginacion";

 //definimos qué irá en el enlace a la página anterior
// $_pagi_nav_anterior = "Anterior"; podría ir un tag <img> o lo que sea

 //definimos qué irá en el enlace a la página siguiente
// $_pagi_nav_siguiente = "Seguinte"; podría ir un tag <img> o lo que sea

 //definimos qué irá en el enlace a la página primeira
//$_pagi_nav_primera = "<< Primeira";  podría ir un tag <img> o lo que sea

 //Incluimos el script de paginación. Éste ya ejecuta la consulta automáticamente
 include("paginator/paginator.inc.php");

echo"
		<h2 align=center> Calendario de eventos </h2>
";
 //Leemos y escribimos los registros de la página actual
 while($registro = mysql_fetch_array($_pagi_result)){
//mostramos la fecha y el título
$data=MySQLDateToDate($registro["data"]);
$nome=$registro["nome_evento"];
$observacions=$registro["observacions"];
$id=$registro["id_evento"] ;
$hora = $registro["hora"] ;
// conto a xente que esta inscrita o evento.
$resultado = mysql_query(" select count(*) from inscritos where evento='$id'",$enlace);
$contados = mysql_result($resultado,0); 


$url = $_SERVER['PHP_SELF'];
$inicio = formato_datahora($registro["inscri_inicio"]) ;
$fin = formato_datahora($registro["inscri_fin"]) ;
// comprobo se as inscricions estan abertas pra poñe-la ligazon ó formulario.
	if (inscricion_aberta($registro["inscri_inicio"],$registro["inscri_fin"],$registro["limite"],$contados))
	$inscri = "<a href=\"$url?corpo=formevento&id=$id\"><b>&lt; Inscribirme &gt;</b></a>";
else 
	$inscri = "<b>&lt; Inscrici&oacute;n pechada &gt;</b>";
// capa onde amoso os datos.
 echo "
<table border=0 cellpadding=3 width=100%><tr>
 <td align=center width=5 bgcolor=#ff6666> <font size=+3 weight=bold> $data </font> </td><td align=left bgcolor=#ff6666> <a href=$url?corpo=evento&id=$id><font size=+3 weight=bold> $nome </font> </a>   </td>
<tr> <td>&nbsp;</td>
<td>$hora
<table width=\"100%\"> <tr> <td align=\"left\">
<b>Prazo de Inscrici&oacute;n:</b> <
<ul> <li> Dende: $inicio. <br> </li>
 <li> Ata: $fin. </li></ul>
</td> <td align=right> 
<b> <a href=$url?corpo=listains&id=$id> &lt; Listaxe de inscritos: $contados &gt; </a> </b>
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
<br>
"; // fin do echo da taboa de datos.
 // cerramos la capa que contiene la información

 }
?>

<!-- colocamos tabla paginacion -->
<div align="center">
<?
//Incluimos la barra de navegación
echo"<p>".$_pagi_navegacion."</p>";
?>
</div>

