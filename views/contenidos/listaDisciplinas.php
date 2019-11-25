<?php
if ($_SESSION['cod_perf'] != 1) {
    echo '<script> window.location.href="' . SERVERURL . 'home/"</script>';
}
$peticionAjax = false;
require_once "./controllers/disciplinaControlador.php";

?>
<!-- Barra de busqueda y boton -->
<nav class="navbar navbar-dark teal darken-1">
    <div id="titulo">
        <h3>DISCIPLINAS</h3>
    </div>
    <button class="btn btn-cyan" type="submit" onclick="location.href='<?php echo SERVERURL ?>registrarDisciplina/'">Registrar</button>
</nav>
<!-- Tabla -->
<div class="table-wrapper-scroll-y my-custom-scrollbar" id="tablaTodas">
    <table class="table table-bordered table-striped" id="tabla">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Disciplina</th>
                <th scope="col">Tipo</th>
                <th scope="col">Editar</th>
            </tr>
        </thead>
        <tbody class="buscar">
            <?php

            $insDisciplina = new disciplinaControlador();
            $insDisciplina->tabla_disciplina();

            ?>
        </tbody>
    </table>
</div>