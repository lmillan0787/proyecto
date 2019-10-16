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
        }else{
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
                'Dirijase al módulo de participaciones para editar o seleccione otro evento disponible',
                'error'
               );  
               </script>
               ";
            }
        }
    }
    public function tabla_deportista()
    {

        $row = deportistaModelo::consultar_deportista();
        foreach ($row as $row) {
            if ($row['cod_nac'] == 1) {
                $row['cod_nac'] = 'Venezolano';
            } else {
                $row['cod_nac'] = 'Extranjero';
            }
            echo '
            <tr>
                    <td>' . $row['cod_per'] . '</td>
                    <td>' . $row['nom'] . '</td>
                    <td>' . $row['ape'] . '</td>
                    <td>' . $row['ced'] . '</td>
                    <td>' . $row['des_gen'] . '</td>
                    <td>' . $row['des_reg'] . '</td>
                    <td>' . $row['edad'] . '</td>
                     <td>
                    <form class="" action="' . SERVERURL . 'editarPersona" method="POST" enctype="multipart/form-data">
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

    public function consultarRegion()
    {
        $consultaRegion = mainModel::conectar()->prepare("SELECT * FROM tab_reg ");
        $consultaRegion->execute();
        $row = $consultaRegion->fetchAll(PDO::FETCH_ASSOC);
        echo '<select name="cod_reg" id="selreg" class="form-control">';
        foreach ($row as $row) {
            echo '<option value="' . $row['cod_reg'] . '">' . $row['des_reg'] . '</option>';
        }

        echo '</select>';
    }

    public function consultarPueblo()
    {
        $consultarPueblo = mainModel::conectar()->prepare("SELECT * FROM tab_pue ");
        $consultarPueblo->execute();
        $row = $consultarPueblo->fetchAll(PDO::FETCH_ASSOC);
        echo '<select name="cod_pue" id="selpue" class="form-control">';
        foreach ($row as $row) {
            echo '<option value="' . $row['cod_pue'] . '">' . $row['des_pue'] . '</option>';
        }
        echo '</select>';
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
        $consultarEvento = mainModel::conectar()->prepare("SELECT cod_even,des_even FROM dat_even ");
        $consultarEvento->execute();
        $row = $consultarEvento->fetchAll(PDO::FETCH_ASSOC);
        echo '<select name="cod_even" id="seleven" class="form-control">';
        foreach ($row as $row) {
            echo '<option value="' . $row['cod_even'] . '">' . $row['des_even'] . '</option>';
        }

        echo '</select>';
    }


    public function consultarDisciplina()
    {
        $consultarDisciplina = mainModel::conectar()->prepare("SELECT cod_dis,des_dis FROM tab_dis ");
        $consultarDisciplina->execute();
        $row = $consultarDisciplina->fetchAll(PDO::FETCH_ASSOC);
        echo '<select name="cod_dis" id="seldis" class="form-control">';
        foreach ($row as $row) {
            echo '<option value="' . $row['cod_dis'] . '">' . $row['des_dis'] . '</option>';
        }

        echo '</select>';
    }


    public function consultarCategoria()
    {
        $consultarCategoria = mainModel::conectar()->prepare("SELECT cod_cat,des_cat FROM tab_cat ");
        $consultarCategoria->execute();
        $row = $consultarCategoria->fetchAll(PDO::FETCH_ASSOC);
        echo '<select name="cod_cat" id="seldis" class="form-control">';
        foreach ($row as $row) {
            echo '<option value="' . $row['cod_cat'] . '">' . $row['des_cat'] . '</option>';
        }

        echo '</select>';
    }
}
