
<?php	

// comprobo que o id do evento foi enviado.
if ($id=$_POST['rdid']){

// collo o nome do dir pra borralo.
$rexistro=mysql_query("SELECT dir FROM eventos WHERE id_evento=$id",$enlace);
$fia=mysql_fetch_array($rexistro);
$ruta = "../evento_config/" . $fia['dir'] . "/*.*";
$rutaa = "../evento_config/" . $fia['dir'] ;

// procedo a borra-lo evento da taboa eventos.
if (mysql_query("DELETE FROM eventos WHERE ID_evento=$id",$enlace)){
	if (mysql_query("DELETE FROM inscritos WHERE evento=$id",$enlace)){
// se chega aqui, e que tamen borrou a xente da taboa inscitos asociada a este evento.
	echo "<h1> Evento borrado con exito </h1>";
// antes de borra-lo dir miro se existe.
if(is_dir($rutaa)){
//  o dir existe, procedo o borrado.
foreach(glob($ruta) as $arquivos) { 
 unlink($arquivos);     // Eliminamos todos los archivos de la carpeta hasta dejarla vacia 
}  // fin do foreach 
if (rmdir($rutaa)) echo "<p>O directorio: $ruta , borrouse correctamente.</p>";
} // fin do if de is_dir 

	}else{ // else do delete da taboa inscritos.
	echo "<h1>Erro: Non se borrou a xente inscrita no evento.</h1>
<p>Borrouse o evento e toda a sua informacion, pero non se puido borra-la xente inscrita no mesmo por un problema interno na base de datos alleo o Administrador desta paxina.</p>
";
} // fin do if de delete na taboa inscritos.
}else{ // else do delete do evento.
echo "<h1>Erro: Non se borrou o evento.</h1>
<p>Non se puido borra-lo evento por un problema da base de datos alleo o administrador desta paxina. Pero a xente inscrita a este evento, segue gardada na base de datos.</p>
";
} // fin do if de delete da taboa eventos.
}else{ // else do if do envio do id  do evento.
echo "<h1>Erro: Non se enviou o id do evento.</h1>
<p>Por algun motivo o id do evento non foi enviado, polo que non se puido proceder o borrado do evento.</p>
";
} // fin do if que mira o envio do id do evento.
?>