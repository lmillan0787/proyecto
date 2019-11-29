<?php
    $peticionAjax = true;
    require_once "../core/configGeneral.php";
    if (isset($_POST['cod_par']) && isset($_POST['ced']) && isset($_POST['cod_even']) && isset($_POST['cod_perf']) && isset($_POST['cod_estat'])) {
        require_once "../controllers/invitadoControlador.php";
        $insInvitado = new invitadoControlador();
        echo $insInvitado->editar_invitado_controlador();
        

    } else {
        session_start();
        session_destroy();
        echo '<script> window.location.href="' . SERVERURL . 'inicio/"</script>';
    }