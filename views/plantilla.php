<?php

$peticionAjax = false;
session_start(['name'=>'junain']);


?>

<!DOCTYPE html>
<html lang="es" class=" animated fadeIn">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta http-equiv="Expires" content="0">
    <meta http-equiv="Last-Modified" content="0">
    <meta http-equiv="Cache-Control" content="no-cache, mustrevalidate">
    <meta http-equiv="Pragma" content="no-cache">
    <title>Junain</title>

  
    <!-- Bootstrap core CSS -->
    <link href="<?php echo SERVERURL ?>views/assets/css/bootstrap.min.css" rel="stylesheet">
    <!-- Material Design Bootstrap -->
    <link href="<?php echo SERVERURL ?>views/assets/css/mdb.min.css" rel="stylesheet">
    <!-- Sweetalert2 -->
    <link href="<?php echo SERVERURL ?>views/assets/css/sweetalert2.css" rel="stylesheet">   
    <!-- Estilos personalizados -->
    <link href="<?php echo SERVERURL ?>views/assets/css/style.css" rel="stylesheet">   

    <script type="text/javascript" src="<?php echo SERVERURL ?>views/assets/js/jquery-3.4.1.min.js"></script>
    <!-- Data table -->
    <script type="text/javascript" src="<?php echo SERVERURL ?>views/assets/js/webcam.min.js"></script>
    <!-- Sweetalerts -->
    <script type="text/javascript" src="<?php echo SERVERURL ?>views/assets/js/sweetalert2.all.js"></script>

</head>

<body>

    <!-- header -->
    <div class="container" id="conb">
        <img id="banner" src="<?php echo SERVERURL ?>views/assets/img/banner.jpg">
    </div>
    <?php


    require_once "controllers/vistasControlador.php";
    $vt = new vistasControlador();
    $vistasR = $vt->obtener_vistas_controlador();
    if ($vistasR == "inicio" || $vistasR == "404") {
        if ($vistasR == "inicio") {
            require_once "./views/contenidos/inicio.php";
        } else {
            require_once "./views/contenidos/404.php";
        }
    } else {

        require_once "include/nav.php";
        
        ?>

        <div id="con_todo">
            <?php require_once $vistasR; ?>
        </div>

    <?php } ?>
    <!-- footer -->   
    <div class="container " id="conf">
        <img src="<?php echo SERVERURL ?>views/assets/img/pie_pagina1.jpg" id="pie">
    </div>

    <!-- Sweetalerts -->
    <script type="text/javascript" src="<?php echo SERVERURL ?>views/assets/js/sweetalert2.all.js"></script>
    <!-- JQuery -->
    <script type="text/javascript" src="<?php echo SERVERURL ?>views/assets/js/jquery-3.4.1.min.js"></script>
    <!-- Bootstrap tooltips -->
    <script type="text/javascript" src="<?php echo SERVERURL ?>views/assets/js/popper.min.js"></script>
    <!-- Bootstrap core JavaScript -->
    <script type="text/javascript" src="<?php echo SERVERURL ?>views/assets/js/bootstrap.min.js"></script>
    <!-- MDB core JavaScript -->
    <script type="text/javascript" src="<?php echo SERVERURL ?>views/assets/js/mdb.min.js"></script>
    <!-- Font Awesome -->
    <script type="text/javascript" src="<?php echo SERVERURL ?>views/assets/js/all.js"></script>
    <!-- Data table -->
    <script type="text/javascript" src="<?php echo SERVERURL ?>views/assets/js/addons/datatables.min.js"></script>
    
    <!-- main js -->
    <script type="text/javascript" src="<?php echo SERVERURL ?>views/assets/js/main.js"></script>
</body>

</html>