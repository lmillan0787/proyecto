<?php

    $peticionAjax = true;
    require_once "../core/configGeneral.php";
    if (isset($_POST['ced'])) {
        require_once "../controllers/invitadoControlador.php";
        $insInvitado = new invitadoControlador();

        if (isset($_POST['ced']) && isset($_POST['cod_nac']) && isset($_POST['cod_even']) && isset($_POST['cod_perf'])) {
            echo $insInvitado->agregar_invitado_controlador();
        }
    } else {
        session_start();
        session_destroy();
        echo '<script> window.location.href="' . SERVERURL . 'inicio/"</script>';
    }