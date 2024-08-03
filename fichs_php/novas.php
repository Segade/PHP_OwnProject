
<?

 //Sentencia sql  
 $_pagi_sql = "SELECT * FROM noticias WHERE publi=1   ORDER BY data DESC";
$sql = "SELECT * FROM noticias WHERE publi=1   ORDER BY data DESC";

 //cantidad de resultados por página  
 $_pagi_cuantos = 10;

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
//  include("paginator/paginator.inc.php");

?>
<article>
						<h3 class="h3__head1">Portada</h3>
<table width="100%"> <tr>  <td width="150px">
<img src="images/escudo1.JPG" alt="escudo do concello de mesia">
</td>
<td>
<p>&iexcl;&iexcl; BENVID@ !! &aacute; p&aacute;xina oficial da Carreira Popular Concello de Mes&iacute;a. Aqu&iacute; atopar&aacute;s todo o que precisas acerca deste evento: noticias, inscrici&oacute;ns, resultados e como chegar.</p>

<p>An&iacute;mate a correr polo concello de Mes&iacute;a, nunha carreira de car&aacute;cter enxebre e familiar. O circuito ten unha lonxitude de 12km aproximados con alternancia de terra e asfalto, e conta con algunha costa que fai desta proba todo un reto para o corredor. Tam&eacute;n se o prefires, tes a opci&oacute;n de facer a Mini-Carreira cunha distancia de 6km m&aacute;is asequibles.</p>

<p>Non o dubides e reserva a data desta carreira no teu calendario, e ven a pasar un bo d&iacute;a con nos en Mes&iacute;a. &iquest;&iquest; AGARD&Aacute;MOSTE !!. </p>
</td> </tr> </table>
</article>
<br> <br>
<?
 //Leemos y escribimos los registros de la página actual
 $res=mysql_query($sql,$enlace);
 while($registro = mysql_fetch_array($res)){

// $subtitulo=$registro["subtitulo"];
//mostramos la fecha y el título
//$data=MySQLDateToDate($registro["data"]);
$titulo=$registro["titulo"];
$contido=$registro["contido"];
$id=$registro["id"] ;
// $imaxe=$registro[imagen];
//la funcion substr nos muestra los primeros 255 caracteres (a modo de resumen)
//$contido=substr($contido, 0, 255)."...";
// Mostramos la imagen en miniatura con un enlace a la imagen real -->
 echo "
<article>
<table border=0 cellpadding=3 width=100%><tr> 
<td align=left class=\"nova_cabeceira\"> 
 $titulo  <br>  </td>
<tr> <td>$contido ";
?>
</td></tr></table>
</article>
<br>
<? // cerramos la capa que contiene la información

 }
?>

<!-- colocamos tabla paginacion -->
<div align="center">
<?
//Incluimos la barra de navegación
//echo"<p>".$_pagi_navegacion."</p>";
?>
</div>

