<?php
$peticionAjax = true;
$var = explode("/",$_GET['views']);
$cod_par = $var[1];

require_once "./controllers/pdfControlador.php";
$pdf = new PDF('p', 'mm', array(100, 80));
$pdf->generar_credencial_controlador($cod_par);
?>