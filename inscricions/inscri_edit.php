<?
	$evento=$_POST['id_evento'];
if ( !is_numeric ($evento)) $evento = 0;
$sql="SELECT * FROM eventos WHERE id_evento=$evento";
$res=mysql_query($sql,$enlace);
$registro=mysql_fetch_array($res);
$nome_evento = $registro["nome_evento"];
$subnome=$registro["subnome"];
$data_evento =MySQLDateToDate($registro["data"]);

echo "
<table cellpadding=3 width=100%>
	<tr><td bgcolor=#ff6666> <font size=+3 weight=bold>$data_evento</font> </td>
	<td bgcolor=#ff6666> <font size=+3 weight=bold> $nome_evento </font> <br> <font size=+1><i> $subnome </i></font> </td></tr>
	<tr><td>&nbsp;</td><td> <br>
";

// o boton modifica e o que damos despois do form que edita os datos pra modificalos.
if (!isset ($_POST['modifica']) ) {
// entramos por 1 vez, polo que amosamo-los datos a modificar no form.
if (isset ($_POST['codigo']) ) {
// miramos que entramos con codigo, se non e que so introducimo-la url.
	$codigo=$_POST['codigo'];

 //Sentencia sql  
				$registro=mysql_query("SELECT * FROM inscritos WHERE id_inscri='$codigo[0]'",$enlace);

if($fia=mysql_fetch_array($registro)){
// existe o rexistro e amoso os datos.
?>
<form name="f1" method="post" action="<?= $_SERVER['PHP_SELF'] ?>?corpo=editinscri&opera=modif" >
<input type="hidden" name="id_evento" value="<?= $evento ?>">
<input type="hidden" name="codigo" value="<?= $codigo[0] ?>">
<table cellspacing="2" cellpadding="2">
<tr> <td align="left"> Nome:</td> <td align="left">
	<input type="text" name="nome" title="nome" autofocus value="<? echo $fia['nome']; ?>">
</td> </tr>

<tr> <td align="left"> Apelidos:</td> <td align="left">
	<input type="text" name="apelidos" title="apelidos" size="50" value="<? echo $fia['apelidos']; ?>">
</td> </tr>

<tr> <td align="left"> Dorsal:</td> <td align="left">
	<input type="text" name="dorsal" title="dorsal" size="5" value="<? echo $fia['dorsal']; ?>">
</td> </tr>


<tr> <td align="left"> DNI/NIE :</td> <td align="left">
	<input type="text" name="dni" title="DNI" size="10" value="<? echo $fia['dni']; ?>">
</td> </tr>

<tr> <td align="left"> Sexo:</td> <td align="left">
<select name="sexo" title="seleccione o seu sexo">
<option value="0">---</option>
<option value="M" 
<? if ($fia['sexo']=="M") echo " selected"; ?>
>Home</option>
<option value="F" 
<? if ($fia['sexo']=="F") echo " selected"; ?>
>Muller</option>
</select>
</td> </tr>
<tr> <td align="left"> Data de Nacemento::</td> <td align="left">
<INPUT TYPE="text" name="nacemento" size="15" value="<?= MySQLDateToDate($fia["nacemento"]) ?>" title="data de nacemento">
</td> </tr>
<tr> <td align="left"> E-mail:</td> <td align="left">
	<input type="email" name="correo" title="e-mail" size="35" value="<? echo $fia['correo']; ?>" >
</td> </tr>
<tr> <td align="left"> M&oacute;bil:</td> <td align="left">
	<input type="tel" name="mobil" title="mobil" size="15" pattern="[0-9]{9}" value="<? echo $fia['mobil']; ?>" >
</td> </tr>
<tr> <td align="left"> Enderezo:</td> <td align="left">
	<input type="text" name="enderezo" title="enderezo" size="50" value="<? echo $fia['enderezo']; ?>" >
<tr> <td align="left"> C&oacute;digo postal:</td> <td align="left">
	<input type="tel" name="postal" title="codigo postal" size="8" pattern="[0-9]{5}" value="<? echo $fia['postal']; ?>" >
</td> </tr>
</td> </tr>
<tr> <td align="left"> Provincia:</td> <td align="left">
	<input type="text" name="provincia" title="provincia" size="30" value="<? echo $fia['provincia']; ?>" >

</td> </tr>
<tr> <td align="left"> Localidade:</td> <td align="left">
	<input type="text" name="localidade" title="localidade" size="30" value="<? echo $fia['localidade']; ?>" >
</td> </tr>

<tr> <td align="left"> Categor&iacute;a:</td> <td align="left">
	<input type="text" name="categoria" title="categoria" size="20" value="<? echo $fia['categoria']; ?>" >
</td> </tr>

<tr> <td align="left"> Licencia:</td> <td align="left">
	<input type="text" name="licencia" title="licencia" size="15" value="<? echo $fia['licencia']; ?>" >
</td> </tr>
<tr> <td align="left"> Club:</td> <td align="left">
	<input type="text" name="club" title="club" size="25" value="<? echo $fia['club']; ?>" >
</td> </tr>
<tr> <td> &nbsp; </td> <td> &nbsp; </td> </tr>
<tr> <td> &nbsp; </td> <td align="right">
	<input type="submit" value="Modificar" name="modifica">
</td> </tr>
</table>
</form>
<?
} // fin do if fia=registro
}else{ // else do if de isset de rdid
	echo "<h3> Erro ca URL </h3>
<p align=center> [ <a href=\"javascript:history.go(-1)\">Volver Atr&aacutee;s</a> ]  </p>
";
}

}else{ //else do if do isset de post modifica
// entramos por 2 vez, polo que temo-los datos que queremos modificar do form e facemo-lo update.
	$codigo=$_POST['codigo'];
$nome = htmlentities($_POST['nome'], ENT_QUOTES, "utf-8");
	$apelidos = htmlentities($_POST['apelidos'], ENT_QUOTES, "utf-8");
$dorsal = $_POST['dorsal'];
	$dni=$_POST['dni'];
	$sexo=$_POST['sexo'];
	$correo=$_POST['correo'];
	$mobil=$_POST['mobil'];
	$data=$_POST['nacemento'];
	$enderezo=htmlentities($_POST['enderezo'], ENT_QUOTES, "utf-8");
	$postal=$_POST['postal'];
	$provincia=htmlentities($_POST['provincia'], ENT_QUOTES, "utf-8");
	$localidade=htmlentities($_POST['localidade'], ENT_QUOTES, "utf-8");
	$categoria=$_POST['categoria'];"---";
	$licencia=$_POST['licencia'];
	$club=htmlentities($_POST['club'], ENT_QUOTES, "utf-8");

 	$nacemento=DateToQuotedMySQLDate($data);

// sentencia SQL de modificacion dos datos.
		if (mysql_query("UPDATE inscritos SET nome='$nome', apelidos='$apelidos', dni='$dni', nacemento=$nacemento, sexo='$sexo', correo='$correo', mobil='$mobil', enderezo='$enderezo', postal='$postal', provincia='$provincia', localidade='$localidade', categoria='$categoria', licencia='$licencia', club='$club', dorsal='$dorsal' WHERE id_inscri='$codigo'",$enlace)){
?>
<!-- Amoso os datos modificados completos do inscrito. -->
 <h3> Os datos da persoa inscrita foron modificados con &eacute;xito. </h3> 
<table cellpadding=3>
<?
 echo"
<tr><td align=left><b> Nome: </b></td> <td align=left> $nome </td></tr>
<tr><td align=left><b> Apelidos: </b></td> <td align=left> $apelidos </td></tr>
<tr><td align=left><b> DNI/NIE: </b></td> <td align=left> $dni </td></tr>
<tr><td align=left><b> Data de nacemento: </b></td> <td align=left> $data </td></tr>
<tr><td align=left><b> E-mail: </b></td> <td align=left> $correo </td></tr>
<tr><td align=left><b> M&oacute;bil: </b></td> <td align=left> $mobil </td></tr>
<tr><td align=left><b> Enderezo: </b></td> <td align=left> $enderezo </td></tr>
<tr><td align=left><b> C&oacute;digo postal: </b></td> <td align=left> $postal </td></tr>
<tr><td align=left><b> Provincia: </b></td> <td align=left> $provincia </td></tr>
<tr><td align=left><b> Localidade: </b></td> <td align=left> $localidade </td></tr>
<tr><td align=left><b> Categor&iacute;a: </b></td> <td align=left> $categoria </td></tr>
<tr><td align=left><b> Licencia: </b></td> <td align=left> $licencia </td></tr>
<tr><td align=left><b> Club: </b></td> <td align=left> $club </td></tr>
<td align=left><b> </b></td> <td align=left> </td>
	</table>
";

}else{ // else do if do update 
echo"
<h3>Erro: Non se modificaron os datos.</h3>
<p>Os datos non foron modificados por problemas alleos o administrador desta paxina. Int&eacute;nteo de novo m&aacute;is tarde.</p>
";
} // fin do if que comproba que o update funcionou.

} // fin do if do isset de modifica
// pecho a taboa que abre cos datos do evento de arriba de todo.
echo "
</td></tr>
	</table>
";

?>