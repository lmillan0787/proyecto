<?php 
session_start();
include '../addons/header.php';
include '../database/db.php'
 ?>




<?php
$ced=$_SESSION['ced'].'';
$cod_per='select cod_per from dat_per where ced="'.$ced.'"';


$selrol = mysqli_query($conexion,"SELECT cod_rol, des_rol  FROM tab_rol");
$selperf = mysqli_query($conexion,"SELECT cod_perf, des_perf  FROM tab_perf");
$seleven = mysqli_query($conexion,"SELECT cod_even, des_even  FROM dat_even");

$result= mysqli_query($conexion,'SELECT * FROM dat_per  WHERE ced="'.$ced.'"') or die(mysql_error());  

   $row = mysqli_fetch_array( $result );
    /*echo $row['cod_per'];
     echo $row['nom'];
     echo $row['ape'];*/

?>
<?php include '../addons/nav.php' ?>
 <!-- contenedor del formulario-->
<div class="card" id="form_ini">

    <h5 class="card-header info-color white-text text-center py-4">
        <strong>Datos de Participación</strong>
    </h5>

    <!--Formulario de inicio-->
    <div class="card-body px-lg-5" >

  

<form class="text-center" style="color: #757575;"  action="../process/reg_par.php" method="POST">
  <center>

Nombre
<div class="form-group">
<div class="col-sm-15">
    <div class="input-group-prepend">
<input type="text"  name="cod_per" class="form-control" hidden="" value="<?php echo $row['cod_per']; ?> ">
<input type="text"  name="" class="form-control"  value="<?php echo $row['nom']; ?> ">

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
 <select id="" name="cod_perf" class="form-control">
    <?php 
                        while($datos = mysqli_fetch_array($selperf))
                        {
                    ?>
                            <option value="<?php echo $datos['cod_perf']?>"> <?php echo $datos['des_perf']?> </option>
                    <?php
                        }
                    ?> 
                    </select>
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

<!--cod_aud-->
<input type="text" name="cod_aud" value="1" hidden="">


<input type="submit" value="Registrar" class="btn btn-primary">

</center>
</form>

</div></div>

<?php include '../addons/footer.php' ?>

     




<!-- cod_par
 cod_per
 cod_rol
 cod_perf
 cod_even
 cod_aud-->