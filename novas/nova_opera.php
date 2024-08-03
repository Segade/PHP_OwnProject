<?

if(isset($_GET["opera"])){
	$oper=$_GET["opera"];

		switch ($oper){
			case "modif":	include("../novas/nova_edit.php");
				break;
			default : echo"<h4>SEN CONTIDO</H4>";
		}// fin do switch

}else{
if (isset ($_POST['rdid']) ) {

	if (isset ($_POST['modificar']) ) 	include("../novas/nova_edit.php");
	else include("../novas/nova_borra.php");
}else{ 
	echo "<h2>Elixa unha noticia ca que operar </h2>
<p align=center> [ <a href=\"javascript:history.go(-1)\">Volver Atr&aacute;s</a> ]  </p>
";
} //fin do if isset de rdid
} // fin do isset de oper

?>