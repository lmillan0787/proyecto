<?php

if ($peticionAjax) {
    require_once "../models/eventoModelo.php";
} else {
    require_once "./models/eventoModelo.php";
}

class eventoControlador extends eventoModelo
{
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //cargar tabla de evento
    public function tabla_evento_controlador()
    {
        $row = eventoModelo::consultar_tabla_evento_modelo();
        foreach ($row as $row) {
            echo '
        <tr>
            <td>' . $row['cod_even'] . '</td>
            <td>' . $row['des_even'] . '</td>
            <td>' . $row['fec_even'] . '</td>
            <td>' . $row['des_tip_even'] . '</td>
            <td>' . $row['des_edo'] . '</td>            
            <td id="estatus' . $row['cod_estat'] . '">' . $row['des_estat'] . '</td>
            <td><button id="modalActivate" type="button" class="btn btn-warning btn-md" data-toggle="modal"><i class="fas fa-eye fa-2x"></i></button></td>            
            <td>
                <form class="" action="' . SERVERURL . 'editarEvento/" method="POST" data-form="" enctype="multipart/form-data">
                    <input type="text" value="' . $row['cod_even'] . '" name="cod_even" hidden required>
                    <button type="submit" class="btn btn-default btn-md">
                        <i class="far fa-edit fa-2x"></i>
                    </button>
                </form>
            </td>            
        </tr>   
        ';
        }
    }
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //validar nombre del evento
    public function validar_evento_controlador()
    {
        $des_even = mainModel::limpiar_cadena($_POST['des_even']);

        $datosEvento = ["des_even" => $des_even];

        $validarEvento = eventoModelo::validar_evento_modelo($datosEvento);

        if ($validarEvento->rowCount() >= 1) {
            echo '<div class="alert alert-danger"><strong>Error!</strong> El nombre del evento ya está en uso</div>';
        } else { }
    }
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //validar editar nombre del evento
    public function validar_evento_distinto_controlador()
    {
        $cod_even = mainModel::limpiar_cadena($_POST['cod_even']);
        $des_even = mainModel::limpiar_cadena($_POST['des_even']);

        $datosEvento = [
            "des_even" => $des_even,
            "cod_even" => $cod_even
        ];

        $row = eventoModelo::validar_evento_distinto_modelo($datosEvento);

        return $row;
    }
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //agregar evento
    public function agregar_evento_controlador()
    {
        $des_even = mainModel::limpiar_cadena($_POST['des_even']);
        $fec_even = mainModel::limpiar_cadena($_POST['fec_even']);
        $cod_edo = mainModel::limpiar_cadena($_POST['cod_edo']);
        $cod_tip_even = mainModel::limpiar_cadena($_POST['cod_tip_even']);


        $datosEvento = [
            "des_even" => $des_even,
            "fec_even" => $fec_even,
            "cod_edo" => $cod_edo,
            "cod_tip_even" => $cod_tip_even,

        ];

        $validarEvento = eventoModelo::validar_evento_modelo($datosEvento);

        if ($validarEvento->rowCount() >= 1) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrio un error inesperado",
                "Texto" => "El nombre del evento que intenta ingresar ya se encuentra registrada en el sistema",
                "Tipo" => "error"
            ];
        } else {
            $guardarEvento = eventoModelo::agregar_evento_modelo($datosEvento);

            if ($guardarEvento->rowCount() >= 1) {
                $alerta = [
                    "Alerta" => "simpleEventos",
                    "Titulo" => "Registro Exitoso",
                    "Texto" => "Evento Creado exitosamente",
                    "Tipo" => "success"
                ];
            } else {
                $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "Ocurrió un error inesperado",
                    "Texto" => "Error al crear evento",
                    "Tipo" => "error"
                ];
            }
        }
        return mainModel::sweet_alert($alerta);
    }
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //editar evento 
    public function editar_evento_controlador()
    {
        $cod_even = mainModel::limpiar_cadena($_POST['cod_even']);
        $des_even = mainModel::limpiar_cadena($_POST['des_even']);
        $fec_even = mainModel::limpiar_cadena($_POST['fec_even']);
        $cod_edo = mainModel::limpiar_cadena($_POST['cod_edo']);
        $cod_estat = mainModel::limpiar_cadena($_POST['cod_estat']);
        $cod_tip_even = mainModel::limpiar_cadena($_POST['cod_tip_even']);

        //echo $cod_even.' '.$des_even.' '.$fec_even.' '.$cod_edo.' '.$cod_estat.' '.$cod_tip_even;

        $datosEvento = [
            "cod_even" => $cod_even,
            "des_even" => $des_even,
            "fec_even" => $fec_even,
            "cod_edo" => $cod_edo,
            "cod_estat" => $cod_estat,
            "cod_tip_even" => $cod_tip_even,
        ];        

        $validarEvento = eventoModelo::validar_evento_distinto_modelo($datosEvento);

        if ($validarEvento->rowCount() >= 1) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrio un error inesperado",
                "Texto" => "El nombre del evento que intenta ingresar ya se encuentra utilizado por otro evento",
                "Tipo" => "error"
            ];
        } else {
            $editarEvento = eventoModelo::editar_evento_modelo($datosEvento);

            if ($editarEvento->rowCount() >= 1) {
                $alerta = [
                    "Alerta" => "simpleEventos",
                    "Titulo" => "Actualización Exitosa",
                    "Texto" => "Evento actualizado exitosamente",
                    "Tipo" => "success"
                ];
            } else {
                $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "Ocurrió un error inesperado",
                    "Texto" => "Error al editar evento",
                    "Tipo" => "error"
                ];
            }
        }        
        return mainModel::sweet_alert($alerta);
    }
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //editar evento formulario
    public function formulario_editar_nombre_evento_controlador()
    {
        $cod_even = mainModel::limpiar_cadena($_POST['cod_even']);
        $datosEvento = [
            "cod_even" => $cod_even
        ];
        $row = eventoModelo::consultar_editar_evento_modelo($datosEvento);
        foreach ($row as $row) {
            echo '
            <input onkeyup="javascript:this.value=this.value.toUpperCase();" type="text" class="form-control" placeholder="Nombre del Evento" aria-describedby="addon-wrapping" minlength="2" maxlength="20" required pattern="[A-Za-zñÑáéíóúÁÉÍÓÚöÖüÜ\s0-9]+" name="des_even" required id="des_even" value="' . $row['des_even'] . '">
                        ';
        }
        return $row;
    }
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //editar fecha formulario
    public function formulario_editar_fecha_evento_controlador()
    {
        $cod_even = mainModel::limpiar_cadena($_POST['cod_even']);
        $datosEvento = [
            "cod_even" => $cod_even
        ];
        $row = eventoModelo::consultar_editar_evento_modelo($datosEvento);
        foreach ($row as $row) {
            echo '
            <input type="date" class="form-control" placeholder="Fecha del evento" aria-label="Username" aria-describedby="addon-wrapping" min="' . $row['fec_even'] . '" max="2050-01-01" step="1" name="fec_even" required value="' . $row['fec_even'] . '">

                        ';
        }
        return $row;
    }
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //editar estado formulario
    public function formulario_editar_estado_evento_controlador()
    {
        $cod_even = mainModel::limpiar_cadena($_POST['cod_even']);
        $datosEvento = [
            "cod_even" => $cod_even
        ];
        $row = eventoModelo::consultar_editar_evento_modelo($datosEvento);
        foreach ($row as $row) {
            echo '
            <option value="' . $row['cod_edo'] . '" selected>' . $row['des_edo'] . '</option>

                        ';
        }
        return $row;
    }
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //editar estatus formulario
    public function formulario_editar_estatus_evento_controlador()
    {
        $cod_even = mainModel::limpiar_cadena($_POST['cod_even']);
        $datosEvento = [
            "cod_even" => $cod_even
        ];
        $row = eventoModelo::consultar_editar_evento_modelo($datosEvento);
        foreach ($row as $row) {
            echo '
            <option selected value="' . $row['cod_estat'] . '" selected>' . $row['des_estat'] . '</option>

                        ';
        }
        return $row;
    }
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////eliminar evento
    public function eliminar_evento_controlador()
    {

        $cod_even = mainModel::limpiar_cadena($_POST['cod_even']);
        $datosEvento = [
            "cod_even" => $cod_even
        ];
        $eliminarEvento = eventoModelo::eliminar_evento($datosEvento);
        if ($eliminarEvento->rowCount() >= 1) {
            $alerta = [
                "Alerta" => "simpleEventos",
                "Titulo" => "Borrado Exitoso",
                "Texto" => "Evento eliminado del sistema exitosamente",
                "Tipo" => "success"
            ];
        } else {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrió un error inesperado",
                "Texto" => "Error al eliminar el evento",
                "Tipo" => "error"
            ];
        }
        return mainModel::sweet_alert($alerta);
    }
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //consultar estado
    public function formulario_evento()
    {
        $consultaEdo = mainModel::consultar_estado_modelo();
        foreach ($consultaEdo as $row) {
            echo '<option value="' . $row['cod_edo'] . '">' . $row['des_edo'] . '</option>';
        }
    }
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //consultar estatus
    public function formulario_evento_estatus()
    {
        $row = mainModel::consultar_estatus_modelo();
        foreach ($row as $row) {
            echo '
                <option value="' . $row['cod_estat'] . '" selected>' . $row['des_estat'] . '</option>                
                        ';
        }
        return $row;
    }
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
}
