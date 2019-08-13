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
                <td><button class="btn btn-success btn-md my-2 my-sm-0 ml-3" type="submit" ><a href="act_dep.php?cod_per='.$row['cod_per'].'">Editar</a></button></td>
                <td><button class="btn btn-success btn-md my-2 my-sm-0 ml-3" type="submit" ><a href="act_dep.php?cod_per='.$row['cod_per'].'">Editar</a></button></td>
            </tr>';
        }
        return $row;
    }
}
