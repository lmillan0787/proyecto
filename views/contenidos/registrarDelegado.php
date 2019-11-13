<?php
$peticionAjax = false;
include "./controllers/delegadoControlador.php";
$insDelegado= new delegadoControlador();
?>
<script type="text/javascript">
$(document).ready(function() {  
    $('#ced').on('blur', function(){
        $('#result-ced').html('<img src="<?php echo SERVERURL ?>views/assets/img/loader.gif" />').fadeOut(1000);

        var ced = $(this).val();   
        var dataString = 'ced='+ced;

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
<div class="card" id="form_invi">
    <h5 class="card-header info-color white-text text-center py-4">
        <strong>Registro de Delegado</strong>
    </h5>
    <!--Formulario de inicio-->
    <div class="card-body px-lg-5">
        <form class="FormularioAjax" action="<?php echo SERVERURL ?>ajax/registrarDelegadoAjax.php" method="POST" data-form="guardar" autocomplete="off" enctype="multipart/form-data">
            <div class="text-center">
            </div>
            <!-- Cédula-->
            <label for="textInput">Cédula:</label>
            <div class="input-group flex-nowrap">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="addon-wrapping"><i class="far fa-id-card prefix grey-text"></i></span>
                </div>
                <input type="text" id="ced" class="form-control" placeholder="Cédula" aria-describedby="addon-wrapping" name="ced" onkeyup="javascript:this.value=this.value.toUpperCase();" minlength="7" maxlength="9" required pattern="[vVeE0-9]+" value="V">
            </div>
            <div id="result-ced"></div
            <!--Rol-->
            <div class="form-group">
                <div class="col-sm-15">
                    <div class="input-group-prepend">
                        <input type="text" name="cod_rol" value="2" hidden>
                    </div>
                </div>
            </div>
            <!--Perfil-->
            <input type="text" name="cod_perf" value="5" hidden="">
            <!--Evento-->
            <label for="textInput">Evento:</label>
            <div class="input-group flex-nowrap">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="addon-wrapping"><i class="far fa-id-card prefix grey-text"></i></span>
                </div>
                <select name="cod_even" id="seleven" class="form-control">
                    <option disabled selected>Evento</option>
                    <?php
                    $insDelegado->consultarEvento();
                    ?>
                </select>
            </div>
            <!-- Region -->
            <label for="textInput">Región:</label>
            <div class="input-group flex-nowrap">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="addon-wrapping"><i class="far fa-id-card prefix grey-text"></i></span>
                </div>
                <select name="cod_reg" id="selreg" class="form-control" required>
                    <option disabled selected>Región</option>
                    <?php
                    $insDelegado->consultarRegion();
                    ?>
                </select>
            </div>
            <!-- Select Pueblo -->
            <label for="textInput">Pueblo:</label>
            <div class="input-group flex-nowrap">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="addon-wrapping"><i class="far fa-id-card prefix grey-text"></i></span>
                </div>
                <select name="cod_pue" id="selpue" class="form-control" required>
                    <option disabled selected>Pueblo</option>
                    <?php
                    $insDelegado->consultarPueblo();
                    ?>
                </select>
            </div>
            <!-- Select Disciplina -->
            <label for="textInput">Disciplina:</label>
            <div class="input-group flex-nowrap">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="addon-wrapping"><i class="far fa-id-card prefix grey-text"></i></span>
                </div>
                <select name="cod_dis" id="seldis" class="form-control">
                    <option disabled selected>Disciplina</option>
                    <?php
                    $insDelegado->consultarDisciplina();
                    ?>
                </select>
            </div>
            <!-- Select Categoria -->
            <label for="textInput">Categoria:</label>
            <div class="input-group flex-nowrap">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="addon-wrapping"><i class="far fa-id-card prefix grey-text"></i></span>
                </div>
                <select name="cod_cat" id="seldis" class="form-control">
                    <option disabled selected>Categoria</option>
                    <?php
                    $insDelegado->consultarCategoria();
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
                        <div id="results">La foto aparecerá aqui...</div>
                        <input type="hidden" name="image" class="image-tag"">
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