<?php

    $peticionAjax = true;
    require_once "../core/configGeneral.php";
    if(isset($_POST['des_pue'])){
        require_once "../controllers/puebloControlador.php";
        $insPueblo = new puebloControlador();
        echo $insPueblo->agregar_pueblo_controlador();
        
    }else{
        session_start();
        session_destroy();
        echo '<script> window.location.href="'.SERVERURL.'inicio/"</script>';
    }