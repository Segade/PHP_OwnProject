<?
$conexion = mysql_connect("mysql17.000webhost.com","a9583070_scv","Vi11a1ucas");
 mysql_select_db ("a9583070_bdd", $conexion);    
 
 $sql = "SELECT * FROM inscritos WHERE evento=34 ORDER BY dorsal, apelidos, nome";
 $resultado = mysql_query ($sql, $conexion) or die (mysql_error ());
 $registros = mysql_num_rows ($resultado);

mysql_close ();
// engadir phpexcell 
require_once 'clases/PHPExcel.php';

 if ($registros > 0) {
   require_once 'Clases/PHPExcel.php';
   $objPHPExcel = new PHPExcel();
   
   //Informacion del excel
   $objPHPExcel->
    getProperties()
        ->setCreator("ingenieroweb.com.co")
        ->setLastModifiedBy("ingenieroweb.com.co")
        ->setTitle("Exportar excel desde mysql")
        ->setSubject("Ejemplo 1")
        ->setDescription("Documento generado con PHPExcel")
        ->setKeywords("ingenieroweb.com.co  con  phpexcel")
        ->setCategory("ciudades");    

   $i = 1;    
   while ($registro = mysql_fetch_object ($resultado)) {
       
      $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A'.$i, $registro->nome);
 
      $i++;
      
   }
} 



header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="ejemplo1.xlsx"');
header('Cache-Control: max-age=0');

$objWriter=PHPExcel_IOFactory::createWriter($objPHPExcel,'Excel2007');
$objWriter->save('php://output');
exit;
mysql_close ();

?>