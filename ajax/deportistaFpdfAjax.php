<?php
require('../views/assets/fpdf/fpdf.php');

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
        $this->Image('../views/assets/fpdf/img/minppi.png', 45, 18, 30, 30);
        $this->Image('../views/assets/fpdf/img/jyd.png', 50, 2, 10, 15);
        $this->Image('../views/assets/img/mascota19.jpg', 65, 2, 10, 15);


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
        $this->SetFont('times', 'B', 30);
        // Número de página
        $this->SetTextColor(248, 246, 249);
        $this->SetXY(0, 65);
        $this->Image('../views/assets/img/'.$_POST['cod_reg'].'.jpg', 1.5, 80, 87, 17, 'JPG');
        $this->Image('../views/assets/img/archery.png', 1.5, 82, 10, 10, 'png');
        //$this->Cell(90,45,'DEPORTISTA',0,1,'C');
        $this->Cell(95, 45, 'DEPORTISTA', 0, 1, 'C');
        $this->Image('../views/assets/fpdf/img/banner.jpg', 1.5, 93.6, 87, 5);
    }
}

// Creación del objeto de la clase heredada
$pdf = new PDF('p', 'mm', array(100, 90));
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times', '', 11);
$pdf->SetLineWidth(.5);



$pdf->Ln(20);
$pdf->Line(4, 14, 35, 14);
$pdf->Line(4, 14, 4, 45);
$pdf->Line(4, 46, 35, 46);
$pdf->Line(35.6, 14, 35.6, 46);
$pdf->Image('../views/assets/upload/' . $_POST['cedula'] . '.jpg', 5, 15, 30, 30, 'JPG');
//$pdf->Ln(2);


//
$pdf->SetY(49);
$pdf->SetX(2);
$pdf->Cell(40, 5, 'Cedula:', 0);
//$pdf->Ln(0);
$pdf->SetX(20);
$pdf->Cell(45, 5, number_format($_POST['cedula'], 0, ',', '.'), 0);
$pdf->Ln(5);

//
$pdf->SetY(54);
$pdf->SetX(2);
$pdf->Cell(40, 5, 'Nombres:', 0);
$pdf->Ln(0);
$pdf->SetX(20);
$pdf->Cell(40, 5, utf8_decode(mb_strtoupper($_POST['nombre'])), 0);
$pdf->Ln(5);



$pdf->SetY(59);
$pdf->SetX(2);
$pdf->Cell(40, 5, 'Apellidos:', 0);
$pdf->Ln(0);
$pdf->SetX(20);
$pdf->Cell(40, 5, utf8_decode(mb_strtoupper($_POST['apellido'])), 0);
$pdf->Ln(5);

$pdf->SetY(64);
$pdf->SetX(2);
$pdf->Cell(40, 5, 'Territorio:', 0);
$pdf->Ln(0);
$pdf->SetX(20);
$pdf->Cell(40, 5, utf8_decode(mb_strtoupper($_POST['alias'], 'UTF-8')), 0);
$pdf->Ln(5);

$pdf->SetY(69);
$pdf->SetX(2);
$pdf->Cell(40, 5, 'Pueblo:', 0);
$pdf->Ln(0);
$pdf->SetX(16);
$pdf->Cell(30, 5, utf8_decode(mb_strtoupper($_POST['des_pue'])), 0);

$pdf->SetY(74);
$pdf->SetX(2);
$pdf->Cell(40, 5, 'Disciplina:', 0);
$pdf->Ln(0);
$pdf->SetX(22);
$pdf->Cell(40, 5, utf8_decode(mb_strtoupper($_POST['des_dis'])), 0);

$pdf->Ln(5);



$pdf->Output('I');
