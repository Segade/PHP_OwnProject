<?
if (isset ($_POST['id_evento']) ){

if (!isset ($_POST['inscribe']) && !isset ($_POST['correxir'])  && !isset ($_POST['borrar'])){
// se non se premeron inscribe nin corexir nin borrar, amoso a listaxe de eventos cos que operar.
		include("../resultado/result_eventos.php");
} else { // else do if dos botóns de inscribe e correxir .
// premeuse algun boton, polo que procedo a face-la restectiva operacion.
if (isset ($_POST['inscribe']))		include("../resultado/result_alta.php");
 
if (isset ($_POST['correxir']))		include("../resultado/result_resultado_modif.php");

if (isset ($_POST['borrar']))		include("../resultado/result_resultado.php");

} // fin do if de inscribe e correxir.
}else{ // else do if de isset de id_evento 
echo " <h3> Erro: </h3>
<p>Debe elixir un evento co que operar.</p>
<p align=center> [ <a href=\"javascript:history.go(-1)\">Volver Atr&aacute;s</a> ]  </p>
";
} // fin do if de isset de id_evento 
?>