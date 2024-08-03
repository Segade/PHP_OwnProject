
<?


if (!isset($_POST['id_evento'])){
	echo"<h3> Erro, non existe ID </h3>";
}else{
 //Busco en la tabla eventos la que corresponda al id de la selección
$id = $_POST['id_evento'];
    if ( !is_numeric ($id )) $id = 0;

// comprobo que o evento existe.
$sql="SELECT * FROM eventos WHERE id_evento=$id";
$res=mysql_query($sql,$enlace);
if (!$rexistro_evento=mysql_fetch_array($res))
 { echo "<H4> NON EXISTE ESTE EVENTO </H4>";
}else{ // se si existe o evento, procedo a amosa-la listaxe de inscritos.
// configuro a paxinacion.
 //Sentencia sql  
$sql = "";
$num_rexistros = 30;
if (isset($_POST['buscar'])){
$buscar = mysql_real_escape_string($_POST['buscar']);
$sql = "AND (nome LIKE '%$buscar%' OR apelidos LIKE '%$buscar%' OR club LIKE '%$buscar%' OR categoria LIKE '%$buscar%')";
$num_rexistros = 1000;
if ($buscar="") $num_rexistros = 30;
}
 $_pagi_sql = "SELECT * FROM inscritos WHERE evento=$id $sql  ORDER BY dorsal ";
 //cantidad de resultados por página  
 $_pagi_cuantos = $num_rexistros;
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


// collo os datos de evento pra amosalos na listaxe.

$nome_evento = $rexistro_evento["nome_evento"];
$subnome=$rexistro_evento["subnome"];
$data_evento =MySQLDateToDate($rexistro_evento["data"]);


// Capa onde amoso todolos datos do evento.
$url= $_SERVER['PHP_SELF'];
echo "
<table cellpadding=3 width=100%>
	<tr><td bgcolor=#ff6666> <font size=+3 weight=bold>$data_evento</font> </td>
	<td bgcolor=#ff6666> <font size=+3 weight=bold> $nome_evento </font> <br> <font size=+1><i> $subnome </i></font> </td></tr>
	<tr><td colspan=2 align=center valign=top> <br>
<h3> Listaxe de inscritos </h3>
<div>
<form name=f1 method=post action=$url?corpo=consultadorsal >
<input type=\"hidden\" name=\"id_evento\" value=\"$id\">
<input type=search name=buscar title='buscar polo nome, apelidos, club, ou categoria'>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input type=submit value=Buscar name=enviar>
</form>
</div>
";
// conto a xente que esta inscrita o evento.
$resultado = mysql_query(" select count(*) from inscritos where evento='$id'",$enlace);
$contados = mysql_result($resultado,0); 

echo "
<p align=right> <b> Total de inscritos: $contados</b> <p>
<table  border=3 cellpadding=2>
<tr> <th> DORSAL </TH> <TH> APELIDOS, NOME </TH> <TH> CLUB </TH> <th> LOCALIDADE </TH> </tr>
";
// bucle onde amoso os inscritos.
 while($rexistro = mysql_fetch_array($_pagi_result)){
$nome = $rexistro["nome"];
$apelidos =$rexistro["apelidos"];
$dorsal = $rexistro["dorsal"];
$localidade=$rexistro["localidade"];
$club=$rexistro["club"];

echo "
<tr> <td> $dorsal </td> <td> $apelidos, $nome </td> <td> $club </td> <td> $localidade </td> </tr> 
";
} // fin do while de inscritos.
echo "
</table>
	</td></tr>
	</table>
";
?>
<!-- colocamos tabla paginacion -->
<div align="center">
<?
//Incluimos la barra de navegación
echo"<p>".$_pagi_navegacion."</p>";
?>
</div>
<?
// fin da capa onde amoso os datos.

}// fin do if se hai evento
} // fin do if, se existe ID na url.
?>


