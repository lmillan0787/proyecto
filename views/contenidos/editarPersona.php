<?php
    $peticionAjax = false;

    require_once "./controllers/personaControlador.php";    
    $insPersona = new personaControlador();
    $cod_per=$_POST['cod_per'];
   
?>
<div class="card" id="form_evento">
    <h5 class="card-header info-color white-text text-center py-4">
        <strong>Datos Básicos</strong>
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
                <?php $insPersona->formulario_editar_cedula_persona_controlador()?>
            </div>
            <div id="result-ced"></div>            
            <!-- Nombre-->
            <br><b><label for=" textInput">Nombre:</label></b>
            <div class="input-group flex-nowrap">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="addon-wrapping"><i class="fas fa-user prefix grey-text"></i></span>
                </div>
                <?php $insPersona->formulario_editar_nombre_persona_controlador()?>
            </div>
            <!-- Apellido-->
            <br><b><label for="textInput">Apellido:</label></b>
            <div class="input-group flex-nowrap">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="addon-wrapping"><i class="fas fa-user prefix grey-text"></i></span>
                </div>
                <?php $insPersona->formulario_editar_apellido_persona_controlador()?>
            </div>
            <!-- Fecha de nacimiento-->
            <br><b><label for="textInput">Fecha de nacimiento:</label></b>
            <div class="input-group flex-nowrap">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="addon-wrapping"><i class="far fa-calendar-alt prefix grey-text"></i></span>
                </div>
                <?php $insPersona->formulario_editar_fecha_persona_controlador()?>
            </div>
            <!-- Género-->
            <br><b><label for="textInput">Género:</label></b>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <label class="input-group-text" for="inputGroupSelect01"><i class="fas fa-venus-mars prefix grey-text"></i></label>
                </div>
                <select class="browser-default custom-select" id="inputGroupSelect01" id="cod_gen" name="cod_gen" required>
                    <?php 
                    $insPersona->formulario_editar_genero_persona_controlador();
                    $insPersona->formulario_genero_distinto();
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
              
                    $insPersona->formulario_editar_estatus_persona_controlador();
                    $insPersona->formulario_estatus_distinto();
                    ?>   
                </select>
            </div>
            <input type="text" value="<?php echo $cod_per ?>" name="cod_per" hidden required>
            <br><button class="btn btn-info btn-block" type="submit">Actualizar</button>
            <div class="RespuestaAjax"></div>
        </form>
    </div>
</div>


