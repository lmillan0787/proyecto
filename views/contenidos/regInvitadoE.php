<?php
$peticionAjax = false;
include "./controllers/medicoControlador.php";
$insMedico= new medicoControlador();
?>
<div>
    <center><h1>Registro de Invitado Especial</h1></center>
</div>
<form id="form" action="<?php echo SERVERURL ?>ajax/personaAjax.php" method="POST" data-form="guardar" autocomplete="off" enctype="multipart/form-data">
    <div class="accordion" id="accordionExample">
        <div class="card">
            <div class="card-header" id="headingOne">
                <h5 class="mb-0">
                <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                Datos Básicos
                </button>
                </h5>
            </div>
            
            <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                <div class="card-body">
                    <div class="card" id="form_ini">
                        <h5 class="card-header info-color white-text text-center py-4">
                        <strong>Datos Básicos</strong>
                        </h5>
                        <div class="card-body px-lg-5" >
                            <!-- Nacionalidad-->
                            <label for="textInput">Nacionalidad:</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <label class="input-group-text" for="inputGroupSelect01"><i class="fas fa-globe-americas prefix grey-text"></i></label>
                                </div>
                                <select class="browser-default custom-select" id="inputGroupSelect01" name="nac">
                                    <option selected disabled>Nacionalidad</option>
                                    <option value="1">Venezolan@</option>
                                    <option value="0">Extrajer@</option>
                                </select>
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
                            <!-- Nombre-->
                            <label for=" textInput">Nombre:</label>
                            <div class="input-group flex-nowrap">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="addon-wrapping"><i class="fas fa-user prefix grey-text"></i></span>
                                </div>
                                <input type="text" class="form-control" placeholder="Nombre" aria-describedby="addon-wrapping" minlength="2" maxlength="20" required pattern="[A-Za-zñÑáéíóúÁÉÍÓÚöÖüÜ\s]+" name="nom">
                            </div>
                            <!-- Apellido-->
                            <label for="textInput">Apellido:</label>
                            <div class="input-group flex-nowrap">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="addon-wrapping"><i class="fas fa-user prefix grey-text"></i></span>
                                </div>
                                <input type="text" class="form-control" placeholder="Apellido" aria-describedby="addon-wrapping" minlength="2" maxlength="20" required pattern="[A-Za-zñÑáéíóúÁÉÍÓÚöÖüÜ\s]+" name="ape">
                            </div>
                            <!-- Fecha de nacimiento-->
                            <label for="textInput">Fecha de nacimiento:</label>
                            <div class="input-group flex-nowrap">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="addon-wrapping"><i class="far fa-calendar-alt prefix grey-text"></i></span>
                                </div>
                                <input type="date" class="form-control" placeholder="Fecha de nacimiento" aria-label="Username" aria-describedby="addon-wrapping" min="1930-01-01" max="2010-01-01" step="1" name="fec_nac">
                            </div>
                            <!-- Género-->
                            <label for="textInput">Género:</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <label class="input-group-text" for="inputGroupSelect01"><i class="fas fa-venus-mars prefix grey-text"></i></label>
                                </div>
                                <select class="browser-default custom-select" id="inputGroupSelect01" id="cod_gen" name="cod_gen">
                                    <option selected disabled>Género</option>
                                    <option value="1">Masculino</option>
                                    <option value="2">Femenino</option>
                                </select>
                            </div>
                            <div>
                                <center><input type="submit" class="btn btn-primary" value="Registrar"></center>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header" id="headingTwo">
                <h5 class="mb-0">
                <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                Evento
                </button>
                </h5>
            </div>
            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                <div class="card-body">
                    <div class="card" id="form_ini">
                        <h5 class="card-header info-color white-text text-center py-4">
                        <strong>Evento</strong>
                        </h5>
                        <!--Formulario de inicio-->
                        <div class="card-body px-lg-5" >
                            
                            <!--Rol-->
                            <div class="form-group">
                                <div class="col-sm-15">
                                    <div class="input-group-prepend">
                                       <input type="text" name="cod_rol" value="5" hidden>
                                    </div>
                                </div>
                            </div>
                            <!--Perfil-->
                            <div class="form-group">
                                <div class="col-sm-15">
                                    <div class="input-group-prepend">
                                      <input type="text" name="cod_perf" value="14" hidden=""> 
                                    </div>
                                </div>
                            </div>
                            Evento:
                            <div class="form-group">
                                <div class="col-sm-15">
                                    <?php $insMedico->consultarEvento();?>
                                </div>
                                <div>
                                    <center><input type="submit" class="btn btn-primary" value="Registrar"></center>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</form>
</div>