<?php 
function Conectarse() 
{ 
   if (!($enlace=mysql_connect("mysql17.000webhost.com","a9583070_scv","Vi11a1ucas"))) 
   { 
      echo "Error conectando a la base de datos."; 
      exit(); 
   } 
   if (!mysql_select_db("a9583070_bdd",$enlace)) 
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
}  // fin da funcion MySQLDateToDate($MySQLFecha) 





function inscricion_aberta($inicio,$fin, $limite,$contados) 
{
$date1 = date_create ($inicio);	
$date2 = date_create ($fin);	
$agora = new DateTime ( "now" );

if ($date1 <= $agora && $agora <= $date2){
     if ($limite == "0") return true ;
     else{
	$contados = $limite - $contados ;
	if ($contados > 0) return true ;
	else return false ;
     } // fin do if limite == "" 
}else
     return false ;
} // fin da funcion inscricion_aberta.




function formato_datahora($datahora) 
{ 
   $anaco=explode(" ",$datahora,2); 
$data= date("d/m/Y",strtotime($anaco[0]));

   $hour=explode(":",$anaco[1],3); 
   $hora = "$hour[0]:$hour[1]";
$prazo = "$data , $hora";

    return $prazo;
} // fin da funcion formato_datahora.


?> 