<?php

$peticionAjax = false;
require_once "./controllers/eventoControlador.php";
$insEvento = new eventoControlador();

?>
<!--<script type="text/javascript">
    function toggle(elemento) {

        if (elemento.value == "1") {
            document.getElementById("autoctono").style.display = "block";
            document.getElementById("convencional").style.display = "none";
            document.getElementById("mixto").style.display = "none";

        } else if (elemento.value == "2") {
            document.getElementById("autoctono").style.display = "none";
            document.getElementById("convencional").style.display = "block";
            document.getElementById("mixto").style.display = "none";

        } else if (elemento.value == "3") {
            document.getElementById("autoctono").style.display = "none";
            document.getElementById("convencional").style.display = "none";
            document.getElementById("mixto").style.display = "block";

        }
    }
</script>-->
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
                <input type="text" class="form-control" placeholder="Nombre del Evento" aria-describedby="addon-wrapping" minlength="2" maxlength="20" required pattern="[A-Za-zñÑáéíóúÁÉÍÓÚöÖüÜ\s0-9]+" name="des_even" required>
            </div>
            <!-- Fecha del evento-->
            <label for="textInput">Fecha del evento:</label>
            <div class="input-group flex-nowrap">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="addon-wrapping"><i class="far fa-calendar-alt prefix grey-text"></i></span>
                </div>
                <input type="date" class="form-control" placeholder="Fecha del evento" aria-label="Username" aria-describedby="addon-wrapping" min="2019-01-01" max="2050-01-01" step="1" name="fec_even" required>
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
            <!-- Tipo de evento-->
            <label for="textInput">Tipo de evento:</label><br>
            <!-- Group of default radios - option 1 -->
            <div class="custom-control custom-radio custom-control-inline">
                <input type="radio" class="custom-control-input " id="aut" onclick="toggle(this)" name="cod_tip_even" value="1" required>
                <label class="custom-control-label" for="aut">Autóctono</label>
            </div>
            <!-- Group of default radios - option 2 -->
            <div class="custom-control custom-radio custom-control-inline">
                <input type="radio" class="custom-control-input " id="con" onclick="toggle(this)" name="cod_tip_even" value="2" required>
                <label class="custom-control-label" for="con">Convencional</label>
            </div>
            <!-- Group of default radios - option 3 -->
            <div class="custom-control custom-radio custom-control-inline">
                <input type="radio" class="custom-control-input " id="mix" onclick="toggle(this)" name="cod_tip_even" value="3" required>
                <label class="custom-control-label" for="mix">Mixto</label>
            </div>
            <p><button class="btn btn-info btn-block" type="submit">Registrar</button></p>
            <div id="autoctono" style="display:none">
                <label for="textInput">Disciplinas Autoctonas:</label>

                <?php
                $insEvento->formulario_evento_disciplinas_autoctonas();
                ?>

                <button class="btn btn-info btn-block" type="submit">Registrar</button>
            </div>
            <div id="convencional" style="display:none">
                <label for="textInput">Disciplinas Convencionales:</label>

                <?php
                $insEvento->formulario_evento_disciplinas_convencionales();
                ?>

                <button class="btn btn-info btn-block" type="submit">Registrar</button>
            </div>
            <div id="mixto" style="display:none">
                <label for="textInput">Disciplinas:</label>

                <?php
                $insEvento->formulario_evento_disciplinas();
                ?>

                <button class="btn btn-info btn-block" type="submit">Registrar</button>
            </div>
            <div class="RespuestaAjax"></div>
        </form>
    </div>
</div>