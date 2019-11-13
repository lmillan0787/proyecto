<?php $peticionAjax=false; ?>

<div class="container elegant-color" id="conn1">
    <nav class="navbar navbar-dark elegant-color lighten-4" id="nav1">
        <span class="navbar-brand" id="brand1"><?php echo PROYECT ?></span> 
    </nav>
</div>
<!--card: formulario de inicio-->
<div class="container" id="con_todo">
    <div class="card" id="form_ini">
        <h5 class="card-header info-color white-text text-center py-4">
            <strong>INICIO DE SESIÓN</strong>
        </h5>
        <div class="card-body px-lg-5 pt-0">
            <form class="md-form needs validation" style="color: #757575;" action="" method="POST" id="loginForm" autocomplete="off" >
                <!-- Usuario -->
                <div class="md-form form-sm">
                    <i class="fa fa-user prefix"></i>
                    <input type="text" onkeyup="javascript:this.value=this.value.toUpperCase();" id="materialFormNameModalEx1" name="des_usr" autocomplete="off" class="form-control form-control-sm" minlength="6" maxlength="15" required>
                    <label for="materialFormNameModalEx1">Usuario</label>
                </div>
                <!-- Clave -->
                <div class="md-form form-sm">
                    <i class="fa fa-lock prefix"></i>
                    <input type="password" id="materialFormEmailModalEx1" name="clave" autocomplete="off" class="form-control form-control-sm" minlength="6" maxlength="15" required>
                    <label for="materialFormEmailModalEx1">Clave</label>
                </div>
                <div class="text-center mt-4 mb-2">
                    <button class="btn btn-dark-green">Ingresar
                        <i class="fa fa-check ml-2"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php 
    if(isset($_POST['des_usr']) && isset($_POST['clave'])){
        require_once "./controllers/loginControlador.php";
        $login = new loginControlador();
        echo $login->iniciar_sesion_controlador();
    }else{

    }
    
?>
