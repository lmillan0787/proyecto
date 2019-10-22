<?php
$peticionAjax = false;

require_once "./controllers/delegadoControlador.php";

?>
<!--tabla Delegado-->
<div id="con_todo">
    <!-- Barra de busqueda y boton -->
    <nav class="navbar navbar-dark teal darken-1">
        <div id="titulo">
            <h3>DELEGADOS</h3>
        </div>
        <button class="btn btn-cyan" type="submit" onclick="location.href='<?php echo SERVERURL ?>registrarDelegado/'">Registrar</button>
    </nav>
    <!-- Tabla -->
    <table class="table table-bordered table-striped" id="tabla">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nombre</th>
                <th scope="col">Apellido</th>
                <th scope="col">Cédula</th>
                <th scope="col">Genero</th>
                <th scope="col">Edad</th>
                <th scope="col">Disciplina</th>
                <th scope="col">Editar</th>
                <th scope="col">Eliminar</th>
            </tr>
        </thead>
        <tbody class="buscar">
            <?php
            $insDelegado = new delegadoControlador();
            $insDelegado->tabla_delegado();
            ?>
        </tbody>
    </table>
</div>
