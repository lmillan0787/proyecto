<?php

    $cod_perf=$_POST['cod_perf'];
    $peticionAjax = false;
    
    require_once "./controllers/perfilControlador.php";
    
    $insPerfil = new perfilControlador();

?>

<div class="card" id="form_evento">
    <h5 class="card-header info-color white-text text-center py-4">
        <strong>Datos Básicos de Perfil</strong>
    </h5>
    <!--Formulario de inicio-->
    <div class="card-body px-lg-5">
        <form class="FormularioAjax" action="<?php echo SERVERURL ?>ajax/editarPerfilAjax.php" method="POST" data-form="guardar" autocomplete="off" enctype="multipart/form-data">
            <div class="text-center">
            </div>

             <?php $insPerfil->editar_perfil_formulario(); ?>

            <!-- Nombre del Perfil-->
            <b><label for=" textInput">Nombre del Perfil:</label></b>
            <div class="input-group flex-nowrap">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="addon-wrapping"><i class="fas fa-user prefix grey-text"></i></span>
                </div>
               
                <?php $insPerfil->editar_perfil_formulario_2(); ?>

               
            </div>
 <?php $insPerfil->editar_perfil_formulario_3(); ?>

           
           
           

            <br><button class="btn btn-info btn-block" type="submit">Actualizar</button>
            <div class="RespuestaAjax"></div>
        </form>
    </div>
</div>
