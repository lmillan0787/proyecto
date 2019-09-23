<?php

if ($peticionAjax) {
    require_once "../models/invitadoModelo.php";
} else {
    require_once "./models/invitadoModelo.php";
}

class invitadoControlador extends invitadoModelo{
    
    public function agregar_deportista_controlador()
    {
        $nac = mainModel::limpiar_cadena($_POST['nac']);
        $ced = mainModel::limpiar_cadena($_POST['ced']);
        $nom = mainModel::limpiar_cadena($_POST['nom']);
        $ape = mainModel::limpiar_cadena($_POST['ape']);
        $fec_nac = mainModel::limpiar_cadena($_POST['fec_nac']);
        $cod_gen = mainModel::limpiar_cadena($_POST['cod_gen']);

        $validarCedula = deportistaModelo::validar_cedula($ced);
        if ($validarCedula->rowCount() >= 1) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrio un error inesperado",
                "Texto" => "La cédula que intenta ingresar ya se encuentra registrada en el sistema",
                "Tipo" => "error"
            ];
        } else {
            $datosDeportista = [
                "nac" => $nac,
                "ced" => $ced,
                "nom" => $nom,
                "ape" => $ape,
                "fec_nac" => $fec_nac,
                "cod_gen" => $cod_gen
            ];
            $guardarDeportista = invitadoModelo::agregar_invitado($datosDeportista);

            if ($guardarDeportista->rowCount() >= 1) {
                $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "",
                    "Texto" => "Deportista registrada exitosamente",
                    "Tipo" => "success"
                ];
            } else {
                $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "Ocurrió un error inesperado",
                    "Texto" => "Error al registrar deportista",
                    "Tipo" => "error"
                ];
            }
        }
        return mainModel::sweet_alert($alerta);
    }
    public function tabla_invitado()
    {
        
        $row=invitadoModelo::consultar_invitado();
        foreach ($row as $row) {
            if ($row['nac'] == 1) {
                $row['nac'] = 'Venezolano';
            } else {
                $row['nac'] = 'Extranjero';
            }
            echo '
            <tr>
                    <td>'.$row['cod_per'].'</td>
                    <td>'.$row['nom'].'</td>
                    <td>'.$row['ape'].'</td>
                    <td>'.$row['ced'].'</td>
                    <td>'.$row['des_gen'].'</td>
                    <td>'.$row['edad'].'</td>
                    <td><button class="btn btn-success btn-md my-2 my-sm-0 ml-3" type="submit"><a href="act_dep.php?cod_per='.$row['cod_per'].'">Editar</a></button></td>                                                        
                </tr>';
        }
        return $row;
    }

      public function consultarRegion(){
        $consultaRegion=mainModel::conectar()->prepare("SELECT * from tab_reg ");
            $consultaRegion->execute();
            $row = $consultaRegion->fetchAll(PDO::FETCH_ASSOC);
            echo '<select name="selreg" id="selreg" class="form-control">';
             foreach ($row as $row) {
            echo '<option value="' . $row['cod_reg'] . '">' . $row['des_reg'] . '</option>';
        }
        
            echo '</select>';
          }

    


}