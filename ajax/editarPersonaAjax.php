<?php
    $peticionAjax = true;
    require_once "../core/configGeneral.php";
    if (isset($_POST['ced'])) {
        require_once "../controllers/personaControlador.php";
        $insPersona = new personaControlador();
        
        if (isset($_POST['cod_per']) && isset($_POST['ced']) && isset($_POST['nom']) && isset($_POST['ape']) && isset($_POST['fec_nac']) && isset($_POST['cod_gen'])) {
            $insPersona->editar_persona_controlador();
        }
    } else {
        session_start();
        session_destroy();
        echo '<script> window.location.href="' . SERVERURL . 'inicio/"</script>';
    }