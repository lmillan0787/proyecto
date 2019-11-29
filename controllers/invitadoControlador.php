<?php

if ($peticionAjax) {
    require_once "../models/invitadoModelo.php";
} else {
    require_once "./models/invitadoModelo.php";
}

class invitadoControlador extends invitadoModelo
{
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //inviados tabla
    public function tabla_invitado_controlador()
    {
        $n = 0;
        $row = invitadoModelo::consultar_invitado_modelo();
        foreach ($row as $row) {
            $n++;
            echo '
                <tr>
                    <td class="text-center">' . $n . '</td>
                    <td class="text-center">' . $row['ced'] . '</td>
                    <td class="text-center">' . $row['nom'] . '</td>
                    <td class="text-center">' . $row['ape'] . '</td>
                    <td class="text-center">' . $row['des_even'] . '</td>
                    <td class="text-center">' . $row['des_perf'] . '</td>
                    <td class="text-center">' . $row['des_estat'] . '</td>
                    <td class="text-center">
                        <form class="" action="' . SERVERURL . 'editarInvitado" method="POST" enctype="multipart/form-data">
                            <input type="text" value="' . $row['cod_par'] . '" name="cod_par" hidden required>
                            <button type="submit" class="btn btn-default btn-sm">
                                <i class="far fa-edit fa-2x"></i>
                            </button>
                        </form>    
                    </td>                                                      
                </tr>';
        }
    }
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //registrar invitado
    public function agregar_invitado_controlador()
    {
        $ced = mainModel::limpiar_cadena($_POST['ced']);
        $cod_even = mainModel::limpiar_cadena($_POST['cod_even']);
        $cod_perf = mainModel::limpiar_cadena($_POST['cod_perf']);
        $datosInvitado = [
            "ced" => $ced,
            "cod_eeven" => $cod_even,
            "cod_perf" => $cod_perf
        ];
        $sql = mainModel::validar_cedula_modelo($datosInvitado);
        if ($sql->rowCount() == 0) {
            echo "<script>
                        Swal.fire({
                            title: 'La cédula que intenta ingresar no existe',
                            text: '¿Desea registrar a la persona?',
                            type: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Si Registrar'
                        }).then((result) => {
                            if (result.value) {
                                window.location='" . SERVERURL . "registrarPersona/';
                            }
                        })
                    </script>
                ";
        } else {
            $sql = mainModel::datos_persona_modelo($datosInvitado);
            foreach ($sql as $row) {
                $cod_estat = $row['cod_estat'];
                $cod_per = $row['cod_per'];
            }
            if ($cod_estat == 2) {
                echo "
                       <script>
                        Swal.fire(
                            'Persona deshabilitada para participar ',
                            'Ingrese otro número de cédula',
                            'error'
                        );     
                       </script>
                    ";
            } else {
                $img = $_POST['image'];
                $datosPart = [
                    'cod_per' => $cod_per,
                    'cod_even' => $cod_even,
                    'cod_perf' => $cod_perf,
                    'foto' => $img
                ];
                $validarParticipacion = mainModel::validar_persona_participacion_modelo($datosPart);
                if ($validarParticipacion->rowCount() >= 1) {

                    echo "
                            <script>
                            Swal.fire(
                                'La persona ya posee participación para este evento',
                                'Dirijase al módulo de participaciones para editar o seleccione un evento diferente',
                                'error'
                            );     
                            </script>
                        ";
                } else {

                    if ($_POST['image'] == "") {
                        echo "
                            <script>
                                Swal.fire(
                                    'Falta capturar la foto',
                                    'Debe capturar la foto del participante ',
                                    'error'
                                );     
                            </script>
                            ";
                    } else {


                        $registrarInvitado = invitadoModelo::agregar_invitado($datosPart);

                        $folderPath = "../views/assets/upload/";

                        $image_parts = explode(";base64,", $img);
                        $image_type_aux = explode("image/", $image_parts[0]);
                        $image_type = $image_type_aux[1];

                        $image_base64 = base64_decode($image_parts[1]);
                        $fileName = $_POST['ced'].$cod_even.'.jpg';

                        $file = $folderPath . $fileName;
                        file_put_contents($file, $image_base64);
                        if ($registrarInvitado->rowCount() >= 1) {
                            echo "
                                <script>
                                    Swal.fire(
                                        'Registro exitoso',
                                        'Exito al agregar la participación',
                                        'success'
                                    ).then(function(){
                                        window.location='" . SERVERURL . "listaInvitados/';
                                    });     
                                </script>
                            ";
                        } else {
                            echo "
                                <script>
                                    Swal.fire(
                                        'Error inesperado',
                                        'Recargue la pagina e intente de nuevo',
                                        'error'
                                    );     
                                </script>
                            ";
                        }
                    }
                }
            }
        }
    }
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function editar_invitado_controlador()
    {
        $cod_par = mainModel::limpiar_cadena($_POST['cod_par']);
        $ced = mainModel::limpiar_cadena($_POST['ced']);
        $cod_even = mainModel::limpiar_cadena($_POST['cod_even']);
        $cod_perf = mainModel::limpiar_cadena($_POST['cod_perf']);
        $cod_estat = mainModel::limpiar_cadena($_POST['cod_estat']);
        $datos = [
            "ced" => $ced
        ];
        $ced = str_replace(' ', '', $ced);
        if (strlen($ced) < 8) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Debe ingresar un número de cédula válido",
                "Texto" => "Mínimo 6 dígitos, máximo 8 dígitos",
                "Tipo" => "error"
            ];
        } else {
            $sql = mainModel::datos_persona_modelo($datos);
            foreach ($sql as $row) {
                $cod_per = $row['cod_per'];
            }
            $sql = mainModel::validar_estatus_persona($datos);
            if ($sql->rowCount() >= 1) {
                $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "La persona ya posee una participación activa para este evento",
                    "Texto" => "",
                    "Tipo" => "error"
                ];
            } else {
                $hora = time();
                $img1 = $hora . $_POST['image'];
                $img = $_POST['image'];
                $datos = [
                    "cod_par" => $cod_par,
                    "cod_per" => $cod_per,
                    "cod_even" => $cod_even,
                    "cod_perf" => $cod_perf,
                    "cod_estat" => $cod_estat
                ];
                $sql = mainModel::validar_persona_participacion_distinta_modelo($datos);
                if ($sql->rowCount() >= 1) {
                    $alerta = [
                        "Alerta" => "simple",
                        "Titulo" => "La persona ya posee una participación activa para este evento",
                        "Texto" => "",
                        "Tipo" => "error"
                    ];
                } else {
                    if ($_POST['image'] == "") {
                        $datos = [
                            "cod_par" => $cod_par,
                            "cod_per" => $cod_per,
                            "cod_even" => $cod_even,
                            "cod_perf" => $cod_perf,
                            "cod_estat" => $cod_estat,
                            "foto" => "0"
                        ];
                        $sql = invitadoModelo::editar_invitado_modelo($datos);
                        if($sql->rowCount() >= 1){
                            $alerta = [
                                "Alerta" => "simpleInvitado",
                                "Titulo" => "Actualización exitosa",
                                "Texto" => "",
                                "Tipo" => "success"
                            ];
                        }else{
                            $alerta = [
                                "Alerta" => "simple",
                                "Titulo" => "Ningún cambio realizado",
                                "Texto" => "Recargue la página e intente de nuevo",
                                "Tipo" => "error"
                            ];
                        }
                    } else {
                        $hora = time();
                        $img1 = $hora . $_POST['image'];
                        $img = $_POST['image'];
                        $datos = [
                            "cod_par" => $cod_par,
                            "cod_per" => $cod_per,
                            "cod_even" => $cod_even,
                            "cod_perf" => $cod_perf,
                            "cod_estat" => $cod_estat,
                            "foto" => $img1
                        ];
                        $folderPath = "../views/assets/upload/";
                        $image_parts = explode(";base64,", $img);
                        $image_type_aux = explode("image/", $image_parts[0]);
                        $image_type = $image_type_aux[1];
                        $image_base64 = base64_decode($image_parts[1]);
                        $fileName = $_POST['ced'].$cod_even.'.jpg';
                        $file = $folderPath . $fileName;
                        file_put_contents($file, $image_base64);
                        $sql = invitadoModelo::editar_invitado_modelo($datos);
                        if($sql->rowCount() >= 1){
                            $alerta = [
                                "Alerta" => "simpleInvitado",
                                "Titulo" => "Actualización exitosa",
                                "Texto" => "",
                                "Tipo" => "success"
                            ];
                        }else{
                            $alerta = [
                                "Alerta" => "simple",
                                "Titulo" => "Ningún cambio realizado",
                                "Texto" => "Recargue la página e intente de nuevo",
                                "Tipo" => "error"
                            ];
                        }
                    }
                }
            }
        }
        return mainModel::sweet_alert($alerta);
    }
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function consultarRegion()
    {
        $consultaRegion = mainModel::conectar()->prepare("SELECT * from tab_reg ");
        $consultaRegion->execute();
        $row = $consultaRegion->fetchAll(PDO::FETCH_ASSOC);
        echo '<select name="cod_reg" id="cod_reg" class="form-control">';
        foreach ($row as $row) {
            echo '<option value="' . $row['cod_reg'] . '">' . $row['des_reg'] . '</option>';
        }

        echo '</select>';
    }
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function consultarPerfil()
    {
        $consultarPerfil = mainModel::ejecutar_consulta_simple("SELECT cod_perf,des_perf FROM tab_perf where cod_rol=5 ");
        $row = $consultarPerfil->fetchAll(PDO::FETCH_ASSOC);
        foreach ($row as $row) {
            echo '<option value="' . $row['cod_perf'] . '">' . $row['des_perf'] . '</option>';
        }
        return $row;
    }
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function consultarEvento()
    {
        $consultarEvento = mainModel::ejecutar_consulta_simple("SELECT * FROM dat_even WHERE cod_estat='1'");
        $row = $consultarEvento->fetchAll(PDO::FETCH_ASSOC);
        foreach ($row as $row) {
            echo '<option value="' . $row['cod_even'] . '">' . $row['des_even'] . '</option>';
        }
        return $row;
    }
}
