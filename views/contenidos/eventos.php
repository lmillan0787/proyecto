<?php
$peticionAjax = false;
require_once "./controllers/eventoControlador.php";
$insEvento = new eventoControlador();
?>
<!-- Barra de busqueda y boton -->
<nav class="navbar navbar-dark teal darken-1">
    <div id="titulo">
        <h3>EVENTOS</h3>
    </div>
    <button id="botonCrear" type="button" class="btn btn-cyan" onclick="location.href='<?php echo SERVERURL ?>registrarEvento/'">Crear evento</button>
</nav>
<!-- Tabla -->
<table id="tabla" class="table table-bordered table-striped">
    <thead>
        <tr>
            <th scope="col">Nombre del Evento</th>
            <th scope="col">Fecha</th>
            <th scope="col">Tipo</th>
            <th scope="col">Región</th>
            <th scope="col">Estatus</th>
            <th scope="col">Ver</th>
            <th scope="col">Editar</th>
        </tr>
    </thead>
    <tbody class="buscar">
        <?php
        $insEvento->tabla_evento_controlador();
        ?>
    </tbody>
    <tfoot>
        <tr>
            <th scope="col">Nombre del Evento</th>
            <th scope="col">Fecha</th>
            <th scope="col">Tipo</th>
            <th scope="col">Región</th>
            <th scope="col">Estatus</th>
            <th scope="col">Ver</th>
            <th scope="col">Editar</th>
        </tr>
    </tfoot>
</table>