<?php

if ($peticionAjax) {
    require_once "../models/tecnicoModelo.php";
} else {
    require_once "./models/tecnicoModelo.php";
}

class tecnicoControlador extends tecnicoModelo
{
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// //tabla personal técnico
    public function tabla_tecnico()
    {
        $n = 0;
        $row = tecnicoModelo::consultar_tecnico();
        foreach ($row as $row) {
            $n++;
            echo '
            <tr>
                <td class="text-center">' . $n . '</td>
                <td class="text-center">' . $row['ced'] . '</td>
                <td class="text-center">' . $row['nom'] . '</td>
                <td class="text-center">' . $row['ape'] . '</td>
                <td class="text-center">' . $row['des_even'] . '</td>
                <td class="text-center">' . $row['siglas'] . '</td>
                <td class="text-center">' . $row['des_carg'] . '</td>
                <td class="text-center">' . $row['des_perf'] . '</td>
                <td class="text-center">' . $row['des_estat'] . '</td>           
                <td class="text-center">
                    <form class="" action="' . SERVERURL . 'editarTecnico" method="POST" enctype="multipart/form-data">
                        <input type="text" value="' . $row['cod_par'] . '" name="cod_par" hidden required>
                        <button type="submit" class="btn btn-default btn-sm">
                            <i class="far fa-edit fa-2x"></i>
                        </button>
                    </form>    
                </td>                                                  
            </tr>';
        }
        return $row;
    }
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// //registrar personal técnico
    public function agregar_invitado_controlador()
    {
        $ced = mainModel::limpiar_cadena($_POST['ced']);
        $cod_even = mainModel::limpiar_cadena($_POST['cod_even']);
        $cod_perf = mainModel::limpiar_cadena($_POST['cod_perf']);
        $cod_inst = mainModel::limpiar_cadena($_POST['cod_inst']);
        $cod_carg = mainModel::limpiar_cadena($_POST['cod_carg']);
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
                            'Error ',
                            'Persona deshabilitada para participar',
                            'error'
                        );     
                       </script>
                    ";
            } else {
                $datosPart = [
                    'cod_per' => $cod_per,
                    'cod_even' => $cod_even,
                    'cod_perf' => $cod_perf,
                    'cod_inst' => $cod_inst,
                    'cod_carg' => $cod_carg
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
                        $registrarInvitado = tecnicoModelo::agregar_tecnico_modelo($datosPart);
                        $img = $_POST['image'];
                        $folderPath = "../views/assets/upload/";

                        $image_parts = explode(";base64,", $img);
                        $image_type_aux = explode("image/", $image_parts[0]);
                        $image_type = $image_type_aux[1];

                        $image_base64 = base64_decode($image_parts[1]);
                        $fileName = $_POST['ced'] . '.jpg';

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
                                        window.location='" . SERVERURL . "listaTecnicos/';
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
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// //validar participacion
    public function editar_tecnico_controlador()
    {
        $ced = mainModel::limpiar_cadena($_POST['ced']);
        $cod_even = mainModel::limpiar_cadena($_POST['cod_even']);
        $cod_perf = mainModel::limpiar_cadena($_POST['cod_perf']);
        $cod_inst = mainModel::limpiar_cadena($_POST['cod_inst']);
        $cod_carg = mainModel::limpiar_cadena($_POST['cod_carg']);
        $cod_estat1 = mainModel::limpiar_cadena($_POST['cod_estat']);
        $cod_par = mainModel::limpiar_cadena($_POST['cod_par']);
        $datosTecnico = [
            "ced" => $ced
        ];
        $sql = mainModel::validar_cedula_modelo($datosTecnico);
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
            $sql = mainModel::datos_persona_modelo($datosTecnico);
            foreach ($sql as $row) {
                $cod_estat = $row['cod_estat'];
                $cod_per = $row['cod_per'];
            }
            if ($cod_estat == 2) {
                echo "
                       <script>
                        Swal.fire(
                            'Error ',
                            'Persona deshabilitada para participar',
                            'error'
                        );     
                       </script>
                    ";
            } else {
                $datosPart = [
                    'cod_per' => $cod_per,
                    'cod_even' => $cod_even,
                    'cod_perf' => $cod_perf,
                    'cod_inst' => $cod_inst,
                    'cod_carg' => $cod_carg,
                    'cod_estat' => $cod_estat1,
                    'cod_par' => $cod_par
                ];
                $validarParticipacion = mainModel::validar_persona_participacion_modelo($datosPart);
                if ($validarParticipacion->rowCount() >= 2) {
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
                    $registrarInvitado = tecnicoModelo::editar_tecnico_modelo($datosPart);

                    if ($registrarInvitado->rowCount() >= 1) {
                        echo "
                                <script>
                                    Swal.fire(
                                        'Registro exitoso',
                                        'Exito al agregar la participación',
                                        'success'
                                    ).then(function(){
                                        window.location='" . SERVERURL . "listaTecnicos/';
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


    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function consultarPerfil()
    {
        $consultarPerfil = mainModel::conectar()->prepare("SELECT cod_perf,des_perf from tab_perf where cod_rol=4 ");
        $consultarPerfil->execute();
        $row = $consultarPerfil->fetchAll(PDO::FETCH_ASSOC);

        foreach ($row as $row) {
            echo '<option value="' . $row['cod_perf'] . '">' . $row['des_perf'] . '</option>';
        }


        return $row;
    }
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// //validar participacion

    public function consultarCargo()
    {

        $row = tecnicoModelo::consultaCargo();

        foreach ($row as $row) {

            echo '<option  value="' . $row['cod_carg'] . '" >' . $row['des_carg'] . '</option>';
        }

        return $row;
    }
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// //validar participacion
    public function consultarInstitucion()
    {

        $consultaInstitucion = mainModel::conectar()->prepare("SELECT * FROM tab_inst");
        $consultaInstitucion->execute();
        $row = $consultaInstitucion->fetchAll(PDO::FETCH_ASSOC);
        foreach ($row as $row) {

            echo '<option  value="' . $row['cod_inst'] . '" >' . $row['des_inst'] . '</option>';
        }

        return $row;
    }
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// //validar participacion
    public function consultarEvento()
    {
        $consultarEvento = mainModel::conectar()->prepare("SELECT * FROM dat_even WHERE cod_estat=1");
        $consultarEvento->execute();
        $row = $consultarEvento->fetchAll(PDO::FETCH_ASSOC);
        foreach ($row as $row) {
            echo '<option value="' . $row['cod_even'] . '">' . $row['des_even'] . '</option>';
        }
        return $row;
    }
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// //validar participacion
    public function formulario_editar_cedula_persona_controlador()
    {
        $cod_per = mainModel::limpiar_cadena($_POST['cod_per']);
        $datos = [
            "cod_per" => $cod_per
        ];
        $row = personaModelo::consultar_persona_modelo1($datos);
        foreach ($row as $row) {
            echo '
            <input type="text" id="ced" class="form-control" placeholder="Cédula" aria-describedby="addon-wrapping" minlength="7" maxlength="9" required pattern="[vVeE0-9]+" name="ced" value="' . $row['ced'] . '" onkeyup="javascript:this.value=this.value.toUpperCase();">                
            ';
        }
        return $row;
    }
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// //validar participacion
    public function formulario_editar_perfil_tecnico_controlador()
    {
        $cod_per = mainModel::limpiar_cadena($_POST['cod_per']);
        $datos = [
            "cod_per" => $cod_per
        ];
        $row = tecnicoModelo::consultar_persona_modelo1($datos);
        foreach ($row as $row) {
            echo '
            <input type="text" id="ced" class="form-control" placeholder="Cédula" aria-describedby="addon-wrapping" minlength="7" maxlength="9" required pattern="[vVeE0-9]+" name="ced" value="' . $row['ced'] . '" onkeyup="javascript:this.value=this.value.toUpperCase();">                
            ';
        }
        return $row;
    }
}
