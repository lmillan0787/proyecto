<?php

$peticionAjax = true;
require_once "../core/configGeneral.php";
if (isset($_POST['des_perf'])) {
    require_once "../controllers/perfilControlador.php";
    $insPerfil = new perfilControlador();

    if (isset($_POST['des_perf']) && isset($_POST['cod_rol'])) {
        echo $insPerfil->agregar_perfil_controlador();
    }
} else {
    session_start();
    session_destroy();
    echo '<script> window.location.href="' . SERVERURL . 'inicio/"</script>';
}