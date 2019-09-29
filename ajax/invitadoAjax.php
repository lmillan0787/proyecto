<?php

$peticionAjax = true;
require_once "../core/configGeneral.php";
if (isset($_POST['ced'])) {
    require_once "../controllers/invitadoControlador.php";
    $insInvitado = new invitadoControlador();

    if (isset($_POST['ced']) && isset($_POST['nac']) && isset($_POST['nom']) && isset($_POST['ape']) && isset($_POST['fec_nac']) && isset($_POST['cod_gen']) && isset($_POST['cod_per']) && isset($_POST['cod_even']) && isset($_POST['cod_perf']) ) {
        echo $insInvitado->agregar_invitado_controlador();
        

    }
} else {
    session_start();
    session_destroy();
    echo '<script> window.location.href="' . SERVERURL . 'inicio/"</script>';
}