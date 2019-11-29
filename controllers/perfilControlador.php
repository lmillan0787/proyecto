<?php

if ($peticionAjax) {
    require_once "../models/perfilModelo.php";
} else {
    require_once "./models/perfilModelo.php";
}

class perfilControlador extends perfilModelo
{
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //cargar tabla de evento
    public function agregar_perfil_controlador()
    {
        $des_perf = mainModel::limpiar_cadena($_POST['des_perf']);
        $cod_rol = mainModel::limpiar_cadena($_POST['cod_rol']);
        $consulta1 = mainModel::ejecutar_consulta_simple("SELECT * FROM tab_perf WHERE des_perf='$des_perf'");
                  
        
        if ($consulta1->rowCount() >= 1) {           
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrio un error inesperado",
                "Texto" => "El nombre del perfil que intenta ingresar ya se encuentra registrada en el sistema",
                "Tipo" => "error"
            ];
        } else {

            $datosPerfil = [
                "des_perf" => $des_perf,
                "cod_rol" => $cod_rol    
            ];

            $guardarPerfil = perfilModelo::agregar_perfil($datosPerfil);
            if ($guardarPerfil->rowCount() >= 1) {
                $alerta = [
                    "Alerta" => "simplePerfil",
                    "Titulo" => "Registro Exitoso",
                    "Texto" => "Perfil Registrado Exitosamente",
                    "Tipo" => "success"
                ];
            } else {                
                $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "Ocurrió un error inesperado",
                    "Texto" => "Error al Registrar el Perfil",
                    "Tipo" => "error"
                    
                ];
            }
        }
        return mainModel::sweet_alert($alerta);
    }
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //cargar tabla de evento
    public function tabla_perfil()
    {
        $n = 0;
        $row = perfilModelo::consultar_perfil();
        foreach ($row as $row) {
            $n++;
            echo '
            <tr>
                <td class="text-center">' . $n . '</td>
                <td class="text-center">' . $row['des_perf'] . '</td>
                <td class="text-center">
                    <form class="" action="' . SERVERURL . 'editarPerfil" method="POST" enctype="multipart/form-data">
                        <input type="text" value="'.$row['cod_perf'].'" name="cod_perf" hidden required>
                        <button type="submit" class="btn btn-default btn-sm">
                            <i class="far fa-edit fa-2x"></i>
                        </button>
                    </form>    
                </td>    
            </tr>';
        }
    }
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //consultar perfils autoctonas
    public function consultar_perfil_autoctona_controlador()
    {
        $disAutoctonas = perfilModelo::consultar_perfils_autoctonas_modelo();        
        foreach ($disAutoctonas as $row) {
            echo '
                <option disabled value="">'.$row['des_perf'].'</option>                
                ';
        }        
    }
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //consultar perfils convencionales
    public function consultar_perfil_convencionales_controlador()
    {
        $disConvencionales = perfilModelo::consultar_perfils_convencionales_modelo();        
        foreach ($disConvencionales as $row) {
            echo '
            <option disabled value="">'.$row['des_perf'].'</option>
                ';
        }        
    }
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //consultar perfils autoctonas
    public function consultar_perfil_controlador()
    {
        $perfils = perfilModelo::consultar_perfils_modelo();        
        foreach ($perfils as $row) {
            echo '
            <option disabled value="">'.$row['des_perf'].'</option>
                ';
        }        
    }
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //consultar perfils autoctonas
    public function validar_perfil_controlador()
    {
        $des_perf = mainModel::limpiar_cadena($_POST['des_perf']);
        $datos = [
            "des_perf" => $des_perf
        ];
        $sql = perfilModelo::consultar_perfil_distinta_modelo($datos);
        if ($sql->rowCount() >= 1){
            echo'<div class="alert alert-danger"><strong>Error!</strong> Ya existe esta perfil</div>';
        }
        
    }
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //consultar perfils autoctonas
    public function editar_perfil_formulario()
    {
        $cod_perf = mainModel::limpiar_cadena($_POST['cod_perf']);
        $datos = [
            "cod_perf" => $cod_perf
        ];
        $sql = perfilModelo::consultar_perfil_editar($datos);
        foreach ($sql as $row){
            echo'<input type="number" hidden=""  class="form-control" placeholder="Nombre del Perfil" aria-describedby="addon-wrapping" minlength="2" maxlength="60" required pattern="[A-Za-zñÑáéíóúÁÉÍÓÚöÖüÜ\s]+" name="cod_perf" value="'.$row['cod_perf'].'" id="cod_perf">';
           
        }
        
    }
    /////////////////////////////////////////////////////////////////////////////////////////////////////
    ////////////////////////////////////////////////////////////////////////////////////////////////////
 public function editar_perfil_formulario_2()
    {
        $cod_perf = mainModel::limpiar_cadena($_POST['cod_perf']);
        $datos = [
            "cod_perf" => $cod_perf
        ];
        $sql = perfilModelo::consultar_perfil_editar($datos);
        foreach ($sql as $row){
            echo'<input type="text"  class="form-control" placeholder="cod_rol" aria-describedby="addon-wrapping" minlength="2" maxlength="20" required pattern="[A-Za-zñÑáéíóúÁÉÍÓÚöÖüÜ\s]+" name="des_perf" value="'.$row['des_perf'].'" id="des_perf">';
        }
        
    }

 /////////////////////////////////////////////////////////////////////////////////////////////////////
    ////////////////////////////////////////////////////////////////////////////////////////////////////
 public function editar_perfil_formulario_3()
    {
        $cod_perf = mainModel::limpiar_cadena($_POST['cod_perf']);
        $datos = [
            "cod_perf" => $cod_perf
        ];
        $sql = perfilModelo::consultar_perfil_editar($datos);
        foreach ($sql as $row){
            echo'<input type="number" hidden="" class="form-control" placeholder="cod_rol" aria-describedby="addon-wrapping" minlength="2" maxlength="20" required pattern="[A-Za-zñÑáéíóúÁÉÍÓÚöÖüÜ\s]+" name="cod_rol" value="'.$row['cod_rol'].'" id="cod_rol">';
        }
        
    }

    ////////////////////////////////////////////////////////////////////////////////
    //consultar perfils autoctonas
    public function editar_perfil_controlador()
    {
        $cod_perf = mainModel::limpiar_cadena($_POST['cod_perf']);
        $des_perf = mainModel::limpiar_cadena($_POST['des_perf']);
        $cod_rol = mainModel::limpiar_cadena($_POST['cod_rol']);
        $datos = [
            "cod_perf" => $cod_perf,
            "des_perf" => $des_perf,
            "cod_rol" => $cod_rol
        ];
        $sql = perfilModelo::editar_perfil_modelo($datos);
        if($sql->rowCount() >= 1){
            echo "
                       <script>
                       Swal.fire(
                        'Perfil actualizado ',
                        '',
                        'success'
                       ).then(function(){
                        window.location='" . SERVERURL . "listaPerfiles/';
                    }); 
                       
                       </script>
                       ";
        }else{
            echo "
                       <script>
                       Swal.fire(
                        'Error al actualizar perfil',
                        '',
                        'error'
                       )    
                       
                       </script>
                       ";
        }
        
    }
    
}