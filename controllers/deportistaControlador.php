<?php

if ($peticionAjax) {
    require_once "../models/deportistaModelo.php";
} else {
    require_once "./models/deportistaModelo.php";
}

class deportistaControlador extends deportistaModelo
{
    public function agregar_deportista_controlador()
    {
        $cod_nac = mainModel::limpiar_cadena($_POST['cod_nac']);
        $ced = mainModel::limpiar_cadena($_POST['ced']);
        $nom = mainModel::limpiar_cadena($_POST['nom']);
        $ape = mainModel::limpiar_cadena($_POST['ape']);
        $fec_cod_nac = mainModel::limpiar_cadena($_POST['fec_cod_nac']);
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
                "cod_nac" => $cod_nac,
                "ced" => $ced,
                "nom" => $nom,
                "ape" => $ape,
                "fec_cod_nac" => $fec_cod_nac,
                "cod_gen" => $cod_gen
            ];
            $guardarDeportista = deportistaModelo::agregar_deportista($datosDeportista);

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
    public function tabla_deportista()
    {
        
        $row=deportistaModelo::consultar_deportista();
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
                    <td>'.$row['des_reg'].'</td>
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


public function consultarDisciplina(){
        $consultarDisciplina=mainModel::conectar()->prepare("SELECT cod_dis,des_dis from tab_dis ");
            $consultarDisciplina->execute();
            $row = $consultarDisciplina->fetchAll(PDO::FETCH_ASSOC);
            echo '<select name="seldis" id="seldis" class="form-control">';
             foreach ($row as $row) {
            echo '<option value="' . $row['cod_dis'] . '">' . $row['des_dis'] . '</option>';
        }
        
            echo '</select>';
          

}


public function consultarCategoria(){
        $consultarCategoria=mainModel::conectar()->prepare("SELECT cod_cat,des_cat from tab_cat ");
            $consultarCategoria->execute();
            $row = $consultarCategoria->fetchAll(PDO::FETCH_ASSOC);
            echo '<select name="selcat" id="seldis" class="form-control">';
             foreach ($row as $row) {
            echo '<option value="' . $row['cod_cat'] . '">' . $row['des_cat'] . '</option>';
        }
        
            echo '</select>';
          

}


}