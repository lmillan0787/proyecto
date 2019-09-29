<?php
    $peticionAjax = true;
    require_once "../core/configGeneral.php";
    if (isset($_POST['ced'])) {
        /*echo $_POST['ced'].' '.$_POST['des_usr'].' '.$_POST['clave'].' '.$_POST['repClave'].' '.$_POST['cod_rol'].' '.$_POST['cod_rol'];*/
        require_once "../controllers/usuarioControlador.php";
        $insUsuario = new usuarioControlador();

        if (isset($_POST['ced']) && isset($_POST['des_usr']) && isset($_POST['clave']) && isset($_POST['repClave']) && isset($_POST['cod_rol']) && isset($_POST['cod_perf'])) {
            echo $insUsuario->agregar_usuario_controlador();
        }
    } else {
        session_start();
        session_destroy();
        echo '<script> window.location.href="' . SERVERURL . 'inicio/"</script>';
    }