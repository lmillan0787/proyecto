<?php

$peticionAjax = true;
require_once "../core/configGeneral.php";
if (isset($_POST['des_inst'])) {
    require_once "../controllers/institucionControlador.php";
    $insInstitucion = new institucionControlador();

    if (isset($_POST['des_inst']) && isset($_POST['siglas'])) {
        echo $insInstitucion->agregar_institucion_controlador();
    }
} else {
    session_start();
    session_destroy();
    echo '<script> window.location.href="' . SERVERURL . 'inicio/"</script>';
}