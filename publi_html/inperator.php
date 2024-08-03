<!DOCTYPE html>
<html lang="es">

<head>
<title> Imperator </title>
        <meta charset="utf-8">
	<link rel="stylesheet" href="estilos.css" type="text/css">
<script src="escripts.js"></script>
    <script type="text/javascript" src="ad/sha512.js"></script>
    <script type="text/javascript" src="ad/forms.js"></script>
    <script type="text/javascript" src="js1/jquery.js"></script>

  <style type="text/css">
  .impera {
font-family:Arial;
    font-size:150%;

  </style>
</head>
<body
<?
    include '../sesions/db_connect.php';
    include '../sesions/functions.php';
    sec_session_start(); //Nuestra manera personalizada segura de iniciar sesión php.

date_default_timezone_set ( 'Europe/Madrid' );
 		if(isset($_GET["corpo"])) {
	if ($_GET["corpo"]=="altanova" && !$_POST["enviar"]) 
		echo "onload=obterdata() "; 
}

?>
>

<table height="100%" width="100%">
<tr> <td align="center" height="15%"> <a href="<?= $_SERVER['PHP_SELF'] ?>" class="impera"> <b> Imperator </b> </a>   <br><p> P&aacute;xina de operaci&oacute;ns de administrador. </p>

</td> </tr>
<tr> <td align="center" valign="midle">

<?
// comprobo se hai sesion iniciada 
    if(login_check($mysqli) == true) {
  	include("../bdd.php");
 	$enlace=Conectarse();
$sql = "SELECT level FROM members WHERE id=" . $_SESSION['user_id'];
				$registro=mysql_query($sql,$enlace);
$permisos=mysql_fetch_array($registro);

// miro que opcion de paxina elixiu o usuario
		if(isset($_GET["corpo"])){ 

	$oper=$_GET["corpo"];
		switch ($oper){
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

			case "altaevento": if ($permisos['level']==1 || $permisos['level']==2)	include("../eventos/evento_alta.php");
				else include ("../fichs_php/faraon.php");
				break;
			case "operaevento": if ($permisos['level']==1 || $permisos['level']==2)	include("../eventos/evento_opera.php");
				else include ("../fichs_php/faraon.php");
				break;
			case "listaevento": if ($permisos['level']==1 || $permisos['level']==2)	include("../eventos/evento_lista.php");
				else include ("../fichs_php/faraon.php");
				break;

			case "inscricions":	include("../inscricions/inscri_eventos.php");
				break;
			case "operainscri":	include("../inscricions/inscricions.php");
				break;
			case "editinscri":	include("../inscricions/inscri_opera.php");
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

			case "logout":	include("../sesions/logout.php");
				break;

			case "edituser":	include("../user/user_edit.php");
				break;
			case "novouser": if ($permisos['level']==1)	include("../user/user_novo.php");
				else include ("../fichs_php/faraon.php");
				break;
			case "listauser": if ($permisos['level']==1)	include("../user/user_lista.php");
				else include ("../fichs_php/faraon.php");
				break;
			case "operauser":	include("../user/user_opera.php");
				break;

			case "altaresev":	include("../res_eventos/res_alta.php");
				break;
			case "operaresev":	include("../res_eventos/res_opera.php");
				break;
			case "listaresev":	include("../res_eventos/res_lista.php");
				break;

			case "results":	include("../resultado/result_eventos.php");
				break;
			case "operaresult":	include("../resultado/resultado.php");
				break;
			case "editresult":	include("../resultado/result_opera.php");
				break;

			default : include ("../fichs_php/faraon.php");
		}// fin do switch

}else{  // se a variable corpo da url non esta activa.
	include ("../fichs_php/faraon.php");
} // fin do if isset corpo.
  	mysql_close($enlace); 

}else{ // else do if de login_check 
// formulario de inicio de sesion
    if(isset($_GET['error'])) {
       echo 'Erro Logging In!';
    }
    ?>
    <form action="ad/inclusion.php" method="post" name="login_form">
       Email: <input type="text" name="email" title="e-mail"/><br />
       Password: <input type="password" name="password" id="password" title="chave"/><br />
       <input type="button" value="Login" onclick="formhash(this.form, this.form.password);" />
    </form>
<?
} // fin if de login_check 
?>

</td> </tr>
</table>
</body>
</html>