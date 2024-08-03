<?php
// informacion adicional 
 $enlace = mysql_connect("mysql17.000webhost.com","a9583070_scv","Vi11a1ucas");
 mysql_select_db ("a9583070_bdd", $enlace);    



//    	include("../bdd.php");
//   	$enlace=Conectarse();
// $evento = $_POST['id_evento'];	
$evento = 34;
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
$x = 2;

 while($rexistro = mysql_fetch_array($res)){

$objPHPExcel->setActiveSheetIndex(0)
->setCellValue('A'.$x, $rexistro['nome'] );
$x++;
} // fin do while do nome




//$objPHPExcel->setActiveSheetIndex(0)
->setCellValue('A1', 'Nome')
->setCellValue('B1', 'Apelidos')
->setCellValue('C1', 'Data de Nacemento')
// ->setCellValue('A2', '10')
// ->setCellValue('b2', '50')
// ->setCellValue('d2', $nome_evento);


 
// Renombrar Hoja
//$objPHPExcel->getActiveSheet()->setTitle('Inscritos');
 
// Establecer la hoja activa, para que cuando se abra el documento se muestre primero.
//$objPHPExcel->setActiveSheetIndex(0);
$nome_evento = "Datos_XLS_$nome_evento.xlsx"; 
// Se modifican los encabezados del HTTP para indicar que se envia un archivo de Excel.
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header("Content-Disposition: attachment;filename=$nome_evento");
header('Cache-Control: max-age=0');
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');
exit;
?>

