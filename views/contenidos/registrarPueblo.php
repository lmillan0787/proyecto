<div class="card" id="formPueblo">
    <h5 class="card-header info-color white-text text-center py-4">
        <strong>Datos Básicos del pueblo</strong>
    </h5>
    <!--Formulario de inicio-->
    <div class="card-body px-lg-5">
        <form class="FormularioAjax" action="<?php echo SERVERURL ?>ajax/puebloAjax.php" method="POST" data-form="guardar" autocomplete="off" enctype="multipart/form-data">

            <div class="text-center">
            </div>
            <!-- Nombre del pueblo-->
            <b><label for=" textInput">Nombre del Pueblo:</label></b>
            <div class="input-group flex-nowrap">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="addon-wrapping"><i class="fas fa-user prefix grey-text"></i></span>
                </div>
                <input type="text" class="form-control" placeholder="Nombre del Pueblo" aria-describedby="addon-wrapping" minlength="2" maxlength="20" required pattern="[A-Za-zñÑáéíóúÁÉÍÓÚöÖüÜ\s]+" name="des_pue">
            </div>
            <br>
            <button class="btn btn-info btn-block" type="submit">Registrar</button>
            <div class="RespuestaAjax"></div>
        </form>
    </div>
</div>
