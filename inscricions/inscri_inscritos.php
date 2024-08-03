<?
// id do evento.
$id=$_POST['id_evento']; 
?>
  <h3> Listaxe de Inscritos </h3>

<table height="100%" width="100%">
<tr> <td>
<table border="1" cellpadding="3" width="100%">
<tr> <th> &nbsp;</th> <th>Apelidos e Nome</th> <th>DNI/NIE</th> <th>Data de nacemento </th> </tr>
<form name="f1" method="post" action="<?= $_SERVER['PHP_SELF'] ?>?corpo=editinscri">
<input type="hidden" name="correxir">
<input type="hidden" name="id_evento" value="<? echo"$id"; ?>">
<?
 //Sentencia sql  
 $_pagi_sql = "SELECT * FROM inscritos WHERE evento=$id ORDER BY apelidos";

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
$data=MySQLDateToDate($registro["nacemento"]);
$nome=$registro["nome"];
$apelidos=$registro["apelidos"];
$dni=$registro["dni"];
$codigo=$registro["id_inscri"];

echo " 
<tr><td> <input type=\"checkbox\" name=\"codigo[]\" value=\"$codigo\" title=\"$apelidos, $nome. $dni. $data\"></td>
<td> $apelidos, $nome </td> <td> $dni </td> <td> $data </td> </tr>
";
 } // fin do while.
// engadimo-la barra de navegacion de anterior e seguinte.
echo "</table>
<div align=\"center\"> <p>$_pagi_navegacion</p> </div>
</td>
<td valign=top> <br><br> <br>
<input type=\"submit\" value=\"Modificar datos\" name=\"modificar\">
<br> <br>
<input type=\"submit\" value=\"Borrar Seleccion\" name=\"borrar_selec\">
<br> <br>
<input type=\"submit\" value=\"Borrar Todos\" name=\"borrar_todo\">

</form>
</td> </tr>
</table>
";
?>