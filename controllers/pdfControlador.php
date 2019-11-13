<?php

if ($peticionAjax) {
    require_once "../views/assets/fpdf/fpdf.php";
} else {
    require_once "../views/assets/fpdf/fpdf.php";
}

class PDF extends FPDF
{

    public function Header()
    {
        //Agregar Fuente Evento
        $this->AddFont('bamboo', '', 'bamboo.php');
        $this->SetFont('bamboo', '', 15);
        /////////////////////////////////////////////////////////////////////////////////////////////////////////////
        $this->Image('../views/assets/img/fondo4.png', 2, 0, 95, 90);
        ///////Nombre del Evento//////////
        $this->SetY(5);
        $this->SetX(2);
        $this->Cell(40, 5, utf8_decode(mb_strtoupper($_POST['des_even'])), 0);
        ////////////////////////////////////////////////////////////////////////
        $this->Line(1, 1, 89, 1);
        $this->Line(1, 1, 1, 99);
        $this->Line(1, 79.5, 89, 79.5);
        $this->Line(89, 1, 89, 99);
        $this->Line(1, 99, 89, 99);
        // Imagenes de Cabecera
        $this->Image('../views/assets/fpdf/img/minppi.png', 45, 18, 30, 30);
        $this->Image('../views/assets/fpdf/img/jyd.png', 60, 2, 8, 15);
        $this->Ln(22);
        // Arial bold 15
        $this->SetFont('helvetica', 'B', 10);
    }
    // Pie de página
    public function Footer()
    {
        // Posición: a 1,5 cm del final
        $this->SetY(-5);
        // Arial italic 8
        $this->SetFont('times', 'B', 20);
        // Número de página
        $this->SetTextColor(248, 246, 249);
        $this->SetXY(0, 65);
        if ($_POST['cod_rol'] == 2) {
            if ($_POST['cod_perf'] == 4) {
                $this->Image('../views/assets/img/' . $_POST['cod_reg'] . '.jpg', 1.5, 80, 87, 17, 'JPG');
                $this->Image('../views/assets/img/archery.png', 3, 82, 10, 10, 'png');
                $this->Cell(95, 45, 'DEPORTISTA', 0, 1, 'C');
                $this->Image('../views/assets/fpdf/img/banner.jpg', 1.5, 93.6, 87, 5);
            } else if ($_POST['cod_perf'] == 5) {
                $this->Image('../views/assets/img/' . $_POST['cod_reg'] . '.jpg', 1.5, 80, 87, 17, 'JPG');
                $this->Image('../views/assets/img/coach.png', 3, 82, 10, 10, 'png');
                $this->Cell(95, 45, 'DELEGADO', 0, 1, 'C');
                $this->Image('../views/assets/fpdf/img/banner.jpg', 1.5, 93.6, 87, 5);
            } else if ($_POST['cod_perf'] == 6) {
                $this->Image('../views/assets/img/' . $_POST['cod_reg'] . '.jpg', 1.5, 80, 87, 17, 'JPG');
                $this->Image('../views/assets/img/medico.png', 3, 82, 10, 10, 'png');
                $this->Cell(95, 45, utf8_decode('MÉDICO'), 0, 1, 'C');
                $this->Image('../views/assets/fpdf/img/banner.jpg', 1.5, 93.6, 87, 5);
            }
        } else if ($_POST['cod_rol'] == 5) {
            $this->Image('../views/assets/img/azul_cielo.jpeg', 1.5, 80, 87, 17, 'PNG');
            $this->Cell(90, 45, strtoupper($_POST['des_perf']), 0, 1, 'C');
            $this->Image('../views/assets/fpdf/img/banner.jpg', 1.5, 93.6, 87, 5);
        } else if ($_POST['cod_rol'] == 4) {
            $this->Image('../views/assets/img/fondo_tecnicos.jpg', 1.5, 80, 87, 17, 'JPG');
            $this->Image('../views/assets/img/tecnicos.png', 3, 82, 10, 10, 'png');
            $this->Cell(95, 45, strtoupper(utf8_decode($_POST['des_perf'])), 0, 1, 'C');
            $this->Image('../views/assets/fpdf/img/banner.jpg', 1.5, 93.6, 87, 5);
        }
    }
    public function generar_credencial_controlador1()
    {
        $this->AddPage();
$this->SetFont('Arial','B',16);
$this->Cell(40,10,'Hello World!');
$this->Output();
    }
    public function generar_credencial_controlador()
    {
        /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        //QR
        require('../views/assets/qrcode/qrcode.class.php');
        $msg = $_POST['ced'];
        $err = 'H';
        $qrcode = new QRcode(utf8_encode($msg), $err);
        $qrcode->disableBorder();
        /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        //invitado
        if ($_POST['cod_perf'] == 14 || $_POST['cod_perf'] == 15) {
            $this->AliasNbPages();
            $this->AddPage();
            $this->SetFont('Times', '', 10);
            $this->SetLineWidth(.5);
            ////////////////////////////////////////////////////////////QR/////////////////////////////
            $qrcode->displayFPDF($this, 73, 2, 15);
            ////////////////////////////////////////////////////////////QR/////////////////////////////
            $this->Ln(20);
            $this->Ln(20);
            $this->Line(4, 14, 36, 14);
            $this->Line(4, 14, 4, 46);
            $this->Line(4, 46, 36, 46);
            $this->Line(36, 14, 36, 46);
            $this->Image('../views/assets/upload/' . $_POST['ced'] . '.jpg', 5, 15, 30, 30, 'JPG');

            $this->SetY(49);
            $this->SetX(2);
            $this->Cell(40, 5, 'Cedula:', 0);
            //$this->Ln(0);
            $this->SetX(20);
            $this->Cell(45, 5, $_POST['ced'], 0);
            $this->Ln(5);

            //
            $this->SetY(54);
            $this->SetX(2);
            $this->Cell(40, 5, 'Nombres:', 0);
            $this->Ln(0);
            $this->SetX(20);
            $this->Cell(40, 5, utf8_decode(mb_strtoupper($_POST['nombre'])), 0);
            $this->Ln(5);

            $this->SetY(59);
            $this->SetX(2);
            $this->Cell(40, 5, 'Apellidos:', 0);
            $this->Ln(0);
            $this->SetX(20);
            $this->Cell(40, 5, utf8_decode(mb_strtoupper($_POST['apellido'])), 0);
            $this->Ln(5);
            $this->SetX(2);
            $this->Cell(40, 5, 'Edad:', 0);
            $this->Ln(0);
            $this->SetX(20);
            //$this->Cell(40,5,'31',0);
            $this->Cell(40, 5, $_POST['edad'], 0);
            $this->Ln(5);
            $this->SetX(2);
            $this->Cell(40, 5, 'Territorio:', 0);
            $this->Ln(0);
            $this->SetX(20);
            //$this->Cell(40,5,'Zonas Urbanas',0);
            $this->Cell(40, 5, strtoupper($_POST['genero']), 0);
            $this->Ln(5);

            $this->Output('I');
            /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
            //deportista
        } else if ($_POST['cod_perf'] == 4) {
            $this->AliasNbPages();
            $this->AddPage();
            $this->SetFont('Times', '', 10);
            $this->SetLineWidth(.5);

            $this->Ln(20);
            $this->Line(4, 14, 36, 14);
            $this->Line(4, 14, 4, 46);
            $this->Line(4, 46, 36, 46);
            $this->Line(36, 14, 36, 46);
            $this->Image('../views/assets/upload/' . $_POST['ced'] . '.jpg', 5, 15, 30, 30, 'JPG');
            //$this->Ln(2);
            ////////////////////////////////////////////////////////////QR/////////////////////////////
            $qrcode->displayFPDF($this, 73, 2, 15);
            ////////////////////////////////////////////////////////////QR/////////////////////////////
            //
            $this->SetY(49);
            $this->SetX(2);
            $this->Cell(40, 5, 'Cedula:', 0);
            //$this->Ln(0);
            $this->SetX(20);
            $this->Cell(45, 5, $_POST['ced'], 0);
            $this->Ln(5);

            //
            $this->SetY(54);
            $this->SetX(2);
            $this->Cell(40, 5, 'Nombres:', 0);
            $this->Ln(0);
            $this->SetX(20);
            $this->Cell(40, 5, utf8_decode(mb_strtoupper($_POST['nombre'])), 0);
            $this->Ln(5);



            $this->SetY(59);
            $this->SetX(2);
            $this->Cell(40, 5, 'Apellidos:', 0);
            $this->Ln(0);
            $this->SetX(20);
            $this->Cell(40, 5, utf8_decode(mb_strtoupper($_POST['apellido'])), 0);
            $this->Ln(5);

            $this->SetY(64);
            $this->SetX(2);
            $this->Cell(40, 5, 'Territorio:', 0);
            $this->Ln(0);
            $this->SetX(20);
            $this->Cell(40, 5, utf8_decode(mb_strtoupper($_POST['alias'], 'UTF-8')), 0);
            $this->Ln(5);

            $this->SetY(69);
            $this->SetX(2);
            $this->Cell(40, 5, 'Pueblo:', 0);
            $this->Ln(0);
            $this->SetX(20);
            $this->Cell(40, 5, utf8_decode(mb_strtoupper($_POST['des_pue'])), 0);

            $this->SetY(74);
            $this->SetX(2);
            $this->Cell(40, 5, 'Disciplina:', 0);
            $this->Ln(0);
            $this->SetX(20);
            $this->Cell(40, 5, utf8_decode(mb_strtoupper($_POST['des_dis'])), 0);

            $this->Ln(5);



            $this->Output('I');
            /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
            //delegado
        } else if ($_POST['cod_perf'] == 5) {
            $this->AliasNbPages();
            $this->AddPage();
            $this->SetFont('Times', '', 10);
            $this->SetLineWidth(.5);



            $this->Ln(20);
            $this->Line(4, 14, 36, 14);
            $this->Line(4, 14, 4, 46);
            $this->Line(4, 46, 36, 46);
            $this->Line(36, 14, 36, 46);
            $this->Image('../views/assets/upload/' . $_POST['ced'] . '.jpg', 5, 15, 30, 30, 'JPG');
            //$this->Ln(2);

            ////////////////////////////////////////////////////////////QR/////////////////////////////
            $qrcode->displayFPDF($this, 73, 2, 15);
            ////////////////////////////////////////////////////////////QR/////////////////////////////

            //
            $this->SetY(49);
            $this->SetX(2);
            $this->Cell(40, 5, 'Cedula:', 0);
            //$this->Ln(0);
            $this->SetX(20);
            $this->Cell(45, 5, $_POST['ced'], 0);
            $this->Ln(5);

            //
            $this->SetY(54);
            $this->SetX(2);
            $this->Cell(40, 5, 'Nombres:', 0);
            $this->Ln(0);
            $this->SetX(20);
            $this->Cell(40, 5, utf8_decode(mb_strtoupper($_POST['nombre'])), 0);
            $this->Ln(5);



            $this->SetY(59);
            $this->SetX(2);
            $this->Cell(40, 5, 'Apellidos:', 0);
            $this->Ln(0);
            $this->SetX(20);
            $this->Cell(40, 5, utf8_decode(mb_strtoupper($_POST['apellido'])), 0);
            $this->Ln(5);

            $this->SetY(64);
            $this->SetX(2);
            $this->Cell(40, 5, 'Territorio:', 0);
            $this->Ln(0);
            $this->SetX(20);
            $this->Cell(40, 5, utf8_decode(mb_strtoupper($_POST['alias'], 'UTF-8')), 0);
            $this->Ln(5);

            $this->SetY(69);
            $this->SetX(2);
            $this->Cell(40, 5, 'Pueblo:', 0);
            $this->Ln(0);
            $this->SetX(20);
            $this->Cell(30, 5, utf8_decode(mb_strtoupper($_POST['des_pue'])), 0);

            $this->SetY(74);
            $this->SetX(2);
            $this->Cell(40, 5, 'Disciplina:', 0);
            $this->Ln(0);
            $this->SetX(20);
            $this->Cell(40, 5, utf8_decode(mb_strtoupper($_POST['des_dis'])), 0);

            $this->Ln(5);



            $this->Output('I');
            /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
            //medico
        } else if ($_POST['cod_perf'] == 6) {
            $this->AliasNbPages();
            $this->AddPage();
            $this->SetFont('Times', '', 10);
            $this->SetLineWidth(.5);

            ////////////////////////////////////////////////////////////QR/////////////////////////////
            $qrcode->displayFPDF($this, 73, 2, 15);
            ////////////////////////////////////////////////////////////QR/////////////////////////////


            $this->Ln(20);
            $this->Line(4, 14, 36, 14);
            $this->Line(4, 14, 4, 46);
            $this->Line(4, 46, 36, 46);
            $this->Line(36, 14, 36, 46);
            $this->Image('../views/assets/upload/' . $_POST['ced'] . '.jpg', 5, 15, 30, 30, 'JPG');
            $this->Ln(2);

            $this->SetX(2);
            $this->Cell(40, 5, 'Cedula:', 0);
            $this->Ln(0);
            $this->SetX(20);
            $this->Cell(40, 5, $_POST['ced'], 0);
            $this->Ln(5);
            //

            //
            $this->SetX(2);
            $this->Cell(40, 5, 'Nombres:', 0);
            $this->Ln(0);
            $this->SetX(20);
            //$this->Cell(40,5,'Luis',0,0,'L');
            $this->Cell(40, 5, utf8_decode(mb_strtoupper($_POST['nombre'])), 0);
            $this->Ln(5);




            $this->SetX(2);
            $this->Cell(40, 5, 'Apellidos:', 0);
            $this->Ln(0);
            $this->SetX(20);
            //$this->Cell(40,5,'Millan',0);
            $this->Cell(40, 5, utf8_decode(mb_strtoupper($_POST['apellido'])), 0);
            $this->Ln(5);
            /*
$this->SetX(2);
$this->Cell(40,5,'Edad:',0);
$this->Ln(0);
$this->SetX(22);
//$this->Cell(40,5,'31',0);
$this->Cell(40,5,$_POST['edad'],0);
$this->Ln(5);*/

            $this->SetX(2);
            $this->Cell(40, 5, 'Territorio:', 0);
            $this->Ln(0);
            $this->SetX(20);
            //$this->Cell(40,5,'Zonas Urbanas',0);
            $this->Cell(40, 5, utf8_decode(mb_strtoupper($_POST['des_reg'], 'UTF-8')), 0);
            $this->Ln(5);

            $this->SetX(2);
            $this->Cell(40, 5, 'Pueblo:', 0);
            $this->Ln(0);
            $this->SetX(20);
            //$this->Cell(40,5,'Deportista',0);
            $this->Cell(40, 5, utf8_decode(mb_strtoupper($_POST['des_pue'], 'UTF-8')), 0);



            $this->Ln(5);


            $this->Output('I');

            /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
            //técnico
        } else if ($_POST['cod_rol'] == 4) {
            $this->AliasNbPages();
            $this->AddPage();
            $this->SetFont('Times', '', 11);
            $this->SetLineWidth(.5);

            $this->Ln(20);
            $this->Line(4, 14, 36, 14);
            $this->Line(4, 14, 4, 46);
            $this->Line(4, 46, 36, 46);
            $this->Line(36, 14, 36, 46);
            $this->Image('../views/assets/upload/' . $_POST['ced'] . '.jpg', 5, 15, 30, 30, 'JPG');
            //$this->Ln(2);

            ////////////////////////////////////////////////////////////QR/////////////////////////////
            $qrcode->displayFPDF($this, 73, 2, 15);
            ////////////////////////////////////////////////////////////QR/////////////////////////////

            //
            $this->SetY(49);
            $this->SetX(2);
            $this->Cell(40, 5, 'Cedula:', 0);
            //$this->Ln(0);
            $this->SetX(20);
            $this->Cell(45, 5, $_POST['ced'], 0);
            $this->Ln(5);

            //
            $this->SetY(54);
            $this->SetX(2);
            $this->Cell(40, 5, 'Nombres:', 0);
            $this->Ln(0);
            $this->SetX(20);
            $this->Cell(40, 5, utf8_decode(mb_strtoupper($_POST['nombre'])), 0);
            $this->Ln(5);

            $this->SetY(59);
            $this->SetX(2);
            $this->Cell(40, 5, 'Apellidos:', 0);
            $this->Ln(0);
            $this->SetX(20);
            $this->Cell(40, 5, utf8_decode(mb_strtoupper($_POST['apellido'])), 0);
            $this->Ln(5);

            $this->SetY(64);
            $this->SetX(2);
            $this->Cell(40, 5, utf8_decode('Institución:'), 0);
            $this->Ln(0);
            $this->SetX(20);
            $this->Cell(40, 5, utf8_decode(mb_strtoupper($_POST['siglas'])), 0);

            $this->SetY(69);
            $this->SetX(2);
            $this->Cell(40, 5, 'Cargo:', 0);
            $this->Ln(0);
            $this->SetX(20);
            $this->Cell(40, 5, utf8_decode(mb_strtoupper($_POST['des_carg'], 'UTF-8')), 0);
            $this->Ln(5);

            $this->Ln(5);

            $this->Output('I');
        }
    }
}
