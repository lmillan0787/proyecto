<?php

if ($peticionAjax) {
    require_once "../models/personaModelo.php";
} else {
    require_once "./models/personaModelo.php";
}

class personaControlador extends personaModelo
{
    public function agregar_persona_controlador()
    {
        $nac = mainModel::limpiar_cadena($_POST['nac']);
        $ced = mainModel::limpiar_cadena($_POST['ced']);
        $nom = mainModel::limpiar_cadena($_POST['nom']);
        $ape = mainModel::limpiar_cadena($_POST['ape']);
        $fec_nac = mainModel::limpiar_cadena($_POST['fec_nac']);
        $cod_gen = mainModel::limpiar_cadena($_POST['cod_gen']);

        $validarCedula = personaModelo::validar_cedula($ced);
        if ($validarCedula->rowCount() >= 1) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrio un error inesperado",
                "Texto" => "La cédula que intenta ingresar ya se encuentra registrada en el sistema",
                "Tipo" => "error"
            ];
        } else {
            $datosPersona = [
                "nac" => $nac,
                "ced" => $ced,
                "nom" => $nom,
                "ape" => $ape,
                "fec_nac" => $fec_nac,
                "cod_gen" => $cod_gen
            ];
            $guardarPersona = personaModelo::agregar_persona($datosPersona);

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
    public function tabla_persona(){
        
        $row=personaModelo::consultar_persona();
        foreach ($row as $row) {
            if ($row['nac'] == 1) {
                $row['nac'] = 'Venezolano';
            } else {
                $row['nac'] = 'Extranjero';
            }
            echo '
            <tr>
                <td>'.$row['cod_per'].'</td>
                <td>'.$row['nac'].'</td>
                <td>'.$row['ced'].'</td>
                <td>'.$row['nom'].'</td>
                <td>'.$row['ape'].'</td>
                <td>'.$row['des_gen'].'</td>
                <td>'.$row['edad'].'</td>
                <td><button id="modalActivate" type="button" class="btn btn-warning btn-md" data-toggle="modal"><i class="fas fa-eye fa-2x"></i></button></td>
                <td><a href="' . SERVERURL . 'editarPersona/?cod_per='.$row['cod_per'].'" class="btn btn-default btn-md"><i class="far fa-edit fa-2x"></i></a></td>
            
            <td>
                <form class="FormularioAjax" action="' . SERVERURL . 'ajax/eliminarPersonaAjax.php" method="POST" data-form="borrar" enctype="multipart/form-data">
                    <input type="text" value="' . $row['cod_per'] . '" name="cod_even" hidden required>
                    <button type="submit" class="btn btn-danger btn-md">
                        <i class="far fa-trash-alt fa-2x"></i>
                    </button>
                </form>
            </td>
            </tr>';
        }
        return $row;
    }
    public function eliminar_persona_controlador(){
        
    }   
}
