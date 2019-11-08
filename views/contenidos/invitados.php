<?php

$peticionAjax = false;
require_once "./controllers/invitadoControlador.php";
$insInvitado = new invitadoControlador();

?>
<!--tabla Invitado-->
<!-- Barra de busqueda y boton -->
<nav class="navbar navbar-dark teal darken-1">
    <div id="titulo">
        <h3>INVITADOS</h3>
    </div>
    <button class="btn btn-cyan" type="submit" onclick="location.href='<?php echo SERVERURL ?>registrarInvitado/'">Registrar</button>
</nav>
<!-- Tabla -->
<table class="table table-bordered table-striped" id="tabla">
    <thead>
        <tr>
            <th scope="col">Nombre</th>
            <th scope="col">Apellido</th>
            <th scope="col">Cédula</th>
            <th scope="col">Evento</th>
            <th scope="col">Credencial</th>
            <th scope="col">Editar</th>
        </tr>
    </thead>
    <tbody class="buscar">
        <?php $insInvitado->tabla_invitado(); ?>
    </tbody>
    <tfoot>
        <tr>
            <th scope="col">Nombre</th>
            <th scope="col">Apellido</th>
            <th scope="col">Cédula</th>
            <th scope="col">Evento</th>
            <th scope="col">Credencial</th>
            <th scope="col">Editar</th>
        </tr>
    </tfoot>
</table>