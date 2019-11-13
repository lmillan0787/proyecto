<?php

$peticionAjax = true;
require_once "../core/configGeneral.php";
if (isset($_POST['cod_even'])) {
    require_once "../controllers/eventoControlador.php";
    $insEvento = new eventoControlador();
    echo $insEvento->validar_disciplinas_evento_controlador();

} else {
    session_start();
    session_destroy();
    echo '<script> window.location.href="' . SERVERURL . 'inicio/"</script>';
}
