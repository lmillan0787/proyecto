<?php

$peticionAjax = false;
$cod_even = $_POST['cod_even'];
require_once "./controllers/eventoControlador.php";
$insEvento = new eventoControlador();
$insEvento->formulario_editar_evento();


?>
