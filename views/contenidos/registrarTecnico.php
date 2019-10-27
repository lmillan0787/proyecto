<?php
$peticionAjax = false;
include "./controllers/tecnicoControlador.php";
$insTecnico= new tecnicoControlador();

?>
<div class="card" id="form_invi">
    <h5 class="card-header info-color white-text text-center py-4">
        <strong>Registro de Técnicos</strong>
    </h5>
    <!--Formulario de inicio-->
    <div class="card-body px-lg-5">
        <form class="FormularioAjax" action="<?php echo SERVERURL ?>ajax/registrarTecnicoAjax.php" method="POST" data-form="guardar" autocomplete="off" enctype="multipart/form-data">
            <div class="text-center">
            </div>
            <!-- Cédula-->
            <label for="textInput">Cédula:</label>
            <div class="input-group flex-nowrap">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="addon-wrapping"><i class="far fa-id-card prefix grey-text"></i></span>
                </div>
                <input type="text" id="ced" class="form-control" placeholder="Cédula" aria-describedby="addon-wrapping" minlength="6" maxlength="8" required pattern="[0-9]+" name="ced">
            </div>
            <!--Rol-->
            <div class="form-group">
                <div class="col-sm-15">
                    <div class="input-group-prepend">
                        <input type="text" name="cod_rol" value="4" hidden>
                    </div>
                </div>
            </div>
            <!--Perfil-->
           <label for="textInput">Perfil:</label>
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
            <!--Evento-->
            <label for="textInput">Evento:</label>
            <div class="input-group flex-nowrap">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="addon-wrapping"><i class="far fa-id-card prefix grey-text"></i></span>
                </div>
                <select name="cod_even" id="seleven" class="form-control">
                    <option disabled selected>Evento</option>
                    <?php
                    $insTecnico->consultarEvento();
                    ?>
                </select>
            </div>
            <!-- Region -->
            <label for="textInput">Cargo:</label>
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
            <!-- Select Pueblo -->
            <label for="textInput">Institución:</label>
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
            <!-- Select Disciplina -->
           
            <!-- Select Categoria -->
           
            <br>
            <center>
                <div class="row">
                    <div class="col-md-6">
                        <div id="my_camera"></div>
                        <input class="btn btn-success" type=button value="Capturar Imagen" onClick="take_snapshot()" required>

                    </div>
                    <div class="col-md-6">
                        <div id="results">La foto aparecerá aqui...</div>
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