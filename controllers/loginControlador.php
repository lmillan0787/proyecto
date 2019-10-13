 <?php

    if ($peticionAjax) {
        require_once "../models/loginModelo.php";
    } else {
        require_once "./models/loginModelo.php";
    }


    class loginControlador extends loginModelo
    {

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
                session_start(['name' => 'junain']);
                $_SESSION['des_usr'] = $des_usr;

                echo  '<script> window.location="' . SERVERURL  . 'home/"</script>';
                $alerta = [
                    "Alerta" => "simplePersona",
                    "Titulo" => "Datos Inválidos",
                    "Texto" => "El nombre de usuario o contraseña ingresados no son válidas",
                    "Tipo" => "error"
                ];

            } else {
                $alerta = [
                    "Alerta" => "simplePersona",
                    "Titulo" => "Datos Inválidos",
                    "Texto" => "El nombre de usuario o contraseña ingresados no son válidas",
                    "Tipo" => "error"
                ];
                
            }
            return mainModel::sweet_alert($alerta);
        }
    }
