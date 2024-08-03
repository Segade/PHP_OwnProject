<?php	

if (!isset ($_POST['enviar']) ) 
// se non se premeu o boton enviar, e que entras na paxina por 1 vez e amosase o formulario.
include("../eventos/evento_form.htm");
else{ // se non está activo o boton enviar, gardanse os datos do evento na taboa.

	$nome=mysql_real_escape_string($_POST['nome']);
	$subnome=mysql_real_escape_string($_POST['subnome']);
	$tipo=mysql_real_escape_string($_POST['tipo']);
	$distancia=mysql_real_escape_string($_POST['distancia']);
	$organiza=mysql_real_escape_string($_POST['organiza']);
	$lugar =mysql_real_escape_string($_POST['lugar']);
	$limite=$_POST['limite'];
	$dir=$_POST['dir'];
	$codigo = $_POST['codigo'];
$observacions = htmlentities($_POST['observacions'], ENT_QUOTES, "utf-8");
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

if (mysql_query("insert into eventos (nome_evento, subnome, data, hora, tipo, distancia, organiza, lugar, inscri_inicio, inscri_fin, limite, dir, evento_cod, observacions, regulamento, publi) values 
('$nome', '$subnome', $data, '$hora', '$tipo', '$distancia', '$organiza', '$lugar', '$inscri_inicio', '$inscri_fin', '$limite', '$dir', '$codigo', '$observacions', '$regulamento', $publi)",$enlace)){

$ruta = "../evento_config/$dir";
if(!is_dir($ruta)){
	mkdir($ruta, 0777, true);
}else{ 
	$dir = "$dir, Xa existia";
}
$regulamento = stripslashes($regulamento);
$observacions = stripslashes($observacions);

?>
<h4>Gracias</h4>
<p> <h3> O Evento foi engadido con &eacute;xito.</h3> </p>

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
Directorio: $dir <br>
C&oacute;digo: $codigo <br>
Observaci&oacute;ns: $observacions <br>
Publicar: $publica <br>
Regulamento: 
</p>
<p align=left>$regulamento </p>

 	</td></tr>
	</table>
<div align=\"center\">
";
$rs = mysql_query("SELECT MAX(id_evento) FROM eventos", $enlace);
$id = mysql_fetch_row($rs);
?>
<form name="f1" method="post" action="<?= $_SERVER['PHP_SELF'] ?>?corpo=operaevento&opera=modif" >
<input type="hidden" name="rdid" value="<?= $id[0] ?>">
<input type="submit" value="Modificar datos">
</form></div>

<?
}else{ // else do if do insert.
echo " <h3>Erro: Non se puido engadir este evento.</3>
<p>Non se puido engadir este evento, por problemas internos na base de datos alleos o administrador desta paxina web.</p>
";
} // fin do if do insert.
} // fin do if isset de enviar
?>