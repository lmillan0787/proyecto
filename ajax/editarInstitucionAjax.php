<?php
    $peticionAjax = true;
    require_once "../core/configGeneral.php";
    if (isset($_POST['cod_inst']) && isset($_POST['des_inst']) && isset($_POST['siglas'])) {
        require_once "../controllers/institucionControlador.php";
        $insDis = new institucionControlador();                
        echo $insDis->editar_institucion_controlador();
        
    } else {
        session_start();
        session_destroy();
        echo '<script> window.location.href="' . SERVERURL . 'inicio/"</script>';
   
    }