
<?
session_start();
if (!isset($_GET['id'])){
	echo"<h2> Erro, non existe ID </h2>";
}else{
 //Busco en la tabla eventos la que corresponda al id de la selección
$id = $_GET['id'];
    if ( !is_numeric ($id )) $id = 0;
$_SESSION['id_evento'] =  $id;

// comprobo que o evento existe.
$sql="SELECT * FROM eventos WHERE id_evento=$id AND publi=1";
$res=mysql_query($sql,$enlace);
if (!$rexistro_evento=mysql_fetch_array($res))
 { echo "<H4> NON EXISTE ESTE EVENTO </H4>";
}else{ // se si existe o evento, procedo a amosa-la listaxe de inscritos.


// collo os datos de evento pra amosalos na listaxe.

$nome_evento = $rexistro_evento["nome_evento"];
$subnome=$rexistro_evento["subnome"];
$data_evento =MySQLDateToDate($rexistro_evento["data"]);


// Capa onde amoso todolos datos do evento.
$url= $_SERVER['PHP_SELF'];
echo "
<article>
<table cellpadding=3 width=100%>
	<tr><td bgcolor=#ff6666> <font size=+3 weight=bold>$data_evento</font> </td>
	<td bgcolor=#ff6666> <font size=+3 weight=bold> $nome_evento </font> <br> <font size=+1><i> $subnome </i></font> </td></tr>
	<tr><td colspan=2 align=center valign=top> <br>

						<h3 class=\"h3__head1\">Listaxe de inscritos</h3>

<div id=contenido> </div>
</article>

	</td></tr>
	</table>
";
?>

<?
// fin da capa onde amoso os datos.

}// fin do if se hai evento
} // fin do if, se existe ID na url.
?>
