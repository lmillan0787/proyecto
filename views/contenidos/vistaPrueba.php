<?php
$peticionAjax = false;
include "./controllers/tecnicoControlador.php";
$insTecnico= new tecnicoControlador();

session_start();
?>








<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
    hola <?php $insTecnico->consultarCargo(); ?>
</body>
</html>