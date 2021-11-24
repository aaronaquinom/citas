<?php
require('pdf/fpdf.php');
/*$resultadopdf->laCodigo;*/
class PDF extends FPDF
{
// Cabecera de página
function Header()
{
    // Logo
    $this->Image('vistas/assets/img/irenlogo.png',10,8,33);
    // Arial bold 15
    $this->SetFont('Arial','B',18);
    // Movernos a la derecha
    $this->Cell(52);
    // Título
    $this->Cell(93,10,' REPORTE DEL RESULTADO',1,0,'C');
    
    // Salto de línea
    $this->Ln(10);
}

// Pie de página
function Footer()
{
    // Posición: a 1,5 cm del final
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    // Número de página
    $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
}
}
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial','B',10);
$pdf->Cell(200,10, utf8_decode('INSTITUTO REGIONAL DE ENFERMEDADES NEOPLÁSICAS'),0,1,'C');
$pdf->Cell(200,1, utf8_decode('Av. Progreso N° 1235, 1237, 1239 Sector Palo Seco - Concepción-Junín'),0,1,'C');
$pdf->SetFont('Times','B',12);
$pdf->Cell(40,30, 'Codigo de Lamina:');
$pdf->SetFont('Times','',12);


$pdf->Output();
?>