<?php

if ($peticionAjax) {
    require_once "../models/disciplinaModelo.php";
} else {
    require_once "./models/disciplinaModelo.php";
}

class disciplinaControlador extends disciplinaModelo
{
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //cargar tabla de evento
    public function agregar_disciplina_controlador()
    {
        $des_pue = mainModel::limpiar_cadena($_POST['des_pue']);
        $consulta1 = mainModel::ejecutar_consulta_simple("SELECT * FROM tab_dis WHERE des_dis='$des_dis'");
                  
        
        if ($consulta1->rowCount() >= 1) {           
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrio un error inesperado",
                "Texto" => "El nombre del disciplina que intenta ingresar ya se encuentra registrada en el sistema",
                "Tipo" => "error"
            ];
        } else {

            $datosDisciplina = [
                "des_pue" => $des_pue    
            ];

            $guardarDisciplina = disciplinaModelo::agregar_disciplina($datosDisciplina);
            if ($guardarDisciplina->rowCount() >= 1) {
                $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "Registro Exitoso",
                    "Texto" => "Disciplina Registrado Exitosamente",
                    "Tipo" => "success"
                ];
            } else {                
                $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "Ocurrió un error inesperado",
                    "Texto" => "Error al Registrar el Disciplina",
                    "Tipo" => "error"
                    
                ];
            }
        }
        return mainModel::sweet_alert($alerta);
    }
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //cargar tabla de evento
    public function tabla_disciplina()
    {
        $row = disciplinaModelo::consultar_disciplina();
        foreach ($row as $row) {
            echo '
            <tr>
                <td>' . $row['cod_dis'] . '</td>
                <td>' . $row['des_dis'] . '</td>
                <td>
                    <form class="" action="' . SERVERURL . 'editarUsuario" method="POST" enctype="multipart/form-data">
                        <input type="text" value="" name="cod_usr" hidden required>
                        <button type="submit" class="btn btn-info btn-md">
                            <i class="far fa-edit fa-2x"></i>
                        </button>
                    </form>    
                </td>    
            
                <td>
                    <form class="FormularioAjax" action="' . SERVERURL . 'ajax/eliminarUsuarioAjax.php" method="POST" data-form="borrar" enctype="multipart/form-data">
                        <input type="text" value="" name="cod_usr" hidden required>
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
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //consultar disciplinas autoctonas
    public function consultar_disciplinas_autoctonas_controlador()
    {
        $disAutoctonas = disciplinaModelo::consultar_disciplinas_autoctonas_modelo();        
        foreach ($disAutoctonas as $row) {
            echo '
                <option disabled value="">'.$row['des_dis'].'</option>                
                ';
        }        
    }
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //consultar disciplinas convencionales
    public function consultar_disciplinas_convencionales_controlador()
    {
        $disConvencionales = disciplinaModelo::consultar_disciplinas_convencionales_modelo();        
        foreach ($disConvencionales as $row) {
            echo '
            <option disabled value="">'.$row['des_dis'].'</option>
                ';
        }        
    }
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //consultar disciplinas autoctonas
    public function consultar_disciplinas_controlador()
    {
        $disciplinas = disciplinaModelo::consultar_disciplinas_modelo();        
        foreach ($disciplinas as $row) {
            echo '
            <option disabled value="">'.$row['des_dis'].'</option>
                ';
        }        
    }
    
}