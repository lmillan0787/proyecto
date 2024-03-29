<?php
if($_SESSION['cod_perf'] != 1){
    echo '<script> window.location.href="' . SERVERURL . 'home/"</script>';
}
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
<div class="table-wrapper-scroll-y my-custom-scrollbar" id="tablaTodas">
    <table class="table table-bordered table-striped" id="tabla">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nombre del Evento</th>
                <th scope="col">Fecha</th>
                <th scope="col">Tipo</th>
                <th scope="col">Región</th>
                <th scope="col">Estatus</th>
                <th scope="col">Estadisticas</th>
                <th scope="col">Editar</th>
            </tr>
        </thead>
        <tbody class="buscar">
            <?php
            $insEvento->tabla_evento_controlador();
            ?>
        </tbody>
    </table>
</div>