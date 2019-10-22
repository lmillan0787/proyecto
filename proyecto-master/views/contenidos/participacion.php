<?php
$peticionAjax = false;

require_once "./controllers/participacionControlador.php";

?>
<!-- Barra de busqueda y boton -->
<nav class="navbar navbar-dark unique-color">
    <form class="form-inline">
        
        <span class="navbar-brand" id="brand1">Participación</span>
    </form>
    <button class="btn btn-info btn-md" type="submit" onclick="location.href='<?php echo SERVERURL ?>registrarParticipacion/'">Registrar</button>
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
                <th scope="col">Editar</th>
                <th scope="col">Eliminar</th>
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
