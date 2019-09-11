<?php

$peticionAjax = true;
require_once "../core/configGeneral.php";
if (isset($_POST['des_even'])) {
    require_once "../controllers/eventoControlador.php";
    $insEvento = new eventoControlador();

    if (isset($_POST['des_even']) && isset($_POST['fec_even']) && isset($_POST['cod_edo']) && isset($_POST['cod_tip_even'])) {
        echo $insEvento->agregar_evento_controlador();
    }
} else {
    session_start();
    session_destroy();
    echo '<script> window.location.href="' . SERVERURL . 'inicio/"</script>';
}
