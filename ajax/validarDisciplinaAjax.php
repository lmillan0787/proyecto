<?php

$peticionAjax = true;
require_once "../core/configGeneral.php";
if (isset($_POST['des_dis'])) {
    require_once "../controllers/disciplinaControlador.php";
    $insDis = new disciplinaControlador();
    echo $insDis->validar_disciplina_controlador();
} else {
    session_start();
    session_destroy();
    echo '<script> window.location.href="' . SERVERURL . 'inicio/"</script>';
}
