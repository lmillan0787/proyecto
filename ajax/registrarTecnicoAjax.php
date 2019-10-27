<?php

$peticionAjax = true;
require_once "../core/configGeneral.php";
if (isset($_POST['ced'])) {
    require_once "../controllers/tecnicoControlador.php";
    $insTecnico = new tecnicoControlador();

    if (isset($_POST['ced']) && isset($_POST['cod_even']) && isset($_POST['cod_perf'])&& isset($_POST['cod_inst']) && isset($_POST['cod_carg'])) {
        echo $insTecnico->agregar_tecnico_controlador();
    }
} else {
    session_start();
    session_destroy();
    echo '<script> window.location.href="' . SERVERURL . 'inicio/"</script>';
}