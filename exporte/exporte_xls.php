<?
    include '../sesions/db_connect.php';
    include '../sesions/functions.php';
    sec_session_start(); //Nuestra manera personalizada segura de iniciar sesión php.

    if(login_check($mysqli) == true) {
$nome = "datos_evento" . date("y") . "xls";
header('Content-type: application/vnd.ms-excel;charset=utf-8');
header("Content-Disposition: attachment; filename=$nome");
header("Pragma: no-cache");
header("Expires: 0");

  	include("../bdd.php");
 	$enlace=Conectarse();
 
$evento = $_POST['id_evento'];	
$sql = "SELECT * FROM inscritos WHERE evento=$evento ORDER BY dorsal, apelidos, nome";
$res=mysql_query($sql,$enlace);
echo "<table boder=\"3\">
<tr>
";
while($campos = mysql_fetch_field($res)){
echo "<th> $campos->name </th>";
} // fin do while dos nomes das fias.
$numero_campos=mysql_num_fields($res);

 while($fia = mysql_fetch_array($res)){
echo "</tr> <tr>"; 
for ($x=0;$x<$numero_campos;$x++){
//	$fia[x] = html_entity_decode($fia[x]);
	echo "<td>". mb_convert_encoding($fia[$x], "UTF-8") ."</td>";
} // fin do for do repaso dos campos.
echo "</tr>";
} // fin do while da consulta de rexistros.
echo "</table>";
// echo $numero_campos ;
}else{ // else do if de check da sesion.
echo "<h3>Erro:</h3>  <br>
<p>This Webpage is not available </p>
";
} // fin do if do check da sesion 
?>