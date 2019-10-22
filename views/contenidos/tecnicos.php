<?php
$peticionAjax = false;

require_once "./controllers/tecnicoControlador.php";

?>
<!-- Barra de busqueda y boton -->
<nav class="navbar navbar-dark teal darken-1">
    <form class="form-inline">
       
        <span class="navbar-brand" id="brand1">Personal Técnico</span>
    </form>
    <button class="btn btn-cyan" type="submit" onclick="location.href='<?php echo SERVERURL ?>registrarTecnico/'">Registrar</button>
</nav>
<!-- Tabla -->
<div class="table-wrapper-scroll-y my-custom-scrollbar" id="tablaTodas">
    <table class="table table-bordered table-striped" id="tabla">
        <thead>
            <tr>
                <th scope="col">Cédula</th>
                <th scope="col">Nombre</th>
                <th scope="col">Apellido</th>
                <th scope="col">Cargo</th>
                <th scope="col">Fecha</th>
                <th scope="col">Institución</th>
                <th scope="col">Evento</th>
                <th scope="col">Editar</th>
                <th scope="col">Eliminar</th>
            </tr>
        </thead>
        <tbody class="buscar">
            <?php

                $insTecnico = new tecnicoControlador();
                $insTecnico->tabla_tecnico();

            ?>
        </tbody>
    </table>
</div>
