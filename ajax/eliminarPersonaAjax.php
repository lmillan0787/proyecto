
<?php
$peticionAjax = true;
require_once "../core/configGeneral.php";
if (isset($_POST['cod_per'])) {
    require_once "../controllers/personaControlador.php";
    $insPersona = new personaControlador();
    echo $insPersona->eliminar_persona_controlador();
    
} else {
    session_start();
    session_destroy();
    echo '<script> window.location.href="' . SERVERURL . 'inicio/"</script>';
}