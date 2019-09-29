<?php

if ($peticionAjax) {
    require_once "./models/participacionModelo.php";
} else {
    require_once "./models/participacionModelo.php";
}

class participacionControlador extends participacionModelo
{
    public function agregar_participacion_controlador()
    {
        $nac = mainModel::limpiar_cadena($_POST['cod_per']);
        $ced = mainModel::limpiar_cadena($_POST['cod_even']);
        $nom = mainModel::limpiar_cadena($_POST['cod_perf']);
        $ape = mainModel::limpiar_cadena($_POST['ape']);
       

        $validarCedula = participacionModelo::validar_cedula($ced);
        if ($validarCedula->rowCount() >= 1) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrio un error inesperado",
                "Texto" => "La cédula que intenta ingresar ya se encuentra registrada en el sistema",
                "Tipo" => "error"
            ];
        } else {
            $datosParticipacion = [
                "nac" => $cod_per,
                "ced" => $cod_even,
                "nom" => $cod_perf,
                
            ];
            $guardarParticipacion = participacionModelo::agregar_participacion($datosParticipacion);

            if ($guardarParticipacion->rowCount() >= 1) {
                $alerta = [
                    "Alerta" => "simpleParticipacion",
                    "Titulo" => "",
                    "Texto" => "Participacion registrada exitosamente",
                    "Tipo" => "success"
                ];
            } else {
                $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "Ocurrió un error inesperado",
                    "Texto" => "Error al registrar participacion",
                    "Tipo" => "error"
                ];
            }
        }
        return mainModel::sweet_alert($alerta);
    }
    public function tabla_participacion(){
        
        $row=participacionModelo::consultar_participacion();
        foreach ($row as $row) {
            if ($row['nac'] == 1) {
                $row['nac'] = 'Venezolano';
            } else {
                $row['nac'] = 'Extranjero';
            }
            echo '
            <tr>
                <td>'.$row['ced'].'</td>
                <td>'.$row['nom'].'</td>
                <td>'.$row['ape'].'</td>
                <td>'.$row['des_perf'].'</td>
                <td>'.$row['edad'].'</td>
                <td>'.$row['des_gen'].'</td>
                <td>'.$row['des_even'].'</td>
                <td><button class="btn btn-success btn-md my-2 my-sm-0 ml-3" type="submit" ><a href="../regParticipacion.php?nom='.$row['nom'].'">Ver</a></button></td>
                <td><button class="btn btn-success btn-md my-2 my-sm-0 ml-3" type="submit" ><a href="act_dep.php?cod_per='.$row['cod_per'].'">Editar</a></button></td>
            </tr>';
        }
        return $row;
    }
}


