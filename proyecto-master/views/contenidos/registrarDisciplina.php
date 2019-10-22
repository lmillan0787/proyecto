<div class="card" id="formPueblo">
    <h5 class="card-header info-color white-text text-center py-4">
        <strong>Datos Básicos de la Disciplina</strong>
    </h5>
    <!--Formulario de inicio-->
    <div class="card-body px-lg-5">
        <form class="FormularioAjax" action="<?php echo SERVERURL ?>ajax/disciplinaAjax.php" method="POST" data-form="guardar" autocomplete="off" enctype="multipart/form-data">

            <div class="text-center">
            </div>
            <!-- Nombre del pueblo-->
            <label for=" textInput">Nombre del Disciplina:</label>
            <div class="input-group flex-nowrap">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="addon-wrapping"><i class="fas fa-user prefix grey-text"></i></span>
                </div>
                <input type="text" class="form-control" placeholder="Nombre del Disciplina" aria-describedby="addon-wrapping" minlength="2" maxlength="20" required pattern="[A-Za-zñÑáéíóúÁÉÍÓÚöÖüÜ\s]+" name="des_dis">
            </div>
           
            <button class="btn btn-info btn-block" type="submit">Registrar</button>
            <div class="RespuestaAjax"></div>
        </form>
    </div>
</div>
