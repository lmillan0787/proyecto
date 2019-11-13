<?php 

$des_even=$_POST['des_even'];
$cod_even=$_POST['cod_even'];

?>
<!-- Barra de busqueda y boton -->
<nav class="navbar navbar-dark teal darken-1">
    <div id="titulo">
    <center><h3>Estadísticas de <?php echo $des_even ?></h3></center>
    </div>
</nav>
    <center>
   
        
            <form class="" action="<?php echo SERVERURL ?>gregionespor/" method="POST" data-form="" enctype="multipart/form-data" target="_blank" rel="noopener noreferrer">
                    <input type="text" value="<?php echo $cod_even?>" name="cod_even" hidden required>
                    <input type="text" value="<?php echo $des_even?>" name="des_even" hidden required>
                    <button type="submit" class="btn btn-info estad">
                    Participación por Regiones Porcentual
                    </button>
            </form>
        
        
            <form class="" action="<?php echo SERVERURL ?>gregiones/" method="POST" data-form="" enctype="multipart/form-data" target="_blank" rel="noopener noreferrer">
                    <input type="text" value="<?php echo $cod_even?>" name="cod_even" hidden required>
                    <input type="text" value="<?php echo $des_even?>" name="des_even" hidden required>
                    <button type="submit" class="btn btn-info estad">
                    Participación por Regiones Cuantitativa
                    </button>
            </form>
        
        
            <form class="" action="<?php echo SERVERURL ?>gdisciplinas/" method="POST" data-form="" enctype="multipart/form-data" target="_blank" rel="noopener noreferrer">
                    <input type="text" value="<?php echo $cod_even?>" name="cod_even" hidden required>
                    <input type="text" value="<?php echo $des_even?>" name="des_even" hidden required>
                    <button type="submit" class="btn btn-info estad">
                    Participación por Disciplinas
                    </button>
                </form>
        
        
            <form class="" action="<?php echo SERVERURL ?>gpueblos/" method="POST" data-form="" enctype="multipart/form-data" target="_blank" rel="noopener noreferrer">
                    <input type="text" value="<?php echo $cod_even?>" name="cod_even" hidden required>
                    <input type="text" value="<?php echo $des_even?>" name="des_even" hidden required>
                    <button type="submit" class="btn btn-info estad">
                    Participación por Pueblos
                    </button>
                </form>
        
        
            <!--<form class="" action="<?php echo SERVERURL ?>geventos/" method="POST" data-form="" enctype="multipart/form-data" target="_blank" rel="noopener noreferrer">
                    <input type="text" value="<?php echo $cod_even?>" name="cod_even" hidden required>
                    <input type="text" value="<?php echo $des_even?>" name="des_even" hidden required>
                    <button type="submit" class="btn btn-info estad">
                    Participación por Eventos
                    </button>
                </form>-->
        
</center>