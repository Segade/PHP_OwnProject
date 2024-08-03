<?

if(isset($_GET["opera"])){
	$oper=$_GET["opera"];

		switch ($oper){
			case "modif":	include("../resultado/result_edit.php");
				break;
			default : echo"<h4>SEN CONTIDO</H4>";
		}// fin do switch

}else{
if (isset ($_POST['codigo']) ) {

	if (isset ($_POST['modificar']) ) 	include("../resultado/result_edit.php");
	else include("../resultado/result_borra.php");
}else{ 
	echo "<h2>Elixa un resultado ca que operar </h2>
<p align=center> [ <a href=\"javascript:history.go(-1)\">Volver Atr&aacute;s</a> ]  </p>
";
} //fin do if isset de codigo
} // fin do isset de oper

?>