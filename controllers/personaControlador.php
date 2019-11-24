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
                    <a href="' . SERVERURL . 'editarPersona/'.$row['cod_per'].'">
                        <button type="submit" class="btn btn-default btn-sm">
                            <i class="far fa-edit fa-2x"></i>
                        </button>
                    </a>  
                </td>               
            </tr>';
        }
        return $row;
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
        $datosPersona = [
            "ced" => $ced,
            "nom" => $nom,
            "ape" => $ape,
            "fec_nac" => $fec_nac,
            "cod_gen" => $cod_gen
        ];
        $validarCedula = mainModel::validar_cedula_modelo($datosPersona);
        if ($validarCedula->rowCount() >= 1) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrió un error inesperado",
                "Texto" => "La cédula que intenta ingresar ya se encuentra registrada en el sistema",
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
                window.location='" . SERVERURL . "listaPersonas/';
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
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //editar persona formulario cedula
    public function formulario_persona_editar_cedula_controlador($datos)
    {   
        $datos = mainModel::limpiar_cadena($datos);
        $datos = [
            "cod_per" => $datos
        ];
        $row = personaModelo::consultar_persona_modelo($datos);
        foreach ($row as $row) {
            echo '
            <input type="text" id="ced" class="ced text-capitalize form-control" placeholder="Cédula" aria-describedby="addon-wrapping" minlength="8" maxlength="10"  name="ced" value="'.$row['ced'].'">                
            ';
        }
        return $row;
    }
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //editar persona formulario nombre
    public function formulario_persona_editar_nombre_controlador($datos)
    {
        $datos = mainModel::limpiar_cadena($datos);
        $datos = [
            "cod_per" => $datos
        ];
        $row = personaModelo::consultar_persona_modelo($datos);
        foreach ($row as $row) {
            echo '
            <input type="text" class="nom text-capitalize form-control" placeholder="Nombre" aria-describedby="addon-wrapping" minlength="2" maxlength="20" required pattern="[A-Za-zñÑáéíóúÁÉÍÓÚöÖüÜ\s]+" name="nom" value="'.$row['nom'].'">
            ';
        }
        return $row;
    }
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //editar persona formulario apellido
    public function formulario_persona_editar_apellido_controlador($datos)
    {
        $datos = mainModel::limpiar_cadena($datos);
        $datos = [
            "cod_per" => $datos
        ];
        $row = personaModelo::consultar_persona_modelo($datos);
        foreach ($row as $row) {
            echo '
            <input type="text" class="ape text-capitalize form-control" placeholder="Apellido" aria-describedby="addon-wrapping" minlength="2" maxlength="20" required pattern="[A-Za-zñÑáéíóúÁÉÍÓÚöÖüÜ\s]+" name="ape" value="'.$row['ape'].'">
            ';
        }
        return $row;
    }
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //editar persona formulario fecha
    public function formulario_person_editar_fecha_controlador($datos)
    {
        $datos = mainModel::limpiar_cadena($datos);
        $datos = [
            "cod_per" => $datos
        ];
        $año=date('Y')-15;
        $fec=date('m-d');
        $fecha_minima = $año.'-'.$fec;
        $row = personaModelo::consultar_persona_modelo($datos);
        foreach ($row as $row) {
            echo '
            <input type="date" class="form-control" placeholder="Fecha de nacimiento" aria-label="Username" aria-describedby="addon-wrapping" min="1919-01-01" max="'.$fecha_minima.'" step="1" name="fec_nac" value="'.$row['fec_nac'].'">
            ';
        }
        return $row;
    }
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //editar persona formulario genero
    public function formulario_editar_persona_genero_controlador($datos)
    {
        $datos = mainModel::limpiar_cadena($datos);
        $datos = [
            "cod_per" => $datos
        ];
        $row = personaModelo::consultar_persona_modelo($datos);
        foreach ($row as $row) {
            echo '
            <option value="'.$row['cod_gen'].'">'.$row['des_gen'].'</option>               
            ';
        }
        return $row;
    }
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //editar persona formulario estatus
    public function formulario_editar_persona_estatus_controlador($datos)
    {
        $datos = mainModel::limpiar_cadena($datos);
        $datos = [
            "cod_per" => $datos
        ];
        $row = personaModelo::consultar_persona_modelo($datos);
        foreach ($row as $row) {
            echo '
            <option value="'.$row['cod_estat'].'">'.$row['des_estat'].'</option>               
            ';
        }
        return $row;
    }
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //consultar genero distinto
    public function formulario_genero_distinto($datos)
    {
        $datos = mainModel::limpiar_cadena($datos);
        $datos = [
            "cod_per" => $datos
        ];
        $row = personaModelo::consultar_persona_modelo($datos);
        foreach ($row as $row) {
            $cod_gen = $row['cod_gen'];
            $datos= [
                "cod_gen" => $cod_gen
            ];
            $row = personaModelo::consultar_genero_distinto_modelo($datos);
            foreach ($row as $row) {
                echo '<option value="' . $row['cod_gen'] . '">' . $row['des_gen'] . '</option>';
            }
        }
        return $row;
    }
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //consultar estatus distinto
    public function formulario_estatus_distinto($datos)
    {
        $datos = mainModel::limpiar_cadena($datos);
        $datos = [
            "cod_per" => $datos
        ];
        $row = personaModelo::consultar_persona_modelo($datos);
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
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //validar cedula
    public function validar_cedula_controlador()
    {
        
        $ced = mainModel::limpiar_cadena($_POST['ced']);
        $datos = [
            "ced" => $ced
        ];
        if ($ced == "") { 

        } else {
            $validarCedula = mainModel::validar_cedula_modelo($datos);
            if ($validarCedula->rowCount() >= 1) {
                echo '<div class="alert alert-danger"><strong>Error!</strong> Cédula registrada anteriormente.</div>';
            } else {

             }
        }
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

        } else {
            $validarCedula = personaModelo::validar_persona_distinta_modelo($datos);
            if ($validarCedula->rowCount() >= 1) {
                echo '<div class="alert alert-danger"><strong>Error!</strong> La cédula pertenece a otra persona.</div>';
            } else { }
        }
    }
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// //validar participacion
    //validar participacion por
    public function validar_cedula_participacion_controlador()
    {
        $ced = mainModel::limpiar_cadena($_POST['ced']);
        $datosPersona = [
            "ced" => $ced
        ];
        if($ced == ""){

        }else{
            $validarCedula = mainModel::validar_cedula_modelo($datosPersona);
            if ($validarCedula->rowCount() >= 1) {
                $sql = personaModelo::consultar_persona_cedula_modelo($datosPersona);
                foreach ($sql as $row) {
                    if($row['cod_estat'] == 1){
                        echo '<div class="text-capitalize alert alert-success"><strong>' . $row['nom'] . ' ' . $row['ape'] . ' Puedes Continuar el registro.</strong></div>';
                    }else{
                        echo '<div class="text-capitalize alert alert-danger"><strong>' . $row['nom'] . ' ' . $row['ape'] . ' Persona deshabilitada para participar.</strong></div>';
                    }
                }
            } else {
                echo '<div class="alert alert-danger"><strong>Error!</strong> La cédula ingresada no está regitrada en el sistema, diríjase al registro de persona.</div>';
            }
        }
    }
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //validar fecha de nacimiento
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
}
