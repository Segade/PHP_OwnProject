
<?


if (!isset($_GET['id'])){
	echo"<h2> Erro, non existe ID </h2>";
}else{
 //Busco en la tabla eventos la que corresponda al id de la selecci�n
$id = $_GET['id'];
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
		switch ($_POST['campo']){
			case "1":	$campo="AND (apelidos LIKE '%$buscar%')";
				break;
			case "2":	$campo="AND (nome LIKE '%$buscar%')";
				break;
			case "3":	$campo="AND (club LIKE '%$buscar%')";
				break;
			case "4":	$campo="AND (localidade LIKE '%$buscar%')";
				break;
			case "5":	$campo="AND (categoria LIKE '%$buscar%')";
				break;
			default : $campo = "";
} // fin do switch
//$sql = "AND (nome LIKE '%$buscar%' OR apelidos LIKE '%$buscar%' OR club LIKE '%$buscar%' OR categoria LIKE '%$buscar%')";
$num_rexistros = 1000;
if ($buscar="") $num_rexistros = 30;
}
 $_pagi_sql = "SELECT * FROM inscritos WHERE evento=$id $campo ORDER BY dorsal, apelidos, nome";
 //cantidad de resultados por p�gina  
 $_pagi_cuantos = $num_rexistros;
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
<form name=f1 method=post action=$url?corpo=listains&id=$id >
<select name=\"campo\" title=\"seleccione o parametro da procura\">
<option value=\"1\">Apelidos</option>
<option value=\"2\">Nome</option>
<option value=\"3\">Club</option>
<option value=\"4\">Localidade</option>
<option value=\"5\">Categor&iacute;a</option>
</select>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input type=search name=buscar title='introduza a palabra a procurar'>
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
//Incluimos la barra de navegaci�n
echo"<p>".$_pagi_navegacion."</p>";
?>
</div>
<?
// fin da capa onde amoso os datos.

}// fin do if se hai evento
} // fin do if, se existe ID na url.
?>


