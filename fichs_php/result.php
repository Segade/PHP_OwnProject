						<h3 class="h3__head1">Resultados</h3>

<?

 //Sentencia sql  
 $_pagi_sql = "SELECT * FROM res_eventos   ORDER BY res_data DESC";

 //cantidad de resultados por p�gina  
 $_pagi_cuantos = 10;

 //cantidad de enlaces que se mostrar�n como m�ximo en la barra de navegaci�n
 $_pagi_nav_num_enlaces = 7; 

 //Decidimos si queremos que se muesten los errores de mysql
 $_pagi_mostrar_errores = true; 

 //Definimos qu� estilo CSS se utilizar� para los enlaces de paginaci�n.
 //El estilo debe estar definido previamente
 $_pagi_nav_estilo = "paginacion";

 //definimos qu� ir� en el enlace a la p�gina anterior
// $_pagi_nav_anterior = "Anterior"; podr�a ir un tag <img> o lo que sea

 //definimos qu� ir� en el enlace a la p�gina siguiente
// $_pagi_nav_siguiente = "Seguinte"; podr�a ir un tag <img> o lo que sea

 //definimos qu� ir� en el enlace a la p�gina primeira
//$_pagi_nav_primera = "<< Primeira";  podr�a ir un tag <img> o lo que sea

 //Incluimos el script de paginaci�n. �ste ya ejecuta la consulta autom�ticamente
 include("paginator/paginator.inc.php");

 //Leemos y escribimos los registros de la p�gina actual
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
//Incluimos la barra de navegaci�n
echo"<p>".$_pagi_navegacion."</p>";
?>
</div>
