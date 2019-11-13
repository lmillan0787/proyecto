<?php

if ($peticionAjax) {
    require_once "../models/medicoModelo.php";
} else {
    require_once "./models/medicoModelo.php";
}

class medicoControlador extends medicoModelo
{

    public function agregar_medico_controlador()
    {
        $ced = mainModel::limpiar_cadena($_POST['ced']);
        $cod_even = mainModel::limpiar_cadena($_POST['cod_even']);
        $cod_perf = mainModel::limpiar_cadena($_POST['cod_perf']);
        $cod_pue = mainModel::limpiar_cadena($_POST['cod_pue']);
        $cod_reg = mainModel::limpiar_cadena($_POST['cod_reg']);
        $cod_dis = mainModel::limpiar_cadena($_POST['cod_dis']);
        $cod_cat = mainModel::limpiar_cadena($_POST['cod_cat']);
        /*echo $ced . ' ' . $cod_even . ' ' . $cod_perf . ' ' . $cod_pue . ' ' . $cod_reg . ' ' . $cod_dis . ' ' . $cod_cat;*/

        $validarCedula = mainModel::validar_cedula_modelo($ced);

        if ($validarCedula->rowCount() == 0) {
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
            
            </script>";
        } else {
            $row = mainModel::validar_persona_modelo($ced);
            foreach ($row as $row) {
                $cod_per = $row['cod_per'];
            }
            $datosPart = [
                'cod_per' => $cod_per,
                'cod_even' => $cod_even,
                'cod_perf' => $cod_perf,
                'cod_reg' => $cod_reg,
                'cod_pue' => $cod_pue,
                'cod_dis' => $cod_dis,
                'cod_cat' => $cod_cat
            ];
            $validarParticipacion = mainModel::validar_participacion_modelo($datosPart);
            if ($validarParticipacion->rowCount() >= 1) {
                echo "
               <script>
               Swal.fire(
                'La persona ya posee participacion para este evento',
                'Dirijase al módulo de participaciones para editar o seleccione otro evento disponible',
                'error'
               );  
               </script>
               ";
            } else {
                $registrarMedico = medicoModelo::agregar_medico($datosPart);
                if ($_POST['image'] != "") {
                    $img = $_POST['image'];
                    $folderPath = "../views/assets/upload/";

                    $image_parts = explode(";base64,", $img);
                    $image_type_aux = explode("image/", $image_parts[0]);
                    $image_type = $image_type_aux[1];

                    $image_base64 = base64_decode($image_parts[1]);
                    $fileName = $_POST['ced'] . '.jpg';

                    $file = $folderPath . $fileName;
                    file_put_contents($file, $image_base64);

                    if ($registrarMedico->rowCount() >= 1) {
                        echo "
               <script>
               Swal.fire(
                'Registro exitoso',
                'Exito al agregar la participación',
                'success'
               ).then(function(){
                window.location='" . SERVERURL . "medicos/';
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
                } else {
                    echo "
               <script>
               Swal.fire(
                'Falta capturar la foto',
                'Debe capturar la foto del participante ',
                'error'
               );     
               
               </script>
               ";
                }
            }
        }
    }

    public function tabla_medico()
    {
        $n=0;
        $row = medicoModelo::consultar_medico();
        foreach ($row as $row) {
            $n++;
            echo '
            <tr>
                    <td>' . $n . '</td>
                    <td>' . $row['ced'] . '</td>
                    <td>' . $row['nom'] . '</td>
                    <td>' . $row['ape'] . '</td>
                    <td>' . $row['des_even'] . '</td>
                    <td>' . $row['des_reg'] . '</td>
                    <td>
                        <form class="" action="' . SERVERURL . 'editarMedico" method="POST" enctype="multipart/form-data">
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

    public function consultarRegion()
    {
        $consultaRegion = mainModel::conectar()->prepare("SELECT * from tab_reg ");
        $consultaRegion->execute();
        $row = $consultaRegion->fetchAll(PDO::FETCH_ASSOC);

        foreach ($row as $row) {
            echo '<option value="' . $row['cod_reg'] . '">' . $row['des_reg'] . '</option>';
        }

        return $row;
    }

    public function consultarPueblo()
    {
        $consultarPueblo = mainModel::conectar()->prepare("SELECT * from tab_pue ");
        $consultarPueblo->execute();
        $row = $consultarPueblo->fetchAll(PDO::FETCH_ASSOC);

        foreach ($row as $row) {
            echo '<option value="' . $row['cod_pue'] . '">' . $row['des_pue'] . '</option>';
        }
        return $row;
    }

    public function consultarPerfil()
    {
        $consultarPerfil = mainModel::conectar()->prepare("SELECT cod_perf,des_perf from tab_perf ");
        $consultarPerfil->execute();
        $row = $consultarPerfil->fetchAll(PDO::FETCH_ASSOC);

        foreach ($row as $row) {
            echo '<option value="' . $row['cod_perf'] . '">' . $row['des_perf'] . '</option>';
        }

        return $row;
    }

    public function consultarRol()
    {
        $consultarRol = mainModel::conectar()->prepare("SELECT cod_rol,des_rol from tab_rol ");
        $consultarRol->execute();
        $row = $consultarRol->fetchAll(PDO::FETCH_ASSOC);

        foreach ($row as $row) {
            echo '<option value="' . $row['cod_rol'] . '">' . $row['des_rol'] . '</option>';
        }

        return $row;
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
}
