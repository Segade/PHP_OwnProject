						<h3 class="h3__head1">Resultados</h3>

<?

 //Sentencia sql  
 $_pagi_sql = "SELECT * FROM res_eventos   ORDER BY res_data DESC";

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
 include("paginator/paginator.inc.php");

 //Leemos y escribimos los registros de la página actual
 while($registro = mysql_fetch_array($_pagi_result)){

$data=MySQLDateToDate($registro["res_data"]);
$evento =$registro["res_nome"];
$id=$registro["id_res"];

echo "
<article>
<table cellpadding=3>
	<tr><td bgcolor=#ff6666> <font size=+3 weight=bold>$data</font> </td>
	<td bgcolor=#ff6666> <font size=+3 weight=bold> $evento </font> </td></tr>
	<tr><td>&nbsp;</td><td> 
";

$sql = "SELECT * FROM result WHERE evento_res=$id";
$rex=mysql_query($sql,$enlace);
 while($rexistro = mysql_fetch_array($rex)){
$competicion = $rexistro['competicion'];
$ligazon = $rexistro['ligazon'];
echo "&raquo; &nbsp; <a href=\"$ligazon\" target=\"_blank\"> $competicion </a> <br>";
} // fin do while da tabhoa result  
echo " </td> </tr> </table> </article> <br> <br>";
 } // fin do while da taboa res_eventos 
?>

<!-- colocamos tabla paginacion -->
<div align="center"><?
//Incluimos la barra de navegación
echo"<p>".$_pagi_navegacion."</p>";
?>
</div>
