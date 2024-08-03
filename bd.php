<?php 
function Conectarse() 
{ 
   if (!($enlace=mysql_connect("mysql17.000webhost.com","a5488354_scv","ka2ina"))) 
   { 
      echo "Error conectando a la base de datos."; 
      exit(); 
   } 
   if (!mysql_select_db("a5488354_BdD",$enlace)) 
   { 
      echo "Error seleccionando la base de datos."; 
      exit(); 
   } 
   return $enlace; 
} 

$enlace=Conectarse(); 
mysql_close($enlace); //cierra la conexion 

function DateToQuotedMySQLDate($Fecha) 
{ 
if ($Fecha<>""){ 
   $trozos=explode("/",$Fecha,3); 
   return "'".$trozos[2]."-".$trozos[1]."-".$trozos[0]."'"; } 
else 
   {return "NULL";} 
} 

function MySQLDateToDate($MySQLFecha) 
{ 
if (($MySQLFecha == "") or ($MySQLFecha == "0000-00-00") ) 
    {return "";} 
else 
    {return date("d/m/Y",strtotime($MySQLFecha));} 
} 
?> 
