<?php

$peticionAjax = false;
require_once "./controllers/eventoControlador.php";
require_once "./controllers/disciplinaControlador.php";
$insEvento = new eventoControlador();
$insDisciplina = new disciplinaControlador();
$cod_even=$_POST['cod_even'];
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
            <input type="text" value=" <?php echo $cod_even ?> " name="cod_even" hidden required>
            <div class="text-center">
            </div>
            <!-- Nombre del Evento-->
            <label for="textInput">Nombre del evento:</label>
            <div class="input-group flex-nowrap">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="addon-wrapping"><i class="fas fa-user prefix grey-text"></i></span>
                </div>
                <?php $insEvento->formulario_editar_nombre_evento_controlador() ?>
            </div>
            <div id="result-even"></div>
            <!-- Fecha del evento-->
            <label for="textInput">Fecha del evento:</label>
            <div class="input-group flex-nowrap">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="addon-wrapping"><i class="far fa-calendar-alt prefix grey-text"></i></span>
                </div>
                <?php $insEvento->formulario_editar_fecha_evento_controlador() ?>
            </div>
            <!-- Estado-->
            <label for="textInput">Estado:</label>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <label class="input-group-text" for="inputGroupSelect01"><i class="fas fa-globe-americas prefix grey-text"></i></label>
                </div>
                <select class="browser-default custom-select" id="inputGroupSelect01" id="cod_edo" name="cod_edo" required>
                    
                    <?php
                    $insEvento->formulario_editar_estado_evento_controlador();
                    $insEvento->formulario_evento();
                    foreach ($row as $row) {
                        echo '<option value="' . $row['cod_edo'] . '">' . $row['des_edo'] . '</option>';
                    }
                    ?>
                </select>
            </div>
            <!-- Estatus-->
            <label for="textInput">Estatus:</label>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <label class="input-group-text" for="inputGroupSelect01"><i class="fas fa-toggle-on prefix grey-text"></i></label>
                </div>
                <select class="browser-default custom-select" id="inputGroupSelect01" id="cod_estar" name="cod_estat" required>
                    <?php 
                    $insEvento->formulario_evento_estatus();
                    $insEvento->formulario_editar_estatus_evento_controlador();
                    ?>   
                </select>
            </div>
            <!-- Tipo de evento-->
            <br><b><label for="textInput">Tipo de evento:</label></b><br>
            <center>
                <!-- Group of default radios - option 1 -->
                <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" class="custom-control-input " id="aut" onclick="toggle(this)" name="cod_tip_even" value="1" required>
                    <label class="custom-control-label" for="aut">Autóctono</label>
                </div>
                <!-- Group of default radios - option 2 -->
                <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" class="custom-control-input " id="con" onclick="toggle(this)" name="cod_tip_even" value="2" required>
                    <label class="custom-control-label" for="con">Convencional</label>
                </div>
                <!-- Group of default radios - option 3 -->
                <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" class="custom-control-input " id="mix" onclick="toggle(this)" name="cod_tip_even" value="3" required>
                    <label class="custom-control-label" for="mix">Mixto</label>
                </div>
            </center><br>
            <div id="autoctono" style="display:none">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <label class="input-group-text" for="inputGroupSelect01"><i class="fas fa-feather prefix grey-text"></i></label>
                    </div>
                    <select class="browser-default custom-select" id="inputGroupSelect01" id="" name="">
                        <option selected disabled value="">Disciplinas autoctonas</option>
                        <?php
                        $insDisciplina->consultar_disciplinas_autoctonas_controlador();
                        ?>
                    </select>
                </div>
            </div>
            <div id="convencional" style="display:none">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <label class="input-group-text" for="inputGroupSelect01"><i class="fas fa-futbol prefix grey-text"></i></label>
                    </div>
                    <select class="browser-default custom-select" id="inputGroupSelect01" id="" name="">
                        <option selected disabled value="">Disciplinas convencionales</option>
                        <?php
                        $insDisciplina->consultar_disciplinas_convencionales_controlador();
                        ?>
                    </select>
                </div>
            </div>
            <div id="mixto" style="display:none">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <label class="input-group-text" for="inputGroupSelect01"><i class="fas fa-futbol prefix grey-text"></i><i class="fas fa-feather prefix grey-text"></i></label>
                    </div>
                    <select class="browser-default custom-select" id="inputGroupSelect01" id="" name="">
                        <option selected disabled value="">Disciplinas</option>
                        <?php
                        $insDisciplina->consultar_disciplinas_controlador();
                        ?>
                    </select>
                </div>
            </div>
            <p><button class="btn btn-info btn-block" type="submit">Registrar</button></p>
            <div class="RespuestaAjax"></div>
        </form>
    </div>
</div>