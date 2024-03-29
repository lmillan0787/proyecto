<?php

    $cod_dis=$_POST['cod_dis'];
    $peticionAjax = false;
    require_once "./controllers/eventoControlador.php";
    require_once "./controllers/disciplinaControlador.php";
    $insEvento = new eventoControlador();
    $insDis = new disciplinaControlador();

?>

<div class="card" id="form_evento">
    <h5 class="card-header info-color white-text text-center py-4">
        <strong>Datos Básicos de la Disciplina</strong>
    </h5>
    <!--Formulario de inicio-->
    <div class="card-body px-lg-5">
        <form class="FormularioAjax" action="<?php echo SERVERURL ?>ajax/editarDisciplinaAjax.php" method="POST" data-form="guardar" autocomplete="off" enctype="multipart/form-data">
            <div class="text-center">
            </div>
            <!-- Nombre del pueblo-->
            <b><label for=" textInput">Nombre del Disciplina:</label></b>
            <div class="input-group flex-nowrap">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="addon-wrapping"><i class="fas fa-user prefix grey-text"></i></span>
                </div>
                <?php $insDis->editar_disciplina_formulario(); ?>
            </div>
            <input hidden tipe="text" name="cod_dis" value="<?php echo $cod_dis ?>">
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
