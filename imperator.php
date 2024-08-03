pdf
<!DOCTYPE html>
<html lang="es">

<head>
<title> Imperator </title>
        <meta charset="utf-8">
	<link rel="stylesheet" href="estilos.css" type="text/css">
<script src="escripts.js"></script>

  <style type="text/css">
  .impera {
font-family:Arial;
    font-size:150%;

  </style>
</head>
<body
<?
 		if(isset($_GET["corpo"])) {
	if ($_GET["corpo"]=="altanova" && !$_POST["enviar"]) 
		echo "onload=obterdata() "; 
}
?>
>

<table height="100%" width="100%">
<tr> <td align="center" height="15%"> <a href="<?= $_SERVER['PHP_SELF'] ?>" class="impera"> <b> Imperator </b> </a>   <br><p> P&aacute;xina de operaci&oacute;ns de administrador. </p>
</td> </tR>
<tr> <td align="center" valign="midle">

<?
		if(isset($_GET["corpo"])){ 
  	include("../bdd.php");
 	$enlace=Conectarse();

	$oper=$_GET["corpo"];
		switch ($oper){
			case "altaevento":	include("../eventos/evento_alta.php");
				break;
			case "operaevento":	include("../eventos/evento_opera.php");
				break;
			case "listaevento":	include("../eventos/evento_lista.php");
				break;

			case "altanova":	include("../novas/nova_alta.php");
				break;
			case "operanova":	include("../novas/nova_opera.php");
				break;
			case "listanova":	include("../novas/nova_lista.php");
				break;

			case "altares":	include("../resultados/res_alta.php");
				break;
			case "operares":	include("../resultados/res_opera.php");
				break;
			case "listares":	include("../resultados/res_lista.php");
				break;

			case "inscricions":	include("../inscricions/inscri_eventos.php");
				break;
			case "operainscri":	include("../inscricions/inscricions.php");
				break;
			case "editinscri":	include("../inscricions/inscri_opera.php");
				break;

			case "correos":	include("../email/email_eventos.php");
				break;
			case "email1":	include("../email/email_individual.php");
				break;
			case "operaemail":	include("../email/emails.php");
				break;

			case "dorsais":	include("../dorsal/dorsais.php");
				break;
			case "consultadorsal":	include("../dorsal/dorsal_consulta.php");
				break;

			case "xlseventos":	include("../exporte/exporte_eventos.php");
				break;
			case "xlsexp":	include("../exporte/exporte_xls.php");
				break;
			case "listapdf":	include("../listaxe/listaxes.php");
				break;

			case "logout":	include("../user/logout.php");
				break;

			case "edituser":	include("../user/user_edit.php");
				break;
			case "novouser":	include("../user/user_novo.php");
				break;
			case "listauser":	include("../user/user_lista.php");
				break;

			default : echo"<h4 align=center>SEN CONTIDO</H4>";
		}// fin do switch

  	mysql_close($enlace); 
}else{  // se a variable corpo da url non esta activa.
?>
<table border=3 cellpadding=3 width=100%>
<tr" <th> EVENTOS </th> <th> NOTICIAS </th> <th> RESULTADOS </th> <th> USUARIOS </th> </tr>
<tr> 
<td>
<!-- opcions de eventos -->
<p><h3><a href="<?= $_SERVER['PHP_SELF'] ?>?corpo=altaevento"> Engadir un novo evento. </a> </h3></p>
<p><h3> <a href="<?= $_SERVER['PHP_SELF'] ?>?corpo=listaevento"> Borrar ou Modificar un evento </a></h3></p>
<p><h3> <a href="<?= $_SERVER['PHP_SELF'] ?>?corpo=inscricions"> Inscrici&oacute;ns dun evento </a></h3></p>
<p><h3> <a href="<?= $_SERVER['PHP_SELF'] ?>?corpo=correos"> Enviar E-mails &oacute;s participantes dun evento </a></h3></p>
<p><h3> <a href="<?= $_SERVER['PHP_SELF'] ?>?corpo=dorsais"> Adxudicaci&oacute;n de dorsais </a></h3></p>
<p><h3> <a href="<?= $_SERVER['PHP_SELF'] ?>?corpo=xlseventos"> Exportar datos &aacute; formato XLS </a></h3></p>
<p><h3> <a href="<?= $_SERVER['PHP_SELF'] ?>?corpo=listapdf"> Crear listaxes en PDF </a></h3></p>

</td> 
<td>
<!-- opcions de novas -->
<p><h3> <a href="<?= $_SERVER['PHP_SELF'] ?>?corpo=altanova"> Publicar unha nova noticia </a> </h3></p>
<p><h3> <a href="<?= $_SERVER['PHP_SELF'] ?>?corpo=listanova"> Borrar ou Modificar unha noticia </a>/h3></p>
</td>
<td>
<!-- opcions de resultados -->
<p><h3> <a href="<?= $_SERVER['PHP_SELF'] ?>?corpo=altares"> Publicar un novo resultado </a> </h3></p>
<p><h3> <a href="<?= $_SERVER['PHP_SELF'] ?>?corpo=listares"> Borrar ou Modificar un resultado </a></h3></p>
</td>
<td>
<!-- opcions de usuario -->
<p><h3> <a href="<?= $_SERVER['PHP_SELF'] ?>?corpo=logout"> Desconectar </a></h3></p>
<p><h3> <a href="<?= $_SERVER['PHP_SELF'] ?>?corpo=edituser"> Modificar datos </a></h3></p>
<p><h3> <a href="<?= $_SERVER['PHP_SELF'] ?>?corpo=novouser"> Crear un novo usuario </a></h3></p>
<p><h3> <a href="<?= $_SERVER['PHP_SELF'] ?>?corpo=listauser">Listaxe de usuarios </a></h3></p>
</td>
</tr>
</table>

<?
} // fin do if isset corpo.
?>

</td> </tr>
</table>
</body>
</html>