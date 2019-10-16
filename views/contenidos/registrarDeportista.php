<?php
$peticionAjax = false;
include "./controllers/deportistaControlador.php";
$insDeportista = new deportistaControlador();
?>

<div class="card" id="form_ini">

    <h5 class="card-header info-color white-text text-center py-4">
        <strong>Datos Básicos</strong>
    </h5>
    <!--Formulario de inicio-->
    <div class="card-body px-lg-5">
        <form class="FormularioAjax" action="<?php echo SERVERURL ?>ajax/registrarDeportistaAjax.php" method="POST" data-form="guardar" autocomplete="off" enctype="multipart/form-data">
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
            <!--Rol-->
            <div class="form-group">
                <div class="col-sm-15">
                    <div class="input-group-prepend">
                        <input type="text" name="cod_rol" value="2" hidden>
                    </div>
                </div>
            </div>
            <!--Perfil-->
            <input type="text" name="cod_perf" value="4" hidden="">
            <!--Evento-->                          
            <label for="textInput">Evento:</label>
            <div class="input-group flex-nowrap">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="addon-wrapping"><i class="far fa-id-card prefix grey-text"></i></span>
                </div>
                <?php $insDeportista->consultarEvento(); ?>
            </div>
           
            <!-- Region -->
            <label for="textInput">Región:</label>
            <div class="input-group flex-nowrap">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="addon-wrapping"><i class="far fa-id-card prefix grey-text"></i></span>
                </div>
                        <?php $insDeportista->consultarRegion(); ?>
                    </div>
               
            <!-- Select Pueblo -->
            <label for="textInput">Pueblo:</label>
            <div class="input-group flex-nowrap">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="addon-wrapping"><i class="far fa-id-card prefix grey-text"></i></span>
                </div>
                        <?php $insDeportista->consultarPueblo(); ?>
                    </div>
                
            <!-- Select Disciplina -->
            <label for="textInput">Disciplina:</label>
            <div class="input-group flex-nowrap">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="addon-wrapping"><i class="far fa-id-card prefix grey-text"></i></span>
                </div>
                        <?php $insDeportista->consultarDisciplina(); ?>
                    </div>
                
            <!-- Select Categoria -->
            <label for="textInput">Categoria:</label>
            <div class="input-group flex-nowrap">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="addon-wrapping"><i class="far fa-id-card prefix grey-text"></i></span>
                </div>
                        <?php $insDeportista->consultarCategoria(); ?>
                    </div>
                
            <br><button class="btn btn-info btn-block" type="submit">Registrar</button>
            <div class="RespuestaAjax"></div>
        </form>
    </div>
</div>