<?php

if ($peticionAjax) {
    require_once "../models/personaModelo.php";
} else {
    require_once "./models/personaModelo.php";
}
class personaControlador extends personaModelo
{
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //tabla persona
    public function tabla_persona()
    {
        $n = 0;
        $sql = personaModelo::consultar_persona_tabla_modelo();
        foreach ($sql as $row) {
            $n++;
            echo '
            <tr>
                <td class="text-center">' . $n . '</td>
                <td class="text-center">' . $row['ced'] . '</td>
                <td class="text-center">' . $row['nom'] . '</td>
                <td class="text-center">' . $row['ape'] . '</td>
                <td class="text-center">' . $row['des_gen'] . '</td>
                <td class="text-center">' . $row['edad'] . '</td> 
                <td class="text-center">' . $row['des_estat'] . '</td>               
                <td class="text-center">
                    <a href="' . SERVERURL . 'editarPersona/' . $row['cod_per'] . '/">
                        <button type="submit" class="btn btn-default btn-sm">
                            <i class="far fa-edit fa-2x"></i>
                        </button>
                    </a>  
                </td>               
            </tr>';
        }
    }
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //agregar persona
    public function agregar_persona_controlador()
    {
        $ced = mainModel::limpiar_cadena($_POST['ced']);
        $nom = mainModel::limpiar_cadena($_POST['nom']);
        $ape = mainModel::limpiar_cadena($_POST['ape']);
        $fec_nac = mainModel::limpiar_cadena($_POST['fec_nac']);
        $cod_gen = mainModel::limpiar_cadena($_POST['cod_gen']);
        $ced = str_replace(' ', '', $ced);
        $nom = str_replace(' ', '', $nom);
        $ape = str_replace(' ', '', $ape);
        $ced = strtoupper ($ced); 
        $datosPersona = [
            "ced" => $ced,
            "nom" => $nom,
            "ape" => $ape,
            "fec_nac" => $fec_nac,
            "cod_gen" => $cod_gen
        ];
        if (strlen($ced) < 8) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Debe ingresar un número de cédula válido",
                "Texto" => "mínimo 6 dígitos, máximo 8 dígitos",
                "Tipo" => "error"
            ];
        } else {
            $validarCedula = mainModel::validar_cedula_modelo($datosPersona);
            if ($validarCedula->rowCount() >= 1) {
                $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "Ocurrió un error inesperado",
                    "Texto" => "La cédula que intenta ingresar ya se encuentra registrada en el sistema",
                    "Tipo" => "error"
                ];
            } else {
                if (strlen($nom) <= 1) {
                    $alerta = [
                        "Alerta" => "simple",
                        "Titulo" => "Ingrese un nombre de válido",
                        "Texto" => "mínimo 2 caracteres, máximo 20 caracteres",
                        "Tipo" => "error"
                    ];
                } else {
                    if (strlen($ape) <= 1) {
                        $alerta = [
                            "Alerta" => "simple",
                            "Titulo" => "Ingrese un apellido válido",
                            "Texto" => "mínimo 2 caracteres, máximo 20 caracteres",
                            "Tipo" => "error"
                        ];
                    } else {
                        $guardarPersona = personaModelo::agregar_persona_modelo($datosPersona);
                        if ($guardarPersona->rowCount() >= 1) {
                            $alerta = [
                                "Alerta" => "simplePersona",
                                "Titulo" => "Persona registrada exitosamente",
                                "Texto" => "",
                                "Tipo" => "success"
                            ];
                        } else {
                            $alerta = [
                                "Alerta" => "simple",
                                "Titulo" => "Ocurrió un error inesperado",
                                "Texto" => "Error al registrar persona",
                                "Tipo" => "error"
                            ];
                        }
                    }
                }
            }
        }
        return mainModel::sweet_alert($alerta);
    }
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //editar persona
    public function editar_persona_controlador()
    {
        $cod_per = mainModel::limpiar_cadena($_POST['cod_per']);
        $ced = mainModel::limpiar_cadena($_POST['ced']);
        $nom = mainModel::limpiar_cadena($_POST['nom']);
        $ape = mainModel::limpiar_cadena($_POST['ape']);
        $fec_nac = mainModel::limpiar_cadena($_POST['fec_nac']);
        $cod_gen = mainModel::limpiar_cadena($_POST['cod_gen']);
        $cod_estat = mainModel::limpiar_cadena($_POST['cod_estat']);
        $ced = str_replace(' ', '', $ced);
        $nom = str_replace(' ', '', $nom);
        $ape = str_replace(' ', '', $ape);
        $ced = strtoupper ($ced);
        $datosPersona = [
            "cod_per" => $cod_per,
            "ced" => $ced,
            "nom" => $nom,
            "ape" => $ape,
            "fec_nac" => $fec_nac,
            "cod_gen" => $cod_gen,
            "cod_estat" => $cod_estat
        ];
        if (strlen($ced) < 8) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Debe ingresar un número de cédula válido",
                "Texto" => "mínimo 6 dígitos, máximo 8 dígitos",
                "Tipo" => "error"
            ];
        } else {
            $validarPersona = personaModelo::validar_persona_distinta_modelo($datosPersona);
            if ($validarPersona->rowCount() >= 1) {
                $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "Ocurrió un error inesperado",
                    "Texto" => "Ya existe una persona con ese número de cédula",
                    "Tipo" => "error"
                ];
            } else {
                if (strlen($nom) <= 1) {
                    $alerta = [
                        "Alerta" => "simple",
                        "Titulo" => "ingrese un nombre de válido",
                        "Texto" => "mínimo 2 caracteres, máximo 20 caracteres",
                        "Tipo" => "error"
                    ];
                } else {
                    if (strlen($ape) <= 1) {
                        $alerta = [
                            "Alerta" => "simple",
                            "Titulo" => "Ingrese un apellido válido",
                            "Texto" => "mínimo 2 caracteres, máximo 20 caracteres",
                            "Tipo" => "error"
                        ];
                    } else {
                        $editarPersona = personaModelo::editar_persona_modelo($datosPersona);
                        if ($editarPersona->rowCount() >= 1) {
                            $alerta = [
                                "Alerta" => "simplePersona",
                                "Titulo" => "Persona actualizada exitosamente",
                                "Texto" => "",
                                "Tipo" => "success"
                            ];
                        } else {
                            $alerta = [
                                "Alerta" => "simple",
                                "Titulo" => "Ocurrió un error inesperado",
                                "Texto" => "Error al actualizar persona",
                                "Tipo" => "error"
                            ];
                        }
                    }
                }
            }
        }
        return mainModel::sweet_alert($alerta);
    }
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //editar persona formulario cedula
    public function datos_persona($datos)
    {
        $datos = mainModel::limpiar_cadena($datos);
        $datos = [
            "cod_per" => $datos
        ];
        $row = personaModelo::consultar_persona_modelo($datos);
        foreach ($row as $row) {
            $array =  [
                "cod_per" => $row['cod_per'],
                "ced" => $row['ced'],
                "nom" => $row['nom'],
                "ape" => $row['ape'],
                "fec_nac" => $row['fec_nac'],
                "cod_gen" => $row['cod_gen'],
                "des_gen" => $row['des_gen'],
                "cod_estat" => $row['cod_estat'],
                "des_estat" => $row['des_estat']
            ];
        }
        return $array;
    }
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //consultar datos ersona por cedula
    public function datos_cedula_persona($datos)
    {
        $ced = mainModel::limpiar_cadena($datos);
        $datos = [
            "ced" => $ced
        ];
        $sql = personaModelo::consultar_persona_cedula_modelo($datos);
        if ($sql == true){
            foreach ($sql as $row) {
                $array =  [
                    "cod_per" => $row['cod_per'],
                    "ced" => $row['ced'],
                    "nom" => $row['nom'],
                    "ape" => $row['ape'],
                    "fec_nac" => $row['fec_nac'],
                    "cod_gen" => $row['cod_gen'],
                    "des_gen" => $row['des_gen'],
                    "cod_estat" => $row['cod_estat'],
                    "des_estat" => $row['des_estat']
                ];
            }
        }else {
            $array = false;
        }
        return $array;
    }
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //consultar datos ersona por cedula
    public function consultar_existe_persona($datos)
    {
        $ced = mainModel::limpiar_cadena($datos);
        $datos = [
            "ced" => $ced
        ];
        $sql = personaModelo::consultar_persona_existe_modelo($datos);
        return $sql;
    }
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //consultar genero distinto
    public function formulario_persona_genero_distinto($datos)
    {
        $datos = mainModel::limpiar_cadena($datos);
        $datos = [
            "cod_per" => $datos
        ];
        $row = personaModelo::consultar_persona_modelo($datos);
        foreach ($row as $row) {
            $cod_gen = $row['cod_gen'];
            $datos = [
                "cod_gen" => $cod_gen
            ];
            $row = personaModelo::consultar_genero_distinto_modelo($datos);
            foreach ($row as $row) {
                $option = '<option value="' . $row['cod_gen'] . '">' . $row['des_gen'] . '</option>';
            }
        }
        return $option;
    }
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //consultar estatus distinto
    public function formulario_persona_estatus_distinto($datos)
    {
        $datos = mainModel::limpiar_cadena($datos);
        $datos = [
            "cod_per" => $datos
        ];
        $row = personaModelo::consultar_persona_modelo($datos);
        foreach ($row as $row) {
            $cod_estat = $row['cod_estat'];
            $datos = [
                "cod_estat" => $cod_estat
            ];
            $row = mainModel::consultar_estatus_distinto($datos);
            foreach ($row as $row) {
                $option = '<option value="' . $row['cod_estat'] . '">' . $row['des_estat'] . '</option>';
            }
        }
        return $option;
    }
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //validar cedula
    public function validar_cedula_controlador()
    {
        $ced = mainModel::limpiar_cadena($_POST['ced']);
        $datos = [
            "ced" => $ced
        ];
        if ($ced == "") { 
            $alerta = false;
        } else {
            $validarCedula = mainModel::validar_cedula_modelo($datos);
            if ($validarCedula->rowCount() >= 1) {
                $alerta = '<div class="alert alert-danger"><strong>Cédula registrada anteriormente.</div>';
            } else { 
                $alerta = false;
            }
        }
        return $alerta;
    }
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //validar cedula distinta
    public function validar_cedula_distinta_controlador()
    {
        $ced = mainModel::limpiar_cadena($_POST['ced']);
        $cod_per = mainModel::limpiar_cadena($_POST['cod_per']);
        $datos = [
            "ced" => $ced,
            "cod_per" => $cod_per
        ];
        if ($ced == "") { 
            $alerta = false;
        } else {
            $validarCedula = personaModelo::validar_persona_distinta_modelo($datos);
            if ($validarCedula->rowCount() >= 1) {
                $alerta = '<div class="alert alert-danger">La cédula pertenece a otra persona.</div>';
            } else { 
                $alerta = false;
            }
        }
        return $alerta;
    }
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// //validar participacion
    //validar participacion por
    public function validar_cedula_participacion_controlador()
    {
        $ced = mainModel::limpiar_cadena($_POST['ced']);
        $datosPersona = [
            "ced" => $ced
        ];
        if ($ced == "") {
            $alerta = false;
         } else {
            $validarCedula = mainModel::validar_cedula_modelo($datosPersona);
            if ($validarCedula->rowCount() >= 1) {
                $sql = personaModelo::consultar_persona_cedula_modelo($datosPersona);
                foreach ($sql as $row) {
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
    }
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //validar fecha de nacimiento
    public function validar_fecha_nacimiento_controlador()
    {
        $fec_nac = mainModel::limpiar_cadena($_POST['fec_nac']);
        $año = date('Y') - 15;
        $fec = date('m-d');
        $fecha_maxima = $año . '-' . $fec;
        $fecha_minima = "1919-01-01";
        $fecha_alerta = $fec=date('d-m').'-'.$año;
        if ($fec_nac > $fecha_maxima) {
            $alerta = '<div class="alert alert-danger"><strong>Error!</strong> La fecha máxima permitida es ' . $fecha_alerta . '</div>';
        } else if($fec_nac < $fecha_minima){
            $alerta = '<div class="alert alert-danger"><strong>Error!</strong> La fecha mínima permitida es 01-01-1919 </div>';
        }else { 
            $alerta =false;
        }
        return $alerta;
    }
}
