<?php

$peticionAjax = false;
require_once "./controllers/eventoControlador.php";
$insEvento = new eventoControlador();

?>
 <!-- Validar Cedula -->
<script type="text/javascript">
$(document).ready(function() {  
    $('#des_even').on('blur', function(){
        $('#result-even').html('<img src="<?php echo SERVERURL ?>views/assets/img/loader.gif" />').fadeOut(1000);

        var des_even = $(this).val();   
        var dataString = 'des_even='+des_even;

        $.ajax({
            type: "POST",
            url: "<?php echo SERVERURL ?>ajax/validarEventoAjax.php",
            data: dataString,
            success: function(data) {
                $('#result-even').fadeIn(1000).html(data);
            }
        });
    });              
});    
</script>
<div class="card" id="form_evento">

    <h5 class="card-header info-color white-text text-center py-4">
        <strong>Datos Básicos del Evento</strong>
    </h5>
    <!--Formulario de inicio-->
    <div class="card-body px-lg-5">
        <form class="FormularioAjax" action="<?php echo SERVERURL ?>ajax/registrarEventoAjax.php" method="POST" data-form="guardar" autocomplete="off" enctype="multipart/form-data">
            <div class="text-center">
            </div>
            <!-- Nombre del Evento-->
            <label for="textInput">Nombre del evento:</label>
            <div class="input-group flex-nowrap">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="addon-wrapping"><i class="fas fa-user prefix grey-text"></i></span>
                </div>
                <input onkeyup="javascript:this.value=this.value.toUpperCase();" type="text" class="form-control" placeholder="Nombre del Evento" aria-describedby="addon-wrapping" minlength="2" maxlength="20" required pattern="[A-Za-zñÑáéíóúÁÉÍÓÚöÖüÜ\s0-9]+" name="des_even" required id="des_even">
            </div>
            <div id="result-even"></div> 
            <!-- Fecha del evento-->
            <label for="textInput">Fecha del evento:</label>
            <div class="input-group flex-nowrap">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="addon-wrapping"><i class="far fa-calendar-alt prefix grey-text"></i></span>
                </div>
                <input type="date" class="form-control" placeholder="Fecha del evento" aria-label="Username" aria-describedby="addon-wrapping" min="today" max="2050-01-01" step="1" name="fec_even" required>
            </div>
            <!-- Estado-->
            <label for="textInput">Estado:</label>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <label class="input-group-text" for="inputGroupSelect01"><i class="fas fa-globe-americas prefix grey-text"></i></label>
                </div>
                <select class="browser-default custom-select" id="inputGroupSelect01" id="cod_edo" name="cod_edo" required>
                    <option selected disabled>Estado</option>
                    <?php
                    $insEvento->formulario_evento();
                    foreach ($row as $row) {
                        echo '<option value="' . $row['cod_edo'] . '">' . $row['des_edo'] . '</option>';
                    }
                    ?>
                </select>
            </div>
            <!-- Estatus-->
            <label for="textInput">Estatus:</label>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <label class="input-group-text" for="inputGroupSelect01"><i class="fas fa-toggle-on prefix grey-text"></i></label>
                </div>
                <select class="browser-default custom-select" id="inputGroupSelect01" id="cod_estar" name="cod_estat" required>
                    <option selected disabled>Estatus</option>
                    <?php
                    $insEvento->formulario_evento_estatus();
                    foreach ($row as $row) {
                        echo '<option value="' . $row['cod_estat'] . '">' . $row['des_estat'] . '</option>';
                    }
                    ?>
                </select>
            </div>
            <!-- Tipo de evento-->
            <label for="textInput">Tipo de evento:</label><br>
            <!-- Group of default radios - option 1 -->
            <div class="custom-control custom-radio custom-control-inline">
                <input type="radio" class="custom-control-input " id="aut"  name="cod_tip_even" value="1" required>
                <label class="custom-control-label" for="aut">Autóctono</label>
            </div>
            <!-- Group of default radios - option 2 -->
            <div class="custom-control custom-radio custom-control-inline">
                <input type="radio" class="custom-control-input " id="con"  name="cod_tip_even" value="2" required>
                <label class="custom-control-label" for="con">Convencional</label>
            </div>
            <!-- Group of default radios - option 3 -->
            <div class="custom-control custom-radio custom-control-inline">
                <input type="radio" class="custom-control-input " id="mix" name="cod_tip_even" value="3" required>
                <label class="custom-control-label" for="mix">Mixto</label>
            </div>
            <p><button class="btn btn-info btn-block" type="submit">Registrar</button></p>
            <div class="RespuestaAjax"></div>
        </form>
    </div>
</div>