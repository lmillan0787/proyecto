<?php

if ($peticionAjax) {
    require_once "../models/eventoModelo.php";
} else {
    require_once "./models/eventoModelo.php";
}

class eventoControlador extends eventoModelo
{
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //cargar tabla de evento
    public function tabla_evento_controlador()
    {
        $n = 0;
        $row = eventoModelo::consultar_tabla_evento_modelo();
        foreach ($row as $row) {
            $n++;
            echo '
        <tr>
            <td>' . $n . '</td>
            <td id="">' . $row['des_even'] . '</td>
            <td id="">' . $row['fec_even'] . '</td>
            <td id="">' . $row['des_tip_even'] . '</td>
            <td id="">' . $row['des_reg'] . '</td>            
            <td id="estatus' . $row['cod_estat'] . '">' . $row['des_estat'] . '</td>
            <td>
                <form class="" action="' . SERVERURL . 'estadisticas/" method="POST" data-form="" enctype="multipart/form-data">
                    <input type="text" value="' . $row['cod_even'] . '" name="cod_even" hidden required>
                    <input type="text" value="' . $row['des_even'] . '" name="des_even" hidden required>
                    <button type="submit" class="btn btn-warning btn-sm">
                    <i class="fas fa-chart-bar fa-2x"></i>
                    </button>
                </form>
            </td>
            <td>
                <form class="" action="' . SERVERURL . 'editarEvento/" method="POST" data-form="" enctype="multipart/form-data">
                    <input type="text" value="' . $row['cod_even'] . '" name="cod_even" hidden required>
                    <button type="submit" class="btn btn-default btn-sm">
                        <i class="far fa-edit fa-2x"></i>
                    </button>
                </form>
            </td>            
        </tr>   
        ';
        }
    }
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //agregar evento
    public function agregar_evento_controlador()
    {
        $des_even = mainModel::limpiar_cadena($_POST['des_even']);
        $fec_even = mainModel::limpiar_cadena($_POST['fec_even']);
        $cod_reg = mainModel::limpiar_cadena($_POST['cod_reg']);
        $cod_tip_even = mainModel::limpiar_cadena($_POST['cod_tip_even']);
        $datosEvento = [
            "des_even" => $des_even,
            "fec_even" => $fec_even,
            "cod_reg" => $cod_reg,
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
            $fecha_actual = date("Y-m-d");
            $fecha_actual2 = date("d-m-Y");
            if ($fec_even < $fecha_actual) {
                $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "Error en la fecha",
                    "Texto" => "Ingrese una fecha igual o superior al $fecha_actual2",
                    "Tipo" => "error"
                ];
            } else if ($fec_even > '2051-01-01') {
                $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "Error en la fecha",
                    "Texto" => "Ingrese una fecha igual o inferior al 01-01-2051",
                    "Tipo" => "error"
                ];
            } else {
                $validarEvento = eventoModelo::validar_region_modelo($datosEvento);
                if ($validarEvento->rowCount() >= 1) {

                    $alerta = [
                        "Alerta" => "simple",
                        "Titulo" => "Ya existe un evento activo en esta región",
                        "Texto" => "Seleccione otra región",
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
            }
        }
        return mainModel::sweet_alert($alerta);
    }
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //editar evento 
    public function editar_evento_controlador()
    {
        $cod_even = mainModel::limpiar_cadena($_POST['cod_even']);
        $des_even = mainModel::limpiar_cadena($_POST['des_even']);
        $fec_even = mainModel::limpiar_cadena($_POST['fec_even']);
        $cod_reg = mainModel::limpiar_cadena($_POST['cod_reg']);
        $cod_tip_even = mainModel::limpiar_cadena($_POST['cod_tip_even']);
        $cod_estat = mainModel::limpiar_cadena($_POST['cod_estat']);
        /*echo $cod_even . ' ' . $des_even . ' ' . $fec_even . ' ' . $cod_reg . ' ' . $cod_estat . ' ' . $cod_tip_even;*/
        $datosEvento = [
            "cod_even" => $cod_even,
            "des_even" => $des_even,
            "fec_even" => $fec_even,
            "cod_reg" => $cod_reg,
            "cod_tip_even" => $cod_tip_even,
            "cod_estat" => $cod_estat
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
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //validar nombre del evento
    public function validar_evento_controlador()
    {
        $des_even = mainModel::limpiar_cadena($_POST['des_even']);
        if ($_POST['des_even'] == "") { } else {
            $datosEvento = ["des_even" => $des_even];
            $validarEvento = eventoModelo::validar_evento_modelo($datosEvento);
            if ($validarEvento->rowCount() >= 1) {
                echo '<div class="alert alert-danger"><strong>Error!</strong> El nombre del evento ya está en uso</div>';
            } else { }
        }
    }
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //validar editar nombre del evento
    public function validar_evento_distinto_controlador()
    {
        $cod_even = mainModel::limpiar_cadena($_POST['cod_even']);
        $des_even = mainModel::limpiar_cadena($_POST['des_even']);
        $datosEvento = [
            "des_even" => $des_even,
            "cod_even" => $cod_even
        ];
        $validarEvento = eventoModelo::validar_evento_distinto_modelo($datosEvento);
        if ($validarEvento->rowCount() >= 1) {
            echo '<div class="alert alert-danger"><strong>Error!</strong> El nombre del evento ya está en uso</div>';
        } else { }
    }
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //validar fecha evento
    public function validar_fecha_controlador()
    {
        $fec_even = mainModel::limpiar_cadena($_POST['fec_even']);
        $fecha_actual = date("Y-m-d");
        $fecha_actual2 = date("d-m-Y");
        if ($fec_even < $fecha_actual) {
            echo '<div class="alert alert-danger"><strong>Error!</strong> La fecha mínima para registrar el evento es ' . $fecha_actual2 . '</div>';
        } else if ($fec_even > '2051-01-01') {
            echo '<div class="alert alert-danger"><strong>Error!</strong> La fecha maxima para registrar el evento es 01-01-2051</div>';
        } else { }
    }
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //validar fecha evento
    public function validar_fecha_distinta_controlador()
    {

        $fec_form = mainModel::limpiar_cadena($_POST['fec_even']);
        $cod_even = mainModel::limpiar_cadena($_POST['cod_even']);
        $datosEvento = [
            "cod_even" => $cod_even
        ];

        $row = eventoModelo::consultar_editar_evento_modelo($datosEvento);
        foreach ($row as $row) {
            $fecha_actual = date("d-m-Y");
            $fec_even = $row['fec_even'];
            if ($fec_even < $fecha_actual) {
                $fecha_minima = $fec_even;
            } else {
                $fecha_minima = date("Y-m-d");
            }
            if ($fec_form < $fecha_minima) {
                echo '<div class="alert alert-danger"><strong>Error!</strong> La fecha mínima para registrar el evento es ' . $fecha_minima . '</div>';
            } else if ($fec_form > '2051-01-01') {
                echo '<div class="alert alert-danger"><strong>Error!</strong> La fecha maxima para registrar el evento es 01-01-2051</div>';
            } else { }
        }
    }
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //validar región evento
    public function validar_region_controlador()
    {
        $cod_reg = mainModel::limpiar_cadena($_POST['cod_reg']);
        $datosEvento = ["cod_reg" => $cod_reg];
        $validarEvento = eventoModelo::validar_region_modelo($datosEvento);
        if ($validarEvento->rowCount() >= 1) {
            echo '<div class="alert alert-danger"><strong>Error!</strong> Ya existe un evento activo en esta región</div>';
        } else { }
    }
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //validar region editar
    public function validar_region_estatus_controlador()
    {
        $cod_even = mainModel::limpiar_cadena($_POST['cod_even']);
        $cod_reg = mainModel::limpiar_cadena($_POST['cod_reg']);
        $datosEvento = [
            "cod_even" => $cod_even,
            "cod_reg" => $cod_reg,
        ];
        $row = eventoModelo::consultar_editar_evento_modelo($datosEvento);
        foreach ($row as $row) {
            $cod_estat = $row['cod_estat'];
            if ($cod_estat == 1) { } else { }
        }
    }
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
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
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //editar fecha formulario
    public function formulario_editar_fecha_evento_controlador()
    {
        $cod_even = mainModel::limpiar_cadena($_POST['cod_even']);
        $datosEvento = [
            "cod_even" => $cod_even
        ];

        $row = eventoModelo::consultar_editar_evento_modelo($datosEvento);

        foreach ($row as $row) {
            $fec_even = $row['fec_even'];
            $fecha_actual = date("Y-m-d");
            if ($fec_even < $fecha_actual) {
                $fecha_minima = $fec_even;
            } else {
                $fecha_minima = $fecha_actual;
            }
            echo '
            <input type="date" class="form-control" placeholder="Fecha del evento" aria-label="Username" aria-describedby="addon-wrapping" min="' . $fecha_minima . '" max="2051-01-01" step="1" name="fec_even" id="fec_even" required value="' . $row['fec_even'] . '">
            ';
        }
        return $row;
    }
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //editar  region formulario
    public function formulario_editar_region_evento_controlador()
    {
        $cod_even = mainModel::limpiar_cadena($_POST['cod_even']);
        $datosEvento = [
            "cod_even" => $cod_even
        ];
        $row = eventoModelo::consultar_editar_evento_modelo($datosEvento);
        foreach ($row as $row) {
            echo '
            <option value="' . $row['cod_reg'] . '" selected>' . $row['des_reg'] . '</option>
            ';
        }
        return $row;
    }
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
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
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //editar tipo de evento formulario
    public function formulario_editar_tipo_evento_controlador()
    {
        $cod_even = mainModel::limpiar_cadena($_POST['cod_even']);
        $datosEvento = [
            "cod_even" => $cod_even
        ];
        $row = eventoModelo::consultar_editar_evento_modelo($datosEvento);
        foreach ($row as $row) {
            echo '
            <option selected value="' . $row['cod_tip_even'] . '" selected>' . $row['des_tip_even'] . '</option>
            ';
        }
        return $row;
    }

    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //consultar region
    public function formulario_evento_region()
    {
        $Reg = mainModel::consultar_region_modelo();
        foreach ($Reg as $row) {
            echo '<option value="' . $row['cod_reg'] . '">' . $row['des_reg'] . '</option>';
        }
        return $row;
    }
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //consultar region distinta
    public function formulario_evento_region_distinta()
    {
        $cod_even = mainModel::limpiar_cadena($_POST['cod_even']);
        $datosEvento = [
            "cod_even" => $cod_even
        ];
        $row = eventoModelo::consultar_editar_evento_modelo($datosEvento);
        foreach ($row as $row) {
            $cod_reg = $row['cod_reg'];
            $datosEvento = [
                "cod_reg" => $cod_reg
            ];
            $row = mainModel::consultar_region_distinta_modelo($datosEvento);
            foreach ($row as $row) {
                echo '<option value="' . $row['cod_reg'] . '">' . $row['des_reg'] . '</option>';
            }
        }
        return $row;
    }
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
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
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //consultar estatus distinta
    public function formulario_evento_estatus_distinta()
    {
        $cod_even = mainModel::limpiar_cadena($_POST['cod_even']);
        $datosEvento = [
            "cod_even" => $cod_even
        ];
        $row = eventoModelo::consultar_editar_evento_modelo($datosEvento);
        foreach ($row as $row) {
            $cod_estat = $row['cod_estat'];
            $datosEvento = [
                "cod_estat" => $cod_estat
            ];
            $row = mainModel::consultar_estatus_distinto($datosEvento);
            foreach ($row as $row) {
                echo '<option value="' . $row['cod_estat'] . '">' . $row['des_estat'] . '</option>';
            }
        }
        return $row;
    }
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //consultar evento tipo
    public function formulario_evento_tipo()
    {
        $Reg = eventoModelo::consultar_tipo_evento_modelo();
        foreach ($Reg as $row) {
            echo '<option value="' . $row['cod_tip_even'] . '">' . $row['des_tip_even'] . '</option>';
        }
        return $row;
    }
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //consultar evento distinto tipo
    public function formulario_evento_tipo_distinto()
    {
        $cod_even = mainModel::limpiar_cadena($_POST['cod_even']);
        $datosEvento = [
            "cod_even" => $cod_even
        ];
        $row = eventoModelo::consultar_editar_evento_modelo($datosEvento);
        foreach ($row as $row) {
            $cod_tip_even = $row['cod_tip_even'];
            $datosEvento = [
                "cod_tip_even" => $cod_tip_even
            ];
            $row = eventoModelo::consultar_tipo_evento_distinto_modelo($datosEvento);
            foreach ($row as $row) {
                echo '<option value="' . $row['cod_tip_even'] . '">' . $row['des_tip_even'] . '</option>';
            }
        }
        return $row;
    }
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //consultar eventos activos
    public function consultar_evento_activo()
    {
        $row = eventoModelo::consultar_evento_activo_modelo();
        foreach ($row as $row) {
            echo '
                <form class="dropdown-item" action="' . SERVERURL . 'participacion/" method="POST" data-form="" enctype="multipart/form-data">
                    <input type="text" value="' . $row['cod_even'] . '" name="cod_even" hidden required>
                    <button  type="submit" class="btn btn-default even" value="">' . $row['des_even'] . '</button>
                </form>
            ';
        }
        return $row;
    }
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //eliminar evento
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
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //editar evento formulario
    public function cabecera_nombre_evento_controlador($datos)
    {
        $cod_even = mainModel::limpiar_cadena($datos['cod_even']);
        $datosEvento = [
            "cod_even" => $cod_even
        ];
        $row = eventoModelo::consultar_editar_evento_modelo($datosEvento);
        foreach ($row as $row) {
            echo $row['des_even'];
        }
        return $row;
    }
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //consultar eventos activos
    public function boton_credenciales($datos)
    {
        $cod_even = mainModel::limpiar_cadena($datos['cod_even']);
        echo '<form action="'.SERVERURL.'ajax/credencialesFpdfAjax.php" method="POST" target="_blank" rel="noopener noreferrer">                            
                <input type="text" name="cod_even" value="' . $cod_even . '" hidden>                 
                <button type="submit" class="btn btn-warning ">Credenciales</button>
            </form>';
    }
}
