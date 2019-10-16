<?php
$peticionAjax = false;

require_once "./controllers/invitadoControlador.php";

?>
<!--tabla Invitado-->
<div id="con_todo">

    <!-- Barra de busqueda y boton -->
    <nav class="navbar navbar-dark unique-color">
        <form class="form-inline">            
          
            <span class="navbar-brand" id="brand1">Invitados</span>
        </form>        
        <button class="btn btn-info btn-md" type="submit" onclick="location.href='<?php echo SERVERURL ?>registrarInvitado/'">Registrar</button>
    </nav> 
    
    <!-- Tabla -->
    <div class="table-wrapper-scroll-y my-custom-scrollbar">
        
        <table class="table table-bordered table-striped" id="tabla">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Apellido</th>
                    <th scope="col">Cédula</th>
                    <th scope="col">Genero</th>                   
                    <th scope="col">Edad</th> 
                    <th scope="col">Perfil</th>
                    <th scope="col">Credencial</th>                  
                    <th scope="col">Editar</th>
                    <th scope="col">Eliminar</th>
                </tr>
            </thead>
            <tbody class="buscar">
            <?php
               $insInvitado= new invitadoControlador();
               $insInvitado->tabla_invitado();
            ?>
            </tbody>
        </table>
    </div>
</div>


