<?php

$peticionAjax = false;
$_GET['views'];
$var = explode("/", $_GET['views']);
$cod_par = $var[1];

require_once "./controllers/participacionControlador.php";
$insParticiapacion = new participacionControlador();
$insParticiapacion->validar_credencial_participacion_evento($cod_par);



?>
