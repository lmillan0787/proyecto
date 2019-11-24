<?php

$peticionAjax = false;

require_once "./controllers/personaControlador.php";
$insPersona = new personaControlador();
$var = explode("/",$_GET['views']);
$cod_per = $var[1];

?>
<div class="card" id="form_evento">
    <h5 class="card-header info-color white-text text-center py-4">
        <strong>Editar Datos Básicos de Persona</strong>
    </h5>
    <!--Formulario de inicio-->
    <div class="card-body px-lg-5">
        <form class="FormularioAjax" action="<?php echo SERVERURL ?>ajax/editarPersonaAjax.php" method="POST" data-form="guardar" autocomplete="off" enctype="multipart/form-data">
            <div class="text-center">
            </div>
            <!-- Cédula-->
            <br><b><label for="textInput">Cédula:</label></b>
            <div class="input-group flex-nowrap">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="addon-wrapping"><i class="far fa-id-card prefix grey-text"></i></span>
                </div>
                <?php $insPersona->formulario_persona_editar_cedula_controlador($cod_per) ?>
            </div>
            <div id="result-ced"></div>
            <!-- Nombre-->
            <br><b><label for=" textInput">Nombre:</label></b>
            <div class="input-group flex-nowrap">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="addon-wrapping"><i class="fas fa-user prefix grey-text"></i></span>
                </div>
                <?php $insPersona->formulario_persona_editar_nombre_controlador($cod_per) ?>
            </div>
            <!-- Apellido-->
            <br><b><label for="textInput">Apellido:</label></b>
            <div class="input-group flex-nowrap">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="addon-wrapping"><i class="fas fa-user prefix grey-text"></i></span>
                </div>
                <?php $insPersona->formulario_persona_editar_apellido_controlador($cod_per) ?>
            </div>
            <!-- Fecha de nacimiento-->
            <br><b><label for="textInput">Fecha de nacimiento:</label></b>
            <div class="input-group flex-nowrap">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="addon-wrapping"><i class="far fa-calendar-alt prefix grey-text"></i></span>
                </div>
                <?php $insPersona->formulario_person_editar_fecha_controlador($cod_per) ?>
            </div>
            <!-- Género-->
            <br><b><label for="textInput">Género:</label></b>
            <div class="input-group">
                <div class="input-group-prepend">
                    <label class="input-group-text" for="inputGroupSelect01"><i class="fas fa-venus-mars prefix grey-text"></i></label>
                </div>
                <select class="browser-default custom-select" id="inputGroupSelect01" id="cod_gen" name="cod_gen" required>
                    <?php
                    $insPersona->formulario_editar_persona_genero_controlador($cod_per);
                    $insPersona->formulario_genero_distinto($cod_per);
                    ?>
                </select>
            </div>
            <!-- Estatus-->
            <br><b><label for="textInput">Estatus:</label></b>
            <div class="input-group">
                <div class="input-group-prepend">
                    <label class="input-group-text" for="inputGroupSelect01"><i class="fas fa-toggle-on prefix grey-text"></i></label>
                </div>
                <select class="browser-default custom-select" id="inputGroupSelect01" id="cod_estat" name="cod_estat" required>
                    <?php
                    $insPersona->formulario_editar_persona_estatus_controlador($cod_per);
                    $insPersona->formulario_estatus_distinto($cod_per);
                    ?>
                </select>
            </div>
            <input type="text" value="<?php echo $cod_per ?>" id="cod_per" name="cod_per" hidden required>
            <br><button class="btn btn-info btn-block" type="submit">Actualizar</button>
            <div class="RespuestaAjax"></div>
        </form>
    </div>
</div>
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

    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    $(document).ready(function() {
        $('#ced').on('blur', function() {
            $('#result-ced').html('<img src="<?php echo SERVERURL ?>views/assets/img/loader.gif" />')
                .fadeOut(1500);
            var cod_per =$('#cod_per').val();
            var ced = $(this).val();
            var dataString = {
                'ced': ced,
                'cod_per': cod_per
            };
            $.ajax({
                type: "POST",
                url: "<?php echo SERVERURL ?>ajax/validarPersonaDistintaAjax.php",
                data: dataString,
                success: function(data) {
                    $('#result-ced').fadeIn(1000).html(data);
                }
            });
        });
    });
</script>