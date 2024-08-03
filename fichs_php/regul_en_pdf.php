<?

if (!isset($_GET['id'])){
	exit;
}else{
 //Busco en la tabla noticias la que corresponda al id de la selección
$id = $_GET['id'];
    if ( !is_numeric ($id )) exit;
$sql="SELECT regulamento FROM eventos WHERE id_evento=$id";
$res=mysql_query($sql,$enlace);
if (!$registro=mysql_fetch_array($res)){ 
	exit;
}else{
// o evento existe polo que procedo a amosa-los datos.
$r = html_entity_decode($fia['regulamento']);
$re = str_replace("<br />", "", $r);
 
require('../aaa/fpdf.php');
class PDF extends fpdf{
function Header()
{
//Arial bold 15
$this->SetFont('Arial','B',15);
    // Calculamos ancho y posición del título.
$title = "Regulamento";
    $w = $this->GetStringWidth($title)+6;
    $this->SetX((210-$w)/2);

//Título
$this->Cell(60,10,$title,1,0,'C');
  
} // fin da funcion header

function Footer()
{
//Posición: a 1,5 cm del final
$this->SetY(-15);
//Arial italic 8
$this->SetFont('Arial','I',8);
//Número de página
$this->Cell(0,10,'Page '.$this->PageNo(),0,0,'C');
} // fin do footer 

} // fin da declaracion da clase FPDF 


$pdf=new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','',26);

$pdf->SetFont('Times','',12);
// Imprimimos el texto justificado
$pdf->MultiCell(0,5,$re);
// Salto de línea
$pdf->Ln();

$pdf->Output("regulamento.pdf", "i");
	} // fin do if se existe o evento.
} // fin do if se existe id na url 
echo "$sql";
?>
