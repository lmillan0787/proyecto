<?php

if ($peticionAjax) {
    require_once "../models/puebloModelo.php";
} else {
    require_once "./models/puebloModelo.php";
}

class puebloControlador extends puebloModelo
{
    public function agregar_pueblo_controlador()
    {
        $des_pue = mainModel::limpiar_cadena($_POST['des_pue']);
        $consulta1 = mainModel::ejecutar_consulta_simple("SELECT * FROM tab_pue WHERE des_pue='$des_pue'");
                  
        
        if ($consulta1->rowCount() >= 1) {           
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrio un error inesperado",
                "Texto" => "El nombre del pueblo que intenta ingresar ya se encuentra registrada en el sistema",
                "Tipo" => "error"
            ];
        } else {

            $datosPueblo = [
                "des_pue" => $des_pue    
            ];

            $guardarPueblo = puebloModelo::agregar_pueblo($datosPueblo);
            if ($guardarPueblo->rowCount() >= 1) {
                $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "Registro Exitoso",
                    "Texto" => "Pueblo Registrado Exitosamente",
                    "Tipo" => "success"
                ];
            } else {                
                $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "Ocurrió un error inesperado",
                    "Texto" => "Error al Registrar el Pueblo",
                    "Tipo" => "error"
                    
                ];
            }
        }
        return mainModel::sweet_alert($alerta);
    }

    public function tabla_pueblo()
    {
        $row = puebloModelo::consultar_pueblo();
        foreach ($row as $row) {
            echo '
            <tr>
                <td class="text-center">' . $row['cod_pue'] . '</td>
                <td class="text-center">' . $row['des_pue'] . '</td>
                <td class="text-center">
                    <form class="" action="' . SERVERURL . 'editarPueblo" method="POST" enctype="multipart/form-data">
                        <input type="text" value="" name="cod_usr" hidden required>
                        <button type="submit" class="btn btn-default btn-sm">
                            <i class="far fa-edit fa-2x"></i>
                        </button>
                    </form>    
                </td>    
            </tr>';
        }
        return $row;
    }
    
}