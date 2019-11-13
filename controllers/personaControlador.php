<?php

if ($peticionAjax) {
    require_once "../models/personaModelo.php";
} else {
    require_once "./models/personaModelo.php";
}

class personaControlador extends personaModelo
{
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //agregas persona
    public function agregar_persona_controlador()
    {
        $ced = mainModel::limpiar_cadena($_POST['ced']);
        $nom = mainModel::limpiar_cadena($_POST['nom']);
        $ape = mainModel::limpiar_cadena($_POST['ape']);
        $fec_nac = mainModel::limpiar_cadena($_POST['fec_nac']);
        $cod_gen = mainModel::limpiar_cadena($_POST['cod_gen']);

        $validarCedula = mainModel::validar_cedula_modelo($ced);

        if ($validarCedula->rowCount() >= 1) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrio un error inesperado",
                "Texto" => "La cédula que intenta ingresar ya se encuentra registrada en el sistema",
                "Tipo" => "error"
            ];
        } else {
            $datosPersona = [
                "ced" => $ced,
                "nom" => $nom,
                "ape" => $ape,
                "fec_nac" => $fec_nac,
                "cod_gen" => $cod_gen
            ];
            $guardarPersona = personaModelo::agregar_persona_modelo($datosPersona);

            if ($guardarPersona->rowCount() >= 1) {
                $alerta = [
                    "Alerta" => "simplePersona",
                    "Titulo" => "",
                    "Texto" => "Persona registrada exitosamente",
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
        return mainModel::sweet_alert($alerta);
    }
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //tabla persona
    public function tabla_persona()
    {
        $n = 0;
        $row = mainModel::consultar_persona_modelo();
        foreach ($row as $row) {
            $n++;
            echo '
            <tr>    
                <td>' . $n . '</td>
                <td>' . $row['ced'] . '</td>
                <td>' . $row['nom'] . '</td>
                <td>' . $row['ape'] . '</td>
                <td>' . $row['des_gen'] . '</td>
                <td>' . $row['edad'] . '</td> 
                <td>' . $row['des_estat'] . '</td>               
                <td>
                    <form class="" action="' . SERVERURL . 'editarPersona" method="POST" enctype="multipart/form-data">
                        <input type="text" value="' . $row['cod_per'] . '" name="cod_per" hidden required>
                        <button type="submit" class="btn btn-info btn-sm">
                            <i class="far fa-edit fa-2x"></i>
                        </button>
                    </form>    
                </td>               
            </tr>';
        }
        return $row;
    }
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //
    public function editar_persona_controlador()
    {
        $cod_per = mainModel::limpiar_cadena($_POST['cod_per']);
        $ced = mainModel::limpiar_cadena($_POST['ced']);
        $nom = mainModel::limpiar_cadena($_POST['nom']);
        $ape = mainModel::limpiar_cadena($_POST['ape']);
        $fec_nac = mainModel::limpiar_cadena($_POST['fec_nac']);
        $cod_gen = mainModel::limpiar_cadena($_POST['cod_gen']);
        $cod_estat = mainModel::limpiar_cadena($_POST['cod_estat']);

        //echo $cod_per.' '.$ced.' '.$nom.' '.$ape.' '.$fec_nac.' '.$cod_gen.' '.$cod_estat;

        $datosPersona = [
            "cod_per" => $cod_per,
            "ced" => $ced,
            "nom" => $nom,
            "ape" => $ape,
            "fec_nac" => $fec_nac,
            "cod_gen" => $cod_gen,
            "cod_estat" => $cod_estat
        ];

        $validarPersona = personaModelo::validar_persona_distinta_modelo($datosPersona);
        if ($validarPersona->rowCount() >= 1) {
            echo "<script>
            Swal.fire(
                'Error al actualizar',
                'El numero de Cédula pertenece a otra persona que ya se encuentra registrada en el sistema',
                'error'
            );            
            </script>";
        } else {
            $editarPersona = personaModelo::editar_persona_modelo($datosPersona);

            if ($editarPersona->rowCount() >= 1) {
                echo "<script>
            Swal.fire(
                'Actualización exitosa',
                'Persona actualizada exitosamente!',
                'success'
            ).then(function(){
                window.location='" . SERVERURL . "personas/';
            });            
            </script>";
            } else {
                echo "<script>
            Swal.fire(
                'Error',
                'Error al actualizar persona',
                'error'
            );            
            </script>";
            }
        }
    }
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function eliminar_persona_controlador()
    {
        $cod_per = mainModel::limpiar_cadena($_POST['cod_per']);

        $datosPersona = [
            "cod_per" => $cod_per
        ];
        $eliminarPersona = personaModelo::eliminar_persona_modelo($datosPersona);

        if ($eliminarPersona->rowCount() >= 1) {
            $alerta = [
                "Alerta" => "simplePersona",
                "Titulo" => "",
                "Texto" => "Persona eliminada del sistema exitosamente",
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
        return mainModel::sweet_alert($alerta);
    }
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //validar cedula
    public function validar_cedula_controlador()
    {
        $ced = mainModel::limpiar_cadena($_POST['ced']);
        if ($ced == "") { } else {
            $validarCedula = mainModel::validar_cedula_modelo($ced);

            if ($validarCedula->rowCount() >= 1) {
                echo '<div class="alert alert-danger"><strong>Error!</strong> Cedula registrada anteriormente.</div>';
            } else { }
        }
    }
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //validar cedula
    public function validar_fecha_nacimiento_controlador()
    {
        $fec_nac = mainModel::limpiar_cadena($_POST['fec_nac']);
        $año=date('Y')-15;
        $fec=date('m-d');
        $fecha_minima = $año.'-'.$fec;
        if ($fec_nac > $fecha_minima) {
            echo '<div class="alert alert-danger"><strong>Error!</strong> La fecha mínima permitida es ' . $fecha_minima . '</div>';
        } else { }
    }
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //validar participacion
    public function validar_cedula_participacion_controlador()
    {
        $ced = mainModel::limpiar_cadena($_POST['ced']);
        $datosPersona = [
            "ced" => $ced
        ];

        if($ced == ""){
            
        }else{
            $validarCedula = mainModel::validar_cedula_modelo($ced);

            if ($validarCedula->rowCount() >= 1) {
                $consultaPersona = personaModelo::consultar_persona_modelo2($datosPersona);
                foreach ($consultaPersona as $row) {
                    if($row['cod_estat'] == 1){
                        echo '<div class="alert alert-success"><strong>' . $row['nom'] . ' ' . $row['ape'] . ' Puedes Continuar el registro</strong></div>';
                    }else{
                        echo '<div class="alert alert-danger"><strong>' . $row['nom'] . ' ' . $row['ape'] . ' Persona deshabilitada para participar</strong></div>';
                    }
                }
            } else {
                echo '<div class="alert alert-danger"><strong>Error!</strong> La cédula ingresada no está regitrada en el sistema dirijase al registro de persona.</div>';
            }
        }
        
    }
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //editar persona formulario
    public function formulario_editar_nombre_persona_controlador()
    {
        $cod_per = mainModel::limpiar_cadena($_POST['cod_per']);
        $datos = [
            "cod_per" => $cod_per
        ];
        $row = personaModelo::consultar_persona_modelo1($datos);
        foreach ($row as $row) {
            echo '
            <input onkeyup="javascript:this.value=this.value.toUpperCase();" type="text" class="form-control" placeholder="Nombre" aria-describedby="addon-wrapping" minlength="2" maxlength="20" required pattern="[A-Za-zñÑáéíóúÁÉÍÓÚöÖüÜ\s]+" name="nom" value="'.$row['nom'].'">
            ';
        }
        return $row;
    }
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //editar persona formulario
    public function formulario_editar_apellido_persona_controlador()
    {
        $cod_per = mainModel::limpiar_cadena($_POST['cod_per']);
        $datos = [
            "cod_per" => $cod_per
        ];
        $row = personaModelo::consultar_persona_modelo1($datos);
        foreach ($row as $row) {
            echo '
            <input onkeyup="javascript:this.value=this.value.toUpperCase();" type="text" class="form-control" placeholder="Apellido" aria-describedby="addon-wrapping" minlength="2" maxlength="20" required pattern="[A-Za-zñÑáéíóúÁÉÍÓÚöÖüÜ\s]+" name="ape" value="'.$row['ape'].'">
            ';
        }
        return $row;
    }
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //editar persona formulario
    public function formulario_editar_cedula_persona_controlador()
    {
        $cod_per = mainModel::limpiar_cadena($_POST['cod_per']);
        $datos = [
            "cod_per" => $cod_per
        ];
        $row = personaModelo::consultar_persona_modelo1($datos);
        foreach ($row as $row) {
            echo '
            <input type="text" id="ced" class="form-control" placeholder="Cédula" aria-describedby="addon-wrapping" minlength="7" maxlength="9" required pattern="[vVeE0-9]+" name="ced" value="'.$row['ced'].'" onkeyup="javascript:this.value=this.value.toUpperCase();">                
            ';
        }
        return $row;
    }
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //editar persona formulario
    public function formulario_editar_fecha_persona_controlador()
    {
        $cod_per = mainModel::limpiar_cadena($_POST['cod_per']);
        $datos = [
            "cod_per" => $cod_per
        ];
        $año=date('Y')-15;
        $fec=date('m-d');
        $fecha_minima = $año.'-'.$fec;
        $row = personaModelo::consultar_persona_modelo1($datos);
        foreach ($row as $row) {
            echo '
            <input type="date" class="form-control" placeholder="Fecha de nacimiento" aria-label="Username" aria-describedby="addon-wrapping" min="1919-01-01" max="'.$fecha_minima.'" step="1" name="fec_nac" value="'.$row['fec_nac'].'">
            ';
        }
        return $row;
    }
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //editar persona formulario
    public function formulario_editar_genero_persona_controlador()
    {
        $cod_per = mainModel::limpiar_cadena($_POST['cod_per']);
        $datos = [
            "cod_per" => $cod_per
        ];
        $row = personaModelo::consultar_persona_modelo1($datos);
        foreach ($row as $row) {
            echo '
            <option value="'.$row['cod_gen'].'">'.$row['des_gen'].'</option>               
            ';
        }
        return $row;
    }
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //editar persona formulario
    public function formulario_editar_estatus_persona_controlador()
    {
        $cod_per = mainModel::limpiar_cadena($_POST['cod_per']);
        $datos = [
            "cod_per" => $cod_per
        ];
        $row = personaModelo::consultar_persona_modelo1($datos);
        foreach ($row as $row) {
            echo '
            <option value="'.$row['cod_estat'].'">'.$row['des_estat'].'</option>               
            ';
        }
        return $row;
    }
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //editar persona formulario
    public function formulario_editar_nacionalidad_persona_controlador()
    {
        $cod_per = mainModel::limpiar_cadena($_POST['cod_per']);
        $datos = [
            "cod_per" => $cod_per
        ];
        $row = personaModelo::consultar_persona_modelo1($datos);
        foreach ($row as $row) {
            echo '
            <option value="'.$row['cod_estat'].'">'.$row['des_estat'].'</option>               
            ';
        }
        return $row;
    }
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //consultar genero distinto
    public function formulario_genero_distinto()
    {
        $cod_per = mainModel::limpiar_cadena($_POST['cod_per']);
        $datos = [
            "cod_per" => $cod_per
        ];
        $row = personaModelo::consultar_persona_modelo1($datos);
        foreach ($row as $row) {
            $cod_gen = $row['cod_gen'];
            $datos= [
                "cod_gen" => $cod_gen
            ];
            $row = mainModel::consultar_genero_distinto_modelo($datos);
            foreach ($row as $row) {
                echo '<option value="' . $row['cod_gen'] . '">' . $row['des_gen'] . '</option>';
            }
        }
        return $row;
    }
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //consultar genero distinto
    public function formulario_estatus_distinto()
    {
        $cod_per = mainModel::limpiar_cadena($_POST['cod_per']);
        $datos = [
            "cod_per" => $cod_per
        ];
        $row = personaModelo::consultar_persona_modelo1($datos);
        foreach ($row as $row) {
            $cod_estat = $row['cod_estat'];
            $datos= [
                "cod_estat" => $cod_estat
            ];
            $row = mainModel::consultar_estatus_distinto($datos);
            foreach ($row as $row) {
                echo '<option value="' . $row['cod_estat'] . '">' . $row['des_estat'] . '</option>';
            }
        }
        return $row;
    }
}
