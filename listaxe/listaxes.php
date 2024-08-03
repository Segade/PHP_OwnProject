<?

if (!isset ($_POST['xerar'])){
// Se non se premeron "individual"nin "colectivo" amoso os eventos cos que operar.
		include("../listaxe/listaxe_eventos.php");
} else { // else do if dos botóns de "individual" e "colectivo"
// premeuse algun boton, polo que procedo a face-la restectiva operacion.
 
if (isset ($_POST['xerar']))		include("../listaxe/listaxe_opcions.php");

} // fin do if de inscribe e correxir.

?>