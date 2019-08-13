<?php

if ($peticionAjax) {
    require_once "../models/medicoModelo.php";
} else {
    require_once "./models/medicoModelo.php";
}

class medicoControlador extends medicoModelo{
    
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
            $guardarDeportista = medicoModelo::agregar_medico($datosDeportista);

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
    public function tabla_medico()
    {
        
        $row=medicoModelo::consultar_medico();
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
                    <td>'.$row['des_reg'].'</td>
                    <td>'.$row['des_esp'].'</td>
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

     public function consultarPueblo(){
        $consultarPueblo=mainModel::conectar()->prepare("SELECT * from tab_pue ");
            $consultarPueblo->execute();
            $row = $consultarPueblo->fetchAll(PDO::FETCH_ASSOC);
            echo '<select name="selpue" id="selpue" class="form-control">';
             foreach ($row as $row) {
            echo '<option value="' . $row['cod_pue'] . '">' . $row['des_pue'] . '</option>';
            
        }
        echo '</select>';
            
          }

 public function consultarPerfil(){
        $consultarPerfil=mainModel::conectar()->prepare("SELECT cod_perf,des_perf from tab_perf ");
            $consultarPerfil->execute();
            $row = $consultarPerfil->fetchAll(PDO::FETCH_ASSOC);
            echo '<select name="selperf" id="selperf" class="form-control">';
             foreach ($row as $row) {
            echo '<option value="' . $row['cod_perf'] . '">' . $row['des_perf'] . '</option>';
        }
        
            echo '</select>';
          

}

 public function consultarRol(){
        $consultarRol=mainModel::conectar()->prepare("SELECT cod_rol,des_rol from tab_rol ");
            $consultarRol->execute();
            $row = $consultarRol->fetchAll(PDO::FETCH_ASSOC);
            echo '<select name="selrol" id="selrol" class="form-control">';
             foreach ($row as $row) {
            echo '<option value="' . $row['cod_rol'] . '">' . $row['des_rol'] . '</option>';
        }
        
            echo '</select>';
          

}

public function consultarEvento(){
        $consultarEvento=mainModel::conectar()->prepare("SELECT cod_even,des_even from dat_even ");
            $consultarEvento->execute();
            $row = $consultarEvento->fetchAll(PDO::FETCH_ASSOC);
            echo '<select name="seleven" id="seleven" class="form-control">';
             foreach ($row as $row) {
            echo '<option value="' . $row['cod_even'] . '">' . $row['des_even'] . '</option>';
        }
        
            echo '</select>';
          

}


}