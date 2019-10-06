<?php
    $peticionAjax = false;

    require_once "./controllers/personaControlador.php";    
    $insPersona = new personaControlador();
    $insPersona->consultar_persona2();

?>


