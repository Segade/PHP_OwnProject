<?
// o boton modifica e o que damos despois do form que edita os datos pra modificalos.
if (!isset ($_POST['modifica']) ) {
// entramos por 1 vez, polo que amosamo-los datos a modificar no form.
if (isset ($_POST['rdid']) ) {
// miramos que entramos con id, se non e que so introducimo-la url.
	$id=$_POST['rdid'];

 //Sentencia sql  
				$registro=mysql_query("SELECT * FROM eventos WHERE id_evento=$id",$enlace);

if($fia=mysql_fetch_array($registro)){
$data=MySQLDateToDate($fia["data"]);
$regulamento = html_entity_decode($fia['regulamento'], ENT_QUOTES, "utf-8");
$regulamento = str_replace("<br />", "", $regulamento);
$regulamento = stripslashes($regulamento);
$observacions = html_entity_decode($fia['observacions'], ENT_QUOTES, "utf-8");
$observacions = str_replace("<br />", "", $observacions);
$observacions = stripslashes($observacions);

?>
<form name="f1" method="post" action="<?= $_SERVER['PHP_SELF'] ?>?corpo=operaevento&opera=modif" onsubmit="return val_form(this)">
<table cellspacing="2" cellpadding="2">
<tr>
	<td>	ID do evento </td><td> <input type="Text" name="id" size="10" title="identificador do evento" value="<? echo $fia['id_evento']; ?>"> </td>
</tr>
<tr>
	<td>	Nome </td><td> <input type="Text" name="nome" size="50" title="nome do evento" value="<? echo $fia['nome_evento']; ?>"> </td>
</tr>

<tr>
	<td>	Subnome </td><td> <input type="Text" name="subnome" title="subnome do evento" size="50" value="<? echo $fia['subnome']; ?>"> </td>
</tr>

<tr>
	<td>	Data </td><td> <input type="Text" name="data" size="10" title="data do evento" value="<? echo $data; ?>"> </td>
</tr>

<tr>
	<td>	Hora </td><td> <input type="Text" name="hora" size="10" title="hora do evento" value="<? echo $fia['hora']; ?>"> </td>
</tr>

<tr>
	<td>	Tipo </td><td> <input type="Text" name="tipo" size="50" title="tipo do evento" value="<? echo $fia['tipo']; ?>"> </td>
</tr>

<tr>
	<td>	Distancia </td><td> <input type="Text" name="distancia" size="10" title="distancia do evento" value="<? echo $fia['distancia']; ?>"> </td>
</tr>

<tr>
	<td>	Organiza </td><td> <input type="Text" name="organiza" size="50" title="organizacion do evento" value="<? echo $fia['organiza']; ?>"> </td>
</tr>

<tr>
	<td>	Lugar </td><td> <input type="Text" name="lugar" size="50" title="lugar do evento" value="<?= $fia['Lugar'] ?>"> </td>
</tr>

<tr>
	<td>	Inicio da inscrición </td><td> <input type="Text" name="inicio" size="20" title="inicio da inscricion" value="<? echo $fia['inscri_inicio']; ?>"> </td>
</tr>

<tr>
	<td>	Fin da inscrición </td><td> <input type="Text" name="fin" size="20" title="fin da inscricion" value="<? echo $fia['inscri_fin']; ?>"> </td>
</tr>

<tr>
	<td>	Límite de inscritos </td><td> <input type="Text" name="limite" size="10" title="limite de inscritos" value="<? echo $fia['limite']; ?>"> </td>
</tr>

<tr>
	<td>	Directorio </td><td> <input type="Text" name="dir" size="15" title="directorio" value="<? echo $fia['dir']; ?>"> </td>
</tr>

<tr>
	<td>	C&oacute;digo </td><td> <input type="Text" name="codigo" size="15" title="codigo do evento" value="<? echo $fia['evento_cod']; ?>"> </td>
</tr>

<tr>
	<td>Publicar:</td> <td> <input type="checkbox" name="publicar" title="publicar evento" value="si" <? if ($fia['publi']==1) echo "checked";?>
></td>
</tr>

<tr>
	<td>	Observacións </td><td > <textarea name=observacions title=observacions cols=40 rows=10><? echo $observacions; ?></textarea></td>
</tr>

<tr>
	<td>	Regulamento </td><td > <textarea name=regulamento title=regulamento do evento cols=50 rows=50><? echo $regulamento ; ?></textarea></td>
</tr>


<tr><td>&nbsp;</td><td>&nbsp;</td></tr>
<tr><td><input type="submit" value="Modificar" name="modifica"></td>
<td>&nbsp;	</td>
</tr>
</table>
</form>
<?
} // fin do if fia=registro
}else{ // else do if de isset de rdid
	echo "<h2> Erro ca URL </h2>
<p align=center> [ <a href=\"javascript:history.go(-1)\">Volver Atr&aacutee;s</a> ]  </p>
";

}

}else{ //else do if do isset de post modifica
// entramos por 2 vez, polo que temo-los datos que queremos modificar do form e facemo-lo update.
	$id_evento=$_POST['id'];
	$nome=mysql_real_escape_string($_POST['nome']);
	$subnome=mysql_real_escape_string($_POST['subnome']);
	$tipo=mysql_real_escape_string($_POST['tipo']);
	$distancia=mysql_real_escape_string($_POST['distancia']);
	$organiza=mysql_real_escape_string($_POST['organiza']);
	$lugar =mysql_real_escape_string($_POST['lugar']);
	$limite=$_POST['limite'];
	$dir=$_POST['dir'];
	$codigo=$_POST['codigo'];
	$observacions =htmlentities($_POST['observacions'], ENT_QUOTES, "utf-8");
	$observacions= nl2br($observacions);
$regulamento = htmlentities($_POST['regulamento'], ENT_QUOTES, "utf-8");
	$regulamento= nl2br($regulamento);
if (isset ($_POST['publicar']) ){	 $publi = 1; $publica="Si";}
	else{ $publi = 0; $publica="Non";}




	$inscri_inicio=$_POST['inicio'];
	$inscri_fin=$_POST['fin'];
	$hora=$_POST['hora'];
	$fecha=$_POST['data'];

	$data=DateToQuotedMySQLDate($fecha);

// fago o cambio do dir se se modificou 
// collo o nome do dir pra borralo.
$rexistro=mysql_query("SELECT dir FROM eventos WHERE id_evento=$id_evento",$enlace);
$fia=mysql_fetch_array($rexistro);
if ($dir != $fia['dir']){
	$dir1="";
	$vello = "../evento_config/" . $fia['dir'];
	$novo = "../evento_config/$dir";
if (!rename ($vello , $novo)) $dir1 = "<i>, non puido ser modificado.</i>";
} // fin do if de dir != fia['dir']

// sentencia SQL de modificacion dos datos.
		if (mysql_query("UPDATE eventos SET nome_evento='$nome', subnome='$subnome', data=$data, hora='$hora', tipo='$tipo', distancia='$distancia', organiza='$organiza', lugar='$lugar', inscri_inicio='$inscri_inicio', inscri_fin='$inscri_fin', limite='$limite', dir='$dir', evento_cod='$codigo', observacions='$observacions', regulamento='$regulamento', publi=$publi WHERE id_evento=$id_evento",$enlace)){
$regulamento = stripslashes($regulamento);
$observacions = stripslashes($observacions);
?>
<!-- Muestro la noticia completa (titulo, imagen, contenido, etc -->
<p> <h2> O evento foi modificado con exito </h2> </p>
<table cellpadding=3>
	<tr><td> <font size=+1> <? echo "$fecha"; ?> </font> </td>
	<td> <font size=+3> <? echo "$nome </font> <br> <font size=+1><i> $subnome </i></font> </td></tr>"; ?>
	<tr><td>&nbsp;</td><td> <br>  
<? echo" <p align=center>
Nome: $nome <br>
Subnome: $subnome <br>
Data: $fecha <br>
Hora: $hora <br>
Tipo: $tipo <br>
Distancia: $distancia <br>
Organiza: $organiza <br>
Lugar: $lugar <br>
Inicio da inscrici&oacute;n: $inscri_inicio <br>
Fin da inscrici&oacute;n: $inscri_fin <br>
L&iacute;mite de inscritos: $limite <br>
Directorio: $dir $dir1 <br>
C&oacute;digo: $codigo <br>
Observaci&oacute;ns: $observacions <br>
Publicar: $publica <br>
Regulamento: 
</p>
<p align=left>$regulamento </p>
";
?>
<div align="center">
<form name="f1" method="post" action="<?= $_SERVER['PHP_SELF'] ?>?corpo=operaevento&opera=modif" >
<input type="hidden" name="rdid" value="<?= $id_evento ?>">
<input type="submit" value="Modificar datos">
</form></div>
<?
}else{ // else do if do update 
echo"<h3>Erro: Non se modificaron os datos.</h3>
<p>Os datos non foron modificados por problemas alleos o administrador desta paxina</p>
";
} // fin do if que comproba que o update funcionou.

echo " 	</td></tr>
	</table>
";


} // fin do if do isset de modifica
?>