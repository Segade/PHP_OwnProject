<?

if(isset($_GET["opera"])){
	$oper=$_GET["opera"];

		switch ($oper){
			case "modif":	include("../inscricions/inscri_edit.php");
				break;
			default : echo"<h4>SEN CONTIDO</H4>";
		}// fin do switch

}else{
if (isset ($_POST['codigo']) ) {

	if (isset ($_POST['modificar']) ) 	include("../inscricions/inscri_edit.php");
	else include("../inscricions/inscri_borra.php");
}else{ 
	echo "<h3>Elixa unha persoa ca que operar </h3>
<p align=center> [ <a href=\"javascript:history.go(-1)\">Volver Atr&aacute;s</a> ]  </p>
";
} //fin do if isset de codigo
} // fin do isset de oper

?>