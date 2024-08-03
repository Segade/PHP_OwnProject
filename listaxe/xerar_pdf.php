<?
    include '../sesions/db_connect.php';
    include '../sesions/functions.php';
    sec_session_start(); //Nuestra manera personalizada segura de iniciar sesión php.
if(login_check($mysqli) == true) {
// hai unha sesion aberta, polo que procedo a executa-la paxina.


  if (!isset($_POST['id']))	exit;
$id = $_POST['id'];
     if ( !is_numeric ($id )) exit;

// creo o nome e titulo do ficheiro.
$nome = "listaxe.pdf";
if (isset($_POST['nome'])){
		$nome = $_POST['nome'];
	$nome = str_replace(' ', '', $nome) . ".pdf";
} // fin do if se existe o nome.


require('fpdf/fpdf.php');
class PDF extends fpdf{
function Header()
{
//Arial bold 15
$this->SetFont('Arial','B',15);
    // Calculamos ancho y posición del título.
		$titulo = $_POST['nome'];
    $w = $this->GetStringWidth($titulo)+6;
    $this->SetX((210-$w)/2);

//Título
$this->Cell(60,10,$titulo,1,0,'C');
    $this->Ln();  
} // fin da funcion header

function Footer()
{
//Posición: a 1,5 cm del final
$this->SetY(-15);
//Arial italic 8
$this->SetFont('Arial','I',8);
$this->Cell(100,10,'Carreira Popular Concello de Mesía',0,0,'L');
//Número de página
$this->Cell(0,10,'Páxina '.$this->PageNo(),0,0,'C');
    $this->Ln();
} // fin do footer 

function ImprovedTable($rexistro)
{
    // Anchuras de las columnas
    $w_dorsal = $this->GetStringWidth("0")+6;
    $w_nome = $this->GetStringWidth("XXXXXXXXXX XXXXXXXXXX ")+6;
    // Cabeceras
        $this->SetFont('Arial','B',14);
        $this->Cell($w_dorsal,7,"DORSAL",1,0,'C');
        $this->Cell($w_nome,7,"APELIDOS E NOME",1,0,'C');
        $this->Cell($w_nome,7,"CLUB",1,0,'C');
    $this->Ln();
    // Datos
        $this->SetFont('Arial','',12);

 while ($fia=mysql_fetch_array($rexistro))
    {
 $dorsal = $fia['dorsal'];
$nome = html_entity_decode($fia['nome']);
$nome = str_replace('&#039;', "'", $nome);
// $nome = mb_convert_encoding($nome, "UTF-8");
$apelidos = html_entity_decode($fia['apelidos']);
$apelidos = str_replace('&#039;', "'", $apelidos);
// $apelidos = html_entity_decode($fia['apelidos'], ENT_QUOTES, "utf-8");
// $apelidos = mb_convert_encoding($apelidos, "UTF-8");
 $nome = "$apelidos, $nome";
$club = html_entity_decode($fia['club']);
$club = str_replace('&#039;', "'", $club);
//  $club = html_entity_decode($fia['club'], ENT_QUOTES, "utf-8");
// $club =  mb_convert_encoding($club, "UTF-8");

        $this->Cell($w_dorsal,5,number_format($dorsal),'B',0,"C");
        $this->Cell($w_nome,5,$nome,'B');
        $this->Cell($w_club,6,$club,'B',0,'B');
        $this->Ln();
     } // fin do while.
    // Línea de cierre
//     $this->Cell(array_sum($w),0,'','T');
} // fin da funcion da taboa. 
} // fin do required FPDF 

  	include("../bdd.php");
 	$enlace=Conectarse();

// creamo-la sintaxe SQL das categorias.
if (isset($_POST['categoria'])){
$categoria = $_POST['categoria'];
$categorias = "AND (categoria='---'";
$y = count($categoria);
for ($x=0;$x<$y;$x++) {
	$categorias .=" OR categoria='$categoria[$x]'";
} // fin do for de revision das categorias.
$categorias .= ")";
} // fin do if se se enviaron as categorias.

// creamo-la sintaxe do ORDER BY do SQL.
$orderby = "ORDER BY ";
if (isset($_POST['orde'])){
	switch ($_POST['orde']){
		case "apelidos": $orderby .= "apelidos, nome";
		break;
		case "nome": $orderby .= "nome, apelidos";
		break;
		case "dorsal": $orderby .= "dorsal";
		break;
		default : $orderby .= "";
	} // fin do switch.
} // fin do if se seleccionou a opcion de ordeado por.


$sql = "SELECT * FROM inscritos WHERE evento=$id $categorias $orderby";
 
				$rexistro=mysql_query($sql,$enlace);

$pdf = new PDF();
$pdf->SetFont('Arial','',14);
$pdf->AddPage();
$pdf->ImprovedTable($rexistro);

$pdf->Output($nome, "i");

} else{ // else do if de check do login de sesions.

} // fin do if de check login de sesion
	echo "<h3>Erro:</h3> <br>
<p>This Webpage is not available </p>
";
?>

