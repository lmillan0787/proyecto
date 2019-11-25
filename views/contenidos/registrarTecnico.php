<?php
$peticionAjax = false;
include "./controllers/tecnicoControlador.php";
$insTecnico = new tecnicoControlador();

?>
<div class="card" id="form_invi">
    <h5 class="card-header info-color white-text text-center py-4">
        <strong>Registro de Personal Técnico</strong>
    </h5>
    <!--Formulario de inicio-->
    <div class="card-body px-lg-5">
        <form class="FormularioAjax" action="<?php echo SERVERURL ?>ajax/registrarTecnicoAjax.php" method="POST" data-form="guardar" autocomplete="off" enctype="multipart/form-data">
            <div class="text-center">
            </div>
            <!-- Cédula-->
            <b><label for="textInput">Cédula:</label></b>
            <div class="input-group flex-nowrap">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="addon-wrapping"><i class="far fa-id-card prefix grey-text"></i></span>
                </div>
                <input type="text" id="ced" class="ced text-capitalize form-control" placeholder="Ejm: V-12345678" aria-describedby="addon-wrapping" minlength="8" maxlength="10"  name="ced" value="">
            </div>
            <div id="result-ced"></div>
            <!--Rol-->
            <input type="text" name="cod_rol" value="4" hidden>
            <!--Evento-->
            <br><b><label for="textInput">Evento:</label></b>
            <div class="input-group flex-nowrap">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="addon-wrapping"><i class="far fa-id-card prefix grey-text"></i></span>
                </div>
                <select name="cod_even" id="cod_even" class="form-control">
                    <option disabled selected>Evento</option>
                    <?php
                    $insTecnico->consultarEvento();
                    ?>
                </select>
            </div>
            <div id="result-even"></div>
            <!--Perfil-->
            <br><b><label for="textInput">Perfil:</label></b>
            <div class="input-group flex-nowrap">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="addon-wrapping"><i class="far fa-id-card prefix grey-text"></i></span>
                </div>
                <select name="cod_perf" id="cod_perf" class="form-control">
                    <option disabled selected>Perfil</option>
                    <?php
                    $insTecnico->consultarPerfil();
                    ?>
                </select>
            </div>
            <!-- Select Pueblo -->
            <br><b><label for="textInput">Institución:</label></b>
            <div class="input-group flex-nowrap">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="addon-wrapping"><i class="far fa-id-card prefix grey-text"></i></span>
                </div>
                <select name="cod_inst" id="selpue" class="form-control" required>
                    <option disabled selected>Institución</option>
                    <?php
                    $insTecnico->consultarInstitucion();
                    ?>
                </select>
            </div>
            <!-- Region -->
            <br><b><label for="textInput">Cargo:</label></b>
            <div class="input-group flex-nowrap">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="addon-wrapping"><i class="far fa-id-card prefix grey-text"></i></span>
                </div>
                <select name="cod_carg" id="cod_carg" class="form-control" required>
                    <option disabled selected>Cargo</option>
                    <?php
                    $insTecnico->consultarCargo();
                    ?>
                </select>
            </div>
            <!-- Select Disciplina -->

            <!-- Select Categoria -->

            <br>
            <center>
                <div class="row">
                    <div class="col-md-6">
                        <div id="my_camera" class="border border-info rounded mb-0"></div>
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
        $('.ced').mask('N-Z0000000', {
            translation: {
                'N': {
                    pattern: /[vVeE]/

                },
                'Z': {
                    pattern: /[0-9]/,
                    optional: true
                },
            }
        });
    });
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
    $(document).ready(function() {
        $('#cod_even').on('blur', function() {
            $('#result-even').html('<img src="<?php echo SERVERURL ?>views/assets/img/loader.gif" />').fadeOut(1000);

            var cod_even = $(this).val();
            var ced = $('#ced').val();
            var dataString = {
                'cod_even': cod_even,
                'ced': ced
            };

            $.ajax({
                type: "POST",
                url: "<?php echo SERVERURL ?>ajax/validarEventoParticipacionAjax.php",
                data: dataString,
                success: function(data) {
                    $('#result-even').fadeIn(1000).html(data);
                }
            });
        });
    });
</script>