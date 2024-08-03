<?

if (!isset ($_POST['adxudicar']) && !isset ($_POST['consultar']) ){
// Se non se premeron "individual"nin "colectivo" amoso os eventos cos que operar.
		include("../dorsal/dorsal_eventos.php");
} else { // else do if dos botóns de "individual" e "colectivo"
// premeuse algun boton, polo que procedo a face-la restectiva operacion.
if (isset ($_POST['adxudicar']))		include("../dorsal/dorsal_adxudicar.php");
 
if (isset ($_POST['consultar']))		include("../dorsal/dorsal_consulta.php");

} // fin do if de inscribe e correxir.

?>