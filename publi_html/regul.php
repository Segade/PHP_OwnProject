<?

if (!isset($_GET['id'])){
	exit;
}else{
 //Busco en la tabla noticias la que corresponda al id de la selección
$id = $_GET['id'];
    if ( !is_numeric ($id )) exit;
$sql="SELECT regulamento, nome_evento FROM eventos WHERE id_evento=$id AND publi=1";
  	include("../bdd.php");
 	$enlace=Conectarse();
				$res=mysql_query($sql,$enlace);
if (!$rexistro=mysql_fetch_array($res)){ 
	exit;
}else{
// o evento existe polo que procedo a amosa-los datos.
$r = $rexistro['regulamento'];
$nome_evento = $rexistro['nome_evento'];
$r = str_replace("<br />", "", $r);
// $r = html_entity_decode($r, ENT_QUOTES, "utf-8");
$r = html_entity_decode($r);
$r = str_replace("&#039;", "'", $r);
require('fpdf/fpdf.php');
class PDF extends fpdf{
function Header()
{
//Arial bold 15
$this->SetFont('Arial','B',15);
    // Calculamos ancho y posición del título.
$title = "Carreira Popular Concello de Mesía";
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
$pdf->MultiCell(0,5,$r);
// Salto de línea
$pdf->Ln();
	$nome_evento = "Regulamento_" . str_replace(' ', '', $nome_evento) . ".pdf";
$pdf->Output($nome_evento, "i");
	} // fin do if se existe o evento.
} // fin do if se existe id na url 
echo "$sql";
?>
