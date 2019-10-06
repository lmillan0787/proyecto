<?php
$peticionAjax = false;
include "./controllers/invitadoControlador.php";
$insInvitado= new invitadoControlador();
?>



               
<!-- Nav tabs -->
<ul class="nav nav-tabs">
    <li class="nav-item">
        <a class="nav-link active" data-toggle="tab" href="#basicos">Datos Básicos</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" data-toggle="tab" href="#menu1">Datos de Participación</a>
    </li>
</ul>
<!-- Tab panes -->

<header>  <Center><h1>Registro de Invitados</h1></Center></header> 
<div class="tab-content">
    <div class="tab-pane container active" id="basicos"><div class="card" id="form_ini">
       
    <h5 class="card-header info-color white-text text-center py-4">
        <strong>Datos Básicos</strong>
        </h5>
        <!--Formulario de inicio-->
        
        <div class="card-body px-lg-5">
            <form class="FormularioAjax" action="<?php echo SERVERURL ?>ajax/registrarPersonaAjax.php" method="POST" data-form="guardar" autocomplete="off" enctype="multipart/form-data">
                <div class="text-center">
                </div>
                <!-- Nacionalidad-->
                <label for="textInput">Nacionalidad:</label>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <label class="input-group-text" for="inputGroupSelect01"><i class="fas fa-globe-americas prefix grey-text"></i></label>
                    </div>
                    <select class="browser-default custom-select" id="inputGroupSelect01" name="nac" required>
                        <option value="">Nacionalidad</option>
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
                    <input onkeyup="javascript:this.value=this.value.toUpperCase();" type="text" class="form-control" placeholder="Nombre" aria-describedby="addon-wrapping" minlength="2" maxlength="20" required pattern="[A-Za-zñÑáéíóúÁÉÍÓÚöÖüÜ\s]+" name="nom">
                </div>
                <!-- Apellido-->
                <label for="textInput">Apellido:</label>
                <div class="input-group flex-nowrap">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="addon-wrapping"><i class="fas fa-user prefix grey-text"></i></span>
                    </div>
                    <input onkeyup="javascript:this.value=this.value.toUpperCase();" type="text" class="form-control" placeholder="Apellido" aria-describedby="addon-wrapping" minlength="2" maxlength="20" required pattern="[A-Za-zñÑáéíóúÁÉÍÓÚöÖüÜ\s]+" name="ape">
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
                    <select class="browser-default custom-select" id="inputGroupSelect01" id="cod_gen" name="cod_gen" required>
                        <option value="">Género</option>
                        <option value="1">Masculino</option>
                        <option value="2">Femenino</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
    <!-- Datos de Participación  -->

  
    <div class="tab-pane container fade" id="menu1">
        <!-- Codigo de persona -->
        <div class="card" id="form_ini">
            <h5 class="card-header info-color white-text text-center py-4">
            <strong>Datos de Participación</strong>
            </h5>
            <!--Formulario de inicio-->
            <div class="card-body px-lg-5">

          <!--Rol-->
        
                            <!--Perfil-->
                            <div class="form-group">
                                <div class="col-sm-15">
                                    <div class="input-group-prepend">
                                    <?php $insInvitado->consultarPerfil(); ?> 
                                    </div>
                                </div>
                            </div>
                            Evento:
                            <div class="form-group">
                                <div class="col-sm-15">
                                <div class="input-group-prepend">
                                    <?php $insInvitado->consultarEvento();?>
                                </div></div></div>
                              
                
               
            <DIV><button class="btn btn-info btn-block" type="submit">Registrar</button></DIV>
                        <div class="RespuestaAjax"></div>    
            </div></div></div>
            