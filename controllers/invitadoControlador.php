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
                    <td>
                    <form class="" action="' . SERVERURL . 'editarPersona" method="POST" enctype="multipart/form-data">
                        <input type="text" value="' . $row['cod_per'] . '" name="cod_per" hidden required>
                        <button type="submit" class="btn btn-info btn-md">
                            <i class="far fa-edit fa-2x"></i>
                        </button>
                    </form>    
                </td>    
            
                <td>
                    <form class="FormularioAjax" action="' . SERVERURL . 'ajax/eliminarPersonaAjax.php" method="POST" data-form="borrar" enctype="multipart/form-data">
                        <input type="text" value="' . $row['cod_per'] . '" name="cod_per" hidden required>
                        <button type="submit" class="btn btn-danger btn-md">
                            <i class="far fa-trash-alt fa-2x"></i>                            
                        </button>
                        <div class="RespuestaAjax"></div>
                    </form>
                </td>                                                        
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