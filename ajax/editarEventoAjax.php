<?php
    $peticionAjax = true;
    require_once "../core/configGeneral.php";
    if (isset($_POST['cod_even']) && isset($_POST['des_even']) && isset($_POST['fec_even']) && isset($_POST['cod_reg']) && isset($_POST['cod_tip_even']) && isset($_POST['cod_estat'])) {
        require_once "../controllers/eventoControlador.php";
        $insEvento = new eventoControlador();                
        echo $insEvento->editar_evento_controlador();
        
    } else {
        session_start();
        session_destroy();
        echo '<script> window.location.href="' . SERVERURL . 'inicio/"</script>';
   
    }