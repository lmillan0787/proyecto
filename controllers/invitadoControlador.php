<?php

if ($peticionAjax) {
    require_once "../models/invitadoModelo.php";
} else {
    require_once "./models/invitadoModelo.php";
}

class invitadoControlador extends invitadoModelo
{
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function agregar_invitado_controlador()
    {
        $ced = mainModel::limpiar_cadena($_POST['ced']);
        $cod_even = mainModel::limpiar_cadena($_POST['cod_even']);
        $cod_perf = mainModel::limpiar_cadena($_POST['cod_perf']);

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
                'cod_perf' => $cod_perf
            ];
            $validarParticipacion = mainModel::validar_participacion_modelo($datosPart);
            if ($validarParticipacion->rowCount() >= 1) {
                echo "
               <script>
               Swal.fire(
                'La persona ya posee participacion para este evento',
                'Dirijase al módulo de participaciones para editar o seleccione un evento diferente',
                'error'
               );     
               
               </script>
               ";
            } else {
                $registrarInvitado = invitadoModelo::agregar_invitado($datosPart);
                $img = $_POST['image'];
                $folderPath = "../views/assets/upload/";

                $image_parts = explode(";base64,", $img);
                $image_type_aux = explode("image/", $image_parts[0]);
                $image_type = $image_type_aux[1];

                $image_base64 = base64_decode($image_parts[1]);
                $fileName = $_POST['ced'] . '.jpg';

                $file = $folderPath . $fileName;
                file_put_contents($file, $image_base64);

                print_r($fileName);
                if ($registrarInvitado->rowCount() >= 1) {
                    echo "
               <script>
               Swal.fire(
                'Registro exitoso',
                'Exito al agregar la participación',
                'success'
               ).then(function(){
                window.location='" . SERVERURL . "invitados/';
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
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function tabla_invitado()
    {

        $row = invitadoModelo::consultar_invitado();
        foreach ($row as $row) {
            echo '
            <tr>
                    <td>' . $row['cod_par'] . '</td>
                    <td>' . $row['nom'] . '</td>
                    <td>' . $row['ape'] . '</td>
                    <td>' . $row['ced'] . '</td>
                    <td>' . $row['des_gen'] . '</td>
                    <td>' . $row['edad'] . '</td>
                    <td>' . $row['des_perf'] . '</td>
                    <td>' . $row['des_even'] . '</td>
                    <td>
                        <form action="'.SERVERURL.'ajax/invitadoFpdfAjax.php" method="POST" target="_blank" rel="noopener noreferrer">                            
                            <input type="text" name="cedula" value="' . $row['ced'] . '" hidden>                            
                            <input type="text" name="perfil" value="' . $row['des_perf'] . '"hidden>
                            <input type="text" name="nombre" value="' . $row['nom'] . '" hidden>
                            <input type="text" name="apellido" value="' . $row['ape'] . '" hidden>
                            <input type="text" name="edad" value="' . $row['edad'] . '" hidden>
                            <input type="text" name="genero"  value="' . $row['des_gen'] . '" hidden>    
                            <input type="text" name="des_even"  value="' . $row['des_even'] . '" hidden>        
                            <button type="submit" class="btn btn-warning btn-md">
                                <i class="far fa-address-card fa-2x"></i>                            
                            </button>
                        </form>                    
                    </td>
                    <td>
                    <form class="" action="' . SERVERURL . 'editarPersona" method="POST" enctype="multipart/form-data">
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
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
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
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
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
