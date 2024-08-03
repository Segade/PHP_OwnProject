<?

if (!isset ($_POST['inscribe']) && !isset ($_POST['correxir']) ){
// se non se premeron inscribe nin corexir nin borrar, amoso a listaxe de eventos cos que operar.
		include("../inscricions/inscri_eventos.php");
} else { // else do if dos botóns de inscribe e correxir .
// premeuse algun boton, polo que procedo a face-la restectiva operacion.
if (isset ($_POST['inscribe']))		include("../inscricions/inscri_alta.php");
 
if (isset ($_POST['correxir']))		include("../inscricions/inscri_inscritos.php");

} // fin do if de inscribe e correxir.

?>