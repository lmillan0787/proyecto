<?php

$peticionAjax = true;
require_once "../core/configGeneral.php";
if (isset($_POST['ced'])) {
    require_once "../controllers/deportistaControlador.php";
    $insDeportista = new deportistaControlador();

    if (isset($_POST['ced']) && isset($_POST['cod_even']) && isset($_POST['cod_perf'])&& isset($_POST['cod_pue']) && isset($_POST['cod_reg']) && isset($_POST['cod_dis']) && isset($_POST['cod_cat'])) {
        echo $insDeportista->agregar_deportista_controlador();
    }
} else {
    session_start();
    session_destroy();
    echo '<script> window.location.href="' . SERVERURL . 'inicio/"</script>';
}