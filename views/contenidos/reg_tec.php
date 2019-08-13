<?php

include '../database/db.php';
session_start();
$varsession = $_SESSION['des_usr'];
$_SESSION['des_usr'];

$query1 = mysqli_query($conexion, "SELECT * FROM tab_perf WHERE cod_rol=4");
$query2 = mysqli_query($conexion, "SELECT * FROM tab_reg");
$query3 = mysqli_query($conexion, "SELECT * FROM tab_pue");
$query4 = mysqli_query($conexion, "SELECT * FROM tab_cat");
?>
<!-- Inicio del codigo -->
<?php require '../addons/header.php' ?>
<?php require '../addons/nav.php' ?>

<!--Pantalla principal -->
<<div class="card" id="form_ini">

  <h5 class="card-header info-color white-text text-center py-4">
    <strong>Datos Básicos</strong>
  </h5>

  <!--Formulario de inicio-->
  <div class="card-body px-lg-5">



    <form class="text-center" style="color: #757575;" action="../process/reg_tec.php" method="POST" autocomplete="off">
      <center>
        <fieldset>

          <!-- Titulo del Formulario -->
          <!--<legend>Datos Básicos</legend>-->

          <!-- Nacionalidad-->


          <span>

            <div class="input-group mb-3">
              <div class="col-sm-3">
                <div class="input-group-prepend">
                  <select name="des_nac" id="des_nac" class="form-control">

                    <option value="v">V</option>
                    <option value="e">E</option>
                  </select>
                </div>
              </div>
          </span>





          <!-- Cedula-->


          <span>
            <div class="input-group mb-3">
              <div class="col-sm-15">
                <div class="input-group-prepend">

                </div>
                <input type="text" name="ced" class="form-control" placeholder="Cedula" aria-label="Cédula" aria-describedby="basic-addon1" minlength="6" maxlength="8" required pattern="[0-9]+">
              </div>
            </div>
          </span>

  </div>


  <!-- Nombre-->
  <div class="input-group mb-3">
    <div class="col-sm-10">
      <div class="input-group-prepend">
        <input type="text" id="nom" class="form-control" name="nom" placeholder="Nombre" minlength="4" maxlength="30" required pattern="[A-Za-zñÑáéíóúÁÉÍÓÚ\s]+">
      </div>
    </div>
  </div>




  <!-- Apellido-->
  <div class="input-group mb-3">
    <div class="col-sm-10">
      <div class="input-group-prepend">
        <input type="text" id="ape" class="form-control" name="ape" placeholder="Apellido" minlength="4" maxlength="30" required pattern="[A-Za-zñÑáéíóúÁÉÍÓÚ\s]+" required>

      </div>
    </div>
  </div>


  <!-- Fecha de Nacimiento-->

  <div class="input-group mb-3">
    <div class="col-sm-10">
      <div class="input-group-prepend">
        <input name="fec_nac" placeholder="Fecha de Nacimiento" type="date" min='1960-01-01' max='2003-01-01' step="1" id="fec_nac" class="form-control" required>

      </div>
    </div>
  </div>




  <!-- Género-->

  <div class="input-group mb-3">
    <div class="col-sm-10">
      <div class="input-group-prepend">
        <select id="des_gen" name="des_gen" type="date" placeholder="Sexo" class="form-control" required>
          <option value="" disabled="" selected="">Seleccione Género</option>
          <option value="masculino">Masculino</option>
          <option value="femenino">Femenino</option>
        </select>
      </div>
    </div>
  </div>

  <div class="input-group mb-3">
    <div class="col-sm-10">
      <div class="input-group-prepend">
        <input type="text" id="des_ins" class="form-control" name="des_ins" placeholder="Institución" minlength="2" maxlength="30" required pattern="[A-Za-zñÑáéíóúÁÉÍÓÚ\s]+">
      </div>
    </div>
  </div>
  
  <div class="input-group mb-3">
    <div class="col-sm-10">
      <div class="input-group-prepend">
        <select id="des_perf" name="cod_perf" type="text" placeholder="Comisión" class="form-control" required>
          <option value="" disabled="" selected="">Seleccione comisión</option>
          <?php       
          
          while($row1 = mysqli_fetch_array($query1)){
            echo '<option value="'.$row1["cod_perf"].'">'.$row1["des_perf"].'</option>';
          }?>
          
        </select>
      </div>
    </div>
  </div>
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

  <?php include '../addons/footer.php'; ?>



  <!-- Fin del codigo -->