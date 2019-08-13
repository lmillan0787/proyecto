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
    
}