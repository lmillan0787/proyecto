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
    public function tabla_participacion()
    {

        $cod_even = mainModel::limpiar_cadena($_POST['cod_even']);

        $datos = [
            "cod_even" => $cod_even
        ];

        $row = participacionModelo::consultar_participacion_modelo($datos);

        foreach ($row as $row) {

            echo '
            <tr>
                <td>' . $row['ced'] . '</td>
                <td>' . $row['nom'] . '</td>
                <td>' . $row['ape'] . '</td>
                <td>' . $row['des_perf'] . '</td>
                <td>' . $row['edad'] . '</td>
                <td>' . $row['des_gen'] . '</td>
                <td>' . $row['des_even'] . '</td>
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
    public function generar_credenciales_controlador()
    {
        $cod_even = mainModel::limpiar_cadena($_POST['cod_even']);

        $datos = [
            "cod_even" => $cod_even
        ];

        $row = participacionModelo::consultar_participacion_modelo($datos);

        foreach ($row as $row) {
            $datos = [
                "cod_even" => $cod_even,
                "ced" => $row['ced'],
                "nom" => $row['nom'],
                "ape" => $row['ape'],
            ];
            
        }
        return $row;
    }
}
