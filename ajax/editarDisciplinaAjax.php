<?php
    $peticionAjax = true;
    require_once "../core/configGeneral.php";
    if (isset($_POST['cod_dis']) && isset($_POST['des_dis']) && isset($_POST['cod_tip_even'])) {
        require_once "../controllers/disciplinaControlador.php";
        $insDis = new disciplinaControlador();                
        echo $insDis->editar_disciplina_controlador();
        
    } else {
        session_start();
        session_destroy();
        echo '<script> window.location.href="' . SERVERURL . 'inicio/"</script>';
   
    }