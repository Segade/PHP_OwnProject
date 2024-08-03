<?

if(isset($_GET["opera"])){
	$oper=$_GET["opera"];

		switch ($oper){
			case "modif":	include("../eventos/evento_edit.php");
				break;
			default : echo"<h4>SEN CONTIDO</H4>";
		}// fin do switch

}else{
if (isset ($_POST['rdid']) ) {

	if (isset ($_POST['modificar']) ) 	include("../eventos/evento_edit.php");
	else include("../eventos/evento_borra.php");
}else{ 
	echo "<h2>Elixa un evento co que operar </h2>
<p align=center> [ <a href=\"javascript:history.go(-1)\">Volver Atr&aacute;s</a> ]  </p>
";
} //fin do if isset de rdid
} // fin do isset de oper

?>