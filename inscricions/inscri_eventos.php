
  <h3> Listaxe de eventos </h3>

<table height="100%" width="100%">
<tr> <td>
<table border="1" cellpadding="3" width="100%">
<tr> <th> &nbsp;</th> <th>Data</th> <th>Evento</th> </tr>

<form name="f1" method="post" action="<?= $_SERVER['PHP_SELF'] ?>?corpo=operainscri">
<?
 //Sentencia sql  
 $_pagi_sql = "SELECT * FROM eventos ORDER BY data DESC";

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
//mostramos la fecha y el título
$data=MySQLDateToDate($registro["data"]);
$nome=$registro["nome_evento"];
$id=$registro["id_evento"];

echo " <tr><td> <input type=radio name=id_evento value=$id title=\"$data-$nome\" ></td>
<td> $data </td> <td> $nome </td></tr>
";
 } // fin do while.
// engadimo-la barra de navegacion de anterior e seguinte.
echo "</table>
<div align=\"center\"> <p>$_pagi_navegacion</p> </div>
</td>
<td valign=top> <br><br> <br>
<input type=\"submit\" value=\"Inscribir a unha persoa nun evento\" name=\"inscribe\">
<br> <br>
<input type=\"submit\" value=\"Modificar/Borrar a unha persoa nun evento\" name=\"correxir\">
<br> <br>

</form>
</td> </tr>
</table>
";
?>