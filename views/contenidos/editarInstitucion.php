<?php

    $cod_inst=$_POST['cod_inst'];
    $peticionAjax = false;
    
    require_once "./controllers/institucionControlador.php";
    
    $insInstitucion = new institucionControlador();

?>

<div class="card" id="form_evento">
    <h5 class="card-header info-color white-text text-center py-4">
        <strong>Datos Básicos de la Disciplina</strong>
    </h5>
    <!--Formulario de inicio-->
    <div class="card-body px-lg-5">
        <form class="FormularioAjax" action="<?php echo SERVERURL ?>ajax/editarInstitucionAjax.php" method="POST" data-form="guardar" autocomplete="off" enctype="multipart/form-data">
            <div class="text-center">
            </div>
            <!-- Nombre del Institucion-->
            <b><label for=" textInput">Nombre del Institución:</label></b>
            <div class="input-group flex-nowrap">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="addon-wrapping"><i class="fas fa-user prefix grey-text"></i></span>
                </div>
                <?php $insInstitucion->editar_institucion_formulario(); ?>
            </div>
            <input hidden tipe="text" name="cod_inst" value="<?php echo $cod_inst ?>">
            <!-- Siglas de Institucion-->
            <b><label for=" textInput">Nombre del Institución:</label></b>
            <div class="input-group flex-nowrap">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="addon-wrapping"><i class="fas fa-user prefix grey-text"></i></span>
                </div>
                <?php $insInstitucion->editar_institucion_formulario_2(); ?>
            </div>

            <br><button class="btn btn-info btn-block" type="submit">Actualizar</button>
            <div class="RespuestaAjax"></div>
        </form>
    </div>
</div>
