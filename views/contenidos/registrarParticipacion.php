<?php
$peticionAjax = false;
include "./controllers/participacionControlador.php";
include "./controllers/deportistaControlador.php";
$insParticipacion= new participacionControlador();
$insDeportista= new deportistaControlador();
?>
<div>
    <center><h1>Registro de Participación</h1></center>
</div>
<ul class="stepper parallel" id="custom-validation">
  <li class="step active">
    <div class="step-title waves-effect waves-dark">Step 1</div>
    <div class="step-new-content">
      <div class="row">
        <div class="md-form col-12 ml-auto">
          <input id="email-validation" type="email" class="validate form-control" placeholder="This field is not required">
          <label for="email-validation">Your e-mail</label>
        </div>
      </div>
      <div class="step-actions">
        <button class="waves-effect waves-dark btn btn-sm btn-primary next-step" data-feedback="validationFunction">CONTINUE</button>
      </div>
    </div>
  </li>
  <li class="step">
    <div class="step-title waves-effect waves-dark">Step 2</div>
    <div class="step-new-content">
      <div class="row">
        <div class="md-form col-12 ml-auto">
          <input id="password-validation" type="password" class="validate form-control" required>
          <label for="password-validation">Your password</label>
        </div>
      </div>
      <div class="step-actions">
        <button class="waves-effect waves-dark btn btn-sm btn-primary next-step" data-feedback="validationFunction">CONTINUE</button>
        <button class="waves-effect waves-dark btn btn-sm btn-secondary previous-step">BACK</button>
      </div>
    </div>
  </li>
  <li class="step">
    <div class="step-title waves-effect waves-dark">Step 3</div>
    <div class="step-new-content">
      Finish!
      <div class="step-actions">
        <button class="waves-effect waves-dark btn btn-sm btn-primary m-0 mt-4" type="button">SUBMIT</button>
      </div>
    </div>
  </li>
</ul>

<script>
function validationFunction() {
setTimeout(function () {
$('#custom-validation').nextStep();
}, 1600);
}
function someTrueFunction() {
return true;
}

$(document).ready(function () {
$('.stepper').mdbStepper();
})
</script>
<form id="form" action="<?php echo SERVERURL ?>ajax/personaAjax.php" method="POST" data-form="guardar" autocomplete="off" enctype="multipart/form-data">
    
        
          
            
           
               
                 
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
                                      <?php $insDeportista->consultarPerfil();?>  
                                    </div>
                                </div>
                            </div>
                            Evento:
                            <div class="form-group">
                                <div class="col-sm-15">
                                    <?php $insDeportista->consultarEvento();?>
                                </div>
                            </div>
                        </div>
                    
                    
                            <div>
                                <center><input type="submit" class="btn btn-primary" value="Registrar"></center>
                            </div>
                             
</div>
</form>
