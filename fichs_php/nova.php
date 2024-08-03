
<?

if (!isset($_GET['id'])){
	echo"<h2> Erro, non existe ID </h2>";
}else{
 //Busco en la tabla noticias la que corresponda al id de la selección
$id = $_GET['id'];
    if ( !is_numeric ($id )) $id = 0;

$sql="SELECT * FROM noticias WHERE id=$id";

$res=mysql_query($sql,$enlace);
if (!$registro=mysql_fetch_array($res))
 { echo "<H4> NON EXISTE ESTA NOTICIA </H4>";
}else{

$titulo=$registro["titulo"];
$subtitulo=$registro["subtitulo"];
$data=MySQLDateToDate($registro["data"]);
$contido=$registro["contido"];
?>

<!-- Muestro la noticia completa (titulo, imagen, contenido, etc -->
<article>
						<h3 class="h3__head1">Nova completa</h3>
<table cellpadding=3 width=100%>
	<tr><td class="nova_cabeceira">  <? echo "$data"; ?> </td>
	<td class="nova_cabeceira"> <? echo "$titulo  <br> <font size=+1><i> $subtitulo </i></font> </td></tr>"; ?>
	<tr><td>&nbsp;</td><td align=left> <br> <p> <? echo"$contido"; ?> </p>
	</td></tr>
	</table>
</article>
<?	}// fin do if se hai novas
} // fin do if, se existe ID
?>

<br><br>
<p align=center> [ <a href="javascript:history.go(-1)">Volver Atr&aacute;s</a> ]  </p>
