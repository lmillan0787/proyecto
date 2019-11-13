<?php
$peticionAjax = false;

require_once "./controllers/medicoControlador.php";

?>

<!-- Barra de busqueda y boton -->
<nav class="navbar navbar-dark teal darken-1">
    <div id="titulo">
        <h3>MÉDICOS</h3>
    </div>

    <button class="btn btn-info" type="submit" onclick="location.href='<?php echo SERVERURL ?>registrarMedico/'">Registrar</button>
</nav>
<!-- Tabla -->
<div class="table-wrapper-scroll-y my-custom-scrollbar">
    <table class="table table-bordered table-striped" id="tabla">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Cédula</th>
                <th scope="col">Nombre</th>
                <th scope="col">Apellido</th>
                <th scope="col">Región</th>
                <th scope="col">Editar</th>
            </tr>
        </thead>
        <tbody class="buscar">

            <?php
            $insMedico = new medicoControlador();
            $insMedico->tabla_medico();
            ?>

        </tbody>
    </table>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        (function($) {
            $('#filtrar').keyup(function() {
                var rex = new RegExp($(this).val(), 'i');
                $('.buscar tr').hide();
                $('.buscar tr').filter(function() {
                    return rex.test($(this).text());
                }).show();
            })
        }(jQuery));
    });
</script>