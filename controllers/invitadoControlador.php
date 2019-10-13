<?php

if ($peticionAjax) {
    require_once "../models/invitadoModelo.php";
} else {
    require_once "./models/invitadoModelo.php";
}

class invitadoControlador extends invitadoModelo{
    
    public function agregar_invitado_controlador()
    {
        $cod_nac = mainModel::limpiar_cadena($_POST['cod_nac']);
        $ced = mainModel::limpiar_cadena($_POST['ced']);       
        $cod_even = mainModel::limpiar_cadena($_POST['cod_even']);
        $cod_perf = mainModel::limpiar_cadena($_POST['cod_perf']);

        $validarCedula = mainModel::validar_cedula_modelo($ced);
        if ($validarCedula->rowCount() <= 0) {
            $alerta = [
                "Alerta" => "confirmarCedula",                
            ];
        } else {
            $datosInvitado = [
                "cod_nac" => $cod_nac,
                "ced" => $ced        
            ];
            $guardarInvitado = invitadoModelo::agregar_invitado($datosInvitado);

            if ($guardarInvitado->rowCount() >= 1) {
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
            if ($row['cod_nac'] == 1) {
                $row['cod_nac'] = 'Venezolano';
            } else {
                $row['cod_nac'] = 'Extranjero';
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
            echo '<select name="cod_reg" id="cod_reg" class="form-control">';
             foreach ($row as $row) {
            echo '<option value="' . $row['cod_reg'] . '">' . $row['des_reg'] . '</option>';
        }
        
            echo '</select>';
          }

          public function consultarPerfil(){
            $consultarPerfil=mainModel::ejecutar_consulta_simple("SELECT cod_perf,des_perf FROM tab_perf where cod_rol=5 ");                
                $row = $consultarPerfil->fetchAll(PDO::FETCH_ASSOC);
                echo '<select name="cod_perf" id="cod_perf" class="form-control" required>
                            <option selected disabled value="">Perfil</option>
                ';
                 foreach ($row as $row) {
                echo '<option value="' . $row['cod_perf'] . '">' . $row['des_perf'] . '</option>';
            }
            
                echo '</select>';
                }

                public function consultarEvento(){
                    $consultarEvento=mainModel::ejecutar_consulta_simple("SELECT cod_even,des_even from dat_even ");                        
                        $row = $consultarEvento->fetchAll(PDO::FETCH_ASSOC);
                        echo '<select name="cod_even" id="cod_even" class="form-control" required>
                                <option selected disabled value="">Eventos</option>
                        ';
                            
                         foreach ($row as $row) {
                        echo '<option value="' . $row['cod_even'] . '">' . $row['des_even'] . '</option>';
                    }
                    
                        echo '</select>';
                      
            
            }


}