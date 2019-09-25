<?php
$peticionAjax = false;

require_once "./controllers/participacionControlador.php";

?>
<!-- Barra de busqueda y boton -->
<nav class="navbar navbar-dark unique-color">
    <form class="form-inline">
        <input class="form-control mr-sm-2" id="filtrar" type="text" placeholder="Buscar" aria-label="Buscar">
        <span class="navbar-brand" id="brand1">Personas</span>
    </form>
    <button class="btn btn-outline-white btn-md my-2 my-sm-0 ml-3" type="submit" onclick="location.href='<?php echo SERVERURL ?>regParticipacion/'">Registrar</button>
</nav>
<!-- Tabla -->
<div class="table-wrapper-scroll-y my-custom-scrollbar" id="tablaTodas">
    <table class="table table-bordered table-striped" id="tabla">
        <thead>
            <tr>
                <th scope="col">Cédula</th>
                <th scope="col">Nombre</th>
                <th scope="col">Apellido</th>
                <th scope="col">Perfil</th>
                <th scope="col">Edad</th>
                <th scope="col">Género</th>
                <th scope="col">Evento</th>
                <th scope="col">Ver</th>
                <th scope="col">Editar</th>
            </tr>
        </thead>
        <tbody class="buscar">
            <?php

                $insPersona = new participacionControlador();
                $insPersona->tabla_participacion();

            ?>
        </tbody>
    </table>
</div>
