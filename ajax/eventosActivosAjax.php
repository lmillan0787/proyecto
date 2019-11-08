<?php

$peticionAjax = true;
require_once "../core/configGeneral.php";
if (isset($_POST['cod_even'])) {
    require_once "../controllers/participacionControlador.php";
    $insEvento = new participacionControlador();
    $insEvento->tabla_participacion();

} else {
    session_start();
    session_destroy();
    echo '<script> window.location.href="' . SERVERURL . 'inicio/"</script>';
}
