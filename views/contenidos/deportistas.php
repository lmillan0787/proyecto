   <?php
$peticionAjax = false;

require_once "./controllers/deportistaControlador.php";

?>

   <!-- Barra de busqueda y boton -->
    <nav class="navbar navbar-dark teal darken-1">
        <form class="form-inline">            
            
            <span class="navbar-brand" id="brand1">Deportistas</span>
        </form>        
        <button class="btn btn-cyan" type="submit" onclick="location.href='<?php echo SERVERURL ?>registrarDeportista/'">Registrar</button>
    </nav> 
    <!-- Tabla -->
    <div class="table-wrapper-scroll-y my-custom-scrollbar" >
        
        <table class="table table-bordered table-striped" id="tabla">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Apellido</th>
                    <th scope="col">Cédula</th>
                    <th scope="col">Genero</th>                    
                    <th scope="col">Disciplina</th>
                    <th scope="col">Edad</th>
                    <th scope="col">Credencial</th>                    
                    <th scope="col">Editar</th>
                    <th scope="col">Eliminar</th>

                </tr>
            </thead>
            <tbody class="buscar">
            <?php

                $insDeportista = new deportistaControlador();
                $insDeportista->tabla_deportista();

            ?>
            </tbody>
        </table>
    </div>


