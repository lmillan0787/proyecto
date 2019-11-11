<?php
$peticionAjax = false;

require_once "./controllers/participacionControlador.php";
require_once "./controllers/eventoControlador.php";
$insParticiapacion = new participacionControlador();
$insEvento = new eventoControlador();
$cod_even = $_POST['cod_even'];
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
    <button class="btn btn-info" type="submit" onclick="location.href='<?php echo SERVERURL ?>registrarParticipacion/'">Registrar</button>
</nav>
<!-- Tabla -->
<table class="table table-bordered table-striped" id="tabla">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Cédula</th>
            <th scope="col">Nombre</th>
            <th scope="col">Apellido</th>
            <th scope="col">Perfil</th>
            <th scope="col">Evento</th>
            <th scope="col">Credencial</th>
            <th scope="col">Editar</th>
        </tr>
    </thead>
    <tbody>
        <?php $insParticiapacion->tabla_participacion($datos) ?>
    </tbody>
</table>