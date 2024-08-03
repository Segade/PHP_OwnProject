						<h3 class="h3__head1">Resultados</h3>
<article>

<table border=1 cellpadding=3 width=100%>
<tr>  <th>Data</th> <th>Nome da carreira</th> </tr>


<?

 //Sentencia sql  
 $_pagi_sql = "SELECT * FROM resultados   ORDER BY data DESC";

 //cantidad de resultados por página  
 $_pagi_cuantos = 25;

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

 //Leemos y escribimos los registros de la página actual
 while($registro = mysql_fetch_array($_pagi_result)){


// amosamo-los resultados como ligazons.
$data=MySQLDateToDate($registro["data"]);
$carreira=$registro["carreira"];
$id=$registro["id"];
$ligazon=$registro["ligazon"];




// fias da taboa por cada rexisro 

echo " <tr>

<td> $data </td> <td> <a href=$ligazon target=_blank> $carreira </a> </td>
</tr>";

 // cerramos la capa que contiene la información
 }
?>
</table>

<!-- colocamos tabla paginacion -->
<div align="center"><?
//Incluimos la barra de navegación
echo"<p>".$_pagi_navegacion."</p>";
?>
</div>
</article>

