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
    //editar evento formulario
    public function formulario_editar_evento_controlador()
    {
        $cod_even = mainModel::limpiar_cadena($_POST['cod_even']);
        $datosEvento = [
            "cod_even" => $cod_even
        ];
        $cosultarEdo = mainModel::consultar_estado_modelo();
        $row = eventoModelo::consultar_editar_evento_modelo($datosEvento);
        foreach ($row as $row) {
            echo '
            <div class="card" id="form_evento">
                <h5 class="card-header info-color white-text text-center py-4">
                    <strong>Datos Básicos del Evento</strong>
                </h5>
                <!--Formulario de inicio-->
                <div class="card-body px-lg-5">
                    <form class="FormularioAjax" action="'.SERVERURL.'ajax/registrarEventoAjax.php" method="POST"
                        data-form="guardar" autocomplete="off" enctype="multipart/form-data">
                        <div class="text-center">
                        </div>
                        <!-- Nombre del Evento-->
                        <label for="textInput">Nombre del evento:</label>
                        <div class="input-group flex-nowrap">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="addon-wrapping"><i class="fas fa-user prefix grey-text"></i></span>
                            </div>
                            <input onkeyup="javascript:this.value=this.value.toUpperCase();" type="text" class="form-control"
                                placeholder="Nombre del Evento" aria-describedby="addon-wrapping" minlength="2" maxlength="20" required
                                pattern="[A-Za-zñÑáéíóúÁÉÍÓÚöÖüÜ\s0-9]+" name="des_even" required id="des_even" value="'.$row['des_even'].'">
                        </div>
                        <div id="result-even"></div>
                        <!-- Fecha del evento-->
                        <label for="textInput">Fecha del evento:</label>
                        <div class="input-group flex-nowrap">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="addon-wrapping"><i
                                        class="far fa-calendar-alt prefix grey-text"></i></span>
                            </div>
                            <input type="date" class="form-control" placeholder="Fecha del evento" aria-label="Username"
                                aria-describedby="addon-wrapping" min="'.$row['fec_even'].'" max="2050-01-01" step="1" name="fec_even" required value="'.$row['fec_even'].'">
                        </div>
                        <!-- Estado-->
                        <label for="textInput">Estado:</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <label class="input-group-text" for="inputGroupSelect01"><i
                                        class="fas fa-globe-americas prefix grey-text"></i></label>
                            </div>
                            <select class="browser-default custom-select" id="inputGroupSelect01" id="cod_edo" name="cod_edo" required>
                                <option value="'.$row['cod_edo'].'" selected>'.$row['des_edo'].'</option>                              
                            </select>
                        </div>
                        <!-- Estatus-->
                        <label for="textInput">Estatus:</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <label class="input-group-text" for="inputGroupSelect01"><i
                                        class="fas fa-toggle-on prefix grey-text"></i></label>
                            </div>
                            <select class="browser-default custom-select" id="inputGroupSelect01" id="cod_estar" name="cod_estat"
                                required>
                                <option value="'.$row['cod_estat'].'" selected>'.$row['des_estat'].'</option>
                            </select>
                        </div>
                        <!-- Tipo de evento-->
                        <br><b><label for="textInput">Tipo de evento:</label></b><br>
                        <center>
                            <!-- Group of default radios - option 1 -->
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input " id="aut" onclick="toggle(this)" name="cod_tip_even"
                                    value="1" required>
                                <label class="custom-control-label" for="aut">Autóctono</label>
                            </div>
                            <!-- Group of default radios - option 2 -->
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input " id="con" onclick="toggle(this)" name="cod_tip_even"
                                    value="2" required>
                                <label class="custom-control-label" for="con">Convencional</label>
                            </div>
                            <!-- Group of default radios - option 3 -->
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input " id="mix" onclick="toggle(this)" name="cod_tip_even"
                                    value="3" required>
                                <label class="custom-control-label" for="mix">Mixto</label>
                            </div>
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
    public function formulario_evento_estatus()
    {
    $consultaEdo = mainModel::ejecutar_consulta_simple("SELECT * FROM tab_estat");
    $row = $consultaEdo->fetchAll(PDO::FETCH_ASSOC);
    foreach ($row as $row) {

    echo '<option value="' . $row['cod_estat'] . '">' . $row['des_estat'] . '</option>';
    }
    return $row;
    }
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function formulario_editar_evento()
    {
    $cod_even = mainModel::limpiar_cadena($_POST['cod_even']);

    $consultaEvento = mainModel::ejecutar_consulta_simple("SELECT * FROM dat_even WHERE cod_per=$cod_even");
    $row = $consultaEvento->fetchAll(PDO::FETCH_ASSOC);

    foreach ($row as $row) {

    echo '

    <div class="card" id="form_evento">
        <h5 class="card-header info-color white-text text-center py-4">
            <strong>Datos Básicos del Evento</strong>
        </h5>
        <!--Formulario de inicio-->
        <div class="card-body px-lg-5">
            <form class="FormularioAjax" action="<?php echo SERVERURL ?>ajax/registrarEventoAjax.php" method="POST"
                data-form="guardar" autocomplete="off" enctype="multipart/form-data">
                <div class="text-center">
                </div>
                <!-- Nombre del Evento-->
                <label for="textInput">Nombre del evento:</label>
                <div class="input-group flex-nowrap">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="addon-wrapping"><i
                                class="fas fa-user prefix grey-text"></i></span>
                    </div>
                    <input onkeyup="javascript:this.value=this.value.toUpperCase();" type="text" class="form-control"
                        placeholder="Nombre del Evento" aria-describedby="addon-wrapping" minlength="2" maxlength="20"
                        required pattern="[A-Za-zñÑáéíóúÁÉÍÓÚöÖüÜ\s0-9]+" name="des_even" required>
                </div>
                <!-- Fecha del evento-->
                <label for="textInput">Fecha del evento:</label>
                <div class="input-group flex-nowrap">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="addon-wrapping"><i
                                class="far fa-calendar-alt prefix grey-text"></i></span>
                    </div>
                    <input type="date" class="form-control" placeholder="Fecha del evento" aria-label="Username"
                        aria-describedby="addon-wrapping" min="2019-01-01" max="2050-01-01" step="1" name="fec_even"
                        required>
                </div>
                <!-- Estado-->
                <label for="textInput">Estado:</label>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <label class="input-group-text" for="inputGroupSelect01"><i
                                class="fas fa-globe-americas prefix grey-text"></i></label>
                    </div>
                    <select class="browser-default custom-select" id="inputGroupSelect01" id="cod_edo" name="cod_edo"
                        required>
                        <option selected disabled>Estado</option>
                    </select>
                </div>
                <!-- Estatus-->
                <label for="textInput">Estatus:</label>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <label class="input-group-text" for="inputGroupSelect01"><i
                                class="fas fa-globe-americas prefix grey-text"></i></label>
                    </div>
                    <select class="browser-default custom-select" id="inputGroupSelect01" id="cod_estar" name="cod_estat"
                        required>
                        <option selected disabled>Estatus</option>
                    </select>
                </div>
                <!-- Tipo de evento-->
                <label for="textInput">Tipo de evento:</label><br>
                <!-- Group of default radios - option 1 -->
                <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" class="custom-control-input " id="aut" name="cod_tip_even" value="1" required>
                    <label class="custom-control-label" for="aut">Autóctono</label>
                </div>
                <!-- Group of default radios - option 2 -->
                <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" class="custom-control-input " id="con" name="cod_tip_even" value="2" required>
                    <label class="custom-control-label" for="con">Convencional</label>
                </div>
                <!-- Group of default radios - option 3 -->
                <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" class="custom-control-input " id="mix" name="cod_tip_even" value="3" required>
                    <label class="custom-control-label" for="mix">Mixto</label>
                </div>
                <p><button class="btn btn-info btn-block" type="submit">Registrar</button></p>
                <div class="RespuestaAjax"></div>
            </form>
        </div>
    </div>';
    }
    return $row;
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    }
}