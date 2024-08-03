
<?php	

// comprobo que o id do evento foi enviado.
if ($id=$_POST['rdid']){


// procedo a borra-lo evento da taboa eventos.
if (mysql_query("DELETE FROM members WHERE ID=$id",$enlace)){
echo " <h2>Borrado completado </h2>
<p>O usuario foi borrado corréctamente.</p>
";

}else{ // else do delete do evento.
echo "<h2>Erro: Non se borrou o usuario.</h2>
<p>Non se puido borra-lo usuario por un problema da base de datos alleo o administrador desta paxina. Pero a xente inscrita a este evento, segue gardada na base de datos.</p>
";
} // fin do if de delete da taboa eventos.
}else{ // else do if do envio do id  do evento.
echo "<h2>Erro: Non se enviou o id do evento.</h2>
<p>Por algun motivo o id do usuario non foi enviado, polo que non se puido proceder o borrado do usuario.</p>
";
} // fin do if que mira o envio do id do evento.
?>