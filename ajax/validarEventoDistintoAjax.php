<?php

$peticionAjax = true;
require_once "../core/configGeneral.php";
if (isset($_POST['des_even'])) {
    require_once "../controllers/eventoControlador.php";
    $insEvento = new eventoControlador();
    echo $insEvento->validar_evento_distinto_controlador();
} else if (isset($_POST['fec_even'])) {
    require_once "../controllers/eventoControlador.php";
    $insEvento = new eventoControlador();
    echo $insEvento->validar_fecha_distinta_controlador();
} else if (isset($_POST['cod_reg'])) {
    require_once "../controllers/eventoControlador.php";
    $insEvento = new eventoControlador();
    echo $insEvento->validar_region_estatus_controlador();
} else {
    session_start();
    session_destroy();
    echo '<script> window.location.href="' . SERVERURL . 'inicio/"</script>';
}
