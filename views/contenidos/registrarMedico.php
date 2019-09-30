<?php
$peticionAjax = false;
include "./controllers/medicoControlador.php";
$insMedico= new medicoControlador();
?>


<ul class="nav nav-tabs" id="myTab" role="tablist">
  <li class="nav-item">
    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Datos Básicos</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Datos de Participación</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Datos de Delegación</a>
  </li>
</ul>
<div class="tab-content" id="myTabContent">
  <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
<center>
    <h1>
        Registro de Médicos
    </h1>
</center>
<form id="form" action="<?php echo SERVERURL ?>ajax/personaAjax.php" method="POST" data-form="guardar" autocomplete="off" enctype="multipart/form-data">

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
                            
                        </div>
                    </div>
                </div>


  </div>
  <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
<div class="card-body">
                    <div class="card" id="form_ini">
                        <h5 class="card-header info-color white-text text-center py-4">
                        <strong>Datos de Participación</strong>
                        </h5>
                        <!--Formulario de inicio-->
                        <div class="card-body px-lg-5" >
                            
                           <!--Rol-->
                            <div class="form-group">
                                <div class="col-sm-15">
                                    <div class="input-group-prepend">
                                       <input type="text" name="cod_rol" value="2" hidden>
                                    </div>
                                </div>
                            </div>
                            <!--Perfil-->
                            <div class="form-group">
                                <div class="col-sm-15">
                                    <div class="input-group-prepend">
                                      <input type="text" name="cod_perf" value="6" hidden=""> 
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
  <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">

    <div class="card-body">
                    <div class="card" id="form_ini">
                        <h5 class="card-header info-color white-text text-center py-4">
                        <strong>Datos de Delegación/Disciplina</strong>
                        </h5>
                        
                        <!--Formulario de inicio-->
                        <div class="card-body px-lg-5" >
                            <!-- Codigo Persona/Nombre -->
                            <div class="form-group">
                                <div class="col-sm-15">
                                    <label class="col-md-4 control-label" for="cod_reg">Nombre</label>
                                    <div class="input-group-prepend">
                                    </div>
                                </div>
                            </div>
                            <!-- Region -->
                            <div class="form-group">
                                <div class="col-sm-15">
                                    <label class="col-md-4 control-label" for="cod_reg">Región</label>
                                    <div class="input-group-prepend">
                                        <?php $insMedico->consultarRegion(); ?>
                                    </div>
                                </div>
                            </div>
                            <!-- Select Pueblo -->
                            <div class="form-group">
                                <div class="col-sm-15">
                                    <label class="col-md-4 control-label" for="cod_reg">Pueblo</label>
                                    <div class="input-group-prepend">
                                        <?php $insMedico->consultarPueblo(); ?>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <center><input type="submit" class="btn btn-primary" value="Registrar"></center>
                            </div>
                        </div>
                    </div>

                </div>

    </div>
</div>