<?php
// informacion adicional $evento = $_POST['id_evento'];	
$sql = "SELECT * FROM inscritos WHERE evento=$evento ORDER BY dorsal, apelidos, nome";
$res=mysql_query($sql,$enlace);
$sql = "SELECT nome_evento FROM eventos WHERE id_evento=$evento";
$result = mysql_query($sql,$enlace);
$fia=mysql_fetch_array($result);
$nome_evento = str_replace(' ', '', $fia['nome_evento']);


/** Incluir la libreria PHPExcel */
require_once 'clases/PHPExcel.php';
 
// Crea un nuevo objeto PHPExcel
$objPHPExcel = new PHPExcel();
 
// Establecer propiedades
$objPHPExcel->getProperties()
->setCreator("Cattivo")
->setLastModifiedBy("Cattivo")
->setTitle("Documento Excel de Prueba")
->setSubject("Documento Excel de Prueba")
->setDescription("Demostracion sobre como crear archivos de Excel desde PHP.")
->setKeywords("Excel Office 2007 openxml php")
->setCategory("Pruebas de Excel");



 
// Agregar Informacion
$objPHPExcel->setActiveSheetIndex(0)
->setCellValue('A1', 'Valor 1')
->setCellValue('B1', 'Valor 2')
->setCellValue('C1', 'Total')
->setCellValue('A2', '10')
->setCellValue('b2', '50')
// ->setCellValue('C2', '=sum(A2:B2)');
->setCellValue('C2', 'pasa');
$row = "3";
$column = "3";
$value = "codigo valido ";
// ->setCellValueByColumnAndRow($column, $row, $value);

 
// Renombrar Hoja
$objPHPExcel->getActiveSheet()->setTitle('Inscritos');
 
// Establecer la hoja activa, para que cuando se abra el documento se muestre primero.
$objPHPExcel->setActiveSheetIndex(0);
 
// Se modifican los encabezados del HTTP para indicar que se envia un archivo de Excel.
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="datos.xlsx"');
header('Cache-Control: max-age=0');
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');
exit;
?>

