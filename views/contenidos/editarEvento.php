<?php

$peticionAjax = false;
require_once "./controllers/eventoControlador.php";
require_once "./controllers/disciplinaControlador.php";
$insEvento = new eventoControlador();
$insDisciplina = new disciplinaControlador();
$cod_even = $_POST['cod_even'];
$fecha_actual = date("Y-m-d");

?>
<!-- Validar Cedula -->
<!--<script type="text/javascript">
    $(document).ready(function() {
        $('#des_even').on('blur', function() {
            $('#result-even').html('<img src="<?php echo SERVERURL ?>views/assets/img/loader.gif" />').fadeOut(1000);

            var des_even = $(this).val();
            var dataString = 'des_even=' + des_even;

            $.ajax({
                type: "POST",
                url: "<?php echo SERVERURL ?>ajax/EditarEventoAjax.php",
                data: dataString,
                success: function(data) {
                    $('#result-even').fadeIn(1000).html(data);
                }
            });
        });
    });
</script>-->
<div class="card" id="form_evento">
    <h5 class="card-header info-color white-text text-center py-4">
        <strong>Datos Básicos del Evento</strong>
    </h5>
    <!--Formulario de inicio-->
    <div class="card-body px-lg-5">
        <form class="FormularioAjax" action="<?php echo SERVERURL ?>ajax/editarEventoAjax.php" method="POST" data-form="guardar" autocomplete="off" enctype="multipart/form-data">
            <div class="text-center">
            </div>
            <!-- Nombre del Evento-->
            <b><label for="textInput">Nombre del evento:</label></b>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="addon-wrapping"><i class="fas fa-newspaper prefix grey-text"></i></span>
                </div>
                <?php $insEvento->formulario_editar_nombre_evento_controlador() ?>
            </div>
            <div id="result-even"></div>
            <!-- Fecha inicio del evento-->
            <br><b><label for="textInput">Fecha del evento:</label></b>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="addon-wrapping"><i class="far fa-calendar-alt prefix grey-text"></i></span>
                </div>
                <?php $insEvento->formulario_editar_fecha_evento_controlador() ?>
            </div>
            <div id="result-fec"></div>
            <!-- Region-->
            <br><b><label for="textInput">Región:</label></b>
            <div class="input-group">
                <div class="input-group-prepend">
                    <label class="input-group-text" for="inputGroupSelect01"><i class="fas fa-globe-americas prefix grey-text"></i></label>
                </div>
                <select class="browser-default custom-select" id="cod_reg" name="cod_reg" required>
                    <?php
                    $insEvento->formulario_editar_region_evento_controlador();
                    $insEvento->formulario_evento_region_distinta();
                    ?>
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
                    <?php
                    $insEvento->formulario_editar_tipo_evento_controlador();
                    $insEvento->formulario_evento_tipo_distinto();
                    ?>
                </select>
            </div>
            <!-- Estatus-->
            <br><b><label for="textInput">Estatus:</label></b>
            <div class="input-group">
                <div class="input-group-prepend">
                    <label class="input-group-text" for="inputGroupSelect01"><i class="fas fa-toggle-on prefix grey-text"></i></label>
                </div>
                <select class="browser-default custom-select" id="inputGroupSelect01" id="cod_estat" name="cod_estat" required>
                    <?php 
                    $insEvento->formulario_evento_estatus();
                    $insEvento->formulario_editar_estatus_evento_controlador();
                    ?>   
                </select>
            </div>
            <input type="text" hidden required name="cod_even" id="cod_even" value="<?php echo $cod_even ?>">
            <br><button class="btn btn-info btn-block" type="submit">Aceptar</button>
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
            var dataString = {
                'des_even': des_even,
                'cod_even': <?php echo $cod_even ?>
            };

            $.ajax({
                type: "POST",
                url: "<?php echo SERVERURL ?>ajax/validarEventoDistintoAjax.php",
                data: dataString,
                success: function(data) {
                    $('#result-even').fadeIn(1000).html(data);
                }
            });
        });
    });
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    $(document).ready(function() {
        $('#fec_even').on('blur', function() {
            $('#result-fec').html('<img src="<?php echo SERVERURL ?>views/assets/img/loader.gif" />')
                .fadeOut(1500);

            var fec_even = $(this).val();
            var dataString = {
                'fec_even': fec_even,
                'cod_even': <?php echo $cod_even ?>
            };

            $.ajax({
                type: "POST",
                url: "<?php echo SERVERURL ?>ajax/validarEventoDistintoAjax.php",
                data: dataString,
                success: function(data) {
                    $('#result-fec').fadeIn(1000).html(data);
                }
            });
        });
    });
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    $(document).ready(function() {
        $('#cod_reg').on('blur', function() {
            $('#result-reg').html('<img src="<?php echo SERVERURL ?>views/assets/img/loader.gif" />')
                .fadeOut(1500);

            var cod_reg = $(this).val();
            var dataString = {
                'cod_reg': fcod_reg,
                'cod_even': <?php echo $cod_even ?>
            };

            $.ajax({
                type: "POST",
                url: "<?php echo SERVERURL ?>ajax/validarEventoDistintoAjax.php",
                data: dataString,
                success: function(data) {
                    $('#result-reg').fadeIn(1000).html(data);
                }
            });
        });
    });
</script>