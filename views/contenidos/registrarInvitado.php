<?php
$peticionAjax = false;
include "./controllers/invitadoControlador.php";
$insInvitado = new invitadoControlador();
?>
<header>
    <Center>
        <h1>Registro de Invitados</h1>
    </Center>
</header>

<div class="card" id="regInvitado">

    <h5 class="card-header info-color white-text text-center py-4">
        <strong>Datos Básicos</strong>
    </h5>
    <!--Formulario de inicio-->

    <div class="card-body px-lg-5">
        <form class="FormularioAjax" action="<?php echo SERVERURL ?>ajax/registrarInvitadoAjax.php" method="POST" data-form="guardar" autocomplete="off" enctype="multipart/form-data">

            <div class="text-center">
            </div>
            <!-- Nacionalidad-->
            <label for="textInput">Nacionalidad:</label>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <label class="input-group-text"><i class="fas fa-globe-americas prefix grey-text"></i></label>
                </div>
                <select class="browser-default custom-select" name="cod_nac" required>
                    <option value="">Nacionalidad</option>
                    <option value="1">Venezolana</option>
                    <option value="2">Extranjera</option>
                </select>
            </div>
            <!-- Cédula-->
            <label for="textInput">Cédula:</label>
            <div class="input-group flex-nowrap">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="addon-wrapping"><i class="far fa-id-card prefix grey-text"></i></span>
                </div>
                <input type="text" id="ced" class="form-control" placeholder="Cédula" aria-describedby="addon-wrapping" minlength="6" maxlength="8" required pattern="[0-9]+" name="ced">                
            </div>
            <!-- Evento -->
            <label for="textInput">Evento:</label>
            <div class="input-group flex-nowrap">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="addon-wrapping"><i class="fas fa-user prefix grey-text"></i></span>
                </div>
                <?php $insInvitado->consultarEvento(); ?>
            </div>
            <!--Perfil -->
            <label for="textInput">Perfil:</label>
            <div class="input-group flex-nowrap">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="addon-wrapping"><i class="fas fa-user prefix grey-text"></i></span>
                </div>
                <?php $insInvitado->consultarPerfil(); ?>
            </div>
            <Center>
            <br><div class="row">
            <div class="col-md-6">
                <div id="my_camera"></div>                               
                <br><input class="btn btn-primary" type=button value="Capturar Imagen" onClick="take_snapshot()"></br>
                <input type="hidden" name="image" class="image-tag">
            </div>
            <div class="col-md-6">
                <div id="results">La foto aparecerá aqui...</div>
            </div>
            <div class="col-md-12 text-center">
                <br/>                
            </div>
        </div>
            <br><button class="btn btn-info btn-block" type="submit">Registrar</button></br>
            <div class="RespuestaAjax"></div>
        </form></br>
</Center>
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
  
    Webcam.attach( '#my_camera' );
  
    function take_snapshot() {
        Webcam.snap( function(data_uri) {
            $(".image-tag").val(data_uri);
            document.getElementById('results').innerHTML = '<img src="'+data_uri+'"/>';
        } );
    }
</script>
