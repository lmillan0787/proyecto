<?php
<<<<<<< HEAD
=======

>>>>>>> aeaf42768a76951059e9c19df36c5b7d192892c1
    $peticionAjax = true;
    require_once "../core/configGeneral.php";
    if (isset($_POST['cod_even'])) {
        require_once "../controllers/eventoControlador.php";
        $insEvento = new eventoControlador();
        echo $insEvento->eliminar_evento_controlador();
        
    } else {
        session_start();
        session_destroy();
        echo '<script> window.location.href="' . SERVERURL . 'inicio/"</script>';
    }
        $insEvento = new eventoControlador();       
        echo $insEvento->eliminar_evento_controlador();
        
    }else{
        session_start();
        session_destroy();
        echo '<script> window.location.href="' . SERVERURL . 'inicio/"</script>';
    }
