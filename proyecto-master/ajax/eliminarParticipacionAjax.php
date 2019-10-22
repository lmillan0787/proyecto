
<?php
$peticionAjax = true;
require_once "../core/configGeneral.php";
if (isset($_POST['cod_par'])) {
    require_once "../controllers/participacionControlador.php";
    $insParticipacion = new participacionControlador();
    echo $insParticipacion->eliminar_participacion_controlador();
    
} else {
    session_start();
    session_destroy();
    echo '<script> window.location.href="' . SERVERURL . 'inicio/"</script>';
}