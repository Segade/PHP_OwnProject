
<?php	


	$id=$_POST['rdid'];


	if (mysql_query("DELETE FROM resultado WHERE evento_res=$id",$enlace)){
	if (mysql_query("DELETE FROM res_eventos WHERE ID_res=$id",$enlace)){
		echo "<h3>Os resultados e o evento de resultado foron orrados con &Eacute;xito.</h3>
<p><a href=\"inperator.php?corpo=listaresev\"> Listaxe de eventos de resultados </a> </p>
";
	}else{ // else do if do borrado da taboa de res_eventos
		echo "<p>houbo un erro interno, polo que os resultados foron borrados pero o evento non.</p>";
	} // fin do if do borrado do if da taboa de res_eventos 
}else{ // else do if do borrado da taboa de resultado 
	echo "<p>Houbo un erro interno, polo que nin se borraron os resultados nin o evento.</p>";
} // fin do if do borrado da taboa resultado 
?>
