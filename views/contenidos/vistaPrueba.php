<?php
$peticionAjax = false;
include "./controllers/invitadoControlador.php";
$insDeportista= new invitadoControlador();



$insDeportista->agregar_invitado_controlador();

?>

