<?php

$peticionAjax = true;
require_once "../core/configGeneral.php";
if (isset($_POST['des_dis'])) {
    require_once "../controllers/disciplinaControlador.php";
    $insDisciplina = new disciplinaControlador();

    if (isset($_POST['des_dis']) && isset($_POST['cod_tip_even'])) {
        echo $insDisciplina->agregar_disciplina_controlador();
    }
} else {
    session_start();
    session_destroy();
    echo '<script> window.location.href="' . SERVERURL . 'inicio/"</script>';
}