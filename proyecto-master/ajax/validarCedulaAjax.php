<?php

$peticionAjax = true;
require_once "../core/configGeneral.php";
if (isset($_POST['ced'])) {
    require_once "../controllers/personaControlador.php";
    $insPersona = new personaControlador();
    echo $insPersona->validar_cedula_controlador();
    
} else {
    session_start();
    session_destroy();
    echo '<script> window.location.href="' . SERVERURL . 'inicio/"</script>';
}
