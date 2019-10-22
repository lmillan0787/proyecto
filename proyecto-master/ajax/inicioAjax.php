<?php

    $peticionAjax = true;

    require_once "../core/configGeneral.php";
    if (isset($_POST['des_usr']) && isset($_POST['clave'])) {
        require_once "./controllers/loginControlador.php";
        $login = new inicioControlador();
        echo $login->iniciar_sesion_controlador();
    } else {
        session_start();
        session_destroy();
        echo '<script> window.location.href="' . SERVERURL . 'inicio/"</script>';
    }
