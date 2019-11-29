<?php

if ($peticionAjax) {
    require_once "../models/usuarioModelo.php";
} else {
    require_once "./models/usuarioModelo.php";
}

class usuarioControlador extends usuarioModelo
{
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //TABLA USUARIOS
    public function tabla_usuario_controlador()
    {
        $sql = usuarioModelo::consultar_usuario_modelo();
        foreach ($sql as $row) {
            echo '
            <tr>
                <td class="text-center">' . $row['cod_usr'] . '</td>
                <td class="text-center">' . $row['ced'] . '</td>
                <td class="text-center">' . $row['nom'] . '</td>
                <td class="text-center">' . $row['ape'] . '</td>
                <td class="text-center">' . $row['des_usr'] . '</td>
                <td class="text-center">' . $row['des_perf'] . '</td>
                <td class="text-center">' . $row['des_estat'] . '</td>
                <td class="text-center">
                    <a href="' . SERVERURL . 'editarUsuario/' . $row['cod_usr'] . '/">
                        <button type="submit" class="btn btn-default btn-sm">
                            <i class="far fa-edit fa-2x"></i>
                        </button>
                    </a>  
                </td>
            </tr>';
        }
    }
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //registrar usuarios
    public function agregar_usuario_controlador()
    {
        $ced = mainModel::limpiar_cadena($_POST['ced']);
        $des_usr = mainModel::limpiar_cadena($_POST['des_usr']);
        $clave = mainModel::limpiar_cadena($_POST['clave']);
        $repClave = mainModel::limpiar_cadena($_POST['repClave']);
        $cod_perf = mainModel::limpiar_cadena($_POST['cod_perf']);
        $datosUsuario = [
            "des_usr" => $des_usr,
        ];
        $peticionAjax=true;
        require_once "../controllers/personaControlador.php";
        $persona = new personaControlador;
        $sql = $persona->consultar_existe_persona($ced);
        $cod_per = $persona->datos_cedula_persona($ced)['cod_per'];
        $usuario = usuarioModelo::consular_usuario_disponible_modelo($cod_per);
        $ced = str_replace(' ', '', $ced);
        if (strlen($ced) < 8) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Debe ingresar un número de cédula válido",
                "Texto" => "Mínimo 6 dígitos, máximo 8 dígitos",
                "Tipo" => "error"
            ];
        }else{
            if($usuario->rowCount() >= 1){
                $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "La persona ya posee un usuario registrado",
                    "Texto" => "Ingrese otro numero de cédula",
                    "Tipo" => "error"
                ];
            }else{
                $des_usr = str_replace(' ', '', $des_usr);
                if (strlen($des_usr) < 4) {
                    $alerta = [
                        "Alerta" => "simple",
                        "Titulo" => "Ingrese un nombre de usuario válido",
                        "Texto" => "Mínimo 4 caracteres, máximo 20 caracteres",
                        "Tipo" => "error"
                    ];
                }else{
                    if ($sql->rowCount() >= 1) {
                        $consultarUsuarioNombre = usuarioModelo::consultar_usuario_nombre($datosUsuario);
                        if ($consultarUsuarioNombre->rowCount() >= 1) {
                            $alerta = [
                                "Alerta" => "simple",
                                "Titulo" => "El nombre de usuario ya se encuentra en uso",
                                "Texto" => "Utilice otro nombre de usuario",
                                "Tipo" => "error"
                            ];
                        } else {
                            $clave = str_replace(' ', '', $clave);
                            $repClave = str_replace(' ', '', $repClave);
                            if(strlen($clave) < 8 || strlen($repClave) < 8){
                                $alerta = [
                                    "Alerta" => "simple",
                                    "Titulo" => "La clave debe tener un valor de 8 dígitos o caracteres",
                                    "Texto" => "Las claves no pueden iniciar o finalizar con espacios en blanco",
                                    "Tipo" => "error"
                                ];
                            }else{
                                if ($clave != $repClave) {
                                    $alerta = [
                                        "Alerta" => "simple",
                                        "Titulo" => "Ocurrio un error inesperado",
                                        "Texto" => "Las claves que intenta ingresar no coinciden",
                                        "Tipo" => "error"
                                    ];
                                } else {
                                    $clave = mainModel::encryption($clave); 
                                    $des_usr = strtoupper ($des_usr);                   
                                    $datosUsuario = [
                                        "cod_per" => $cod_per,
                                        "des_usr" => $des_usr,
                                        "clave" => $clave,
                                        "cod_perf" => $cod_perf
                                    ];
                                    $registrarUsuario = usuarioModelo::agregar_usuario_modelo($datosUsuario);
                                    if ($registrarUsuario->rowCount() >= 1) {
                                        $alerta = [
                                            "Alerta" => "simpleUsuario",
                                            "Titulo" => "",
                                            "Texto" => "Usuario registrada exitosamente",
                                            "Tipo" => "success"
                                        ];
                                    } else {
                                        $alerta = [
                                            "Alerta" => "simple",
                                            "Titulo" => "Ocurrió un error inesperado",
                                            "Texto" => "Recargue la página e intente de nuevo",
                                            "Tipo" => "error"
                                        ];
                                    }
                                }
                            }
                        }
                    } else {
                        $alerta = [
                            "Alerta" => "simple",
                            "Titulo" => "Debe registrar primero a la persona",
                            "Texto" => "Dírijase al módulo de personas",
                            "Tipo" => "error"
                        ];
                    }
                }
            }  
        }
        return mainModel::sweet_alert($alerta);
    }
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //editar persona formulario cedula
    public function editar_usuario_controlador()
    {
        $cod_usr = mainModel::limpiar_cadena($_POST['cod_usr']);
        $des_usr = mainModel::limpiar_cadena($_POST['des_usr']);
        $cod_perf = mainModel::limpiar_cadena($_POST['cod_perf']);
        $cod_estat = mainModel::limpiar_cadena($_POST['cod_estat']);
        $clave = mainModel::limpiar_cadena($_POST['clave']);
        $repClave = mainModel::limpiar_cadena($_POST['repClave']);
        $clave1 = mainModel::encryption($clave);
        $datos = [
            "cod_usr" => $cod_usr,
            "des_usr" => $des_usr,
            "cod_perf" => $cod_perf,
            "cod_estat" => $cod_estat,
            "clave" => $clave1
        ];
        $des_usr = str_replace(' ', '', $des_usr);
        if(strlen($des_usr) < 4 || strlen($des_usr) > 12){
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "El nombre de usuario debe tener una longitud de 4 a 12 caracteres",
                "Texto" => "Utilice otro nombre de usuario",
                "Tipo" => "error"
            ];
        }else{
            $sql = usuarioControlador::validar_usuario_distinto_modelo($datos);
            if($sql->rowCount() >= 1){
                $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "El nombre de usuario no se encuentra disponible",
                    "Texto" => "Utilice otro nombre de usuario",
                    "Tipo" => "error"
                ];
            }else{
                $clave = str_replace(' ', '', $clave);
                $repClave = str_replace(' ', '', $repClave);
                if(strlen($clave) < 8 || strlen($repClave) < 8){
                    $alerta = [
                        "Alerta" => "simple",
                        "Titulo" => "La clave debe tener un valor de 8 dígitos o caracteres",
                        "Texto" => "Las claves no pueden contener espacios en blanco",
                        "Tipo" => "error"
                    ];
                }else{
                    if($clave != $repClave){
                        $alerta = [
                            "Alerta" => "simple",
                            "Titulo" => "Las claves que intenta ingresar no coinciden",
                            "Texto" => "Corrija las claves ingresadas",
                            "Tipo" => "error"
                        ];
                    }else{
                        $sql = usuarioModelo::editar_usuario_modelo($datos);
                        if($sql->rowCount() >= 1){
                            $alerta = [
                                "Alerta" => "simpleUsuario",
                                "Titulo" => "Usuario actualizado exitosamente",
                                "Texto" => "",
                                "Tipo" => "success"
                            ];
                        } else {
                            $alerta = [
                                "Alerta" => "simple",
                                "Titulo" => "Ocurrió un error inesperado",
                                "Texto" => "Recargue la página e intente de nuevo",
                                "Tipo" => "error"
                            ];
                        }
                    }

                }
            }
        } 
        return mainModel::sweet_alert($alerta);
    }
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //editar persona formulario cedula
    public function datos_usuario($datos)
    {
        $datos = mainModel::limpiar_cadena($datos);
        $datos = [
            "cod_usr" => $datos
        ];
        $row = usuarioModelo::consultar_datos_usuario($datos);
        foreach ($row as $row) {
            $clave = $row['clave'];
            $clave=mainModel::description($clave);
            $array =  [
                "cod_per" => $row['cod_per'],
                "ced" => $row['ced'],
                "clave" => $clave,
                "des_usr" => $row['des_usr'],
                "des_perf" => $row['des_perf'],
                "cod_perf" => $row['cod_perf'],
                "cod_estat" => $row['cod_estat'],
                "des_estat" => $row['des_estat'],
                "nom" => $row['nom'],
                "ape" => $row['ape']
            ];
        }
        return $array;
    }
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //perfiles formulario
    public function formulario_usuario_perfil()
    {
        
        $sql = usuarioModelo::formulario_usuario_perfil_modelo();
        foreach ($sql as $row) {
            echo '<option value="' . $row['cod_perf'] . '">' . $row['des_perf'] . '</option>';
        }
    }
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //perfil distinto
    public function formulario_editar_perfil_distinto($datos)
    {
        $cod_perf = mainModel::limpiar_cadena($datos);
        $datos = [
            "cod_perf" => $cod_perf
        ];
        $sql = usuarioModelo::formulario_editar_perfil_distinto_modelo($datos);
        foreach ($sql as $row) {
            echo '<option value="' . $row['cod_perf'] . '">' . $row['des_perf'] . '</option>';
        }
    }
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //estatus distinto
    public function formulario_editar_estatus_distinto($datos)
    {
        $cod_estat = mainModel::limpiar_cadena($datos);
        $datos = [
            "cod_estat" => $cod_estat
        ];
        $sql = usuarioModelo::formulario_editar_estatus_distinto_modelo($datos);
        foreach ($sql as $row) {
            echo '<option value="' . $row['cod_estat'] . '">' . $row['des_estat'] . '</option>';
        }
    }
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //estatus distinto
    /*public function validar_cedula_usuario()
    {
        $ced = mainModel::limpiar_cadena($_POST['ced']);
        $datos = [
            "ced" => $ced
        ];
        if ($ced == "" || $ced == "v-") { 
            $alerta = false;
        } else {
            $validarCedula = mainModel::validar_cedula_modelo($datos);
            if ($validarCedula->rowCount() >= 1) {
                $peticionAjax=true;
                require_once "../controllers/personaControlador.php";
                $persona = new personaControlador;
                $persona->consultar_persona_cedula_modelo($datos);
                $cod_per->consultar_persona_cedula_modelo($datos)['cod_per'];
                $usuario=usuarioModelo::validar_usuario_modelo($cod_per);
                foreach ($persona as $row) {
                    if ($row['cod_estat'] == 1) {
                        $alerta = '<div class="text-capitalize alert alert-success"><strong>' . $row['nom'] . ' ' . $row['ape'] . ' Puedes Continuar el registro.</strong></div>';
                    } else {
                        $alerta = '<div class="text-capitalize alert alert-danger"><strong>' . $row['nom'] . ' ' . $row['ape'] . ' Persona deshabilitada para participar.</strong></div>';
                    }
                }
            } else {
                $alerta = '<div class="alert alert-danger"><strong>Error!</strong> La cédula ingresada no se encuentra registrada en el sistema, diríjase a Registro de Persona.</div>';
            }
        }
        return $alerta;
    }*/
}
