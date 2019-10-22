<?php 
require('../../controllers/deportistaControlador.php');
sleep(1);
if (isset($_POST)) {
    $ced = (string)$_POST['ced'];
    
    $result = $conexion->mainModel::conectar($ced)(
        'SELECT * FROM dat_per WHERE ced = "'.strtolower($ced).'"'
    );
    
    if ($result->num_rows > 0) {
        echo '<div class="alert alert-danger"><strong>Error!</strong> Cedula registrada anteriormente.</div>';
    } else {
       // echo '<div class="alert alert-success"><strong>Puedes Continuar el registro</strong> Continua.</div>';
    }
}