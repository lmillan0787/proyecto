<?php
$peticionAjax = false;

require_once "./controllers/eventoControlador.php";

?>
<!-- Barra de busqueda y boton -->
<nav class="navbar navbar-dark unique-color">
    <button id="modalActivate" type="button" class="btn btn-info btn-md" onclick="location.href='<?php echo SERVERURL ?>regEvento/'">Crear evento</button>
    <form class="form-inline">
        <input class="form-control mr-sm-2" id="filtrar" type="text" placeholder="Buscar" aria-label="Buscar">
        <span class="navbar-brand" id="brand1">Eventos</span>
    </form>
</nav>
<!-- Tabla -->
<div class='table-responsive' id="tablasTodas">
    <table id="tabla" class="table table-bordered table-striped">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nombre del Evento</th>
                <th scope="col">Fecha</th>
                <th scope="col">Tipo</th>
                <th scope="col">Estado del Evento</th>
                <th scope="col">Estatus</th>
                <th scope="col">Ver</th>
                <th scope="col">Editar</th>
                <th scope="col">Eliminar</th>
            </tr>
        </thead>
        <tbody class="buscar">
            <?php

                $tablaEvento = new eventoControlador();
                $tablaEvento->tabla_evento();

            ?>
        </tbody>
        <tfoot>
            <tr></tr>
                <th scope="col">#</th>
                <th scope="col">Nombre del Evento</th>
                <th scope="col">Fecha</th>
                <th scope="col">Tipo</th>
                <th scope="col">Estado del Evento</th>
                <th scope="col">Estatus</th>
                <th scope="col">Ver</th>
                <th scope="col">Editar</th>
                <th scope="col">Eliminar</th>
            </tr>
        </tfoot>
    </table>
</div>
