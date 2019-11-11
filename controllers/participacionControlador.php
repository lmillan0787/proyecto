<?php

if ($peticionAjax) {
    require_once "../models/participacionModelo.php";
} else {
    require_once "./models/participacionModelo.php";
}

class participacionControlador extends participacionModelo
{
    public function agregar_participacion_controlador()
    {
        $cod_nac = mainModel::limpiar_cadena($_POST['cod_per']);
        $ced = mainModel::limpiar_cadena($_POST['cod_even']);
        $nom = mainModel::limpiar_cadena($_POST['cod_perf']);
        $ape = mainModel::limpiar_cadena($_POST['ape']);


        $validarCedula = participacionModelo::validar_cedula($ced);
        if ($validarCedula->rowCount() >= 1) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrio un error inesperado",
                "Texto" => "La cédula que intenta ingresar ya se encuentra registrada en el sistema",
                "Tipo" => "error"
            ];
        } else {
            $guardarParticipacion = participacionModelo::agregar_participacion($datosParticipacion);

            if ($guardarParticipacion->rowCount() >= 1) {
                $alerta = [
                    "Alerta" => "simpleParticipacion",
                    "Titulo" => "",
                    "Texto" => "Participacion registrada exitosamente",
                    "Tipo" => "success"
                ];
            } else {
                $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "Ocurrió un error inesperado",
                    "Texto" => "Error al registrar participacion",
                    "Tipo" => "error"
                ];
            }
        }
        return mainModel::sweet_alert($alerta);
    }
    ///////////////////////////////////////////////////////////////////////////////
    public function tabla_participacion($datos)
    {
        $cod_even = mainModel::limpiar_cadena($datos['cod_even']);

        $datos = [
            "cod_even" => $cod_even
        ];

        $row = participacionModelo::consultar_participacion_modelo($datos);
        $n = 0;
        foreach ($row as $row) {
            $n++;
            if  ($row['cod_rol'] == 2){
                $form = '
                <form action="'.SERVERURL.'ajax/participacionFpdfAjax.php" method="POST" target="_blank" rel="noopener noreferrer">                            
                    <input type="text" name="ced" value="' . $row['ced'] . '" hidden>           
                    <input type="text" name="nombre" value="' . $row['nom'] . '" hidden>
                    <input type="text" name="apellido" value="' . $row['ape'] . '" hidden>
                    <input type="text" name="edad" value="' . $row['edad'] . '" hidden>
                    <input type="text" name="genero"  value="' . $row['des_gen'] . '" hidden>
                    <input type="text" name="cod_reg"  value="' . $row['cod_reg'] . '" hidden> 
                    <input type="text" name="des_reg"  value="' . $row['des_reg'] . '" hidden>
                    <input type="text" name="des_even"  value="' . $row['des_even'] . '" hidden>
                    <input type="text" name="cod_rol"  value="' . $row['cod_rol'] . '" hidden>
                    <input type="text" name="cod_perf"  value="' . $row['cod_perf'] . '" hidden>
                    <input type="text" name="des_perf"  value="' . $row['des_perf'] . '" hidden>  
                    <input type="text" name="des_pue"  value="' . $row['des_pue'] . '" hidden>
                    <input type="text" name="alias"  value="' . $row['alias'] . '" hidden>
                    <input type="text" name="des_dis"  value="' . $row['des_dis'] . '" hidden>
                    <button type="submit" class="btn btn-warning btn-md">
                        <i class="far fa-address-card fa-2x"></i>                            
                    </button>
                </form>
                ';
            } else if ($row['cod_rol'] == 4){
                $form = '';
            } else if ($row['cod_rol'] == 5){
                $form = '
                <form action="'.SERVERURL.'ajax/participacionFpdfAjax.php" method="POST" target="_blank" rel="noopener noreferrer">                            
                    <input type="text" name="ced" value="' . $row['ced'] . '" hidden>           
                    <input type="text" name="nombre" value="' . $row['nom'] . '" hidden>
                    <input type="text" name="apellido" value="' . $row['ape'] . '" hidden>
                    <input type="text" name="edad" value="' . $row['edad'] . '" hidden>
                    <input type="text" name="genero"  value="' . $row['des_gen'] . '" hidden>
                    <input type="text" name="cod_reg"  value="' . $row['cod_reg'] . '" hidden> 
                    <input type="text" name="des_even"  value="' . $row['des_even'] . '" hidden>
                    <input type="text" name="cod_rol"  value="' . $row['cod_rol'] . '" hidden>
                    <input type="text" name="cod_perf"  value="' . $row['cod_perf'] . '" hidden>
                    <input type="text" name="des_perf"  value="' . $row['des_perf'] . '" hidden>      
                    <button type="submit" class="btn btn-warning btn-md">
                        <i class="far fa-address-card fa-2x"></i>                            
                    </button>
                </form>
                ';
            }
            echo '
            <tr>
                <td>' . $n . '</td>
                <td>' . $row['ced'] . '</td>
                <td>' . $row['nom'] . '</td>
                <td>' . $row['ape'] . '</td>
                <td>' . $row['des_perf'] . '</td>
                <td>' . $row['des_even'] . '</td>
                <td>' . $form . '</td>
                <td>
                <form class="" action="' . SERVERURL . 'editarPersona" method="POST" enctype="multipart/form-data">
                    <input type="text" value="' . $row['cod_per'] . '" name="cod_per" hidden required>
                    <button type="submit" class="btn btn-info btn-md">
                        <i class="far fa-edit fa-2x"></i>
                    </button>
                </form>    
                </td>    
            </tr>';
        }
        return $row;
    }
    public function eliminar_participacion_controlador()
    {

        $cod_par = mainModel::limpiar_cadena($_POST['cod_par']);
        $datosPersona = [
            "cod_par" => $cod_par
        ];
        $eliminarParticipacion = participacionModelo::eliminar_participacion_modelo($datosPersona);

        if ($eliminarParticipacion->rowCount() >= 1) {
            echo "
               <script>
               Swal.fire(
                'Borrado exitoso',
                'Exito al borrar la participación',
                'success'
               ).then(function(){
                window.location='" . SERVERURL . "deportistas/';
            });     
               
               </script>
               ";
        } else {
            echo "
               <script>
               Swal.fire(
                'Error al eliminar',
                'recargue la pagina',
                'error'
               ).then(function(){
                window.location='" . SERVERURL . "deportistas/';
            });     
               
               </script>
               ";
        }
    }
    /////////////////////////////////////
    public function datos_credenciales_controlador()
    {
        $cod_even = mainModel::limpiar_cadena($_POST['cod_even']);
        $datos = [
            "cod_even" => $cod_even
        ];
        $row = participacionModelo::consultar_participacion_modelo($datos);
        return $row;
    }
    ///////////////////////////////////////////////////
}
