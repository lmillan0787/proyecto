<?php

$peticionAjax = false;
require_once "./controllers/eventoControlador.php";
require_once "./controllers/disciplinaControlador.php";
$insEvento = new eventoControlador();
$fecha_actual = date("Y-m-d");
$fechaValidacion = date("d-m-Y");

?>
<div class="card" id="form_evento">
    <h5 class="card-header info-color white-text text-center py-4">
        <strong>Datos Básicos del Evento</strong>
    </h5>
    <!--Formulario de inicio-->
    <div class="card-body px-lg-5">
        <form class="FormularioAjax" action="<?php echo SERVERURL ?>ajax/registrarEventoAjax.php" method="POST" data-form="guardar" autocomplete="off" enctype="multipart/form-data">
            <div class="text-center">
            </div>
            <!-- Nombre del Evento-->
            <b><label for="textInput">Nombre del evento:</label></b>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="addon-wrapping"><i class="fas fa-newspaper prefix grey-text"></i></span>
                </div>
                <input onkeyup="javascript:this.value=this.value.toUpperCase();" type="text" class="form-control" placeholder="Nombre del Evento" aria-describedby="addon-wrapping" minlength="2" maxlength="15" required pattern="[A-Za-zñÑáéíóúÁÉÍÓÚöÖüÜ\s0-9]+" name="des_even" required id="des_even">
            </div>
            <div id="result-even"></div>
            <!-- Fecha inicio del evento-->
            <br><b><label for="textInput">Fecha del evento:</label></b>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="addon-wrapping"><i class="far fa-calendar-alt prefix grey-text"></i></span>
                </div>
                <input type="date" class="form-control" placeholder="Fecha del evento" aria-label="Username" aria-describedby="addon-wrapping" min="<?php echo $fecha_actual ?>" max="2051-01-01" step="1" name="fec_even" required id="fec_even">
            </div>
            <div id="result-fec"></div>
            <!-- Region-->
            <br><b><label for="textInput">Región:</label></b>
            <div class="input-group">
                <div class="input-group-prepend">
                    <label class="input-group-text" for="inputGroupSelect01"><i class="fas fa-globe-americas prefix grey-text"></i></label>
                </div>
                <select class="browser-default custom-select" id="cod_reg" name="cod_reg" required>
                    <option selected disabled>Región</option>
                    <?php $insEvento->formulario_evento_region() ?>
                </select>
            </div>
            <div id="result-reg"></div>
            <!-- Tipo de evento-->
            <br><b><label for="textInput">Tipo de evento:</label></b>
            <div class="input-group">
                <div class="input-group-prepend">
                    <label class="input-group-text" for="inputGroupSelect01"><i class="fas fa-globe-americas prefix grey-text"></i></label>
                </div>
                <select class="browser-default custom-select" id="cod_tip_even" name="cod_tip_even" required>
                    <option selected disabled>Tipo de evento</option>
                    <?php $insEvento->formulario_evento_tipo() ?>
                </select>
            </div>
            <br><button class="btn btn-info btn-block" type="submit">Registrar</button>
            <div class="RespuestaAjax"></div>
        </form>
    </div>
</div>


<script type="text/javascript">
    $(document).ready(function() {
        $('#des_even').on('blur', function() {
            $('#result-even').html('<img src="<?php echo SERVERURL ?>views/assets/img/loader.gif" />')
                .fadeOut(1500);

            var des_even = $(this).val();
            var dataString = 'des_even=' + des_even;

            $.ajax({
                type: "POST",
                url: "<?php echo SERVERURL ?>ajax/validarEventoAjax.php",
                data: dataString,
                success: function(data) {
                    $('#result-even').fadeIn(1000).html(data);
                }
            });
        });
    });
    $(document).ready(function() {
        $('#cod_reg').on('blur', function() {
            $('#result-reg').html('<img src="<?php echo SERVERURL ?>views/assets/img/loader.gif" />')
                .fadeOut(1500);

            var cod_reg = $(this).val();
            var dataString = 'cod_reg=' + cod_reg;

            $.ajax({
                type: "POST",
                url: "<?php echo SERVERURL ?>ajax/validarEventoAjax.php",
                data: dataString,
                success: function(data) {
                    $('#result-reg').fadeIn(1000).html(data);
                }
            });
        });
    });
    $(document).ready(function() {
        $('#fec_even').on('blur', function() {
            $('#result-fec').html('<img src="<?php echo SERVERURL ?>views/assets/img/loader.gif" />')
                .fadeOut(1500);

            var fec_even = $(this).val();
            var dataString = 'fec_even=' + fec_even;

            $.ajax({
                type: "POST",
                url: "<?php echo SERVERURL ?>ajax/validarEventoAjax.php",
                data: dataString,
                success: function(data) {
                    $('#result-fec').fadeIn(1000).html(data);
                }
            });
        });
    });
</script>