<?php
$peticionAjax = false;

require_once "./controllers/participacionControlador.php";
require_once "./controllers/eventoControlador.php";
$insParticiapacion = new participacionControlador();
$insEvento = new eventoControlador();
$var = explode("/",$_GET['views']);
$cod_even = $var[1];
$datos = [
    "cod_even" => $cod_even
];
?>
<!-- Barra de busqueda y boton -->
<nav class="navbar navbar-dark teal darken-1">
    <div id="titulo">
        <h3>PARTICIPACIÓN <?php $insEvento->cabecera_nombre_evento_controlador($datos) ?></h3>
    </div>
    <?php $insEvento->boton_credenciales($datos) ?>
</nav>
<!-- Tabla -->
<div class="table-wrapper-scroll-y my-custom-scrollbar" id="tablaTodas">
    <table class="text-capitalize table table-bordered table-striped" id="tabla">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Cédula</th>
                <th scope="col">Nombre</th>
                <th scope="col">Apellido</th>
                <th scope="col">Rol</th>
                <th scope="col">Estatus</th>
                <th scope="col">Credencial</th>
            </tr>
        </thead>
        <tbody>
            <?php $insParticiapacion->tabla_participacion($datos) ?>
        </tbody>
    </table>
</div>