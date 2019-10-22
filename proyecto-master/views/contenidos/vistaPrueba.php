<?php
$peticionAjax = false;
include "./controllers/tecnicoControlador.php";
$insTecnico= new tecnicoControlador();


?>








<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
    <form action="<?php echo SERVERURL ?>ajax/fpdfAjax.php" method="post">

         <label for="" class="form-control">Cedula</label>
        <input type="number" name="cedula"  class="form-control">
        <label for="" class="form-control">Rol</label>
        <input type="text" name="rol" class="form-control" >
        <label for="" class="form-control">Nombre</label>
        <input type="text" name="nombre"  class="form-control">
        <label for="">Apellido</label>
        <input type="text" name="apellido"  class="form-control">
        <label for="">Territorio</label>
        <input type="text" name="territorio"  class="form-control">
        <label for="" class="form-control">Edad</label>
        <input type="text" name="edad" >
        <label for="" class="form-control">Disciplina</label>
        <input type="text" name="disciplina"  class="form-control">
        
        <input type="submit" value="Enviar" >
    </form>
</body>
</html>