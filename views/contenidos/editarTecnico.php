<?php

$peticionAjax = false;
include "./controllers/participacionControlador.php";
$insPart = new participacionControlador();
$cod_par = $_POST['cod_par'];

?>

<div class="card" id="form_invi">
    <h5 class="card-header info-color white-text text-center py-4">
        <strong>Datos Básicos</strong>
    </h5>
    <!--Formulario de inicio-->
    <div class="card-body px-lg-5">
        <form class="FormularioAjax" action="<?php echo SERVERURL ?>ajax/editarTecnicoAjax.php" method="POST" data-form="guardar" autocomplete="off" enctype="multipart/form-data">
        <input type="text" hidden value="<?php echo $cod_par?>" name="cod_par">
            <div class="text-center">
            </div>
            <!-- Cédula -->
            <b><label for="textInput">Cédula:</label></b>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="addon-wrapping"><i class="far fa-id-card prefix grey-text"></i></span>
                </div>
                <?php $insPart->formulario_participacion_editar_cedula_controlador() ?>
            </div>
            <div id="result-ced"></div>
            <!-- Evento -->
            <br><b><label for="textInput">Evento:</label></b>
            <div class="input-group">
                <div class="input-group-prepend">
                    <label class="input-group-text" for="inputGroupSelect01"><i class="fas fa-map-marked-alt prefix grey-text"></i></label>
                </div>
                <select class="browser-default custom-select" id="inputGroupSelect01" id="cod_even" name="cod_even" required>
                    <?php
                    $insPart->formulario_participacion_editar_evento_controlador();
                    $insPart->formulario_participacion_editar_evento_distinto_controlador();
                    ?>
                </select>
            </div>
            <!-- perf -->
            <br><b><label for="textInput">Rol:</label></b>
            <div class="input-group ">
                <div class="input-group-prepend">
                    <label class="input-group-text" for="inputGroupSelect01"><i class="fas fa-user-tag prefix grey-text"></i></label>
                </div>
                <select class="browser-default custom-select" id="inputGroupSelect01" id="cod_perf" name="cod_perf" required>
                    <?php
                    $insPart->formulario_participacion_editar_rol_controlador();
                    $insPart->formulario_participacion_editar_rol_distinto_controlador();
                    ?>
                </select>
            </div>
            <!-- Institución -->
            <br><b><label for="textInput">Institución:</label></b>
            <div class="input-group flex-nowrap">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="addon-wrapping"><i class="far fa-id-card prefix grey-text"></i></span>
                </div>
                <select name="cod_inst" id="selpue" class="form-control" required>
                    <?php
                    $insPart->formulario_participacion_editar_institucion_controlador();
                    $insPart->formulario_participacion_editar_institucion_distinta_controlador();
                    ?>
                </select>
            </div>
            <!-- cargo -->
            <br><b><label for="textInput">Cargo:</label></b>
            <div class="input-group flex-nowrap">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="addon-wrapping"><i class="far fa-id-card prefix grey-text"></i></span>
                </div>
                <select name="cod_carg" id="cod_carg" class="form-control" required>
                    <?php
                    $insPart->formulario_participacion_editar_cargo_controlador();
                    $insPart->formulario_participacion_editar_cargo_distinto_controlador();
                    ?>
                </select>
            </div>
            <!-- Estatus-->
            <br><b><label for="textInput">Estatus de la participación:</label></b>
            <div class="input-group">
                <div class="input-group-prepend">
                    <label class="input-group-text" for="inputGroupSelect01"><i class="fas fa-toggle-on prefix grey-text"></i></label>
                </div>
                <select class="browser-default custom-select" id="inputGroupSelect01" id="cod_estat" name="cod_estat" required>
                    <?php
                    $insPart->formulario_participacion_editar_estatus_controlador();
                    $insPart->formulario_participacion_editar_estatus_distinto_controlador();
                    ?>
                </select>
            </div>
            <br><center>    
            <div class="col-md-6">
                <?php $insPart->formulario_participacion_editar_foto_controlador(); ?>
            </div>
            </center>
            <center>
                <br>
                <div class="row">
                    <div class="col-md-6">
                        <div id="my_camera"></div>
                        <input class="btn btn-success" type=button value="Capturar Imagen" onClick="take_snapshot()" required>
                    </div>
                    <div class="col-md-6">
                        <input type="hidden" name="image" class="image-tag"">
                        <div id="results">
                        </div>
                    </div>
                </div>
            </center>
            <br><button class=" btn btn-info btn-block" type="submit">Aceptar</button>
            <div class="RespuestaAjax"></div>
        </form>
    </div>
</div>
<script language="JavaScript">
    Webcam.set({
        // live preview size
        width: 320,
        height: 240,

        // device capture size
        dest_width: 320,
        dest_height: 240,

        // final cropped size
        crop_width: 240,
        crop_height: 240,

        // format and quality
        image_format: 'jpeg',
        jpeg_quality: 90
    });

    Webcam.attach('#my_camera');

    function take_snapshot() {
        Webcam.snap(function(data_uri) {
            $(".image-tag").val(data_uri);
            document.getElementById('results').innerHTML = '<img src="' + data_uri + '"/>';
        });
    }
</script>