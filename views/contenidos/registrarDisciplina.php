<?php

    $peticionAjax = false;
    require_once "./controllers/eventoControlador.php";
    $insEvento = new eventoControlador();

?>
<div class="card" id="form_evento">
    <h5 class="card-header info-color white-text text-center py-4">
        <strong>Datos Básicos de la Disciplina</strong>
    </h5>
    <!--Formulario de inicio-->
    <div class="card-body px-lg-5">
        <form class="FormularioAjax" action="<?php echo SERVERURL ?>ajax/registrarDisciplinaAjax.php" method="POST" data-form="guardar" autocomplete="off" enctype="multipart/form-data">
            <div class="text-center">
            </div>
            <!-- Nombre del pueblo-->
            <b><label for=" textInput">Nombre del Disciplina:</label></b>
            <div class="input-group flex-nowrap">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="addon-wrapping"><i class="fas fa-user prefix grey-text"></i></span>
                </div>
                <input type="text" class="form-control" placeholder="Nombre del Disciplina" aria-describedby="addon-wrapping" minlength="2" maxlength="20" required pattern="[A-Za-zñÑáéíóúÁÉÍÓÚöÖüÜ\s]+" name="des_dis" id="des_dis">
            </div>
            <div id="result-dis"></div>
            <!-- Tipo de evento-->
            <br><b><label for="textInput">Tipo de disciplina:</label></b>
            <div class="input-group">
                <div class="input-group-prepend">
                    <label class="input-group-text" for="inputGroupSelect01"><i class="fas fa-globe-americas prefix grey-text"></i></label>
                </div>
                <select class="browser-default custom-select" id="cod_tip_even" name="cod_tip_even" required>
                    <option selected disabled>Tipo de Disciplina</option>
                    <?php $insEvento->formulario_evento_tipo_no_mix() ?>
                </select>
            </div> 
            <br><button class="btn btn-info btn-block" type="submit">Registrar</button>
            <div class="RespuestaAjax"></div>
        </form>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        $('#des_dis').on('blur', function() {
            $('#result-dis').html('<img src="<?php echo SERVERURL ?>views/assets/img/loader.gif" />')
                .fadeOut(1500);

            var des_dis = $(this).val();
            var dataString = 'des_dis=' + des_dis;

            $.ajax({
                type: "POST",
                url: "<?php echo SERVERURL ?>ajax/validarDisciplinaAjax.php",
                data: dataString,
                success: function(data) {
                    $('#result-dis').fadeIn(1000).html(data);
                }
            });
        });
    });
</script>