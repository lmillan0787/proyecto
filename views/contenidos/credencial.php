<?php
$peticionAjax = false;
$insCredencial= require ("./fpdf/fpdf.php");






class PDF extends FPDF
{
// Cabecera de página
function Header()
{
    // Imagenes de Cabecera
   // $this->Image('cre_minpi',3,2,10,10);
    //$this->Image('cre_jyd.png',15,2,10,10);
   // $this->Image('cre_jaguar_juegos.png',75,2,10,20);
  //  $this->Ln(22);
    // Arial bold 15
  //  $this->SetFont('helvetica','B',10);
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
    // $this->Image('../assets/img/cre_fondo_cargo.png',0,80,100,17);
    $this->Cell(90,45,'DEPORTISTA',0,1,'C');
    //$this->Cell(55,17,$_POST['rol'],0,1,'C');
    // $this->Image('../assets/img/cre_banner.jpg',0,95 ,100,5);
}
}
//$insCredencial->credencial(); 
//$ced=mysqli_query($conexion,'select * from dat_per where ced=18530418');
//$cod_per=4;
//$ced=mysqli_query($conexion,'SELECT *, date_format(fec_nac,"%d-%m-%Y") as fecha FROM dat_per a,dat_par b,dat_del c WHERE a.cod_per=b.cod_per and cod_per=$_get['cod_per'] group by 1');
//$row = mysqli_fetch_array( $ced );



// Creación del objeto de la clase heredada
$pdf = new PDF('p','mm',array(100,90));
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times','',12);
$pdf->SetX(2);
$pdf->Cell(40,5,'C.I:',0);
//$pdf->Ln(5);
$pdf->SetX(10);
//$pdf->Cell(40,5,$row['ced'],0,0,'L');
$pdf->Ln(5);
$pdf->SetX(2);
$pdf->Cell(40,5,'Nombres:',0);
$pdf->Ln(0);
$pdf->SetX(22);
//$pdf->Cell(40,5,$row['nom'],0,0,'L');
//$pdf->Cell(40,5,$_POST['nombre'],1,0,'L');
$pdf->Ln(5);
$pdf->SetX(2);
$pdf->Cell(40,5,'Apellidos:',0);
$pdf->Ln(0);
$pdf->SetX(22);
//$pdf->Cell(40,5,$row['ape'],0);
//$pdf->Cell(40,5,$_POST['apellido'],1);
$pdf->Ln(5);
$pdf->SetX(2);
$pdf->Cell(40,5,'Fecha de Nacimiento:',0);
$pdf->Ln(0);
$pdf->SetX(40);
//$pdf->Cell(40,5,$row['fec_nac'],0);
//$pdf->Cell(40,5,$_POST['cedula'],1);
$pdf->Ln(5);
$pdf->SetX(2);
$pdf->Cell(40,5,'Territorio:',0);
$pdf->Ln(0);
$pdf->SetX(22);
//$pdf->Cell(40,5,'Zonas Urbanas',0);
//$pdf->Cell(40,5,$_POST['territorio'],1);
$pdf->Ln(5);
$pdf->SetX(2);
$pdf->Cell(40,5,'Rol:',);
$pdf->Ln(0);
$pdf->SetX(22);
$pdf->Cell(40,5,'Deportista',0);
//$pdf->Cell(40,5,$_POST['rol'],1);
$pdf->Ln(5);
$pdf->SetX(2);
$pdf->Cell(40,5,'Disciplina:',0);
$pdf->Ln(0);
$pdf->SetX(22);
$pdf->Cell(40,5,'Arco y Flecha',0);
//$pdf->Cell(40,5,$_POST['rol'],1);
$pdf->SetY(-25);
$pdf->Output();
?>