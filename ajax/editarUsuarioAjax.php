<?php
    $peticionAjax = true;
    require_once "../core/configGeneral.php";
    if (isset($_POST['cod_usr']) && isset($_POST['des_usr']) && isset($_POST['des_usr']) && isset($_POST['cod_perf']) && isset($_POST['clave']) && isset($_POST['repClave']) && isset($_POST['cod_estat'])) {
        require_once "../controllers/usuarioControlador.php";
        $usuario = new usuarioControlador();
        echo $usuario->editar_usuario_controlador();
    } else {
        session_start();
        session_destroy();
        echo '<script> window.location.href="' . SERVERURL . 'inicio/"</script>';
    }