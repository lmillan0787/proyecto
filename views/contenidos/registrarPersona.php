<?php

$año = date('Y') - 15;
$fec = date('m-d');

?>
<div class="card" id="form_evento">
    <h5 class="card-header info-color white-text text-center py-4">
        <strong>Datos Básicos</strong>
    </h5>
    <!--Formulario de inicio-->
    <div class="card-body px-lg-5">
        <form class="FormularioAjax" action="<?php echo SERVERURL ?>ajax/registrarPersonaAjax.php" method="POST" data-form="guardar" autocomplete="off" enctype="multipart/form-data">
            <div class="text-center">
            </div>
            <!-- Cédula-->
            <b><label for="textInput">Cédula:</label></b>
            <div class="input-group flex-nowrap">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="addon-wrapping"><i class="far fa-id-card prefix grey-text"></i></span>
                </div>
                <input type="text" id="ced" class="ced text-capitalize form-control" placeholder="Ejm: V-12345678" aria-describedby="addon-wrapping" minlength="8" maxlength="10"  name="ced" value="" required>
            </div>
            <div id="result-ced"></div>
            <!-- Nombre-->
            <br><b><label for=" textInput">Nombre:</label></b>
            <div class="input-group flex-nowrap">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="addon-wrapping"><i class="fas fa-user prefix grey-text"></i></span>
                </div>
                <input type="text" class="nom text-capitalize form-control" placeholder="Nombre" aria-describedby="addon-wrapping" minlength="2" maxlength="20" required pattern="[A-Za-zñÑáéíóúÁÉÍÓÚöÖüÜ\s]+" name="nom">
            </div>
            <!-- Apellido-->
            <br><b><label for="textInput">Apellido:</label></b>
            <div class="input-group flex-nowrap">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="addon-wrapping"><i class="fas fa-user prefix grey-text"></i></span>
                </div>
                <input type="text" class="ape text-capitalize form-control" placeholder="Apellido" aria-describedby="addon-wrapping" minlength="2" maxlength="20" required pattern="[A-Za-zñÑáéíóúÁÉÍÓÚöÖüÜ\s]+" name="ape">
            </div>
            <!-- Fecha de nacimiento-->
            <br><b><label for="textInput">Fecha de nacimiento:</label></b>
            <div class="input-group flex-nowrap">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="addon-wrapping"><i class="far fa-calendar-alt prefix grey-text"></i></span>
                </div>
                <input type="date" class="fec_nac form-control" placeholder="Fecha de nacimiento" aria-label="Username" aria-describedby="addon-wrapping" min="1919-01-01" max="<?php echo $año . '-' . $fec ?>" step="1" name="fec_nac" id="fec_nac" required>
            </div>
            <div id="result-fec"></div>
            <!-- Género-->
            <br><b><label for="textInput">Género:</label></b>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <label class="input-group-text" for="inputGroupSelect01"><i class="fas fa-venus-mars prefix grey-text"></i></label>
                </div>
                <select class="browser-default custom-select" id="inputGroupSelect01" id="cod_gen" name="cod_gen" required>
                    <option value="">Género</option>
                    <option value="1">Masculino</option>
                    <option value="2">Femenino</option>
                </select>
            </div>
            <button class="btn btn-info btn-block" type="submit">Registrar</button>
            <div class="RespuestaAjax"></div>
        </form>
    </div>
</div>
<!-- Validar Cedula -->
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
        $('.nom').mask('NNNNNNNNNNNNNNNNNNNN', {
            translation: {
                'N': {
                    pattern: /[A-Za-zñÑáéíóúÁÉÍÓÚöÖüÜ\s]/
                }
            }
        });
        $('.ape').mask('NNNNNNNNNNNNNNNNNNNN', {
            translation: {
                'N': {
                    pattern: /[A-Za-zñÑáéíóúÁÉÍÓÚöÖüÜ\s]/
                }
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
                url: "<?php echo SERVERURL ?>ajax/validarPersonaAjax.php",
                data: dataString,
                success: function(data) {
                    $('#result-ced').fadeIn(1000).html(data);
                }
            });
        });
    });
    ///////////////////////////////////#ced<script type="text/javascript">
    $(document).ready(function() {
        $('#fec_nac').on('blur', function() {
            $('#result-fec').html('<img src="<?php echo SERVERURL ?>views/assets/img/loader.gif" />').fadeOut(1000);

            var fec_nac = $(this).val();
            var dataString = 'fec_nac=' + fec_nac;

            $.ajax({
                type: "POST",
                url: "<?php echo SERVERURL ?>ajax/validarPersonaAjax.php",
                data: dataString,
                success: function(data) {
                    $('#result-fec').fadeIn(1000).html(data);
                }
            });
        });
    });
</script>