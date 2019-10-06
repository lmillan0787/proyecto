<?php
$peticionAjax = false;

require_once "./controllers/personaControlador.php";

?>
<!-- Barra de busqueda y boton -->
<nav class="navbar navbar-dark unique-color">
    <form class="form-inline">        
        <span class="navbar-brand" id="brand1">Personas</span>
    </form>
    <button class="btn btn-info btn-md" type="submit" onclick="location.href='<?php echo SERVERURL ?>registrarPersona/'">Registrar</button>
</nav>
<!-- Tabla -->
<div class="table-wrapper-scroll-y my-custom-scrollbar" id="tablaTodas">
    <table class="table table-bordered table-striped" id="tabla">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nacionalidad</th>
                <th scope="col">Cédula</th>
                <th scope="col">Nombre</th>
                <th scope="col">Apellido</th>
                <th scope="col">Genero</th>
                <th scope="col">Edad</th>                
                <th scope="col">Editar</th>
                <th scope="col">Eliminar</th>
            </tr>
        </thead>
        <tbody class="buscar">
            <?php

                $insPersona = new personaControlador();
                $insPersona->tabla_persona();

            ?>
        </tbody>
    </table>
</div>
