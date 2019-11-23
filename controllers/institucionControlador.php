<?php

if ($peticionAjax) {
    require_once "../models/institucionModelo.php";
} else {
    require_once "./models/institucionModelo.php";
}

class institucionControlador extends institucionModelo
{
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //cargar tabla de evento
    public function agregar_institucion_controlador()
    {
        $des_inst = mainModel::limpiar_cadena($_POST['des_inst']);
        $siglas = mainModel::limpiar_cadena($_POST['siglas']);
        $consulta1 = mainModel::ejecutar_consulta_simple("SELECT * FROM tab_inst WHERE des_inst='$des_inst'");
                  
        
        if ($consulta1->rowCount() >= 1) {           
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrio un error inesperado",
                "Texto" => "El nombre del institución que intenta ingresar ya se encuentra registrada en el sistema",
                "Tipo" => "error"
            ];
        } else {

            $datosInstitucion = [
                "des_inst" => $des_inst,
                "siglas" => $siglas    
            ];

            $guardarInstitucion = institucionModelo::agregar_institucion($datosInstitucion);
            if ($guardarInstitucion->rowCount() >= 1) {
                $alerta = [
                    "Alerta" => "simpleInstitucion",
                    "Titulo" => "Registro Exitoso",
                    "Texto" => "Institución Registrada Exitosamente",
                    "Tipo" => "success"
                ];
            } else {                
                $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "Ocurrió un error inesperado",
                    "Texto" => "Error al Registrar el Institucion",
                    "Tipo" => "error"
                    
                ];
            }
        }
        return mainModel::sweet_alert($alerta);
    }
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //cargar tabla de evento
    public function tabla_institucion()
    {
        $n = 0;
        $row = institucionModelo::consultar_institucion();
        foreach ($row as $row) {
            $n++;
            echo '
            <tr>
                <td class="text-center">' . $n . '</td>
                <td class="text-center">' . $row['des_inst'] . '</td>
                <td class="text-center">' . $row['siglas'] . '</td>
                <td class="text-center">
                    <form class="" action="' . SERVERURL . 'editarInstitucion" method="POST" enctype="multipart/form-data">
                        <input type="text" value="'.$row['cod_inst'].'" name="cod_inst" hidden required>
                        <button type="submit" class="btn btn-default btn-sm">
                            <i class="far fa-edit fa-2x"></i>
                        </button>
                    </form>    
                </td>    
            </tr>';
        }
        return $row;
    }
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //consultar institucions autoctonas
    public function consultar_institucion_autoctona_controlador()
    {
        $disAutoctonas = institucionModelo::consultar_institucions_autoctonas_modelo();        
        foreach ($disAutoctonas as $row) {
            echo '
                <option disabled value="">'.$row['des_inst'].'</option>                
                ';
        }        
    }
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //consultar institucions convencionales
    public function consultar_institucion_convencionales_controlador()
    {
        $disConvencionales = institucionModelo::consultar_institucions_convencionales_modelo();        
        foreach ($disConvencionales as $row) {
            echo '
            <option disabled value="">'.$row['des_inst'].'</option>
                ';
        }        
    }
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //consultar institucions autoctonas
    public function consultar_institucion_controlador()
    {
        $institucions = institucionModelo::consultar_institucions_modelo();        
        foreach ($institucions as $row) {
            echo '
            <option disabled value="">'.$row['des_inst'].'</option>
                ';
        }        
    }
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //consultar institucions autoctonas
    public function validar_institucion_controlador()
    {
        $des_inst = mainModel::limpiar_cadena($_POST['des_inst']);
        $datos = [
            "des_inst" => $des_inst
        ];
        $sql = institucionModelo::consultar_institucion_distinta_modelo($datos);
        if ($sql->rowCount() >= 1){
            echo'<div class="alert alert-danger"><strong>Error!</strong> Ya existe esta institucion</div>';
        }
        
    }
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //consultar institucions autoctonas
    public function editar_institucion_formulario()
    {
        $cod_inst = mainModel::limpiar_cadena($_POST['cod_inst']);
        $datos = [
            "cod_inst" => $cod_inst
        ];
        $sql = institucionModelo::consultar_institucion_editar($datos);
        foreach ($sql as $row){
            echo'<input type="text" class="form-control" placeholder="Nombre del Institucion" aria-describedby="addon-wrapping" minlength="2" maxlength="60" required pattern="[A-Za-zñÑáéíóúÁÉÍÓÚöÖüÜ\s]+" name="des_inst" value="'.$row['des_inst'].'" id="des_inst">';
           
        }
        
    }
    /////////////////////////////////////////////////////////////////////////////////////////////////////
    ////////////////////////////////////////////////////////////////////////////////////////////////////
 public function editar_institucion_formulario_2()
    {
        $cod_inst = mainModel::limpiar_cadena($_POST['cod_inst']);
        $datos = [
            "cod_inst" => $cod_inst
        ];
        $sql = institucionModelo::consultar_institucion_editar($datos);
        foreach ($sql as $row){
            echo'<input type="text" class="form-control" placeholder="siglas" aria-describedby="addon-wrapping" minlength="2" maxlength="20" required pattern="[A-Za-zñÑáéíóúÁÉÍÓÚöÖüÜ\s]+" name="siglas" value="'.$row['siglas'].'" id="siglas">';
        }
        
    }


    ////////////////////////////////////////////////////////////////////////////////
    //consultar institucions autoctonas
    public function editar_institucion_controlador()
    {
        $cod_inst = mainModel::limpiar_cadena($_POST['cod_inst']);
        $des_inst = mainModel::limpiar_cadena($_POST['des_inst']);
        $siglas = mainModel::limpiar_cadena($_POST['siglas']);
        $datos = [
            "cod_inst" => $cod_inst,
            "des_inst" => $des_inst,
            "siglas" => $siglas
        ];
        $sql = institucionModelo::editar_institucion_modelo($datos);
        if($sql->rowCount() >= 1){
            echo "
                       <script>
                       Swal.fire(
                        'Institucion actualizada ',
                        '',
                        'success'
                       ).then(function(){
                        window.location='" . SERVERURL . "listaInstitucion/';
                    }); 
                       
                       </script>
                       ";
        }else{
            echo "
                       <script>
                       Swal.fire(
                        'Error al actualizar institución',
                        '',
                        'error'
                       )    
                       
                       </script>
                       ";
        }
        
    }
    
}