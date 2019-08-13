<?php
$peticionAjax = false;
include "./controllers/deportistaControlador.php";
$insDeportista= new deportistaControlador();

?>



<div class="accordion" id="accordionExample">
  <div class="card">
    <div class="card-header" id="headingOne">
      <h2 class="mb-0">
        <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
         Datos Básicos
      </h2>
    </div>

    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
     <div class="card" id="form_ini">

    <h5 class="card-header info-color white-text text-center py-4">
        <strong>Datos Básicos</strong>
    </h5>

    <!--Formulario de inicio-->
    <div class="card-body px-lg-5" >

    <form class="FormularioAjax" action="../process/deportistaBasico.php" method="POST" data-form="guardar" autocomplete="off"
    enctype="multipart/form-data">
    
        <div class="text-center">           
        </div>
        <!-- Nacionalidad-->
        <label for="textInput">Nacionalidad:</label>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <label class="input-group-text" for="inputGroupSelect01"><i class="fas fa-globe-americas prefix grey-text"></i></label>
            </div>
            <select class="browser-default custom-select" id="inputGroupSelect01" name="nac" required>
                <option selected disabled>Nacionalidad</option>
                <option value="1">Venezolan@</option>
                <option value="0">Extrajer@</option>
            </select>
        </div>
        <!-- Cédula-->
        <label for="textInput">Cédula:</label>
        <div class="input-group flex-nowrap">
            <div class="input-group-prepend">
                <span class="input-group-text" id="addon-wrapping"><i
                        class="far fa-id-card prefix grey-text"></i></span>
            </div>
            <input type="text" id="ced" class="form-control" placeholder="Cédula" aria-describedby="addon-wrapping" minlength="6"
                maxlength="8" required pattern="[0-9]+" name="ced">                
        </div>
        <div id="result-ced"></div>
        <!-- Nombre-->
        <label for=" textInput">Nombre:</label>
        <div class="input-group flex-nowrap">
            <div class="input-group-prepend">
                <span class="input-group-text" id="addon-wrapping"><i class="fas fa-user prefix grey-text"></i></span>
            </div>
            <input type="text" class="form-control" placeholder="Nombre" aria-describedby="addon-wrapping" minlength="2"
                maxlength="20" required pattern="[A-Za-zñÑáéíóúÁÉÍÓÚöÖüÜ\s]+" name="nom">
        </div>
        <!-- Apellido-->
        <label for="textInput">Apellido:</label>
        <div class="input-group flex-nowrap">
            <div class="input-group-prepend">
                <span class="input-group-text" id="addon-wrapping"><i class="fas fa-user prefix grey-text"></i></span>
            </div>
            <input type="text" class="form-control" placeholder="Apellido" aria-describedby="addon-wrapping"
                minlength="2" maxlength="20" required pattern="[A-Za-zñÑáéíóúÁÉÍÓÚöÖüÜ\s]+" name="ape">
        </div>
        <!-- Fecha de nacimiento-->
        <label for="textInput">Fecha de nacimiento:</label>
        <div class="input-group flex-nowrap">
            <div class="input-group-prepend">
                <span class="input-group-text" id="addon-wrapping"><i
                        class="far fa-calendar-alt prefix grey-text"></i></span>
            </div>
            <input type="date" class="form-control"  placeholder="Fecha de nacimiento"  min="1930-01-01" max="2010-12-31" name="fec_nac">
        </div>
        <!-- Género-->
        <label for="textInput">Género:</label>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <label class="input-group-text" for="inputGroupSelect01"><i
                        class="fas fa-venus-mars prefix grey-text"></i></label>
            </div>
            <select class="browser-default custom-select" id="inputGroupSelect01" id="des_gen" name="des_gen">
                <option selected disabled>Género</option>
                <option value="1">Masculino</option>
                <option value="0">Femenino</option>
            </select>
        </div>
    </div>
  </div></div>
  <div class="card">
    <div class="card-header" id="headingTwo">
      <h2 class="mb-0">
        <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
          Participación
        </button>
      </h2>
    </div>
    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
      <div class="card-body">
        <p><div class="card" id="form_ini">

    <h5 class="card-header info-color white-text text-center py-4">
        <strong>Datos de Participación</strong>
    </h5>

    <!--Formulario de inicio-->
    <div class="card-body px-lg-5">

  

<form class="text-center" style="color: #757575;"  action="../process/participacionDeportista.php" method="POST">
  <center>


<div class="form-group">
<div class="col-sm-15">
    <div class="input-group-prepend">

</div></div></div>



 Rol:
<div class="form-group">
<div class="col-sm-15">
     <div class="input-group-prepend">
 <select id="" name="cod_rol" class="form-control">
    <
    <?php 
                        while($datos = mysqli_fetch_array($selrol))
                        {
                    ?>
                            <option value="<?php echo $datos['cod_rol']?>"> <?php echo $datos['des_rol']?> </option>
                    <?php
                        }
                    ?> 
                    </select>
</div></div></div>


 

  Perfil:
    <div class="form-group">
<div class="col-sm-15"> 
    <div class="input-group-prepend">

 <?php
     
/*$insDeportista->consultarPerfil();*/
?>
                     
                    
</div></div></div>



<div>

  Evento:
    <div class="form-group">
<div class="col-sm-15"> 
 <select id="" name="cod_even" class="form-control">
    <?php 
                        while($datos = mysqli_fetch_array($seleven))
                        {
                    ?>
                            <option value="<?php echo $datos['cod_even']?>"> <?php echo $datos['des_even']?> </option>
                    <?php
                        }
                    ?> 
                    </select>
</div></div></div>
</div></div></div>
      </div>
    </div>
  </div>
  <div class="card">
    <div class="card-header" id="headingThree">
      <h2 class="mb-0">
        <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
          Delegación
        </button>
      </h2>
    </div>
    <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
    <div class="card" id="form_ini">

    <h5 class="card-header info-color white-text text-center py-4">
        <strong>Datos de Delegación</strong>
    </h5>

    <!--Formulario de inicio-->
    <div class="card-body px-lg-5" >

  
<!-- Region -->

<div class="form-group">
<div class="col-sm-15">
<label class="col-md-4 control-label" for="cod_reg">Región</label>  
   <div class="input-group-prepend">
  
  


<?php


$insDeportista->consultarRegion();
  ?>

</div></div></div>


<!-- Select Pueblo -->

<div class="form-group">
<div class="col-sm-15">
<label class="col-md-4 control-label" for="cod_reg">Pueblo</label> 
   <div class="input-group-prepend">
 
 
 <?php 



 
?>


 </div>
</div></div>

</div></div></div>


  

<div class="card">
    <div class="card-header" id="headingFour">
      <h2 class="mb-0">
        <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseThree">
          Disciplina
        </button>
      </h2>
    </div>
    <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordionExample">
      <div class="card-body">
     <!-- Select Disciplina -->

<div class="form-group">
<div class="col-sm-15">
 <label class="col-md-4 control-label" for="cod_dis">Disciplina</label> 
     <div class="input-group-prepend">

  

    <select name="cod_dis" class="form-control">
     <?php 
                        while($datos1 = mysqli_fetch_array($seldis))
                        {
                    ?>
                            <option value="<?php echo $datos1['cod_dis']?>"> <?php echo $datos1['des_dis']?> </option>
                    <?php
                        }
                    ?> 
</select></div>
</div></div>




<!-- Select Categoria -->

<div class="form-group">
<div class="col-sm-15">
 <label class="col-md-4 control-label" for="cod_cat">Categoria</label> 
     <div class="input-group-prepend">

  

    <select name="cod_cat" class="form-control">
     <?php 
                        while($datos1 = mysqli_fetch_array($selcat))
                        {
                    ?>
                            <option value="<?php echo $datos1['cod_cat']?>"> <?php echo $datos1['des_cat']?> </option>
                    <?php
                        }
                    ?> 
</select></div>
</div></div>

<!--Codigo Auditoria-->


<input type="text" name="cod_aud" value="1" hidden="">  



<div form-control>

      </div>
    </div>
  </div>
</div>

<submit class="btn btn-primary" >Registrar</submit>


