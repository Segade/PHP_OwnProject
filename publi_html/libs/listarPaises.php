<?php 
 session_start();
require_once('../../bdd.php');
$cn=  Conectarse();

  if (!isset($_SESSION['id_evento'])) exit;
$id = $_SESSION['id_evento'];
    if ( !is_numeric ($id )) $id = 0;
$listado=  mysql_query("select * from inscritos WHERE evento=$id",$cn);

?>

 <script type="text/javascript" language="javascript" src="js1/jslistadopaises.js"></script>



            <table cellpadding="0" cellspacing="0" border="0" class="display" id="tabla_lista_paises">
                <thead>
                    <tr>
                        <th>Apelidos e Nome</th> <th>-Categor&iacute;a</th>
 <th>Localidade</th>
 <th>Club</th>    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th></th>
                        <th></th>
                       
                     
                    </tr>
                </tfoot>
                  <tbody>
                    <?php

     
                   while($reg=  mysql_fetch_array($listado))
                   {
                               echo '<tr>';
                               echo '<td >'.mb_convert_encoding($reg['apelidos'], "UTF-8") . ', ' . mb_convert_encoding($reg['nome'], "UTF-8").'</td>';
                               echo '<td>'.mb_convert_encoding($reg['categoria'], "UTF-8").'</td>';
                              
echo '<td >'.mb_convert_encoding($reg['localidade'], "UTF-8").'</td>';
                               ;
echo '<td >'.mb_convert_encoding($reg['club'], "UTF-8").'</td>';
                               ;
 echo '</tr>';
                     
                        }
                    ?>
                <tbody>
            </table>
