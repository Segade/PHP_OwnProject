<?
// id do evento.
$id=$_POST['id_evento']; 
?>
  <h3> Listaxe deresultados para este evento </h3>

<table height="100%" width="100%">
<tr> <td>
<table border="1" cellpadding="3" width="100%">
<tr> <th> &nbsp;</th> <th>Competici&oacute;n </th> <th>Ligaz&oacute;n </th> </tr>
<form name="f1" method="post" action="<?= $_SERVER['PHP_SELF'] ?>?corpo=editresult">
<input type="hidden" name="correxir">
<input type="hidden" name="id_evento" value="<?= $id ?>">
<?
 //Sentencia sql  
 $_pagi_sql = "SELECT * FROM result WHERE evento_res=$id";

 //cantidad de resultados por página  
 $_pagi_cuantos = 100;

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
// amosamo-los datos da persoa.
$competicion=$registro["competicion"];
$ligazon=$registro["ligazon"];
$codigo =$registro["id_result"];

echo " 
<tr><td> <input type=\"hidden\" name=\"codigo[]\" value=\"$codigo\"></td>
<td> <input type=\"text\" name=\"competicion[]\" value=\"$competicion\" required> </td> 
<td> <input type=\"text\" name=\"ligazon[]\" value=\"$ligazon\" required> </td>
</tr>
";
 } // fin do while.
// engadimo-la barra de navegacion de anterior e seguinte.
echo "</table>
<div align=\"center\"> <p>$_pagi_navegacion</p> </div>
</td>
<td valign=top> <br><br> <br>
<input type=\"submit\" value=\"Modificar resultado\" name=\"modificar\">
</form>
</td> </tr>
</table>
";
?>