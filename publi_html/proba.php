
Inicio

    Quien soy
    Servicios
    Blog
    Proyectos
    Escribeme

Exportar datos desde MySQL a Excel con PHP

Para generar  archivos Excel en base a una consulta de SQL  trabajare con la librería PHPExcel.


¿Qué es PHPExcel? es un proyecto  que proporciona un conjunto de clases para el lenguaje de programación PHP, que le permiten escribir y leer diferentes formatos de hojas de cálculo como por ejemplo  Excel (BIFF). Xls, Excel 2007 (OfficeOpenXML). Xlsx, CSV, Libre / OpenOffice Calc. Ods , Gnumeric, PDF, HTML, ... Este proyecto se basa en el estándar OpenXML Microsoft y PHP.
Inicialmente trabajaremos con la consulta sql, suponiendo que tenemos la siguiente tabla.

 CREATE TABLE IF NOT EXISTS `cities` (
  `id` int(11) NOT NULL AUTO_INCREMENT,    
  `province_id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=445 ;

 

1. Realizamos el código PHP que se conecte a la base de datos y nos traiga una lista de todas las ciudades que finalmente exportaremos a un formato Excel.

$conexion = mysql_connect ("localhost", "root", "");
 mysql_select_db ("ica", $conexion);    
 
 $sql = "SELECT * FROM cities ORDER BY name ASC";
 $resultado = mysql_query ($sql, $conexion) or die (mysql_error ());
 $registros = mysql_num_rows ($resultado);

mysql_close ();

2.    Implementaremos la librería PHPExcel con la siguiente línea, es necesario que primero descarges la libreria que se implementara dando clic aqui.

  require_once 'Classes/PHPExcel.php';. 


3.    Recorremos el resultado para realizar la impresión.

 if ($registros > 0) {
   require_once 'Classes/PHPExcel.php';
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
            ->setCellValue('A'.$i, $registro->name);
 
      $i++;
      
   }
}. 


4.    Escribimos la cabecera de nuestro código PHP.

header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="ejemplo1.xlsx"');
header('Cache-Control: max-age=0');

$objWriter=PHPExcel_IOFactory::createWriter($objPHPExcel,'Excel2007');
$objWriter->save('php://output');
exit;
mysql_close ();

