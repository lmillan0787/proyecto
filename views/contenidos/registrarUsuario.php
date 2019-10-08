<?php

    $peticionAjax = false;
    require_once "./controllers/usuarioControlador.php";
    $insUsuario = new usuarioControlador();

?>
<div class="card" id="form_ini">

    <h5 class="card-header info-color white-text text-center py-4">
        <strong>Datos Básicos</strong>
    </h5>
    <!--Formulario de inicio-->
    <div class="card-body px-lg-5">
        <form class="FormularioAjax" action="<?php echo SERVERURL ?>ajax/registrarUsuarioAjax.php" method="POST" data-form="guardar" autocomplete="off" enctype="multipart/form-data">

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
            <div id="result-ced"></div>
            <!-- Nombre de usuario-->
            <label for=" textInput">Nombre de usuario:</label>
            <div class="input-group flex-nowrap">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="addon-wrapping"><i class="fas fa-user prefix grey-text"></i></span>
                </div>
                <input onkeyup="javascript:this.value=this.value.toUpperCase();" type="text" class="form-control" placeholder="Nombre de usuario" aria-describedby="addon-wrapping" minlength="2" maxlength="20" required pattern="[A-Za-zñÑáéíóúÁÉÍÓÚöÖüÜ\s]+" name="des_usr">
            </div>
            <!-- clave-->
            <label for="textInput">Clave:</label>
            <div class="input-group flex-nowrap">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="addon-wrapping"><i class="fas fa-key prefix grey-text"></i></span>
                </div>
                <input onkeyup="javascript:this.value=this.value.toUpperCase();" type="password" class="form-control" placeholder="Clave" aria-describedby="addon-wrapping" minlength="2" maxlength="20" required name="clave">
            </div>
            <!-- clave-->
            <label for="textInput">Repetir clave:</label>
            <div class="input-group flex-nowrap">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="addon-wrapping"><i class="fas fa-key prefix grey-text"></i></span>
                </div>
                <input onkeyup="javascript:this.value=this.value.toUpperCase();" type="password" class="form-control" placeholder="Repetir clave" aria-describedby="addon-wrapping" minlength="2" maxlength="20" required  name="repClave">
            </div>           
            <!-- Rol-->
            <input type="text" value="1" name="cod_rol" hidden required>
            <label for="textInput">Perfil:</label>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <label class="input-group-text" for="inputGroupSelect01"><i class="fas fa-users-cog prefix grey-text"></i></label>
                </div>
                <select class="browser-default custom-select" id="inputGroupSelect01" id="cod_perf" name="cod_perf" required>
                    <option value="">Perfil</option>
                    <?php
                        $insUsuario->formulario_usuario();
                        foreach ($row as $row) {
                            echo '<option value="' . $row['cod_perf'] . '">' . $row['des_perf'] . '</option>';
                        }
                    ?>
                </select>
            </div>
            <button class="btn btn-info btn-block" type="submit">Registrar</button>
            <div class="RespuestaAjax"></div>
        </form>
    </div>
</div>
