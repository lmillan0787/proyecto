<?php

if ($peticionAjax) {
    require_once "../models/eventoModelo.php";
} else {
    require_once "./models/eventoModelo.php";
}

class eventoControlador extends eventoModelo
{
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function agregar_evento_controlador()
    {
        $des_even = mainModel::limpiar_cadena($_POST['des_even']);
        $fec_even = mainModel::limpiar_cadena($_POST['fec_even']);
        $cod_edo = mainModel::limpiar_cadena($_POST['cod_edo']);
        $cod_tip_even = mainModel::limpiar_cadena($_POST['cod_tip_even']);
        $cod_estat = 2;

        $consulta1 = mainModel::ejecutar_consulta_simple("SELECT * FROM dat_even WHERE des_even='$des_even'");


        if ($consulta1->rowCount() >= 1) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrio un error inesperado",
                "Texto" => "El nombre del evento que intenta ingresar ya se encuentra registrada en el sistema",
                "Tipo" => "error"
            ];
        } else {

            $datosEvento = [
                "des_even" => $des_even,
                "fec_even" => $fec_even,
                "cod_edo" => $cod_edo,
                "cod_tip_even" => $cod_tip_even,
                "cod_estat" => $cod_estat
            ];

            $guardarEvento = eventoModelo::agregar_evento($datosEvento);
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
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
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
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function formulario_evento()
    {
        $consultaEdo = mainModel::ejecutar_consulta_simple("SELECT * FROM tab_edo");
        $row = $consultaEdo->fetchAll(PDO::FETCH_ASSOC);
        foreach ($row as $row) {

            echo '<option value="' . $row['cod_edo'] . '">' . $row['des_edo'] . '</option>';
        }
        return $row;
    }
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function formulario_evento_disciplinas_autoctonas()
    {
        $consultaDis = mainModel::ejecutar_consulta_simple("SELECT * FROM tab_dis WHERE cod_tip_even=1");
        $row = $consultaDis->fetchAll(PDO::FETCH_ASSOC);
        foreach ($row as $row) {
            echo '
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="' . $row['des_dis'] . '" name="" value="' . $row['cod_dis'] . '" checked>
                    <label class="custom-control-label" for="' . $row['des_dis'] . '">' . $row['des_dis'] . '</label>
                </div>
                ';
        }
        return $row;
    }
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function formulario_evento_disciplinas_convencionales()
    {
        $consultaDis = mainModel::ejecutar_consulta_simple("SELECT * FROM tab_dis WHERE cod_tip_even=2");
        $row = $consultaDis->fetchAll(PDO::FETCH_ASSOC);
        foreach ($row as $row) {
            echo '
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="' . $row['des_dis'] . '" name="" value="' . $row['cod_dis'] . '" checked>
                    <label class="custom-control-label" for="' . $row['des_dis'] . '">' . $row['des_dis'] . '</label>
                </div>
                ';
        }
        return $row;
    }
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function formulario_evento_disciplinas()
    {
        $consultaDis = mainModel::ejecutar_consulta_simple("SELECT * FROM tab_dis");
        $row = $consultaDis->fetchAll(PDO::FETCH_ASSOC);
        foreach ($row as $row) {
            echo '
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="' . $row['des_dis'] . '" name="" value="' . $row['cod_dis'] . '" checked>
                    <label class="custom-control-label" for="' . $row['des_dis'] . '">' . $row['des_dis'] . '</label>
                </div>
                ';
        }
        return $row;
    }
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function tabla_evento()
    {
        $row = eventoModelo::consultar_evento();
        foreach ($row as $row) {
            echo '
        <tr>
            <td>' . $row['cod_even'] . '</td>
            <td>' . $row['des_even'] . '</td>
            <td>' . $row['fec_even'] . '</td>
            <td>' . $row['des_tip_even'] . '</td>
            <td>' . $row['des_edo'] . '</td>            
            <td>' . $row['des_estat'] . '</td>
            <td><button id="modalActivate" type="button" class="btn btn-warning btn-md" data-toggle="modal"><i class="fas fa-eye fa-2x"></i></button></td>            
            <td>
                <form class="" action="' . SERVERURL . 'editarEvento/" method="POST" data-form="borrar" enctype="multipart/form-data">
                    <input type="text" value="' . $row['cod_even'] . '" name="cod_even" hidden required>
                    <button type="submit" class="btn btn-default btn-md">
                        <i class="far fa-edit fa-2x"></i>
                    </button>
                </form>
            </td>
            <td>
                <form class="FormularioAjax" action="' . SERVERURL . 'ajax/eliminarEventoAjax.php" method="POST" data-form="borrar" enctype="multipart/form-data">
                    <input type="text" value="' . $row['cod_even'] . '" name="cod_even" hidden required>
                    <button type="submit" class="btn btn-danger btn-md">
                        <i class="far fa-trash-alt fa-2x"></i>
                    </button>
                    <div class="RespuestaAjax"></div>
                </form>
            </td>
        </tr>   
        ';
        }
    }
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function editar_evento()
    {
        $row = eventoModelo::consultar_evento();
        $consultaEvento = mainModel::ejecutar_consulta_simple("SELECT * FROM dat_even WHERE cod_even='$cod_even'");
        $row = $consultaEvento->fetchAll(PDO::FETCH_ASSOC);
         
        return $row;
    }
}
