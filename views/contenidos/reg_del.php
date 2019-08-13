<?php 
include '../database/db.php';
session_start();
include '../addons/header.php';
include '../addons/nav.php';

$ced=$_SESSION['ced'].'';

$selreg=mysqli_query($conexion,"select cod_reg,des_reg from tab_reg ");
$selpue=mysqli_query($conexion,"select cod_pue,des_pue from tab_pue ");
$seldis=mysqli_query($conexion,"select cod_dis,des_dis from tab_dis ");
$selcat=mysqli_query($conexion,"select cod_cat,des_cat from tab_cat ");






$result= mysqli_query($conexion,'SELECT * FROM dat_per  WHERE ced="'.$ced.'"') or die(mysql_error());

 ?>




 <!-- contenedor del formulario-->
<div class="card" id="form_ini">

    <h5 class="card-header info-color white-text text-center py-4">
        <strong>Datos de Delegación</strong>
    </h5>

    <!--Formulario de inicio-->
    <div class="card-body px-lg-5" >

  

<form class="text-center" style="color: #757575;"  action="../process/reg_del.php" method="POST">



<?php 

 $row = mysqli_fetch_array( $result );
     /*echo $row['cod_per'];
     echo $row['nom'];
     echo $row['ape'];*/ ?>



<!-- Codigo Delegacion  -->
<div class="form-group">
<div class="col-sm-15">
	Codigo Delegación
    <div class="input-group-prepend">
<input type="number" name=cod_del value="1" class="form-control">
</div></div></div>


<!-- Codigo Persona/Nombre -->

<div class="form-group">
<div class="col-sm-15">
	<label class="col-md-4 control-label" for="cod_reg">Nombre</label>  
    <div class="input-group-prepend">
<input type="text"  name="cod_per" class="form-control" hidden="" value="<?php echo $row['cod_per']; ?> ">
<input type="text"  name="" class="form-control"  value="<?php echo $row['nom']; ?> ">

</div></div></div>




<!-- Region -->



<div class="form-group">
<div class="col-sm-15">
<label class="col-md-4 control-label" for="cod_reg">Región</label>  
	 <div class="input-group-prepend">
  
  


<select name="cod_reg" id="" class="form-control">

 <?php 
                        while($datos = mysqli_fetch_array($selreg))
                        {
                    ?>
                            <option value="<?php echo $datos['cod_reg']?>"> <?php echo $datos['des_reg']?> </option>
                    <?php
                        }
                    ?> 

	

</select>

</div></div></div>


<!-- Select Pueblo -->

<div class="form-group">
<div class="col-sm-15">
<label class="col-md-4 control-label" for="cod_reg">Pueblo</label> 
	 <div class="input-group-prepend">
 
  

	<select name="cod_pue"class="form-control">
     <?php 
                        while($datos1 = mysqli_fetch_array($selpue))
                        {
                    ?>
                            <option value="<?php echo $datos1['cod_pue']?>"> <?php echo $datos1['des_pue']?> </option>
                    <?php
                        }
                    ?> 
</select></div>
</div></div>




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
<input type="submit" class="btn btn-primary" value="Registrar"></div>


</form>



</center>




<!--
cod_del
cod_per
cod_reg
cod_pue
cod_dis
cod_cat
cod_aud


-->





























 <?php 

 include '../addons/footer.php'; ?>