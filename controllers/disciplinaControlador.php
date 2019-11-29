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
        $des_dis = mainModel::limpiar_cadena($_POST['des_dis']);
        $cod_tip_even = mainModel::limpiar_cadena($_POST['cod_tip_even']);
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
                "des_dis" => $des_dis,
                "cod_tip_even" => $cod_tip_even    
            ];

            $guardarDisciplina = disciplinaModelo::agregar_disciplina($datosDisciplina);
            if ($guardarDisciplina->rowCount() >= 1) {
                $alerta = [
                    "Alerta" => "simpleDisciplina",
                    "Titulo" => "Registro Exitoso",
                    "Texto" => "Disciplina Registrada Exitosamente",
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
        $n = 0;
        $row = disciplinaModelo::consultar_disciplina();
        foreach ($row as $row) {
            $n++;
            echo '
            <tr>
                <td class="text-center">' . $n . '</td>
                <td class="text-center">' . $row['des_dis'] . '</td>
                <td class="text-center">' . $row['des_tip_even'] . '</td>
                <td class="text-center">
                    <form class="" action="' . SERVERURL . 'editarDisciplina" method="POST" enctype="multipart/form-data">
                        <input type="text" value="'.$row['cod_dis'].'" name="cod_dis" hidden required>
                        <button type="submit" class="btn btn-default btn-sm">
                            <i class="far fa-edit fa-2x"></i>
                        </button>
                    </form>    
                </td>    
            </tr>';
        }
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
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //consultar disciplinas autoctonas
    public function validar_disciplina_controlador()
    {
        $des_dis = mainModel::limpiar_cadena($_POST['des_dis']);
        $datos = [
            "des_dis" => $des_dis
        ];
        $sql = disciplinaModelo::consultar_disciplinas_distintas_modelo($datos);
        if ($sql->rowCount() >= 1){
            echo'<div class="alert alert-danger"><strong>Error!</strong> Ya existe esta disciplina</div>';
        }
        
    }
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //consultar disciplinas autoctonas
    public function editar_disciplina_formulario()
    {
        $cod_dis = mainModel::limpiar_cadena($_POST['cod_dis']);
        $datos = [
            "cod_dis" => $cod_dis
        ];
        $sql = disciplinaModelo::consultar_disciplina_editar($datos);
        foreach ($sql as $row){
            echo'<input type="text" class="form-control" placeholder="Nombre del Disciplina" aria-describedby="addon-wrapping" minlength="2" maxlength="20" required pattern="[A-Za-zñÑáéíóúÁÉÍÓÚöÖüÜ\s]+" name="des_dis" value="'.$row['des_dis'].'" id="des_dis">';
        }
        
    }
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //consultar disciplinas autoctonas
    public function editar_disciplina_controlador()
    {
        $cod_dis = mainModel::limpiar_cadena($_POST['cod_dis']);
        $des_dis = mainModel::limpiar_cadena($_POST['des_dis']);
        $cod_tip_even = mainModel::limpiar_cadena($_POST['cod_tip_even']);
        $datos = [
            "cod_dis" => $cod_dis,
            "des_dis" => $des_dis,
            "cod_tip_even" => $cod_tip_even
        ];
        $sql = disciplinaModelo::editar_disciplina_modelo($datos);
        if($sql->rowCount() >= 1){
            echo "
                       <script>
                       Swal.fire(
                        'Disciplina actualizada ',
                        '',
                        'success'
                       ).then(function(){
                        window.location='" . SERVERURL . "disciplinas/';
                    }); 
                       
                       </script>
                       ";
        }else{
            echo "
                       <script>
                       Swal.fire(
                        'Error al actualizar disciplina',
                        '',
                        'error'
                       )    
                       
                       </script>
                       ";
        }
        
    }
    
}