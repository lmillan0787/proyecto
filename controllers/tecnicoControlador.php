<?php

if ($peticionAjax) {
    require_once "../models/tecnicoModelo.php";
} else {
    require_once "./models/tecnicoModelo.php";
}

class tecnicoControlador extends tecnicoModelo
{
    public function agregar_tecnico_controlador()
    {

        $ced = mainModel::limpiar_cadena($_POST['ced']);
        $cod_even = mainModel::limpiar_cadena($_POST['cod_even']);
        $cod_perf = mainModel::limpiar_cadena($_POST['cod_perf']);
        $cod_carg = mainModel::limpiar_cadena($_POST['cod_carg']);
        $cod_inst = mainModel::limpiar_cadena($_POST['cod_inst']);;


        $validarCedula = mainModel::validar_cedula_modelo($ced);
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
                'cod_inst' => $cod_inst,
                'cod_carg' => $cod_carg

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
                $registrarTecnico = tecnicoModelo::agregar_tecnico($datosPart);
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

                    if ($registrarTecnico->rowCount() >= 1) {
                        echo "
               <script>
               Swal.fire(
                'Registro exitoso',
                'Exito al agregar la participación',
                'success'
               ).then(function(){
                window.location='" . SERVERURL . "tecnicos/';
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



    public function tabla_tecnico()
    {
        $n=0;
        $row = tecnicoModelo::consultar_tecnico();
        foreach ($row as $row) {
            $n++;
            echo '
            <tr>
                <td>' . $n . '</td>
                <td>' . $row['ced'] . '</td>
                <td>' . $row['nom'] . '</td>
                <td>' . $row['ape'] . '</td>
                <td>' . $row['des_carg'] . '</td>
                <td>' . $row['fec_even'] . '</td>
                <td>' . $row['des_inst'] . '</td>
                <td>' . $row['des_even'] . '</td>
                <td>
                        <form action="' . SERVERURL . 'ajax/tecnicoFpdfAjax.php" method="POST" target="_blank" rel="noopener noreferrer">                            
                            <input type="text" name="cedula" value="' . $row['ced'] . '" hidden>           
                            <input type="text" name="nombre" value="' . $row['nom'] . '" hidden>
                            <input type="text" name="apellido" value="' . $row['ape'] . '" hidden>
                            <input type="text" name="des_carg" value="' . $row['des_carg'] . '" hidden>
                            <input type="text" name="fec_even"  value="' . $row['fec_even'] . '" hidden>
                            <input type="text" name="des_inst"  value="' . $row['des_inst'] . '" hidden> 
                            <input type="text" name="des_even"  value="' . $row['des_even'] . '" hidden>       
                            <input type="text" name="siglas"  value="' . $row['siglas'] . '" hidden>       
                            <button type="submit" class="btn btn-warning btn-md">
                                <i class="far fa-address-card fa-2x"></i>                            
                            </button>
                        </form>                    
                    </td>
                <td><form class="" action="' . SERVERURL . 'editarPersona" method="POST" enctype="multipart/form-data">
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








    public function consultarCargo()
    {

        $row = tecnicoModelo::consultaCargo();

        foreach ($row as $row) {

            echo '<option  value="' . $row['cod_carg'] . '" >' . $row['des_carg'] . '</option>';
        }

        return $row;
    }

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
