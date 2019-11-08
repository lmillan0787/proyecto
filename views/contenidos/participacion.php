<?php
$peticionAjax = false;

require_once "./controllers/participacionControlador.php";
require_once "./controllers/eventoControlador.php";
$insPersona = new participacionControlador();
$insEvento = new eventoControlador();

?>
<!-- Barra de busqueda y boton -->
<nav class="navbar navbar-dark teal darken-1">
    <div id="titulo">
        <h3>PARTICIPACIÓN</h3>
    </div>

    <button class="btn btn-info" type="submit" onclick="location.href='<?php echo SERVERURL ?>registrarParticipacion/'">Registrar</button>
</nav>
<!-- Tabla -->

<div class="container">
<form action="<?php echo SERVERURL ?>ajax/generarCredencialesAjax.php" method="POST" target="_blank" rel="noopener noreferrer">        <div class="row">
            <div class="col">
                <b><label for="textInput">Eventos:</label></b>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <label class="input-group-text" for="inputGroupSelect01"><i class="fas fa-globe-americas prefix grey-text"></i></label>
                    </div>
                    <select class="browser-default custom-select" id="cod_even" name="cod_even" required>
                        <option selected disabled></option>
                        <?php $insEvento->consultar_evento_activo() ?>
                    </select>
                </div>
                <div class="col">
                    <button class="btn btn-info" type="submit">Credenciales</button>
                    <div class="RespuestaAjax"></div>
                </div>
            </div>
        </div>
    </form>
</div>


<table class="table table-bordered table-striped" id="tabla">
    <thead>
        <tr>
            <th scope="col">Cédula</th>
            <th scope="col">Nombre</th>
            <th scope="col">Apellido</th>
            <th scope="col">Perfil</th>
            <th scope="col">Edad</th>
            <th scope="col">Género</th>
            <th scope="col">Evento</th>
            <th scope="col">Editar</th>
            <th scope="col">Eliminar</th>
        </tr>
    </thead>
    <tbody class="buscar" id="select2lista">
    </tbody>
</table>



<script type="text/javascript">
    $(document).ready(function() {
        $('#cod_even').val(0);
        recargarLista();

        $('#cod_even').change(function() {
            recargarLista();
        });
    })
</script>
<script type="text/javascript">
    function recargarLista() {
        $.ajax({
            type: "POST",
            url: "<?php echo SERVERURL ?>ajax/eventosActivosAjax.php",
            data: "cod_even=" + $('#cod_even').val(),
            success: function(r) {
                $('#select2lista').html(r);
            }
        });
    }
</script>