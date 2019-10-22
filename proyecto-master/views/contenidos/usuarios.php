<?php

    $peticionAjax = false;
    require_once "./controllers/usuarioControlador.php";

?>
<!-- Barra de busqueda y boton -->
<nav class="navbar navbar-dark unique-color">
    <form class="form-inline">
        <input class="form-control mr-sm-2" id="filtrar" type="text" placeholder="Buscar" aria-label="Buscar">
        <span class="navbar-brand" id="brand1">Usuarios</span>
    </form>
    <button class="btn btn-info btn-md" type="submit" onclick="location.href='<?php echo SERVERURL ?>registrarUsuario/'">Registrar</button>
</nav>
<!-- Tabla -->
<div class="table-wrapper-scroll-y my-custom-scrollbar" id="tablaTodas">
    <table class="table table-bordered table-striped" id="tabla">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Cédula</th>
                <th scope="col">Nombre</th>
                <th scope="col">Apellido</th>
                <th scope="col">Usuario</th>
                <th scope="col">Perfil</th>
                <th scope="col">Editar</th>
                <th scope="col">Eliminar</th>
            </tr>
        </thead>
        <tbody class="buscar">
            <?php

            $insPersona = new usuarioControlador();
            $insPersona->tabla_usuario();

            ?>
        </tbody>
    </table>
</div>