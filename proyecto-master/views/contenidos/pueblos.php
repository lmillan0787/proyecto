<?php

    $peticionAjax = false;
    require_once "./controllers/puebloControlador.php";

?>
<!-- Barra de busqueda y boton -->
<nav class="navbar navbar-dark unique-color">
    <form class="form-inline">
        <span class="navbar-brand" id="brand1">Pueblos</span>
    </form>
    <button class="btn btn-info btn-md" type="submit" onclick="location.href='<?php echo SERVERURL ?>registrarPueblo/'">Registrar</button>
</nav>
<!-- Tabla -->
<div class="table-wrapper-scroll-y my-custom-scrollbar" id="tablaTodas">
    <table class="table table-bordered table-striped" id="tabla">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nombre del Pueblo</th>
                <th scope="col">Región</th>
                <th scope="col">Editar</th>
                <th scope="col">Eliminar</th>
            </tr>
        </thead>
        <tbody class="buscar">
            <?php

            $insPueblo = new PuebloControlador();
            $insPueblo->tabla_pueblo();

            ?>
        </tbody>
    </table>
</div>



