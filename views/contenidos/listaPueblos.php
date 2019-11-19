<?php

    $peticionAjax = false;
    require_once "./controllers/puebloControlador.php";

?>
<!-- Barra de busqueda y boton -->
<nav class="navbar navbar-dark teal darken-1">
    <div id="titulo">
        <h3>PUEBLOS</h3>
    </div>
    <button class="btn btn-cyan" type="submit" onclick="location.href='<?php echo SERVERURL ?>registrarPueblo/'">Registrar</button>
</nav>
<!-- Tabla -->
<div class="table-wrapper-scroll-y my-custom-scrollbar" id="tablaTodas">
    <table class="table table-bordered table-striped" id="tabla">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nombre del Pueblo</th>
                <th scope="col">Editar</th>
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



