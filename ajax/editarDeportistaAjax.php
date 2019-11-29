<?php
    $peticionAjax = true;
    require_once "../core/configGeneral.php";
    if (isset($_POST['cod_par']) && isset($_POST['ced']) && isset($_POST['cod_even']) && isset($_POST['cod_perf']) && isset($_POST['cod_estat']) && isset($_POST['cod_reg']) && isset($_POST['cod_pue']) && isset($_POST['cod_dis']) && isset($_POST['cod_cat'])) {
        require_once "../controllers/deportistaControlador.php";
        $insDeportista = new deportistaControlador();
        echo $insDeportista->editar_deportista_controlador();

    } else {
        session_start();
        session_destroy();
        echo '<script> window.location.href="' . SERVERURL . 'inicio/"</script>';
    }