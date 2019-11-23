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
        <form class="FormularioAjax" action="<?php echo SERVERURL ?>ajax/editarDeportistaAjax.php" method="POST" data-form="guardar" autocomplete="off" enctype="multipart/form-data">
            <div class="text-center">
            </div>
            <!-- Cédula-->
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
            <!--Rol-->
            <input type="text" name="cod_rol" value="2" hidden>
            <!--Perfil-->
            <input type="text" name="cod_perf" value="4" hidden="">
            <!-- Region -->
            <br><b><label for="textInput">Región:</label></b>
            <div class="input-group flex-nowrap">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="addon-wrapping"><i class="far fa-id-card prefix grey-text"></i></span>
                </div>
                <select name="cod_reg" id="selreg" class="form-control" required>
                    <?php
                    $insPart->formulario_participacion_editar_region_controlador();
                    $insPart->formulario_participacion_editar_region_distinta_controlador();
                    ?>
                </select>
            </div>
            <!-- Select Pueblo -->
            <br><b><label for="textInput">Pueblo:</label></b>
            <div class="input-group flex-nowrap">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="addon-wrapping"><i class="far fa-id-card prefix grey-text"></i></span>
                </div>
                <select name="cod_pue" id="selpue" class="form-control" required>
                    <?php
                    $insPart->formulario_participacion_editar_pueblo_controlador();
                    $insPart->formulario_participacion_editar_pueblo_distinto_controlador();
                    ?>
                </select>
            </div>
            <!-- Select Disciplina -->
            <br><b><label for="textInput">Disciplina:</label></b>
            <div class="input-group flex-nowrap">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="addon-wrapping"><i class="far fa-id-card prefix grey-text"></i></span>
                </div>
                <select name="cod_dis" id="seldis" class="form-control">
                    <?php
                    $insPart->formulario_participacion_editar_disciplina_controlador();
                    $insPart->formulario_participacion_editar_disciplina_distinta_controlador();
                    ?>
                </select>
            </div>
            <!-- Select Categoria -->
            <br><b><label for="textInput">Categoria:</label></b>
            <div class="input-group flex-nowrap">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="addon-wrapping"><i class="far fa-id-card prefix grey-text"></i></span>
                </div>
                <select name="cod_cat" id="seldis" class="form-control">
                    <?php
                    $insPart->formulario_participacion_editar_categoria_controlador();
                    $insPart->formulario_participacion_editar_categoria_distinta_controlador();
                    ?>
                </select>
            </div>
            <br>
            <center>
                <div class="row">
                    <div class="col-md-6">
                        <div id="my_camera"></div>
                        <input class="btn btn-success" type=button value="Capturar Imagen" onClick="take_snapshot()" required>

                    </div>
                    <div class="col-md-6">
                        <div id="results"></div>
                        <input type="hidden" name="image" class="image-tag">
                    </div>
                </div>
            </center>                
            <br><button class=" btn btn-info btn-block" type="submit">Registrar</button>
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
<script type="text/javascript">
    $(document).ready(function() {
        $('#ced').on('blur', function() {
            $('#result-ced').html('<img src="<?php echo SERVERURL ?>views/assets/img/loader.gif" />').fadeOut(1000);

            var ced = $(this).val();
            var dataString = 'ced=' + ced;

            $.ajax({
                type: "POST",
                url: "<?php echo SERVERURL ?>ajax/validarParticipacionAjax.php",
                data: dataString,
                success: function(data) {
                    $('#result-ced').fadeIn(1000).html(data);
                }
            });
        });
    });
</script>