<?php 
include('../database/db.php');
session_start();
include('../addons/header.php');
include('../addons/nav.php');

$cod_per=$_GET['cod_per'];



 $consulta=ConsultarPersona($_GET['cod_per']);

 function ConsultarPersona($cod_per){
GLOBAL $conexion;
  $selact=" select * from dat_per where cod_per='".$cod_per."'";
  $resultado = mysqli_query($conexion,$selact) or die (mysql_error());
 $registro = mysqli_fetch_array($resultado);

return[

	$registro['ced'],
	$registro['nom'],
	$registro['ape'],
	$registro['fec_nac'],
	$registro['des_gen'],
	$registro['cod_per'],

];
}


?>


<!-- contenedor del formulario-->
<div class="card" id="form_ini">

    <h5 class="card-header info-color white-text text-center py-4">
        <strong>Datos Básicos</strong>
    </h5>

    <!--Formulario de inicio-->
    <div class="card-body px-lg-5" >

  

<form class="text-center" style="color: #757575;"  action="../process/act_dep.php" method="POST">
  <center>
<fieldset>

<!-- Titulo del Formulario -->
<!--<legend>Datos Básicos</legend>-->

<!--Codigo-Persona-->

<input type="text" name="cod_per" value="<?php echo $consulta['5'] ?>" hidden>


<!-- Nacionalidad-->

    
 <span>
            
<div class="input-group mb-3">
<div class="col-sm-3">
  <div class="input-group-prepend">
    <select name="des_nac" id="des_nac" class="form-control">
                  
                  <option value="v">V</option>
                  <option value="e">E</option>
                </select>
</div></div></span>



            

<!-- Cedula-->

  
<span><div class="input-group mb-3">
    <div class="col-sm-15">
  <div class="input-group-prepend">
  
  </div>
  <input type="text" name="ced" class="form-control" placeholder="Cedula" aria-label="Cédula" aria-describedby="basic-addon1" minlength="6" maxlength="8" required pattern="[0-9]+" value="<?php echo $consulta['0'] ?>">
</div></div></span>

</div>


<!-- Nombre-->
<div class="input-group mb-3">
  <div class="col-sm-10">
  <div class="input-group-prepend">
                <input type="text" id="nom" class="form-control" name="nom" placeholder="Nombre"  minlength="4" maxlength="30" required pattern="[A-Za-zñÑáéíóúÁÉÍÓÚ\s]+" value="<?php echo $consulta['1'] ?>"> 
              </div></div></div>
                
          


<!-- Apellido-->
<div class="input-group mb-3">
  <div class="col-sm-10">
  <div class="input-group-prepend">
                <input type="text" id="ape" class="form-control" name="ape" placeholder="Apellido" minlength="4" maxlength="30" required pattern="[A-Za-zñÑáéíóúÁÉÍÓÚ\s]+" value="<?php echo $consulta['2'] ?>"> 
                
              </div></div></div>


<!-- Fecha de Nacimiento-->

<div class="input-group mb-3">
  <div class="col-sm-10">
  <div class="input-group-prepend">
  <input name="fec_nac" placeholder="Fecha de Nacimiento" type="date" min='1960-01-01' max='2003-01-01' step="1" id="fec_nac" class="form-control" value="<?php echo $consulta['3'] ?>">
 
</div></div></div>




<!-- Género-->

<div class="input-group mb-3">
  <div class="col-sm-10">
  <div class="input-group-prepend">
                 <select id="des_gen" name="des_gen" type="date" placeholder="Sexo" class="form-control" required>
<option value="" selected=""><?php echo $consulta['4'] ?></option>
<option value="masculino">Masculino</option>
<option value="femenino">Femenino</option>
                
            
</select>
  </div></div></div>


<!--cod auditoria-->

<input type="text" name="cod_aud" value="1" hidden="">

<!--Fecha de Registro-->

<div class="input-group mb-3">

<input type="submit" class="btn btn-primary" value="Siguiente"></div>





</fieldset>
</center>
</form>


</div>

</div>





 <?php '../addons/footer.php'; ?>