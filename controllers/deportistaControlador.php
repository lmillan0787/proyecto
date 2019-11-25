<?php

if ($peticionAjax) {
    require_once "../models/deportistaModelo.php";
} else {
    require_once "./models/deportistaModelo.php";
}

class deportistaControlador extends deportistaModelo
{
    public function agregar_deportista_controlador()
    {
        $ced = mainModel::limpiar_cadena($_POST['ced']);
        $cod_even = mainModel::limpiar_cadena($_POST['cod_even']);
        $cod_perf = mainModel::limpiar_cadena($_POST['cod_perf']);
        $cod_pue = mainModel::limpiar_cadena($_POST['cod_pue']);
        $cod_reg = mainModel::limpiar_cadena($_POST['cod_reg']);
        $cod_dis = mainModel::limpiar_cadena($_POST['cod_dis']);
        $cod_cat = mainModel::limpiar_cadena($_POST['cod_cat']);
        /*echo $ced . ' ' . $cod_even . ' ' . $cod_perf . ' ' . $cod_pue . ' ' . $cod_reg . ' ' . $cod_dis . ' ' . $cod_cat;*/
        $datos = [
            "ced" => $ced,
            "cod_even" => $cod_even,
            "cod_perf" => $cod_perf
        ];
        $sql = mainModel::validar_cedula_modelo($datos);
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
            $sql = mainModel::datos_persona_modelo($datos);
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
                    'cod_reg' => $cod_reg,
                    'cod_pue' => $cod_pue,
                    'cod_dis' => $cod_dis,
                    'cod_cat' => $cod_cat
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
                        $registrarDeportista = deportistaModelo::agregar_deportista($datosPart);
                        $img = strtolower($_POST['image']);
                        $folderPath = "../views/assets/upload/";

                        $image_parts = explode(";base64,", $img);
                        $image_type_aux = explode("image/", $image_parts[0]);
                        $image_type = $image_type_aux[1];

                        $image_base64 = base64_decode($image_parts[1]);
                        $fileName = $_POST['ced'] . '.jpg';

                        $file = $folderPath . $fileName;
                        file_put_contents($file, $image_base64);
                        if ($registrarDeportista->rowCount() >= 1) {
                            echo "
                                <script>
                                    Swal.fire(
                                        'Registro exitoso',
                                        'Exito al agregar la participación',
                                        'success'
                                    ).then(function(){
                                        window.location='" . SERVERURL . "listaDeportistas/';
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
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function tabla_deportista()
    {
        $n = 0;
        $row = deportistaModelo::consultar_deportista();
        foreach ($row as $row) {
            $n++;
            echo '
            <tr>
                    <td class="text-center">' . $n . '</td>
                    <td class="text-center">' . $row['ced'] . '</td> 
                    <td class="text-center">' . $row['nom'] . '</td>
                    <td class="text-center">' . $row['ape'] . '</td>
                    <td class="text-center">' . $row['des_even'] . '</td>
                    <td class="text-center">' . $row['des_reg'] . '</td>
                    <td class="text-center">' . $row['des_pue'] . '</td>
                    <td class="text-center">' . $row['des_dis'] . '</td>
                    <td class="text-center">' . $row['des_cat'] . '</td>
                    <td class="text-center">
                    <form class="" action="' . SERVERURL . 'editarDeportista" method="POST" enctype="multipart/form-data">
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

    public function consultarRegion()
    {
        $consultaRegion = mainModel::conectar()->prepare("SELECT * FROM tab_reg ");
        $consultaRegion->execute();
        $row = $consultaRegion->fetchAll(PDO::FETCH_ASSOC);
        foreach ($row as $row) {
            echo '<option value="' . $row['cod_reg'] . '">' . $row['des_reg'] . '</option>';
        }

        return $row;
    }

    public function consultarPueblo()
    {
        $consultarPueblo = mainModel::conectar()->prepare("SELECT * FROM tab_pue ");
        $consultarPueblo->execute();
        $row = $consultarPueblo->fetchAll(PDO::FETCH_ASSOC);

        foreach ($row as $row) {
            echo '<option value="' . $row['cod_pue'] . '">' . $row['des_pue'] . '</option>';
        }
        return $row;
    }

    public function consultarPerfil()
    {
        $consultarPerfil = mainModel::conectar()->prepare("SELECT cod_perf,des_perf FROM tab_perf ");
        $consultarPerfil->execute();
        $row = $consultarPerfil->fetchAll(PDO::FETCH_ASSOC);
        echo '<select name="cod_perf" id="selperf" class="form-control">';
        foreach ($row as $row) {
            echo '<option value="' . $row['cod_perf'] . '">' . $row['des_perf'] . '</option>';
        }

        echo '</select>';
    }

    public function consultarRol()
    {
        $consultarRol = mainModel::conectar()->prepare("SELECT cod_rol,des_rol FROM tab_rol ");
        $consultarRol->execute();
        $row = $consultarRol->fetchAll(PDO::FETCH_ASSOC);
        echo '<select name="cod_rol" id="selrol" class="form-control">';
        foreach ($row as $row) {
            echo '<option value="' . $row['cod_rol'] . '">' . $row['des_rol'] . '</option>';
        }

        echo '</select>';
    }

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


    public function consultarDisciplina()
    {
        $consultarDisciplina = mainModel::conectar()->prepare("SELECT cod_dis,des_dis FROM tab_dis ");
        $consultarDisciplina->execute();
        $row = $consultarDisciplina->fetchAll(PDO::FETCH_ASSOC);

        foreach ($row as $row) {
            echo '<option value="' . $row['cod_dis'] . '">' . $row['des_dis'] . '</option>';
        }
        return $row;
    }


    public function consultarCategoria()
    {
        $consultarCategoria = mainModel::conectar()->prepare("SELECT cod_cat,des_cat FROM tab_cat ");
        $consultarCategoria->execute();
        $row = $consultarCategoria->fetchAll(PDO::FETCH_ASSOC);

        foreach ($row as $row) {
            echo '<option value="' . $row['cod_cat'] . '">' . $row['des_cat'] . '</option>';
        }

        return $row;
    }
}
