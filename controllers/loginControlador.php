 <?php
    
    if ($peticionAjax) {
        require_once "../models/loginModelo.php";
    } else {
        require_once "./models/loginModelo.php";
    }


    class loginControlador extends loginModelo
    {
        /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        //inicio de sesión
        public function iniciar_sesion_controlador()
        {
            $des_usr = mainModel::limpiar_cadena($_POST['des_usr']);
            $clave = mainModel::limpiar_cadena($_POST['clave']);

            $clave = mainModel::encryption($clave);

            $datosLogin = [
                "des_usr" => $des_usr,
                "clave" => $clave
            ];
            $consultaUsuario = loginModelo::iniciar_sesion_modelo($datosLogin);
            if ($consultaUsuario->rowCount() == 1) {
                $row=$consultaUsuario->fetch();
                session_start(['name' => 'junain']);
                $_SESSION['des_usr_junain'] = $row['des_usr'];
                $_SESSION['cod_perf_junain'] = $row['cod_perf'];
                $_SESSION['cod_per_junain'] = $row['cod_per'];
                $_SESSION['cod_usr_junain'] = $row['cod_usr'];
                $_SESSION['token_junain'] = md5(uniqid(mt_rand(),true));

                $url = SERVERURL . "home/";

                return $urlLocation =  '<script> window.location="' . $url . ' "</script>';
                
            } else {
                echo "
                    <script>
                    Swal.fire(
                        'Error al iniciar sesión',
                        'Contraseña o usuario incorrectos',
                        'error'
                    )                   
                    </script>
               ";
            }
        }
        /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        //forzar cierre de sesión
        public function forzar_cierre_sesion_controlador()
        {
            session_destroy();
            return header("Location:".SERVERURL."inicio/");
        }
    }
