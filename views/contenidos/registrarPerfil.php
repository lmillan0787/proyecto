<?php

    $peticionAjax = false;
    require_once "./controllers/perfilControlador.php";
    $insEvento = new perfilControlador();

?>
<div class="card" id="form_evento">
    <h5 class="card-header info-color white-text text-center py-4">
        <strong>Datos Básicos de Perfil</strong>
    </h5>
    <!--Formulario de inicio-->
    <div class="card-body px-lg-5">
        <form class="FormularioAjax" action="<?php echo SERVERURL ?>ajax/registrarPerfilAjax.php" method="POST" data-form="guardar" autocomplete="off" enctype="multipart/form-data">
            <div class="text-center">
            </div>
            <!-- Nombre del perfil-->
            
<input type="text" name="cod_rol" value="4" hidden="">
            <b><label for=" textInput">Nombre del Perfil:</label></b>
            <div class="input-group flex-nowrap">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="addon-wrapping"><i class="fas fa-user prefix grey-text"></i></span>
                </div>
                <input type="text" class="form-control" placeholder="Nombre del Perfil" aria-describedby="addon-wrapping" minlength="2" maxlength="60" required pattern="[A-Za-zñÑáéíóúÁÉÍÓÚöÖüÜ\s]+" name="des_perf" id="des_perf">
            </div>
            <div id="result-perf"></div>
          
            <br><button class="btn btn-info btn-block" type="submit">Registrar</button>
            <div class="RespuestaAjax"></div>
        </form>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        $('#des_perf').on('blur', function() {
            $('#result-perf').html('<img src="<?php echo SERVERURL ?>views/assets/img/loader.gif" />')
                .fadeOut(1500);

            var des_perf = $(this).val();
            var dataString = 'des_perf=' + des_perf;

            $.ajax({
                type: "POST",
                url: "<?php echo SERVERURL ?>ajax/validarPerfilAjax.php",
                data: dataString,
                success: function(data) {
                    $('#result-perf').fadeIn(1000).html(data);
                }
            });
        });
    });
</script>