<table border=3 cellpadding=3 width=100%>
<tr> <th>EVENTOS</th> <th> NOTICIAS </th> <th> RESULTADOS </th> <th> USUARIOS </TH> </tr>
<tr> 

<td>
<!-- opcions dos eventos -->
<?
if ($permisos['level']==1 || $permisos['level']==2){
?>
<p><h3><a href="<?= $_SERVER['PHP_SELF'] ?>?corpo=altaevento"> Engadir un novo evento. </a> </h3></p>
<p><h3> <a href="<?= $_SERVER['PHP_SELF'] ?>?corpo=listaevento"> Borrar ou Modificar un evento </a></h3></p>
<? } ?>
<p><h3> <a href="<?= $_SERVER['PHP_SELF'] ?>?corpo=inscricions"> Inscrici&oacute;ns dun evento </a></h3></p>
<p><h3> <a href="<?= $_SERVER['PHP_SELF'] ?>?corpo=dorsais"> Adxudicaci&oacute;n de dorsais </a></h3></p>
<p><h3> <a href="<?= $_SERVER['PHP_SELF'] ?>?corpo=xlseventos"> Exportar datos &aacute; formato XLS </a></h3></p>
<p><h3> <a href="<?= $_SERVER['PHP_SELF'] ?>?corpo=listapdf"> Crear listaxes en PDF </a></h3></p>

</td> 

<td>
<p><h3> <a href="<?= $_SERVER['PHP_SELF'] ?>?corpo=altanova"> Publicar unha nova noticia </a> </h3></p>
<!-- opcions das noticias  -->
<p><h3> <a href="<?= $_SERVER['PHP_SELF'] ?>?corpo=listanova"> Borrar ou Modificar unha noticia </a>/h3></p>
</td>
<td>
<!-- opcions dos resultados -->
<p><h3> <a href="<?= $_SERVER['PHP_SELF'] ?>?corpo=altaresev"> Crear un evento de resultado </a> </h3></p>
<p><h3> <a href="<?= $_SERVER['PHP_SELF'] ?>?corpo=listaresev"> Borrar ou Modificar un evento de resultado </a></h3></p>
<p><h3> <a href="<?= $_SERVER['PHP_SELF'] ?>?corpo=results"> Ligaz&oacute;ns dos Resultados dos eventos </a></h3></p>

</td>
<TD>
<!-- opcions de usuario -->
<p><h3> <a href="<?= $_SERVER['PHP_SELF'] ?>?corpo=logout"> Desconectar </a></h3></p>
<p><h3> <a href="<?= $_SERVER['PHP_SELF'] ?>?corpo=edituser"> Modificar datos </a></h3></p>
<? 
if ($permisos['level']==1){
?>
<p><h3> <a href="<?= $_SERVER['PHP_SELF'] ?>?corpo=novouser"> Crear un novo usuario </a></h3></p>
<p><h3> <a href="<?= $_SERVER['PHP_SELF'] ?>?corpo=listauser"> Listaxe de usuarios </a></h3></p>
<? } ?>
</TD>
</tr>
</table>

