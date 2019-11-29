<?php
$peticionAjax = false;
require_once "./controllers/usuarioControlador.php";
$insUsuario = new usuarioControlador();
?>
<div class="card" id="form_ini">

    <h5 class="card-header info-color white-text text-center py-4">
        <strong>Datos Básicos del Usuario</strong>
    </h5>
    <!--Formulario de inicio-->
    <div class="card-body px-lg-5">
        <form class="FormularioAjax" action="<?php echo SERVERURL ?>ajax/registrarUsuarioAjax.php" method="POST" data-form="guardar" autocomplete="off" enctype="multipart/form-data">

            <div class="text-center">
            </div>
            <!-- Cédula-->
            <b><label for="textInput">Cédula:</label></b>
            <div class="input-group flex-nowrap">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="addon-wrapping"><i class="far fa-id-card prefix grey-text"></i></span>
                </div>
                <input type="text" id="ced" class="ced text-capitalize form-control" placeholder="Ejm: V-12345678" aria-describedby="addon-wrapping" minlength="8" maxlength="10" name="ced" value="" required>
            </div>
            <div id="result-ced"></div>
            <!-- Nombre de usuario-->
            <br><b><label for=" textInput">Nombre de usuario:</label></b>
            <div class="input-group flex-nowrap">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="addon-wrapping"><i class="fas fa-user prefix grey-text"></i></span>
                </div>
                <input type="text" class="form-control text-uppercase" placeholder="Nombre de usuario" aria-describedby="addon-wrapping" minlength="4" maxlength="12" required pattern="[A-Za-zñÑáéíóúÁÉÍÓÚöÖüÜ\s0-9]+" name="des_usr">
            </div>
            <!-- clave-->
            <br><b><label for="textInput">Clave:</label></b>
            <div class="input-group flex-nowrap">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="addon-wrapping"><i class="fas fa-key prefix grey-text"></i></span>
                </div>
                <input type="password" class="form-control" placeholder="Clave" aria-describedby="addon-wrapping" minlength="8" maxlength="8" required name="clave">
            </div>
            <!-- clave-->
            <br><b><label for="textInput">Repetir clave:</label></b>
            <div class="input-group flex-nowrap">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="addon-wrapping"><i class="fas fa-key prefix grey-text"></i></span>
                </div>
                <input type="password" class="form-control" placeholder="Repetir clave" aria-describedby="addon-wrapping" minlength="8" maxlength="8" required name="repClave">
            </div>
            <!-- Rol-->
            <input type="text" value="1" name="cod_rol" hidden required>
            <br><b><label for="textInput">Perfil:</label></b>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <label class="input-group-text" for="inputGroupSelect01"><i class="fas fa-users-cog prefix grey-text"></i></label>
                </div>
                <select class="browser-default custom-select" id="inputGroupSelect01" id="cod_perf" name="cod_perf" required>
                    <option value="">Perfil</option>
                    <?php $insUsuario->formulario_usuario_perfil() ?>
                </select>
            </div>
            <button class="btn btn-info btn-block" type="submit">Registrar</button>
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
    });
    $(document).ready(function() {
        $('#ced').on('blur', function() {
            $('#result-ced').html('<img src="<?php echo SERVERURL ?>views/assets/img/loader.gif" />').fadeOut(1000);
            var ced = $(this).val();
            var dataString = 'ced=' + ced;
            $.ajax({
                type: "POST",
                url: "<?php echo SERVERURL ?>ajax/validarUsuarioAjax.php",
                data: dataString,
                success: function(data) {
                    $('#result-ced').fadeIn(1000).html(data);
                }
            });
        });
    });
</script>