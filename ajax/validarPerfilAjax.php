<?php

$peticionAjax = true;
require_once "../core/configGeneral.php";
if (isset($_POST['des_perf'])) {
    require_once "../controllers/perfilControlador.php";
    $insPerfil = new perfilControlador();
    echo $insPerfil->validar_perfil_controlador();
} else {
    session_start();
    session_destroy();
    echo '<script> window.location.href="' . SERVERURL . 'inicio/"</script>';
}
