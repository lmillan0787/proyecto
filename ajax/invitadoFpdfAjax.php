<?php
require('../views/assets/fpdf/fpdf.php');



class PDF extends FPDF
{
// Cabecera de página
function Header()
{
    // Imagenes de Cabecera
    $this->Image('../views/assets/fpdf/img/minppi.png',3,2,10,10);
    $this->Image('../views/assets/fpdf/img/jyd.png',15,2,10,10);
    $this->Image('../views/assets/fpdf/img/jaguar_juegos.png',75,2,10,20);
    $this->Ln(22);
    // Arial bold 15
    $this->SetFont('helvetica','B',10);
    // Movernos a la derecha
   

}

// Pie de página
function Footer()
{
    // Posición: a 1,5 cm del final
    $this->SetY(-5);
    // Arial italic 8
    $this->SetFont('times','B',30);
    // Número de página
    $this->SetTextColor(248,246,249);
     $this->SetXY(0,65);
     $this->Image('../views/assets/fpdf/img/fondo_cargo.png',0,80,100,17);
    //$this->Cell(90,45,'DEPORTISTA',0,1,'C');
    $this->Cell(90,45,$_POST['perfil'],0,1,'C');
    $this->Image('../views/assets/fpdf/img/banner.jpg',0,95 ,100,5);
}
}

// Creación del objeto de la clase heredada
$pdf = new PDF('p','mm',array(100,90));
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times','',12);
$pdf->SetX(2);
$pdf->Cell(40,5,'Cedula:',0);
$pdf->Ln(0);
$pdf->SetX(22);
$pdf->Cell(40,5,$_POST['cedula'],0);
$pdf->Ln(5);

$pdf->SetX(2);
$pdf->Cell(40,5,'Nombres:',0);
$pdf->Ln(0);
$pdf->SetX(22);
//$pdf->Cell(40,5,'Luis',0,0,'L');
$pdf->Cell(40,5,$_POST['nombre'],0);
$pdf->Ln(5);

$pdf->SetX(2);
$pdf->Cell(40,5,'Apellidos:',0);
$pdf->Ln(0);
$pdf->SetX(22);
//$pdf->Cell(40,5,'Millan',0);
$pdf->Cell(40,5,$_POST['apellido'],0);
$pdf->Ln(5);

$pdf->SetX(2);
$pdf->Cell(40,5,'Edad:',0);
$pdf->Ln(0);
$pdf->SetX(22);
//$pdf->Cell(40,5,'31',0);
$pdf->Cell(40,5,$_POST['edad'],0);
$pdf->Ln(5);

$pdf->SetX(2);
$pdf->Cell(40,5,'Territorio:',0);
$pdf->Ln(0);
$pdf->SetX(22);
//$pdf->Cell(40,5,'Zonas Urbanas',0);
$pdf->Cell(40,5,$_POST['genero'],0);
$pdf->Ln(5);

/*$pdf->SetX(2);
$pdf->Cell(40,5,'Rol:',0);
$pdf->Ln(0);
$pdf->SetX(22);
//$pdf->Cell(40,5,'Deportista',0);
$pdf->Cell(40,5,$_POST['rol'],0);
$pdf->Ln(5);*/

/*$pdf->SetX(2);
$pdf->Cell(40,5,'Disciplina:',0);
$pdf->Ln(0);
$pdf->SetX(22);
//$pdf->Cell(40,5,'Arco y Flecha',0);
$pdf->Cell(40,5,$_POST['genero'],0);
$pdf->SetY(-25);
$pdf->Output('I');*/
?>