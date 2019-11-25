<?php

    $peticionAjax = false;
    require_once "./controllers/institucionControlador.php";
    $insInstitucion = new institucionControlador();

?>
<div class="card" id="form_evento">
    <h5 class="card-header info-color white-text text-center py-4">
        <strong>Datos Básicos de la Institucion</strong>
    </h5>
    <!--Formulario de inicio-->
    <div class="card-body px-lg-5">
        <form class="FormularioAjax" action="<?php echo SERVERURL ?>ajax/registrarInstitucionAjax.php" method="POST" data-form="guardar" autocomplete="off" enctype="multipart/form-data">
            <div class="text-center">
            </div>
            <!-- Nombre del pueblo-->
            <b><label for=" textInput">Nombre del Institucion:</label></b>
            <div class="input-group flex-nowrap">
                <div class="input-group-prepend">
                    <span class="input-group-text text-uppercase" id="addon-wrapping"><i class="fas fa-user prefix grey-text"></i></span>
                </div>
                <input type="text" class="form-control" placeholder="Nombre del Institucion" aria-describedby="addon-wrapping" minlength="2" maxlength="60" required pattern="[A-Za-zñÑáéíóúÁÉÍÓÚöÖüÜ\s]+" name="des_inst" id="des_inst">
            </div>
            <div id="result-inst"></div>
            <!-- Tipo de evento-->
           <br><b><label for=" textInput">Siglas del Institucion:</label></b>
            <div class="input-group flex-nowrap">
                <div class="input-group-prepend">
                    <span class="input-group-text text-uppercase" id="addon-wrapping"><i class="fas fa-user prefix grey-text"></i></span>
                </div>
                <input type="text" class="form-control" placeholder="Siglas de la Institucion" aria-describedby="addon-wrapping" minlength="2" maxlength="20" required pattern="[A-Za-zñÑáéíóúÁÉÍÓÚöÖüÜ\s]+" name="siglas" id="siglas">
            </div>
            <div id="result-inst"></div>
            <br><button class="btn btn-info btn-block" type="submit">Registrar</button>
            <div class="RespuestaAjax"></div>
        </form>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        $('#des_inst').on('blur', function() {
            $('#result-inst').html('<img src="<?php echo SERVERURL ?>views/assets/img/loader.gif" />')
                .fadeOut(1500);

            var des_inst = $(this).val();
            var dataString = 'des_inst=' + des_inst;

            $.ajax({
                type: "POST",
                url: "<?php echo SERVERURL ?>ajax/validarInstitucionAjax.php",
                data: dataString,
                success: function(data) {
                    $('#result-inst').fadeIn(1000).html(data);
                }
            });
        });
    });
</script>