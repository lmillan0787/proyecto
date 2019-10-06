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
