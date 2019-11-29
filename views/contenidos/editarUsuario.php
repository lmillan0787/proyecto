<?php
$peticionAjax = false;
$var = explode("/", $_GET['views']);
$cod_usr = $var[1];
$año = date('Y') - 15;
$fec = date('m-d');
require_once "./controllers/usuarioControlador.php";
$usuario = new usuarioControlador();
$des_usr = $usuario->datos_usuario($cod_usr)['des_usr'];
$clave = $usuario->datos_usuario($cod_usr)['clave'];
$cod_perf = $usuario->datos_usuario($cod_usr)['cod_perf'];
$des_perf = $usuario->datos_usuario($cod_usr)['des_perf'];
$cod_estat = $usuario->datos_usuario($cod_usr)['cod_estat'];
$des_estat = $usuario->datos_usuario($cod_usr)['des_estat'];
$nom = $usuario->datos_usuario($cod_usr)['nom'];
$ape = $usuario->datos_usuario($cod_usr)['ape'];
?>
<div class="card" id="form_ini">

    <h5 class="card-header info-color white-text text-center py-4">
        <strong>Datos Básicos del Usuario</strong>
    </h5>
    <!--Formulario de inicio-->
    <div class="card-body px-lg-5">
        <form class="FormularioAjax" action="<?php echo SERVERURL ?>ajax/editarUsuarioAjax.php" method="POST" data-form="guardar" autocomplete="off" enctype="multipart/form-data">
            <div class="text-center">
            </div>
            <!-- Cédula-->
            <b><label for="textInput">Persona:</label></b>
            <div class="input-group flex-nowrap">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="addon-wrapping"><i class="far fa-id-card prefix grey-text"></i></span>
                </div>
                <input type="text" class="text-capitalize form-control"  aria-describedby="addon-wrapping" minlength="8" maxlength="10"  value="<?php echo $nom.' '.$ape ?>" readonly required>
            </div>
            <!-- Nombre de usuario-->
            <br><b><label for=" textInput">Nombre de usuario:</label></b>
            <div class="input-group flex-nowrap">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="addon-wrapping"><i class="fas fa-user prefix grey-text"></i></span>
                </div>
                <input type="text"  class="form-control text-uppercase" placeholder="Nombre de usuario" aria-describedby="addon-wrapping" minlength="4" maxlength="12" required pattern="[A-Za-zñÑáéíóúÁÉÍÓÚöÖüÜ\s0-9]+" name="des_usr" value="<?php echo $des_usr ?>">
            </div>
            <!-- clave-->
            <br><b><label for="textInput">Clave:</label></b>
            <div class="input-group flex-nowrap">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="addon-wrapping"><i class="fas fa-key prefix grey-text"></i></span>
                </div>
                <input type="password" class="form-control" placeholder="Clave" aria-describedby="addon-wrapping" minlength="8" maxlength="8" required name="clave" value="<?php echo $clave ?>">
            </div>
            <!-- clave-->
            <br><b><label for="textInput">Repetir clave:</label></b>
            <div class="input-group flex-nowrap">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="addon-wrapping"><i class="fas fa-key prefix grey-text"></i></span>
                </div>
                <input type="password" class="form-control" placeholder="Repetir clave" aria-describedby="addon-wrapping" minlength="8" maxlength="8" required name="repClave" value="<?php echo $clave ?>">
            </div>
            <!-- Rol-->
            <br><b><label for="textInput">Perfil:</label></b>
            <div class="input-group flex-nowrap">
                <div class="input-group-prepend">
                    <label class="input-group-text" for="inputGroupSelect01"><i class="fas fa-users-cog prefix grey-text"></i></label>
                </div>
                <select class="browser-default custom-select" id="inputGroupSelect01" id="cod_perf" name="cod_perf" required>
                    <option value="<?php echo $cod_perf ?>"><?php echo $des_perf ?></option>
                    <?php $usuario->formulario_editar_perfil_distinto($cod_perf)?>
                </select>
            </div>
            <!-- Estatus-->
            <br><b><label for="textInput">Estatus:</label></b>
            <div class="input-group flex-nowrap">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="addon-wrapping"><i class="fas fa-toggle-on prefix grey-text"></i></span>
                </div>
                <select class="browser-default custom-select" id="inputGroupSelect01" id="cod_estat" name="cod_estat" required>
                    <option value="<?php echo $cod_estat ?>"><?php echo $des_estat ?></option>
                    <?php $usuario->formulario_editar_estatus_distinto($cod_estat) ?>
                </select>
            </div>
            <br>
            <input type="text" value="<?php echo $cod_usr ?>" id="cod_usr" name="cod_usr" hidden required>
            <button class="btn btn-info btn-block" type="submit">Aceptar</button>
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
</script>