<h3> Listaxe de usuarios </h3>

<table border=1 cellpadding=3 width=100%>
<tr> <th> &nbsp;</th> <th>Alcume</th> <th>E-mail</th> </tr>

<form name="f1" method="post" action="<?= $_SERVER['PHP_SELF'] ?>?corpo=operauser">

<?

 //Sentencia sql  
 $_pagi_sql = "SELECT * FROM members ORDER BY id";

 //cantidad de resultados por p�gina  
 $_pagi_cuantos = 25;

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

//mostramos la fecha y el t�tulo
$alcume=$registro["username"];
$email=$registro["email"];
$id=$registro["id"];


echo " <tr>
<td><input type=radio name=rdid value=$id title=\"$alcume, $email\" ></td>
<td> $alcume </td> <td> $email </td>
</tr>";


 // cerramos la capa que contiene la informaci�n
 }
?>
</table>

<!-- colocamos tabla paginacion -->
<div align="center"><?
//Incluimos la barra de navegaci�n
echo"<p>".$_pagi_navegacion."</p>";
?>
</div>


<input type="button" value="Borrar" name="borrar" onclick="confirma_borra_usuario()">
<input type="submit" value="Modificar" name="modificar">
</form>