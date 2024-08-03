<!DOCTYPE html>
<html lang="es">
<head>
<title>
<? 
		if(isset($_GET["corpo"])){ 
	$oper=$_GET["corpo"];
		switch ($oper){

			case "erro":	include("../fichs_php/a.php");
				break;

			case "eventos":	echo "INSCRICIONS - ";
	$current = "2";
				break;
			case "evento":	echo "INFO - ";
	$current = "2";
				break;
			case "formevento":	echo "FORMULARIO INSCRICION - ";
	$current = "2";
				break;
//			case "nova":	echo "NOVA - ";
//	$current = "1";
//				break;
			case "resul":	echo "RESULTADOS - ";
	$current = "3";
				break;
			case "gardarex":	echo "Resultado DA INSCRICION - ";
	$current = "2";
				break;
			case "listains":	echo "LISTAXE INSCRITOS - ";
	$current = "2";
				break;

			case "otempo":	echo "O TEMPO - ";
	$current = "0";
				break;

			case "chegar":	echo "Como Chegar - ";
	$current = "5";
				break;

			default : $current = "1";
	echo "PORTADA - ";

		}// fin do switch

}else{  // se a variable corpo da url non esta activa.
	echo "PORTADA - ";
	$current = "1";
}// fin do if corpo.
?>
Carreira popular concello de Mes&iacute;a</title>
        <meta charset="utf-8">
<script type="text/javascript" src="js1/validacion.js"></script>
 
<!--    ESTILO GENERAL    -->
        <!--    JQUERY   -->
        <script type="text/javascript" src="js1/jquery.js"></script>
        <script type="text/javascript" language="javascript" src="js1/funciones.js"></script>
        <!--    JQUERY    -->
        <!--    FORMATO DE TABLAS    -->
        <link type="text/css" href="css1/jquery.dataTables.css" rel="stylesheet" />
        <script type="text/javascript" language="javascript" src="js1/jquery.dataTables.js"></script>
        <!--    FORMATO DE TABLAS    -->

   



<link type="text/css" href="css1/estilos.css" rel="stylesheet" />
<link type="text/css" href="css1/superfish.css" rel="stylesheet" />
<link type="text/css" href="css1/font-awesome.css" rel="stylesheet" />
		<link rel="icon" href="images/favicon.ico">
		<link rel="shortcut icon" href="images/favicon.ico" />

<link type="text/css" href="css1/jquery.countdown.css" rel="stylesheet" />
<style type="text/css">
.defaultCountdown { width: 240px; height: 45px; float:left; }
</style>
<script type="text/javascript" src="js1/jquery.countdown.js"></script>
<script type="text/javascript" src="js1/jquery.countdown-es.js"></script>
<script type="text/javascript">
$(function () {
	var austDay = new Date();
	date_end = new Date(2016, 8 - 1, 13);
	$('#defaultCountdown').countdown({until: date_end});
});
</script>

</head>
<body <? if ($current==1) echo "onload=\"countDown()\""; ?>>

<!-- taboa principal da paxina. -->
<table  height="100%" width="100%"> 
<tr> <td height="5" colspan="2"> 
<!-- cela onde estan o logo e mailo menu -->
<header>
<div id="cabeceira" style="background: url(images/corredores_B.JPG);"  class="logo">
 Mes&iacute;a 
</div> 
</header>
						<div class="menu_block " width="100%">
							<nav class="horizontal-nav full-width horizontalNav-notprocessed">
								<ul class="sf-menu">
									<li <? if ($current == "1") echo ' class="current"'; ?>><a href="<?= $_SERVER['PHP_SELF'] ?>">PORTADA</a></li>
									<li <? if ($current == "2") echo ' class="current"'; ?>><a href="<?= $_SERVER['PHP_SELF'] ?>?corpo=eventos">INSCRICIONS</a></li>
									<li <? if ($current == "3") echo ' class="current"'; ?>><a href="<?= $_SERVER['PHP_SELF'] ?>?corpo=resul">RESULTADOS</a></li>

									<li <? if ($current == "5") echo ' class="current"'; ?>><a href="<?= $_SERVER['PHP_SELF'] ?>?corpo=chegar">COMO CHEGAR</a></li>
								</ul>
							</nav>
</div>


<div style=" border-top : 1pt solid black;border-bottom : 1pt solid black; "  align="center">
<b> 
<?
date_default_timezone_set ( 'Europe/Madrid' );
$a = date("N");
$b = date("j");
$c = date("n");
$d = date("Y");
    $diadasemana = array(        1 => 'L&uacute;ns', 2 => 'Martes', 3 => 'M&eacute;rcores', 4 => 'Xoves', 5 => 'Venres', 6 => 'S&aacute;bado' , 7 => 'Domingo');

    $mesdoano = array(1 => 'Xaneiro', 2 => 'Febreiro', 3 => 'Marzo', 4 => 'Abril', 5 => 'Maio',
6 => 'Xu&ntilde;o', 7 => 'Xullo', 8 => 'Agosto', 9 => 'Setembro', 10 => 'Outubro', 11 => 'Novembro', 12 => 'Decembro');

echo "$diadasemana[$a], $b de $mesdoano[$c] do $d";
?>
</b>
</div>
</td> </tr> 
<tr> <td valign="top" width="250px">
<div align="center" id="defaultCountdown"></div>

<br> <br>
<!-- menu lateral da esquerda-->
<section id="left_menu">
<p><b>Outros:</b></p>
						<ul class="list1 color1">
							<li><a href="<?= $_SERVER['PHP_SELF'] ?>?corpo=otempo">O tempo en Mes&iacute;a </a></li>
							<li><a href="http://concellodemesia.es/" target="_blank">concello de Mes&iacute;a </a></li>
							<li><a href="https://www.facebook.com/pages/Deporte-Concello-Mes%C3%ADa/410479909027448" class="fa fa-facebook" target="_blank"><b>Deporte en Mes&iacute;a</b></a></li>
						</ul>
</section>
</td>
<td>
<!-- cela onde ira o groso da paxina. -->
<section id="contido">
<?
  	include("../bdd.php");
 	$enlace=Conectarse();

		if(isset($_GET["corpo"])){ 

	$oper=$_GET["corpo"];
		switch ($oper){

			case "erro":	include("../fichs_php/a.php");
				break;


			case "eventos":	include("../fichs_php/eventos.php");
				break;
			case "evento":	include("../fichs_php/evento.php");
				break;
			case "formevento":	include("../fichs_php/evento_form_inscri.php");
				break;
//			case "nova":	include("../fichs_php/nova.php");
//				break;
			case "resul":	include("../fichs_php/result.php");
				break;
			case "gardarex":	include("../fichs_php/inscri_alta.php");
				break;
			case "listains":	include("../fichs_php/listaxe_inscritos_jq.php");
				break;

			case "regulpdf":	include("../fichs_php/regul_en_pdf.php");
				break;
			case "otempo":	include("../fichs_php/otempo.html");
				break;

			case "chegar":	include("../fichs_php/chegar.htm");
				break;

			default : include("../fichs_php/novas.php");
		}// fin do switch

}else{  // se a variable corpo da url non esta activa.
include("../fichs_php/novas.php");
}// fin do if corpo.
  	mysql_close($enlace); 

?>
</section>
<br> <br> <br>
<section id="colabora">
<div align="left">
<B> COLABORADORES: </b>
<br> <br>
<p>Correr en Galicia, Carpinter&iacute;a Ram&oacute;n Garc&iacute;a, Coca-cola, Atletismo Ordes, Atl&eacute;tica A Silva, Froiter&iacute;a A Nova, Eurofrut, Casa Grande, Argal, Panader&iacute;as Abell&aacute;, Visanto&ntilde;a, Gende, Pedro Fern&aacute;ndez, Boga, Casa Zapateiro, A Tilleira. Pascual, &ldquo;A Fonte&rdquo; Mes&oacute;n do Vento, Restaurantes Canaima e Manteiga, Cooperativa de Frades, Pinturas Tocho Betanzos, Progando, Banco Santander, A Banca, Eroski, Verea tejas y tejados, Campo Brick S.L., Asociaci&oacute;n provincial de Protecci&oacute;n Civil, Veci&ntilde;os de Olas Visanto&ntilde;a e Mes&iacute;a.</p>
</div>
</section>
</td></tr>
<tr><td colspan="2" align="center">
<footer>
<div style=" border-top : 1pt solid black;"  align="center">
&copy; Carreira Popular Concello de mes&iacute;a.
</div>
</footer>
</td> </tr></table>
</body>
</html>