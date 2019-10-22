<?php
require('../views/assets/fpdf/fpdf.php');

$ruta = '../views/assets/upload/';

class PDF extends FPDF
{
    // Cabecera de página
    function Header()
    {
        // Imagenes de Cabecera

        $this->Image('../views/assets/img/fondo4.png', 2, 0, 95, 90);
        $this->Line(1, 1, 89, 1);
        $this->Line(1, 1, 1, 99);
        $this->Line(1, 79.5, 89, 79.5);
        $this->Line(89, 1, 89, 99);
        $this->Line(1, 99, 89, 99);
        $this->Image('../views/assets/fpdf/img/minppi.png', 3, 2, 10, 20);
        $this->Image('../views/assets/fpdf/img/jyd.png', 35, 2, 15, 18);
        $this->Image('../views/assets/img/mascota19.jpg', 73, 2, 15, 20);


        $this->Ln(22);
        // Arial bold 15
        $this->SetFont('helvetica', 'B', 10);
        // Movernos a la derecha
    }
    
    // Pie de página
    function Footer()
    {
        // Posición: a 1,5 cm del final
        $this->SetY(-5);
        // Arial italic 8
        $this->SetFont('times', 'B', 22);
        // Número de página
        $this->SetTextColor(248, 246, 249);
        $this->SetXY(0, 65);
        $this->Image('../views/assets/img/azul_cielo.jpeg', 1.5, 80, 87, 17, 'PNG');
        //$this->Cell(90,45,'DEPORTISTA',0,1,'C');
        $this->Cell(90, 45, strtoupper($_POST['perfil']), 0, 1, 'C');
        $this->Image('../views/assets/fpdf/img/banner.jpg', 1.5, 93.6, 87, 5);
    }
}

// Creación del objeto de la clase heredada
$pdf = new PDF('p', 'mm', array(100, 90));
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times', '', 12);
$pdf->SetLineWidth(.5);

$pdf->Ln(20);
$pdf->Line(29, 21, 61, 21);
$pdf->Line(29, 21, 29, 53);
$pdf->Line(29, 53, 61, 53);
$pdf->Line(61, 21, 61, 53);
$pdf->Image('../views/assets/upload/' . $_POST['cedula'] . '.jpg', 30, 22, 30, 30, 'JPG');

$pdf->SetX(2);
$pdf->Cell(40, 5, 'Cedula:', 0);
$pdf->Ln(0);
$pdf->SetX(22);
$pdf->Cell(40, 5, number_format($_POST['cedula'], 0, ',', '.'), 0);
$pdf->Ln(5);
//
$pdf->SetX(2);
$pdf->Cell(40, 5, 'Nombres:', 0);
$pdf->Ln(0);
$pdf->SetX(22);
//$pdf->Cell(40,5,'Luis',0,0,'L');
$pdf->Cell(40, 5, $_POST['nombre'], 0);
$pdf->Ln(5);
$pdf->SetX(2);
$pdf->Cell(40, 5, 'Apellidos:', 0);
$pdf->Ln(0);
$pdf->SetX(22);
//$pdf->Cell(40,5,'Millan',0);
$pdf->Cell(40, 5, $_POST['apellido'], 0);
$pdf->Ln(5);
$pdf->SetX(2);
$pdf->Cell(40, 5, 'Edad:', 0);
$pdf->Ln(0);
$pdf->SetX(22);
//$pdf->Cell(40,5,'31',0);
$pdf->Cell(40, 5, $_POST['edad'], 0);
$pdf->Ln(5);
$pdf->SetX(2);
$pdf->Cell(40, 5, 'Territorio:', 0);
$pdf->Ln(0);
$pdf->SetX(22);
//$pdf->Cell(40,5,'Zonas Urbanas',0);
$pdf->Cell(40, 5, strtoupper($_POST['genero']), 0);
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
$pdf->SetY(-25);*/
$pdf->Output('I');
