<?php

$peticionAjax = true;
require_once "../core/configGeneral.php";
if (isset($_POST['ced'])) {
    require_once "../controllers/pdfControlador.php";
    $pdf = new PDF('p', 'mm', array(100, 90));
    $pdf->generar_credencial_controlador();
} else {
    session_start();
    session_destroy();
    echo '<script> window.location.href="' . SERVERURL . 'inicio/"</script>';
}
